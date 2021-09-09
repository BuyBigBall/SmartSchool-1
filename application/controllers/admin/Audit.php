<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
 
class Audit extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }
 
    public function unauthorized() {
        $data = array();
        $this->load->view('layout/header', $data);
        $this->load->view('unauthorized', $data);
        $this->load->view('layout/footer', $data);
    }

    public function index($offset = 0) {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'audit/index');
        $data['title'] = 'Audit Trail Report';
        $data['title_list'] = 'Audit Trail List';
        $listaudit = $this->audit_model->get();

        $config['total_rows'] = $this->audit_model->count();
        $config['base_url'] = base_url() . "admin/audit/index";
        $config['per_page'] = 100;
        $config['uri_segment'] = '4';
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = '« First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last »';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next →';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '← Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li ><a href="" class="active">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $query = $this->audit_model->get(100, $this->uri->segment(4));
      
        $data['resultlist'] = $query;
        $this->load->view('layout/header');
        $this->load->view('admin/audit/index', $data);
        $this->load->view('layout/footer');
    }

    public function getDatatable() {
        $audit = $this->audit_model->getAllRecord();
        $audit = json_decode($audit);

        $dt_data = array();
        if (!empty($audit->data)) {
            foreach ($audit->data as $key => $value) {

                $date = date($this->customlib->getSchoolDateFormat(), strtotime($value->time));
                $time = date('H:i:s', strtotime($value->time));

                $row = array();
                $row[] = $value->message;
                $row[] = $value->name;
                $row[] = $value->ip_address;
                $row[] = $value->action;
                $row[] = $value->platform;
                $row[] = $value->agent;
                $row[] = $date . " " . $time;


                $dt_data[] = $row;
            }
        }

        $json_data = array(
            "draw" => intval($audit->draw),
            "recordsTotal" => intval($audit->recordsTotal),
            "recordsFiltered" => intval($audit->recordsFiltered),
            "data" => $dt_data,
        );
        echo json_encode($json_data);
    }

}
