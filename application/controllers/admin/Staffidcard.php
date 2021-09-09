<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staffidcard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('staff_id_card', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Certificate');
        $this->session->set_userdata('sub_menu', 'admin/staffidcard');
        $this->data['staffidcardlist'] = $this->Staffidcard_model->staffidcardlist();
        $this->load->view('layout/header');
        $this->load->view('admin/staffidcard/staffidcardView', $this->data);
        $this->load->view('layout/footer');
    }

    public function create() {
        if (!$this->rbac->hasPrivilege('staff_id_card', 'can_add')) {
            access_denied();
        }
        $this->form_validation->set_rules('school_name', $this->lang->line('school_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', $this->lang->line('address_phone_email'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('title', $this->lang->line('id_card_title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('background_image', $this->lang->line('background_image'), 'callback_background_image_handle_upload');
        $this->form_validation->set_rules('logo_img', $this->lang->line('logo_img'), 'callback_logo_img_handle_upload');
        $this->form_validation->set_rules('sign_image', $this->lang->line('sign_image'), 'callback_sign_image_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $this->data['staffidcardlist'] = $this->Staffidcard_model->staffidcardlist();
            $this->load->view('layout/header');
            $this->load->view('admin/staffidcard/staffidcardView', $this->data);
            $this->load->view('layout/footer');
        } else {
            $staff_id = 0;
            $department = 0;
            $designation = 0;
            $name = 0;
            $fathername = 0;
            $mothername = 0;
            $date_of_joining = 0;
            $permanent_address = 0;
            $phone = 0;
            $dob = 0;
            if ($this->input->post('is_active_staff_id') == 1) {
                $staff_id = $this->input->post('is_active_staff_id');
            }
            if ($this->input->post('is_active_department') == 1) {
                $department = $this->input->post('is_active_department');
            }
            if ($this->input->post('is_active_designation') == 1) {
                $designation = $this->input->post('is_active_designation');
            }
            if ($this->input->post('is_active_staff_name') == 1) {
                $name = $this->input->post('is_active_staff_name');
            }
            if ($this->input->post('is_active_staff_father_name') == 1) {
                $fathername = $this->input->post('is_active_staff_father_name');
            }
            if ($this->input->post('is_active_staff_mother_name') == 1) {
                $mothername = $this->input->post('is_active_staff_mother_name');
            }
            if ($this->input->post('is_active_date_of_joining') == 1) {
                $date_of_joining = $this->input->post('is_active_date_of_joining');
            }
            if ($this->input->post('is_active_staff_permanent_address') == 1) {
                $permanent_address = $this->input->post('is_active_staff_permanent_address');
            }
            if ($this->input->post('is_active_staff_phone') == 1) {
                $phone = $this->input->post('is_active_staff_phone');
            }
            if ($this->input->post('is_active_staff_dob') == 1) {
                $dob = $this->input->post('is_active_staff_dob');
            }
            $data = array(
                'title' => $this->input->post('title'),
                'school_name' => $this->input->post('school_name'),
                'school_address' => $this->input->post('address'),
                'header_color' => $this->input->post('header_color'),
                'enable_staff_id' => $staff_id,
                'enable_staff_department' => $department,
                'enable_designation' => $designation,
                'enable_name' => $name,
                'enable_fathers_name' => $fathername,
                'enable_mothers_name' => $mothername,
                'enable_date_of_joining' => $date_of_joining,
                'enable_permanent_address' => $permanent_address,
                'enable_staff_dob' => $dob,
                'enable_staff_phone' => $phone,
                'status' => 1,
            );
            $insert_id = $this->Staffidcard_model->addstaffidcard($data);
            if (!empty($_FILES['background_image']['name'])) {
                $config['upload_path'] = 'uploads/staff_id_card/background/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $file_name = $_FILES['background_image']['name'];
                $config['file_name'] = "background" . $insert_id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('background_image')) {
                    $uploadData = $this->upload->data();
                    $background = $uploadData['file_name'];
                } else {
                    $background = '';
                }
            } else {
                $background = '';
            }

            if (!empty($_FILES['logo_img']['name'])) {
                $config['upload_path'] = 'uploads/staff_id_card/logo/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';                
                $file_name = $_FILES['logo_img']['name'];
                $config['file_name'] = "logo" . $insert_id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('logo_img')) {
                    $uploadData = $this->upload->data();
                    $logo_img = $uploadData['file_name'];
                } else {
                    $logo_img = '';
                }
            } else {
                $logo_img = '';
            }

            if (!empty($_FILES['sign_image']['name'])) {
                $config['upload_path'] = 'uploads/staff_id_card/signature/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';            
                $file_name = $_FILES['sign_image']['name'];
                $config['file_name'] = "sign" . $insert_id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('sign_image')) {
                    $uploadData = $this->upload->data();
                    $sign_image = $uploadData['file_name'];
                } else {
                    $sign_image = '';
                }
            } else {
                $sign_image = '';
            }
              $upload_data = array('id' => $insert_id, 'logo' => $logo_img, 'background' => $background, 'sign_image' => $sign_image);
              $this->Staffidcard_model->addstaffidcard($upload_data);
              $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
              redirect('admin/staffidcard/index');    
        }
    }

    public function edit($id) {
        if (!$this->rbac->hasPrivilege('staff_id_card', 'can_edit')) {
            access_denied();
        }
        $data['id'] = $id;
        $editstaffidcard = $this->Staffidcard_model->get($id);
        $this->data['editstaffidcard'] = $editstaffidcard;
        $this->form_validation->set_rules('school_name', $this->lang->line('school_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', $this->lang->line('address_phone_email'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('title', $this->lang->line('id_card_title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('background_image', $this->lang->line('background_image'), 'callback_background_image_handle_upload');
        $this->form_validation->set_rules('logo_img', $this->lang->line('logo_img'), 'callback_logo_img_handle_upload');
        $this->form_validation->set_rules('sign_image', $this->lang->line('sign_image'), 'callback_sign_image_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $this->data['staffidcardlist'] = $this->Staffidcard_model->staffidcardlist();
            $this->load->view('layout/header');
            $this->load->view('admin/staffidcard/staffidcardedit', $this->data);
            $this->load->view('layout/footer');
        } else {
            $staff_id = 0;
            $department = 0;
            $designation = 0;
            $name = 0;
            $fathername = 0;
            $mothername = 0;
            $date_of_joining = 0;
            $permanent_address = 0;
            $phone = 0;
            $dob = 0;
            if ($this->input->post('is_active_staff_id') == 1) {
                $staff_id = $this->input->post('is_active_staff_id');
            }
            if ($this->input->post('is_active_department') == 1) {
                $department = $this->input->post('is_active_department');
            }
            if ($this->input->post('is_active_designation') == 1) {
                $designation = $this->input->post('is_active_designation');
            }
            if ($this->input->post('is_active_staff_name') == 1) {
                $name = $this->input->post('is_active_staff_name');
            }
            if ($this->input->post('is_active_staff_father_name') == 1) {
                $fathername = $this->input->post('is_active_staff_father_name');
            }
            if ($this->input->post('is_active_staff_mother_name') == 1) {
                $mothername = $this->input->post('is_active_staff_mother_name');
            }
            if ($this->input->post('is_active_date_of_joining') == 1) {
                $date_of_joining = $this->input->post('is_active_date_of_joining');
            }
            if ($this->input->post('is_active_staff_permanent_address') == 1) {
                $permanent_address = $this->input->post('is_active_staff_permanent_address');
            }
            if ($this->input->post('is_active_staff_phone') == 1) {
                $phone = $this->input->post('is_active_staff_phone');
            }
            if ($this->input->post('is_active_staff_dob') == 1) {
                $dob = $this->input->post('is_active_staff_dob');
            }

            if (!empty($_FILES['background_image']['name'])) {
                $config['upload_path'] = 'uploads/staff_id_card/background/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';               
                $file_name = $_FILES['background_image']['name'];
                $config['file_name'] = "background" . $id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('background_image')) {
                    $uploadData = $this->upload->data();
                    $background = $uploadData['file_name'];
                } else {
                    $background = $this->input->post('old_background');
                }
            } else {
                $background = $this->input->post('old_background');
            }

            if (!empty($_FILES['logo_img']['name'])) {
                $config['upload_path'] = 'uploads/staff_id_card/logo/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';                
                $file_name = $_FILES['logo_img']['name'];
                $config['file_name'] = "logo" . $id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('logo_img')) {
                    $uploadData = $this->upload->data();
                    $logo_img = $uploadData['file_name'];
                } else {
                    $logo_img = $this->input->post('old_logo_img');
                }
            } else {
                $logo_img = $this->input->post('old_logo_img');
            }
            if (!empty($_FILES['sign_image']['name'])) {
                $config['upload_path'] = 'uploads/staff_id_card/signature/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';                
                $file_name = $_FILES['sign_img']['name'];
                $config['file_name'] = "sign" . $id;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('sign_image')) {
                    $uploadData = $this->upload->data();
                    $sign_image = $uploadData['file_name'];
                } else {
                    $sign_image = $this->input->post('old_sign_image');
                }
            } else {
                $sign_image = $this->input->post('old_sign_image');
            }
            $data = array(
                'id' => $this->input->post('id'),
                'title' => $this->input->post('title'),
                'school_name' => $this->input->post('school_name'),
                'school_address' => $this->input->post('address'),
                'background' => $background,
                'logo' => $logo_img,
                'sign_image' => $sign_image,
                'header_color' => $this->input->post('header_color'),
                'enable_staff_id' => $staff_id,
                'enable_staff_department' => $department,
                'enable_designation' => $designation,
                'enable_name' => $name,
                'enable_fathers_name' => $fathername,
                'enable_mothers_name' => $mothername,
                'enable_date_of_joining' => $date_of_joining,
                'enable_permanent_address' => $permanent_address,
                'enable_staff_dob' => $dob,
                'enable_staff_phone' => $phone,
                'status' => 1,
            );
            $this->Staffidcard_model->addstaffidcard($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('update_message').'</div>');
            redirect('admin/staffidcard');
        }
    }

    public function delete($id) {
        $data['title'] = 'Certificate List';
        $this->Staffidcard_model->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('delete_message').'</div>');
        redirect('admin/staffidcard/index');
    }

   public function view() {
        $id = $this->input->post('certificateid');
        $data['idcard'] = $this->Staffidcard_model->idcardbyid($id);
        $this->load->view('admin/staffidcard/staffidcardpreview',$data);
    }

     public function background_image_handle_upload()
    { 
       if (isset($_FILES["background_image"]) && !empty($_FILES["background_image"]['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'Jpg', 'Jpeg', 'Png');
            $temp        = explode(".", $_FILES["background_image"]["name"]);
            $extension   = end($temp);
            if ($_FILES["background_image"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["background_image"]["type"] != 'image/gif' &&
                $_FILES["background_image"]["type"] != 'image/jpeg' &&
                $_FILES["background_image"]["type"] != 'image/png') {
                $this->form_validation->set_message('background_image_handle_upload', $this->lang->line('invalid_file_type') );
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('background_image_handle_upload', $this->lang->line('extension_not_allowed'));
                return false;
            }
            // if ($_FILES["logo"]["size"] > 204800) {
            //     $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than_200kB'));
            //     return false;
            // }
            return true;
        } else {
            return true;
        }
    }


    public function logo_img_handle_upload(){
        if (isset($_FILES["logo_img"]) && !empty($_FILES["logo_img"]['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'Jpg', 'Jpeg', 'Png');
            $temp        = explode(".", $_FILES["logo_img"]["name"]);
            $extension   = end($temp);
            if ($_FILES["logo_img"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["logo_img"]["type"] != 'image/gif' &&
                $_FILES["logo_img"]["type"] != 'image/jpeg' &&
                $_FILES["logo_img"]["type"] != 'image/png') {
                $this->form_validation->set_message('logo_img_handle_upload', $this->lang->line('invalid_file_type') );
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('logo_img_handle_upload', $this->lang->line('extension_not_allowed'));
                return false;
            }
            // if ($_FILES["logo"]["size"] > 204800) {
            //     $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than_200kB'));
            //     return false;
            // }
            return true;
        } else {
            return true;
        }
    }

    public function sign_image_handle_upload(){
        if (isset($_FILES["sign_image"]) && !empty($_FILES["sign_image"]['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'Jpg', 'Jpeg', 'Png');
            $temp        = explode(".", $_FILES["sign_image"]["name"]);
            $extension   = end($temp);
            if ($_FILES["background_image"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["sign_image"]["type"] != 'image/gif' &&
                $_FILES["sign_image"]["type"] != 'image/jpeg' &&
                $_FILES["sign_image"]["type"] != 'image/png') {
                $this->form_validation->set_message('sign_image_handle_upload', $this->lang->line('invalid_file_type') );
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('sign_image_handle_upload', $this->lang->line('extension_not_allowed'));
                return false;
            }
            // if ($_FILES["logo"]["size"] > 204800) {
            //     $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than_200kB'));
            //     return false;
            // }
            return true;
        } else {
            return true;
        }
    }

}
 ?>

