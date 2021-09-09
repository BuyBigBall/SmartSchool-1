<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        

        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'admin/content');
        $user_role = $this->customlib->getStaffRole();
        $data['title'] = 'Upload Content';
        $data['title_list'] = 'Upload Content List';
        $data['content_available'] = $this->customlib->contentAvailabelFor();
        $ght = $this->customlib->getcontenttype();
        $role = json_decode($user_role);

        $list = $this->content_model->getContentByRole($this->customlib->getStaffID(), $role->name);
       
        $class = $this->class_model->get(); 
        
        $data['list'] = $list;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $carray = array();
        $data['ght'] = $ght;
        $this->form_validation->set_rules('content_title', $this->lang->line('content_title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('content_type', $this->lang->line('content_type'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('content_available[]', $this->lang->line('available_for'), 'trim|required|xss_clean');
          $this->form_validation->set_rules('upload_date', $this->lang->line('date'), 'trim|required|xss_clean');
        $post_data = $this->input->post();

        if (isset($post_data['content_available']) AND ! isset($post_data['visibility']) AND ( in_array("student", $post_data['content_available']))) {
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        }
 


        $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('layout/header');
            $this->load->view('admin/content/createcontent', $data);
            $this->load->view('layout/footer');
        } else {

            $vs = $this->input->post('visibility');
            $content_available = $this->input->post('content_available');
            $visibility = "No";
            $classes = "";
            $section_id = "";
            if (in_array('student', $content_available) && isset($vs)) {
                $visibility = $this->input->post('visibility');
            } elseif (in_array('student', $content_available) && !isset($vs)) {
                $section_id = $this->input->post('section_id');
                $classes = $this->input->post('class_id');
            } else {
                
            }


            $content_for = array();
            foreach ($content_available as $cont_avail_key => $cont_avail_value) {
                $content_for[] = array('role' => $cont_avail_value);
            }


            $data = array(
                'title' => $this->input->post('content_title'),
                'type' => $this->input->post('content_type'),
                'note' => $this->input->post('note'),
                'class_id' => $classes,
                'cls_sec_id' => $section_id,
                'created_by'=> $this->customlib->getStaffID(),
                //'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('upload_date'))),
                'file' => $this->input->post('file'),
                'is_public' => $visibility
            );

            if(isset($_POST['upload_date']) && $_POST['upload_date']!=''){

                $data['date']=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('upload_date')));
            }
            
            $insert_id = $this->content_model->add($data, $content_for);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/school_content/material/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/school_content/material/' . $img_name);
                $this->content_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/content');
        }
    }

    function index1() {

        $this->customlib->getStaffRole();




        $data['title'] = 'Upload Content';
        $data['title_list'] = 'Upload Content List';
        $data['content_available'] = $this->customlib->contentAvailabelFor();
        $ght = $this->customlib->getcontenttype();
        $list = $this->content_model->get();
        $class = $this->class_model->get();
        $data['list'] = $list;
        $data['classlist'] = $class;
        $data['ght'] = $ght;
        $this->form_validation->set_rules('content_title', 'Content Title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('content_type', 'Content Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('content_available[]', 'Available for', 'trim|required|xss_clean');
        $post_data = $this->input->post();

        if (isset($post_data['content_available']) AND ! isset($post_data['visibility']) AND ( in_array("student", $post_data['content_available']))) {
            $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
            $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        }



        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('admin/content/createcontent', $data);
            $this->load->view('layout/footer');
        } else {

            $vs = $this->input->post('visibility');
            $content_available = $this->input->post('content_available');
            $visibility = "No";
            $classes = "";
            $section_id = "";
            if (in_array('student', $content_available) && isset($vs)) {
                $visibility = $this->input->post('visibility');
            } elseif (in_array('student', $content_available) && !isset($vs)) {
                $section_id = $this->input->post('section_id');
                $classes = $this->input->post('class_id');
            } else {
                
            }


            $content_for = array();
            foreach ($content_available as $cont_avail_key => $cont_avail_value) {
                $content_for[] = array('role' => $cont_avail_value);
            }


            $data = array(
                'title' => $this->input->post('content_title'),
                'type' => $this->input->post('content_type'),
                'note' => $this->input->post('note'),
                'class_id' => $classes,
                'cls_sec_id' => $section_id,
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('upload_date'))),
                'file' => $this->input->post('file'),
                'is_public' => $visibility
            );

            $insert_id = $this->content_model->add($data, $content_for);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/school_content/material/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/school_content/material/' . $img_name);
                $this->content_model->add($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Content added successfully</div>');
            redirect('admin/content');
        }
    }

   public function handle_upload()
    {
        $image_validate = $this->config->item('file_validate');
        $result = $this->filetype_model->get();
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {

            $file_type         = $_FILES["file"]['type'];
            $file_size         = $_FILES["file"]["size"];
            $file_name         = $_FILES["file"]["name"];
           $allowed_extension = array_map('trim', array_map('strtolower', explode(',', $result->file_extension)));
            $allowed_mime_type = array_map('trim', array_map('strtolower', explode(',', $result->file_mime)));
            $ext               = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if ($files = filesize($_FILES['file']['tmp_name'])) {

                if (!in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_type_not_allowed'));
                    return false;
                }
                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_type_not_allowed'));
                    return false;
                }                
                if ($file_size > $result->file_size) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_upload', 'File size is too small');
                return false;
            }

            return true;
        }else {
            $this->form_validation->set_message('handle_upload', $this->lang->line('the_file_field_is_required'));
            return false;
        }
    }

    public function download($file) {

        $this->load->helper('download');
        $filepath = "./uploads/school_content/material/" . $this->uri->segment(7);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(7);
        force_download($name, $data);
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('upload_content', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Add Content';
        $data['id'] = $id;
        $editpost = $this->content_model->get($id);
        $data['editpost'] = $editpost;
        $ght = $this->customlib->getcontenttype();
        $data['ght'] = $ght;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->form_validation->set_rules('content_title', $this->lang->line('content_title'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listpost = $this->content_model->get();
            $data['listpost'] = $listpost;
            $this->load->view('layout/header');
            $this->load->view('admin/content/editpost', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'content_title' => $this->input->post('content_title'),
                'content_type' => $this->input->post('content_type'),
                'class_id' => $this->input->post('class_id'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('upload_date'))),
                'file_uploaded' => $this->input->file['file']['name']
            );
            $this->content_model->addcontentpost($data);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'file_uploaded' => 'uploads/student_images/' . $img_name);
                $this->content_model->addcontentpost($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">'.$this->lang->line('success_message').'</div>');
            redirect('admin/content/createcontent/index');
        }
    }

    // function search() {
    //     $text = $_GET['content'];
    //     $data['title'] = 'Fees Master List';
    //     $contentlist = $this->content_model->search_by_content_type($text);
    //     $data['contentlist'] = $contentlist;
    //     $this->load->view('layout/header');
    //     $this->load->view('admin/content/search', $data);
    //     $this->load->view('layout/footer');
    // }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('upload_content', 'can_delete')) {
            access_denied();
        }
        $data = $this->content_model->get($id);
        $file = $data['file'];
        unlink($file);
        $this->content_model->remove($id);
        redirect('admin/content');
    }

    function deleteassignment($id,$page) {
        if (!$this->rbac->hasPrivilege('upload_content', 'can_delete')) {
            access_denied();
        }
        $this->content_model->remove($id);
		// $this->$page();
		redirect('admin/content/'.$page);
        // $data['title_list'] = 'Assignment List';
        // $list = $this->content_model->getListByCategory("Assignments");
        // $data['list'] = $list;
        // $this->load->view('layout/header');
        // $this->load->view('admin/content/assignment', $data);
        // $this->load->view('layout/footer');
    }

    public function assignment() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/assignment');
        $data['title_list'] = 'Assignment List';
        $list = $this->content_model->getListByCategory("assignments");
        $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/content/assignment', $data);
        $this->load->view('layout/footer');
    }

    public function studymaterial() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/studymaterial');
        $data['title_list'] = 'Study Material List';
        $list = $this->content_model->getListByCategory("study_material");
        $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/content/studymaterial', $data);
        $this->load->view('layout/footer');
    }

    public function syllabus() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/syllabus');
        $data['title_list'] = 'Syllabus List';
        $list = $this->content_model->getListByCategory("syllabus");
        $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/content/syllabus', $data);
        $this->load->view('layout/footer');
    }

    public function other() {
        $this->session->set_userdata('top_menu', 'Download Center');
        $this->session->set_userdata('sub_menu', 'content/other');
        $data['title_list'] = 'Other Download List';
        $list = $this->content_model->getListByCategory("other_download");
        $data['list'] = $list;
        $this->load->view('layout/header');
        $this->load->view('admin/content/other', $data);
        $this->load->view('layout/footer');
    }

}
 
?>