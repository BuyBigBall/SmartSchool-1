<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Captcha extends Admin_Controller
{
    public $custom_fields_list = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->model('captcha_model');
        $this->load->library('captchalib');
    }

    public function index()
    {
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'System Settings/captcha');
        $data['inserted_fields'] = $this->captcha_model->getSetting();
        $data['fields'] = get_captcha_editable_fields();
        $this->load->view('layout/header');
        $this->load->view('admin/captcha/index', $data);
        $this->load->view('layout/footer');
    }

    public function changeStatus(){
        $data = array(
                'name'   => $this->input->post('name'),
                'status' => $this->input->post('status'),
            );
        $this->captcha_model->update_status($data);
        
    }


}

?>