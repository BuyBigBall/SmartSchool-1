<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Syllabus extends Student_Controller {

    public function __construct() {
        parent::__construct();
        $this->sch_setting_detail=$this->setting_model->getSetting();
        $this->start_weekday=strtolower($this->sch_setting_detail->start_week);
    } 

    public function index() {
        $this->session->set_userdata('top_menu', 'syllabus');


        $monday = strtotime("last ".$this->start_weekday);
        $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
        $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
        $this_week_start = date("Y-m-d", $monday);
        $this_week_end = date("Y-m-d", $sunday);
        $data['this_week_start'] = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($this_week_start));
        $data['this_week_end'] = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($this_week_end));

        $this->load->view('layout/student/header', $data);
        $this->load->view('user/syllabus/syllabus', $data);
        $this->load->view('layout/student/footer', $data);
    }

   

    public function get_weekdates() {

        $this->session->set_userdata('top_menu', 'Time_table');
        $this_week_start = $this->customlib->dateFormatToYYYYMMDD($_POST['date']);
        $prev_week_start = date("Y-m-d", strtotime('last '.$this->start_weekday, strtotime($this_week_start)));
        $next_week_start = date("Y-m-d", strtotime('next '.$this->start_weekday, strtotime($this_week_start)));
        $this_week_end = date( "Y-m-d", strtotime($this_week_start." +6 day"));
        $data['this_week_start'] = $this->customlib->dateformat($this_week_start);
        $data['this_week_end'] = $this->customlib->dateformat($this_week_end);
        $data['prev_week_start'] = $this->customlib->dateformat($prev_week_start);
        $data['next_week_start'] = $this->customlib->dateformat($next_week_start);
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        $days = $this->customlib->getDaysname();
        $days_record = array();
        $student_data = $this->syllabus_model->get_studentsyllabus($student_current_class);
        $data['student_data'] = $student_data;
        foreach ($days as $day_key => $day_value) {
            $days_record[$day_key] = $day_value;
        }
        $data['timetable'] = $days_record;
        $this->load->view('user/syllabus/_get_weekdates', $data);
    }

    public function get_subject_syllabus() {
        $data['subject_syllabus_id'] = $_POST['subject_syllabus_id'];
        $data['result'] = $this->syllabus_model->get_subject_syllabus_student($data);
        $this->load->view('user/syllabus/_get_subject_syllabus', $data);
    }

    public function check_subject_syllabus($subject_group_subject_id, $date, $time_from, $time_to, $subject_group_class_section_id) {
        $data['subject_group_subject_id'] = $subject_group_subject_id;
        $data['date'] = $date;
        $data['time_from'] = $time_from;
        $data['time_to'] = $time_to;
        $data['subject_group_class_section_id'] = $subject_group_class_section_id;
        $data['result'] = $this->syllabus_model->get_subject_syllabus_student($data);

        $this->load->view('user/syllabus/_get_subject_syllabus', $data);
    }

    public function download($doc) {
        $this->load->helper('download');
        $filepath = "./uploads/syllabus_attachment/" . $this->uri->segment(4);
        // $filepath = $this->uri->segment(4);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(4);
        force_download($name, $data);
    }

    public function lacture_video_download($doc) {
        $this->load->helper('download');
        $filepath = "./uploads/syllabus_attachment/lacture_video/" . $this->uri->segment(4);

        $data = file_get_contents($filepath);
        $name = $this->uri->segment(4);
        force_download($name, $data);
    }

    public function status() {
        $this->session->set_userdata('top_menu', 'syllabus/status');
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);


        $subjects = $this->syllabus_model->getmysubjects($student_current_class->class_id, $student_current_class->section_id);

        foreach ($subjects as $key => $value) {
            $show_status = 0;
            $teacher_summary = array();
            $lesson_result = array();
            $complete = 0;
            $incomplete = 0;
            $array[] = $value;
            $subject_details = $this->syllabus_model->get_subjectstatus($value->subject_group_subjects_id, $value->subject_group_class_sections_id);
            if ($subject_details[0]->total != 0) {

                $complete = ($subject_details[0]->complete / $subject_details[0]->total) * 100;
                $incomplete = ($subject_details[0]->incomplete / $subject_details[0]->total) * 100;
                if ($value->code == '') {
                    $lebel = $value->name;
                } else {
                    $lebel = $value->name . ' (' . $value->code . ')';
                }
                $data['subjects_data'][$value->subject_group_subjects_id] = array(
                    'lebel' => $lebel,
                    'complete' => round($complete),
                    'incomplete' => round($incomplete),
                    'id' => $value->subject_group_subjects_id . '_' . $value->code,
                    'total' => $subject_details[0]->total,
                    'name' => $value->name
                );
            } else {

                $data['subjects_data'][$value->subject_group_subjects_id] = array(
                    'lebel' => $value->name . ' (' . $value->code . ')',
                    'complete' => 0,
                    'incomplete' => 0,
                    'id' => $value->subject_group_subjects_id . '_' . $value->code,
                    'total' => 0,
                    'name' => $value->name
                );
            }

            $syllabus_report = $this->syllabus_model->get_subjectsyllabussreport($value->subject_group_subjects_id, $value->subject_group_class_sections_id);

            $lesson_result = array();
            foreach ($syllabus_report as $syllabus_reportkey => $syllabus_reportvalue) {

                $topic_data = array();
                $topic_result = $this->syllabus_model->get_topicbylessonid($syllabus_reportvalue['id']);
                $topic_complete = 0;
                foreach ($topic_result as $topic_resultkey => $topic_resultvalue) {
                    if ($topic_resultvalue['status'] == 1) {
                        $topic_complete++;
                    }

                    $topic_data[] = array('name' => $topic_resultvalue['name'], 'status' => $topic_resultvalue['status'], 'complete_date' => $topic_resultvalue['complete_date']);
                }
                $total_topic = count($topic_data);
                if ($total_topic > 0) {
                    $incomplete_percent = round((($total_topic - $topic_complete) / $total_topic) * 100);
                    $complete_percent = round(($topic_complete / $total_topic) * 100);
                } else {
                    $incomplete_percent = 0;
                    $complete_percent = 0;
                }

                $show_status = 1;
                $lesson_result[] = array('name' => $syllabus_reportvalue['name'], 'topics' => $topic_data, 'incomplete_percent' => $incomplete_percent, 'complete_percent' => $complete_percent);
            }

            $data['subjects_data'][$value->subject_group_subjects_id]['lesson_summary'] = $lesson_result;
        }


        $data['status'] = array('1' => $this->lang->line('complete'), '0' => $this->lang->line('incomplete'));

        $this->load->view('layout/student/header', $data);
        $this->load->view('user/syllabus/status', $data);
        $this->load->view('layout/student/footer', $data);
    }

}

?>