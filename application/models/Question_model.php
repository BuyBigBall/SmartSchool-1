<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Question_model extends MY_model
{

    public function add($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('questions', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  questions id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /*Optional*/

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;

            } else {
                //return $return_value;
            }
        } else {
            $this->db->insert('questions', $data);
            $id        = $this->db->insert_id();
            $message   = INSERT_RECORD_CONSTANT . " On  questions id " . $id;
            $action    = "Insert";
            $record_id = $id;
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /*Optional*/

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;

            } else {
                //return $return_value;
            }
            return $id;
        }
    }

    public function get($id = null)
    {
        $userdata = $this->customlib->getUserData();
        $role_id = $userdata["role_id"];
        $carray = array();
        $class_section_id=array();
        if (isset($role_id) && ($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            if ($userdata["class_teacher"] == 'yes') {

                $classlist = $this->teacher_model->get_teacherrestricted_mode($userdata["id"]);
            }
            foreach ($classlist as $key => $value) {
                $class_section=$this->teacher_model->get_teacherrestricted_modesections($userdata["id"], $value['id']);
                $class_section_id[]=$class_section[0]['id'];
            }
        }
        
        $this->db->select('questions.*,subjects.name,classes.class as `class_name`,sections.section as `section_name`')->from('questions');

        $this->db->join('subjects', 'subjects.id = questions.subject_id');
        $this->db->join('classes', 'classes.id = questions.class_id','left');
        $this->db->join('sections', 'sections.id = questions.section_id','left');
        if(!empty($class_section_id)){
             $this->db->where_in('questions.class_section_id', $class_section_id);
        }
        if ($id != null) {
            $this->db->where('questions.id', $id);
        } else {
            $this->db->order_by('questions.id');
        }

        

        $query = $this->db->get();
        if ($id != null) {
            return $query->row();
        } else {
            return $query->result();
        }
        
    }

        public function getall($limit = null, $offset = null)
    {
       $this->db->select('questions.*,subjects.name,classes.class as `class_name`,sections.section as `section_name`')->from('questions');
        $this->db->join('subjects', 'subjects.id = questions.subject_id');
        $this->db->join('classes', 'classes.id = questions.class_id','left');
        $this->db->join('sections', 'sections.id = questions.section_id','left');
        $this->db->limit($limit, $offset);
        $this->db->order_by('questions.id');
        $query = $this->db->get();
        return $query->result();
    } 

     public function getAllRecord() {
        $userdata = $this->customlib->getUserData();
        $role_id = $userdata["role_id"];
        
           $this->datatables
                ->select('questions.*,subjects.name,classes.class as `class_name`,sections.section as `section_name`')
                ->join('subjects', 'subjects.id = questions.subject_id')
                ->join('classes', 'classes.id = questions.class_id','left')
                ->join('sections', 'sections.id = questions.section_id','left')
                ->searchable('questions.id,subjects.name,questions.question_type,questions.level,questions.question,classes.class')
                ->orderable('questions.id,subjects.name,questions.question_type,questions.level,questions.question,classes.class')
                ->from('questions');
                if(isset($role_id) && ($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
                   $carray = array();
        $class_list=array();
       
            if ($userdata["class_teacher"] == 'yes') {

                $carray = $this->teacher_model->get_teacherrestricted_mode($userdata["id"]);
            }
 

        foreach ($carray as $key => $value) {
          $class_list[]=$value['id'];
        } 
        if(!empty($class_list)){
             $this->datatables->where_in('questions.class_id',$class_list);
        }
        
                }
        
              
        return $this->datatables->generate('json');
    }

    public function remove($id)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('questions');
        $message   = DELETE_RECORD_CONSTANT . " On questions id " . $id;
        $action    = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /*Optional*/
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
    }

    public function image_add($id, $image)
    {

        $this->db->where('id', $id);
        $this->db->update('questions', $image);

    }

    public function add_option($data)
    {
       

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('question_options', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On question_options id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
            $return_value =$data['id'];
        } else {
            $this->db->insert('question_options', $data);
            $message   = INSERT_RECORD_CONSTANT . " On question_options id " . $this->db->insert_id();
            $action    = "Insert";
            $record_id = $this->db->insert_id();
            $this->log($message, $record_id, $action);
            $return_value= $this->db->insert_id();
        }

         //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /*Optional*/
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            return $return_value;
        }  
    }

    public function add_question_answers($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('question_answers', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On question_answers id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
            $return_value =$data['id'];
        } else {
            $this->db->insert('question_answers', $data);
            $message   = INSERT_RECORD_CONSTANT . " On question_answers id " . $this->db->insert_id();
            $action    = "Insert";
            $record_id = $this->db->insert_id();
            $this->log($message, $record_id, $action);
            $return_value= $this->db->insert_id();
        }

         //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /*Optional*/
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            return $return_value;
        }          
    }

    public function add_question_bulk($data)
    { 

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->insert_batch('questions', $data);
        $message   = 'Questions '.IMPORT_RECORD_CONSTANT . " (" . count($data).")";
        $action    = "Import";
        $record_id = null; 
        $this->log($message, $record_id, $action);
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /*Optional*/
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }          
             
    }

    public function get_result($id)
    {
        return $this->db->select('*')->from('questions')->join('question_answers', 'question.id=question_answers.question_id')->get()->row_array();

    }
    public function get_option($id)
    {
        return $this->db->select('id,option')->from('question_options')->where('question_id', $id)->get()->result_array();
    }

    public function get_answer($id)
    {
        return $this->db->select('option_id as answer_id')->from('question_answers')->where('question_id', $id)->get()->row_array();
    }

    public function count(){
        $query = $this->db->select('count(*) as total')->get('questions')->row_array();
        return $query['total'];
    }
}
