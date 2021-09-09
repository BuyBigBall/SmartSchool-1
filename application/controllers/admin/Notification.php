<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Notification extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('notice_board', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Communicate');
        $this->session->set_userdata('sub_menu', 'notification/index');
        $data['title'] = 'Notifications';

        $notifications = $this->notification_model->get();
        $user_role           = json_decode($this->customlib->getStaffRole());
        $userdata            = $this->customlib->getUserData();
        $role_id             = $userdata["role_id"];
        $user_id             = $userdata["id"];
        $data["user_id"]     = $user_id;
        $notification_status = false;
        if (!empty($notifications)) {
            foreach ($notifications as $key => $value) {
                $created_by_name = $this->notification_model->getcreatedByName($value["created_id"]);
                $roles           = $value["roles"];
                $arr             = explode(",", $roles);

                if ($user_role->name == "Super Admin") {

                    $rname                                            = $this->notification_model->getSection($arr);
                    $data['notificationlist'][$key]                   = $notifications[$key];
                    $data['notificationlist'][$key]["role_name"]      = $rname;
                    $data['notificationlist'][$key]["createdby_name"] = $created_by_name["name"] . " " . $created_by_name["surname"];
                    $notification_status                              = true;
                } elseif ((in_array($role_id, $arr)) && ($value["created_id"] == $user_id)) {

                    $notification_status                              = true;
                    $rname                                            = $this->notification_model->getSection($arr);
                    $data['notificationlist'][$key]                   = $notifications[$key];
                    $data['notificationlist'][$key]["role_name"]      = $rname;
                    $data['notificationlist'][$key]["createdby_name"] = $created_by_name["name"] . " " . $created_by_name["surname"];
                } elseif ((in_array($role_id, $arr)) && (date($this->customlib->getSchoolDateFormat()) >= date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($value['publish_date'])))) {

                    $notification_status                              = true;
                    $rname                                            = $this->notification_model->getSection($arr);
                    $data['notificationlist'][$key]                   = $notifications[$key];
                    $data['notificationlist'][$key]["role_name"]      = $rname;
                    $data['notificationlist'][$key]["createdby_name"] = $created_by_name["name"] . " " . $created_by_name["surname"];
                }
                $data['notificationlist'][$key]['attached_file']  =  $value["attached_file"];
                $data['notificationlist'][$key]['filename']  =  $value["filename"];
           }
        }
        if (!$notification_status) {
            $data['notificationlist'] = array();
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/notification/notificationList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add()
    {
        if (!$this->rbac->hasPrivilege('notice_board', 'can_add')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Communicate');
        $this->session->set_userdata('sub_menu', 'notification/add');
        $data['title']      = 'Add Notification';
        $data['title_list'] = 'Notification List';
        $data['roles']      = $this->role_model->get();

        $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', $this->lang->line('message'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('publish_date', $this->lang->line('publish_date'), 'trim|required|xss_clean');
        //$this->form_validation->set_rules('visible[]', $this->lang->line('message_to'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id[]', $this->lang->line('section'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

        } else {

            $userdata    = $this->customlib->getUserData();
            $student     = "No";
            $staff       = "No";
            $parent      = "No";
            $staff_roles = array();

            //---------------> uploaded file process 2021.07.16
            // $visible     = $this->input->post('visible');
            // foreach ($visible as $key => $value) {

            //     if ($value == "student") {
            //         $student = "Yes";
            //     } else if ($value == "parent") {
            //         $parent = "Yes";
            //     } else if (is_numeric($value)) {

            //         $staff_roles[] = array('role_id' => $value, 'send_notification_id' => '');
            //         $staff         = "Yes";
            //     }
            // }
            $section_ids = $this->input->post('section_id');
            foreach ($section_ids as $key => $value) {
                if (is_numeric($value) && $value>0) 
                {
                    $staff_roles[] = array('role_id' => $value, 'send_notification_id' => '');
                    //$staff         = "Yes";
                }
            }       
            
            $upload = false;
            {
                if (isset($_FILES["attached_file"]) && !empty($_FILES['attached_file']['name'])) {
                    $time     = md5($_FILES["attached_file"]['name'] . microtime());
                    $fileInfo = pathinfo($_FILES["attached_file"]["name"]);
                    $save_name = $time . '.' . $fileInfo['extension'];


                    $upload = move_uploaded_file($_FILES["attached_file"]["tmp_name"], "./uploads/notice_attached/" . $save_name);
                }
            }
            //<----------------
            $data = array(
                'message'         => $this->input->post('message'),
                'title'           => $this->input->post('title'),
                'date'            => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'created_by'      => $userdata["user_type"],
                'created_id'      => $this->customlib->getStaffID(),
                'visible_student' => $student,
                'visible_staff'   => $staff,
                'visible_parent'  => $parent,
                'publish_date'    => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('publish_date'))),
            );
            if ($upload) {
                $data['attached_file']      = $save_name;
                $data['filename'] = $_FILES["attached_file"]['name'];
            }

            $this->notification_model->insertBatch($data, $staff_roles);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/notification/index');
        }
        $class              = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist']  = $class;
        $exam_result      = $this->exam_model->get();
        $data['examlist'] = $exam_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/notification/notificationAdd', $data);
        $this->load->view('layout/footer', $data);
    }

    public function edit($id)
    {

        $userdata         = $this->customlib->getUserData();
        $user_id          = $userdata["id"];
        $usernotification = $this->notification_model->get($id);
        if ((!$this->rbac->hasPrivilege('notice_board', 'can_edit'))) {
            if ($usernotification['created_id'] != $user_id) {

                access_denied();
            }
        }
        $data['id']   = $id;
        $notification = $this->notification_model->get($id);
        
        $class_id = $this->notification_model->getClass($id);
        $class              = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist']  = $class;
        $sections = $this->notification_model->getNotificationSections( $id);
        $section_Id_string = '';
        foreach($sections as $value) 
        {
            if($section_Id_string!='') $section_Id_string.=',';
            $section_Id_string.=$value['role_id'];
        }
        $data['section_Id_string']  = $section_Id_string;

        $data['class_id']       = $class_id;
        $data['notification'] = $notification;
        $data['roles']        = $this->role_model->get();
        $data['title']        = 'Edit Notification';
        $data['title_list']   = 'Notification List';
        $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', $this->lang->line('message'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('publish_date', $this->lang->line('publish_date'), 'trim|required|xss_clean');
        //$this->form_validation->set_rules('visible[]', $this->lang->line('message_to'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id[]', $this->lang->line('message_to'), 'required');
        //  print_r($_REQUEST); 
        //  print_r($this->input->post('section_id[]')); exit;
        if ($this->form_validation->run() == false || count($this->input->post('section_id[]'))==0) {

        } else {

            $userdata    = $this->customlib->getUserData();
            $student     = "No";
            $staff       = "No";
            $parent      = "No";
            $staff_roles = array();
            $inst_staff  = array();
            $prev_roles  = $this->input->post('prev_roles');
            // $visible     = $this->input->post('visible');
            // foreach ($visible as $key => $value) {

            //     if ($value == "student") {
            //         $student = "Yes";
            //     } else if ($value == "parent") {
            //         $parent = "Yes";
            //     } else if (is_numeric($value)) {
            //         $inst_staff[]  = $value;
            //         $staff_roles[] = array('role_id' => $value, 'send_notification_id' => '');
            //         $staff         = "Yes";
            //     }
            // }
            $section_Ids     = $this->input->post('section_id');
            foreach ($section_Ids as $key => $value) {

                 if (is_numeric($value) && $value>0 ) 
                 {
                    $inst_staff[]  = $value;
                    $staff_roles[] = array('role_id' => $value, 'send_notification_id' => '');
                    // $staff         = "Yes";
                }
            }

            $to_be_del    = array_diff($prev_roles, $inst_staff);
            $to_be_insert = array_diff($inst_staff, $prev_roles);
            $insert       = array();

            if (!empty($to_be_insert)) {

                foreach ($to_be_insert as $to_insert_key => $to_insert_value) {
                    $insert[] = array('role_id' => $to_insert_value, 'send_notification_id' => '');
                }
            }
            //---------------> uploaded file process 2021.07.16
            $upload = false;
            {
                if (isset($_FILES["attached_file"]) && !empty($_FILES['attached_file']['name'])) {
                    $time     = md5($_FILES["attached_file"]['name'] . microtime());
                    $fileInfo = pathinfo($_FILES["attached_file"]["name"]);
                    $save_name = $time . '.' . $fileInfo['extension'];


                    $upload = move_uploaded_file($_FILES["attached_file"]["tmp_name"], "./uploads/notice_attached/" . $save_name);
                }
            }
            //<----------------

            $data = array(
                'id'              => $id,
                'message'         => $this->input->post('message'),
                'title'           => $this->input->post('title'),
                'date'            => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'created_by'      => $userdata["user_type"],
                'created_id'      => $this->customlib->getStaffID(),
                'visible_student' => $student,
                'visible_staff'   => $staff,
                'visible_parent'  => $parent,
                'publish_date'    => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('publish_date'))),
            );
            if ($upload) {
                $data['attached_file']      = $save_name;
                $data['filename'] = $_FILES["attached_file"]['name'];
            }
            $this->notification_model->insertBatch($data, $insert, $to_be_del);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/notification/index');
        }
        $exam_result      = $this->exam_model->get();
        $data['examlist'] = $exam_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/notification/notificationEdit', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        $userdata         = $this->customlib->getUserData();
        $user_id          = $userdata["id"];
        $usernotification = $this->notification_model->get($id);
        if ((!$this->rbac->hasPrivilege('notice_board', 'can_edit'))) {
            if ($usernotification['created_id'] != $user_id) {

                access_denied();
            }
        }
        $this->notification_model->remove($id);
        redirect('admin/notification');
    }

    public function setting()
    {
        if (!$this->rbac->hasPrivilege('notification_setting', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'notification/setting');
        $data                     = array();
        $data['title']            = 'Email Config List';
        $notificationlist         = $this->notificationsetting_model->get();
        $data['notificationlist'] = $notificationlist;
        $this->form_validation->set_rules('email_type', $this->lang->line('email_type'), 'required');
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ids          = $this->input->post('ids');
            $update_array = array();
            foreach ($ids as $id_key => $id_value) {
                $array = array(
                    'id'      => $id_value,
                    'is_mail' => 0,
                    'is_sms'  => 0,
                );
                $mail         = $this->input->post('mail_' . $id_value);
                $sms          = $this->input->post('sms_' . $id_value);
                $notification = $this->input->post('notification_' . $id_value);
                if (isset($mail)) {
                    $array['is_mail'] = $mail;
                }
                if (isset($sms)) {
                    $array['is_sms'] = $sms;
                }
                if (isset($notification)) {
                    $array['is_notification'] = $notification;
                } else {
                    $array['is_notification'] = 0;
                }

                $update_array[] = $array;
            }

            $this->notificationsetting_model->updatebatch($update_array);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/notification/setting');
        }

        $data['title'] = 'Email Config List';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/notification/setting', $data);
        $this->load->view('layout/footer', $data);
    }

    public function read()
    {
        $array           = array('status' => "fail", 'msg' => $this->lang->line('somthing_wrong'));
        $notification_id = $this->input->post('notice');
        if ($notification_id != "") {
            $staffid = $this->customlib->getStaffID();
            $data    = $this->notification_model->updateStatusforStaff($notification_id, $staffid);
            $array   = array('status' => "success", 'data' => $data, 'msg' => $this->lang->line('update_message'));
        }

        echo json_encode($array);
    }

    public function gettemplate()
    {

        $id             = $this->input->post('id');
        $data['record'] = $this->notificationsetting_model->get($id);

        $template = $this->load->view('admin/notification/gettemplate', $data, true);
        $response = array('status' => 1, 'template' => $template);
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($response));
    }

    public function savetemplate()
    {
        $response = array();
        $this->form_validation->set_rules('temp_id', $this->lang->line('template_id'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('template_message', $this->lang->line('template_message'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'temp_id'          => form_error('temp_id'),
                'template_message' => form_error('template_message'),
            );
            $response = array('status' => 0, 'error' => $data);
        } else {

            $data_update = array(
                'id'       => $this->input->post('temp_id'),
                'template' => $this->input->post('template_message'),
            );
            $this->notificationsetting_model->update($data_update);
            $response = array('status' => 1, 'message' => $this->lang->line('update_message'));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($response));
    }

}
