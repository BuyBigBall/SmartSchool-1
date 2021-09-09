<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Alumni extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->config->load('app-config');
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->library('encoding_lib');
    }

    public function alumnilist() {
        if (!$this->rbac->hasPrivilege('manage_alumni', 'can_view')) {
            access_denied();
        }
        $data = array();
        $data['sessionlist'] = $this->session_model->get();
        $this->session->set_userdata('top_menu', 'alumni');
        $this->session->set_userdata('sub_menu', 'alumni/alumnilist');
        $class = $this->class_model->get();
        $data['classlist'] = $class;

        $data['title'] = 'Alumni Student';
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting'] = $this->sch_setting_detail;
        $data['fields'] = $this->customfield_model->get_custom_fields('students', 1);
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['session_id'] = $session_id = "";
        $userdata = $this->customlib->getUserData();
        $carray = array();
        $alumni_student = $this->alumni_model->get();
        $alumni_studets = array();
        foreach ($alumni_student as $key => $value) {
            $alumni_studets[$value['student_id']] = $value;
        }
        $data['alumni_studets'] = $alumni_studets;
        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/alumni/alumnilist', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search = $this->input->post('search');
            $search_text = $this->input->post('search_text');
            $data['session_id'] = $session_id = $this->input->post('session_id');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                    if ($this->form_validation->run() == false) {
                        
                    } else {
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');
                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->search_alumniStudent($class, $section, $session_id);
                        $data['resultlist'] = $resultlist;
                    }
                } else if ($search == 'search_full') {
                    $data['searchby'] = "text";

                    $data['search_text'] = trim($this->input->post('search_text'));
                    $resultlist = $this->student_model->search_alumniStudentbyAdmissionNo($search_text, $carray);
                    $data['resultlist'] = $resultlist;
                }
            }
            $data['sch_setting'] = $this->sch_setting_detail;
            $this->load->view('layout/header');
            $this->load->view('admin/alumni/alumnilist', $data);
            $this->load->view('layout/footer');
        }
    }

    public function get_alumnidetails() {
        $student_id = $_POST['student_id'];
        $data = $this->alumni_model->get_alumnidetail($student_id);

        if (empty($data)) {

            $data = array(
                'id' => '',
                'current_email' => '',
                'current_phone' => '',
                'occupation' => '',
                'address' => '',
                'student_id' => '');
        }

        echo json_encode($data);
    }

    public function add() {

        $this->form_validation->set_rules('current_phone', $this->lang->line('current_phone'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');

        if ($this->form_validation->run() == false) {

            $msg = array(
                'current_phone' => form_error('current_phone'),
                'file' => form_error('file'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $data = array(
                'current_email' => $this->input->post('current_email'),
                'current_phone' => $this->input->post('current_phone'),
                'occupation' => $this->input->post('occupation'),
                'address' => $this->input->post('address'),
                'student_id' => $this->input->post('student_id'),
                'id' => $this->input->post('id'),
            );

            $insert_id = $this->alumni_model->add($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/alumni_student_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'photo' => 'uploads/alumni_student_images/' . $img_name);
                $this->alumni_model->add($data_img);
            }
         
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }

        echo json_encode($array);
    }

    public function handle_upload() {

        $image_validate = $this->config->item('image_validate');
        $result = $this->filetype_model->get();
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {

            $file_type = $_FILES["file"]['type'];
            $file_size = $_FILES["file"]["size"];
            $file_name = $_FILES["file"]["name"];

           $allowed_extension = array_map('trim', array_map('strtolower', explode(',', $result->image_extension)));
            $allowed_mime_type = array_map('trim', array_map('strtolower', explode(',', $result->image_mime)));
            $ext               = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if ($files = @getimagesize($_FILES['file']['tmp_name'])) {

                if (!in_array($files['mime'], $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', 'File Type Not Allowed');
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', 'Extension Not Allowed');
                    return false;
                }
               if ($file_size > $result->image_size) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }
            } else {
                // $this->form_validation->set_message('handle_upload', "File Type / Extension Error Uploading  Image");
                //  return false;
            }

            return true;
        }
        return true;
    }

    public function events() {

        if (!$this->rbac->hasPrivilege('events', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Event List';
        $data['sessionlist'] = $this->session_model->get();
        $eventlist = $this->alumni_model->getevents();

        foreach ($eventlist as $key => $class) {
            if (!empty($class['class_id'])) {

                $eventclasslist = $this->class_model->getAll($class['class_id']);
                $eventclass[$key] = $eventclasslist['class'];
                $eventsection[$key] = $this->class_model->get_section($class['class_id']);
                $sessionlist = $this->session_model->get($class['session_id']);
                $eventsession[$key] = $sessionlist['session'];
            } else {
                $eventclass[$key] = '';
                $eventsection[$key] = '';
                $eventsession[$key] = '';
            }
        }

        $data['eventlist'] = $eventlist;
        if (!empty($eventclass)) {
            $data['eventclass'] = $eventclass;
        }
        if (!empty($eventsection)) {
            $data['eventsection'] = $eventsection;
        }
        if (!empty($eventsession)) {
            $data['eventsession'] = $eventsession;
        }


        $data['classlist'] = $this->class_model->get();
        $this->session->set_userdata('top_menu', 'alumni');
        $this->session->set_userdata('sub_menu', 'alumni/event');
        $this->load->view("layout/header.php");
        $this->load->view("admin/alumni/events.php", $data);
        $this->load->view("layout/footer.php");
    }

    public function add_event() {

        $this->form_validation->set_rules('event_title', $this->lang->line('event') . " " . $this->lang->line('title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('from_date', $this->lang->line("event").''.$this->lang->line("from").' '.$this->lang->line("date"), 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_date', $this->lang->line("event").''.$this->lang->line("to").' '.$this->lang->line("date"), 'trim|required|xss_clean');


        $studentclass = $this->input->post('event_for');
        if ($studentclass == 'class') {
            $this->form_validation->set_rules('session_id', $this->lang->line("pass_out_session"), 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', $this->lang->line("class"), 'trim|required|xss_clean');
            $this->form_validation->set_rules('user[]', $this->lang->line("section"), 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == false) {
            $msg = array(
                'event_title' => form_error('event_title'),
                'from_date' => form_error('from_date'),
				'to_date' => form_error('to_date'),
            );
            if ($studentclass == 'class') {
                $msg1 = array(
                    'class_id' => form_error('class_id'),
                    'user' => form_error('user[]'),
                    'session_id' => form_error('session_id'),
                );
            }
            if (!empty($msg1)) {
                $error_msg = array_merge($msg, $msg1);
            } else {
                $error_msg = $msg;
            }

            $array = array('status' => 'fail', 'error' => $error_msg, 'message' => '');
        } else {
            $section = json_encode($this->input->post('user'));



            $event_starting_date = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('from_date')));
            $event_end_date = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('to_date')));

            $data = array(
                'id' => $this->input->post('id'),
                'title' => $this->input->post('event_title'),
                'event_for' => $this->input->post('event_for'),
                'session_id' => $this->input->post('session_id'),
                'class_id' => $this->input->post('class_id'),
                'section' => json_encode($this->input->post('user')),
                'from_date' => $event_starting_date,
                'to_date' => $event_end_date,
                'note' => $this->input->post('note'),
                'event_notification_message' => $this->input->post('event_notification_message'),
            );

            $insert_id = $this->alumni_model->add_event($data);
            $email = $this->input->post('email');
            $sms = $this->input->post('sms');
            $subject = $this->input->post('event_title');
            $body = $this->input->post('event_notification_message');

            $email_value = 'no';
            $sms_value = 'no';

            if ($email != '') {
                $email_value = 'yes';
            }
            if ($sms != '') {
                $sms_value = 'yes';
            }
            $studentclass = $this->input->post('event_for');

            if ($studentclass == 'class') {
                $usersection = $this->input->post('user');
                foreach ($usersection as $section) {
                    $alumniStudent = $this->alumni_model->alumniMail($this->input->post('class_id'), $this->input->post('session_id'), $section);
                    foreach ($alumniStudent as $alumniStudent_value) {

                        $sender_details = array('student_id' => $insert_id, 'contact_no' => $alumniStudent_value['current_phone'], 'email' => $alumniStudent_value['current_email'], 'email_value' => $email_value, 'sms_value' => $sms_value, 'subject' => $subject, 'body' => $body, 'from_date' => $this->input->post('from_date'), 'to_date' => $this->input->post('to_date'));

                        $this->mailsmsconf->mailsmsalumnistudent($sender_details);
                    }
                }
            } else {
                $alumniStudent = $this->alumni_model->get();
                foreach ($alumniStudent as $alumniStudent_value) {

                    $sender_details = array('student_id' => $insert_id, 'contact_no' => $alumniStudent_value['current_phone'], 'email' => $alumniStudent_value['current_email'], 'email_value' => $email_value, 'sms_value' => $sms_value, 'subject' => $subject, 'body' => $body, 'from_date' => $this->input->post('from_date'), 'to_date' => $this->input->post('to_date'));

                    $this->mailsmsconf->mailsmsalumnistudent($sender_details);
                }
            }




            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/alumni_event_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'photo' => 'uploads/alumni_event_images/' . $img_name);
                $this->alumni_model->add_event($data_img);
            }

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }

        echo json_encode($array);
    }

    public function get_event($id) {
        $data = $this->alumni_model->get_eventbyid($id);
        $data['from_date'] = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($data['from_date']));
        $data['to_date'] = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($data['to_date']));
        echo json_encode($data);
    }

    public function delete_event($id) {
        $this->alumni_model->delete_event($id);
    }

    public function getevent() {

        $year = $this->input->get('year');
        $month = $this->input->get('month');

        $result = array();
        $new_date = "01-" . $month . "-" . $year;
        $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $first_day_this_month = date('01-m-Y');
        $fst_day_str = strtotime(date('d-m-Y', strtotime($new_date)));
        $array = array();
        for ($day = 1; $day <= $totalDays; $day++) {
            $date = date('Y-m-d', $fst_day_str);

            $events = $event = $this->alumni_model->get_eventbydate($date);

            if (!empty($events)) {
                $body = "";
                $counter = 0;
                //===========
                foreach ($events as $event_key => $event_value) {
                    $counter++;

                    if ($event_value['photo'] != '') {
                        $event_image = base_url() . $event_value['photo'];
                    } else {
                        $event_image = base_url() . 'uploads/student_images/no_image.png';
                    }

                    $body .= "<div>
    <div class='file-text'><i class='fa fa-calendar'></i></div>
     <div class='file-right'><h3 class='info-title2'>" . $event_value['title'] . "</h3>
      <div class='font12 minus8'><i class='fa fa-clock-o'></i> " . date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($event_value['from_date'])) . " To " . date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($event_value['to_date'])) . "</div>
       </div>
     <p>" . $event_value['note'] . "</p>
     <div class='divi'></div>
    </div>";
                }

                //===========
                $s = array();
                $s['date'] = $date;
                $s['badge'] = false;
                $s['title'] = $this->lang->line('alumni') . " " . $this->lang->line('event') . " " . $this->lang->line('for') . " " . date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($event_value['from_date']));
                $s['body'] = $body;
                $s['footer'] = $this->lang->line('total') . " " . $this->lang->line('events') . ": " . $counter;

                $s['classname'] = "grade-2";

                $array[] = $s;
            }
            $fst_day_str = ($fst_day_str + 86400);
        }
        if (!empty($array)) {
            echo json_encode($array);
        } else {
            echo false;
        }
    }

    public function deletestudent($id) {
        $this->alumni_model->deletestudent($id);
    }

}
