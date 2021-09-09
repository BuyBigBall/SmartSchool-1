<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Onlineexam extends Student_Controller
{

    public function __construct()
    {
        parent::__construct();
         $this->config->load("mailsms");
    }

    public function index()
    {
        $data = array();
        $this->session->set_userdata('top_menu', 'Onlineexam');

        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student_session_id    = $student_current_class->student_session_id;

        $onlineexam         = $this->onlineexam_model->getStudentexam($student_session_id);
        $data['onlineexam'] = $onlineexam;
        $this->load->view('layout/student/header');
        $this->load->view('user/onlineexam/onlineexamlist', $data);
        $this->load->view('layout/student/footer');
    }

    public function view($id)
    {
        $data = array();
        $this->session->set_userdata('top_menu', 'Onlineexam');
        $role                        = $this->customlib->getUserRole();
        $data['role']                = $role;
        $student_current_class       = $this->customlib->getStudentCurrentClsSection();
        $student_session_id          = $student_current_class->student_session_id;
        $online_exam_validate        = $this->onlineexam_model->examstudentsID($student_session_id, $id);
        
        $data['question_true_false'] = $this->config->item('question_true_false');
        $exam                        = $this->onlineexam_model->get($id);
        $data['exam']                = $exam;
        $questionOpt                 = $this->customlib->getQuesOption();
        $data['questionOpt']         = $questionOpt;

        if (!empty($online_exam_validate)) {

            $data['question_result'] = $this->onlineexamresult_model->getResultByStudent($online_exam_validate->id, $online_exam_validate->onlineexam_id);
            $data['result_prepare']  = $this->onlineexamresult_model->checkResultPrepare($online_exam_validate->id);

        } 
        $data['online_exam_validate'] = $online_exam_validate;
       // echo "<pre>"; print_r($data);  echo "<pre>";die;
        $this->load->view('layout/student/header');
        $this->load->view('user/onlineexam/view', $data);
        $this->load->view('layout/student/footer');
    }

      public function print()
    {
        $data = array();
        $exam_id=$this->input->post('exam_id');
        $role                        = $this->customlib->getUserRole();
        $data['role']                = $role;
        $student_current_class       = $this->customlib->getStudentCurrentClsSection();
        $student_session_id          = $student_current_class->student_session_id;
        $online_exam_validate        = $this->onlineexam_model->examstudentsID($student_session_id, $exam_id);
        $data['question_true_false'] = $this->config->item('question_true_false');
        $exam                        = $this->onlineexam_model->get($exam_id);
        $data['exam']                = $exam;
        $questionOpt                 = $this->customlib->getQuesOption();
        $data['questionOpt']         = $questionOpt;

        if (!empty($online_exam_validate)) {

            $data['question_result'] = $this->onlineexamresult_model->getResultByStudent($online_exam_validate->id, $online_exam_validate->onlineexam_id);
            $data['result_prepare']  = $this->onlineexamresult_model->checkResultPrepare($online_exam_validate->id);

        }
        $data['online_exam_validate'] = $online_exam_validate;
        $data['page']=$this->load->view('user/onlineexam/_print', $data,true);
        echo json_encode(array('status' => 1, 'page' => $data['page']));
    }

    public function save()
    {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $total_rows = $this->input->post('total_rows');

            if (!empty($total_rows)) {
                $save_result = array();
                foreach ($total_rows as $row_key => $row_value) {
                    if (($_POST['question_type_' . $row_value]) == "singlechoice") {

                        if (isset($_POST['radio' . $row_value])) {
                            $save_result[] = array(
                                'onlineexam_student_id'  => $this->input->post('onlineexam_student_id'),
                                'onlineexam_question_id' => $this->input->post('question_id_' . $row_value),
                                'select_option'          => $_POST['radio' . $row_value],
                            );
                        }
                    } elseif (($_POST['question_type_' . $row_value]) == "true_false") {
                        # code...
                        if (isset($_POST['radio' . $row_value])) {
                            $save_result[] = array(
                                'onlineexam_student_id'  => $this->input->post('onlineexam_student_id'),
                                'onlineexam_question_id' => $this->input->post('question_id_' . $row_value),
                                'select_option'          => $_POST['radio' . $row_value],
                            );
                        }
                    } elseif (($_POST['question_type_' . $row_value]) == "multichoice") {
                        # code...
                        if (isset($_POST['checkbox' . $row_value])) {
                            $save_result[] = array(
                                'onlineexam_student_id'  => $this->input->post('onlineexam_student_id'),
                                'onlineexam_question_id' => $this->input->post('question_id_' . $row_value),
                                'select_option'          => json_encode($_POST['checkbox' . $row_value]),
                            );
                        }
                    } elseif (($_POST['question_type_' . $row_value]) == "descriptive") {
                        # code...
                        if (isset($_POST['answer' . $row_value])) {
                            $save_result[] = array(
                                'onlineexam_student_id'  => $this->input->post('onlineexam_student_id'),
                                'onlineexam_question_id' => $this->input->post('question_id_' . $row_value),
                                'select_option'          => $_POST['answer' . $row_value],
                            );
                        }
                    }

                }

                $this->onlineexamresult_model->add($save_result);
                $this->onlineexam_model->updateExamResult($this->input->post('onlineexam_student_id')); 
                redirect('user/onlineexam', 'refresh');
            }
        } else {

        }
    }

    public function startexam____($id)
    {
        $data = array();
        $this->session->set_userdata('top_menu', 'Hostel');
        $this->session->set_userdata('sub_menu', 'hostel/index');
        $questionOpt          = $this->customlib->getQuesOption();
        $data['questionOpt']  = $questionOpt;
        $onlineexam_question  = $this->onlineexam_model->getExamQuestions($id);
        $data['examquestion'] = $onlineexam_question;
        $this->load->view('layout/student/header');
        $this->load->view('user/onlineexam/startexam', $data);
        $this->load->view('layout/student/footer');
    }

    public function getExamForm()
    {
        $data            = array();
        $question_status = 0;
        $recordid        = $this->input->post('recordid');
        $exam            = $this->onlineexam_model->get($recordid);
        $data['exam']                  = $exam;
       
        $data['questions']             = $this->onlineexam_model->getExamQuestions($recordid,$exam->is_random_question);

        $student_current_class         = $this->customlib->getStudentCurrentClsSection();
        $student_session_id            = $student_current_class->student_session_id;
        $onlineexam_student            = $this->onlineexam_model->examstudentsID($student_session_id, $exam->id);
        $data['onlineexam_student_id'] = $onlineexam_student;
        $getStudentAttemts             = $this->onlineexam_model->getStudentAttemts($onlineexam_student->id);
        $data['question_status'] = 0;
        $data['exam_duration']=$exam->duration;
        if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date($exam->exam_to))) {
            $question_status         = 1;
            $data['question_status'] = 1;
        } else if ($exam->attempt > $getStudentAttemts) {
            $this->onlineexam_model->addStudentAttemts(array('onlineexam_student_id' => $onlineexam_student->id));
        } else {
            $question_status         = 1;
            $data['question_status'] = 1;
        }

        $questionOpt         = $this->customlib->getQuesOption();
        $data['questionOpt'] = $questionOpt;
        $pag_content         = $this->load->view('user/onlineexam/_searchQuestionByExamID', $data, true);
        
        $total_remaining_seconds = round((strtotime($exam->exam_to) - strtotime(date('Y-m-d H:i:s')))/3600*60*60, 1);
        $exam_duration=($total_remaining_seconds < getSecondsFromHMS($exam->duration)) ? getHMSFromSeconds($total_remaining_seconds) : $exam->duration;

        echo json_encode(array('status' => 0, 'exam' => $exam, 'duration' =>$exam_duration,'page' => $pag_content, 'question_status' => $question_status,'total_question'=>count($data['questions'])));
    }
}