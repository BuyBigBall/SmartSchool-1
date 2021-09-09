<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examgrade extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
    }

    function index() {
        if (!$this->rbac->hasPrivilege('homework', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Exam');
        $this->session->set_userdata('sub_menu', 'examgrade');
        $data['title'] = 'Exam Grade';
        $examgrade_result = $this->examgrade_model->get();
        $data['examgradelist'] = $examgrade_result;
        //$data['pubdate'] = date($this->customlib->getSchoolDateFormat(), strtotime(date('Y-n-d')));
        $data['pubdate'] = date('Y-m-d');

        $this->form_validation->set_rules('name', $this->lang->line('examgrade_name'), 'trim|required|xss_clean|callback__check_name_exists');
       
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/examgrade/examgradeList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            //print_r($_REQUEST); 
            $data = array(
                'name' => $this->input->post('name'),
                'desc' => $this->input->post('description'),
                'gradepoint' => $this->input->post('gradepoint'),
                'pubdate' =>date('Y-m-d', strtotime($this->input->post('pubdate'))),
            );
            //print_r($data); exit;
            $this->examgrade_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('examgrade/index');
        }
    }

    // function view($id) {
    //     if (!$this->rbac->hasPrivilege('examgrade', 'can_view')) {
    //         access_denied();
    //     }
    //     $data['title'] = 'Examgrade List';
    //     $examgrade = $this->examgrade_model->get($id);
    //     $data['examgrade'] = $examgrade;
    //     $this->load->view('layout/header', $data);
    //     $this->load->view('admin/examgrade/examgradeShow', $data);
    //     $this->load->view('layout/footer', $data);
    // }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('examgrade', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Examgrade List';
        $this->examgrade_model->remove($id);
        redirect('examgrade/index');
    }

    function _check_name_exists() {
        $data['name'] = $this->security->xss_clean($this->input->post('name'));
        if ($this->examgrade_model->check_data_exists($data)) {
            $this->form_validation->set_message('_check_name_exists', $this->lang->line('name_already_exists'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // function _check_code_exists() {
    //     $data['code'] = $this->security->xss_clean($this->input->post('code'));
    //     if ($this->examgrade_model->check_code_exists($data)) {
    //         $this->form_validation->set_message('_check_code_exists', $this->lang->line('code_already_exists'));
    //         return FALSE;
    //     } else {
    //         return TRUE;
    //     }
    // }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('examgrade', 'can_edit')) {
            access_denied();
        }
        $examgrade_result = $this->examgrade_model->get();
        $data['examgradelist'] = $examgrade_result;
        $data['title'] = 'Edit Examgrade';
        $data['id'] = $id;
        $examgrade = $this->examgrade_model->get($id);
        $data['examgrade'] = $examgrade;

        $this->form_validation->set_rules('name', $this->lang->line('exam_type'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/examgrade/examgradeEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'desc' => $this->input->post('description'),
                'gradepoint' => $this->input->post('gradepoint'),
                'pubdate' =>date('Y-m-d', strtotime($this->input->post('pubdate'))),
            );
            $this->examgrade_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('examgrade/index');
        }
    }

    function get() {
        $data = array();
        $data = $this->examgrade_model->get();
        echo json_encode($data);
    }

}

?>