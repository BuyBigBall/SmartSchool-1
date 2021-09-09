<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examtype extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
    }

    function index() {
        if (!$this->rbac->hasPrivilege('homework', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Exam');
        $this->session->set_userdata('sub_menu', 'examtype');
        $data['title'] = 'Exam Type';
        $examtype_result = $this->examtype_model->get();
        $data['examtypelist'] = $examtype_result;
        //$data['pubdate'] = date($this->customlib->getSchoolDateFormat(), strtotime(date('Y-n-d')));
        $data['pubdate'] = date('Y-m-d');

        $this->form_validation->set_rules('name', $this->lang->line('examtype_name'), 'trim|required|xss_clean|callback__check_name_exists');
       
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/examtype/examtypeList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            //print_r($_REQUEST); 
            $data = array(
                'name' => $this->input->post('name'),
                'desc' => $this->input->post('description'),
                'pubdate' =>date('Y-m-d', strtotime($this->input->post('pubdate'))),
            );
            //print_r($data); exit;
            $this->examtype_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('examtype/index');
        }
    }

    // function view($id) {
    //     if (!$this->rbac->hasPrivilege('examtype', 'can_view')) {
    //         access_denied();
    //     }
    //     $data['title'] = 'Examtype List';
    //     $examtype = $this->examtype_model->get($id);
    //     $data['examtype'] = $examtype;
    //     $this->load->view('layout/header', $data);
    //     $this->load->view('admin/examtype/examtypeShow', $data);
    //     $this->load->view('layout/footer', $data);
    // }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('examtype', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Examtype List';
        $this->examtype_model->remove($id);
        redirect('examtype/index');
    }

    function _check_name_exists() {
        $data['name'] = $this->security->xss_clean($this->input->post('name'));
        if ($this->examtype_model->check_data_exists($data)) {
            $this->form_validation->set_message('_check_name_exists', $this->lang->line('name_already_exists'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // function _check_code_exists() {
    //     $data['code'] = $this->security->xss_clean($this->input->post('code'));
    //     if ($this->examtype_model->check_code_exists($data)) {
    //         $this->form_validation->set_message('_check_code_exists', $this->lang->line('code_already_exists'));
    //         return FALSE;
    //     } else {
    //         return TRUE;
    //     }
    // }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('examtype', 'can_edit')) {
            access_denied();
        }
        $examtype_result = $this->examtype_model->get();
        $data['examtypelist'] = $examtype_result;
        $data['title'] = 'Edit Examtype';
        $data['id'] = $id;
        $examtype = $this->examtype_model->get($id);
        $data['examtype'] = $examtype;

        $this->form_validation->set_rules('name', $this->lang->line('exam_type'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/examtype/examtypeEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'desc' => $this->input->post('description'),
                'pubdate' =>date('Y-m-d', strtotime($this->input->post('pubdate'))),
            );
            $this->examtype_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('examtype/index');
        }
    }

    function get() {
        $data = array();
        $data = $this->examtype_model->get();
        echo json_encode($data);
    }

}

?>