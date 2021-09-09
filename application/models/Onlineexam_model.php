<?php
class Onlineexam_model extends MY_model
{
    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }
    public function add($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('onlineexam', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  online exam id " . $data['id'];
            $action    = "Update";
            $record_id = $id = $data['id'];
            $this->log($message, $record_id, $action);

        } else {
            $this->db->insert('onlineexam', $data);
            $id        = $this->db->insert_id();
            $message   = INSERT_RECORD_CONSTANT . " On  online exam id " . $id;
            $action    = "Insert";
            $record_id = $id;
            $this->log($message, $record_id, $action);

            // return $id;
        }

        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /*Optional*/

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;

        } else {
            return $id;
        }
    }

    public function get($id = null, $publish = null)
    {
        $this->db->select('onlineexam.*,(select count(*) from onlineexam_questions where onlineexam_questions.onlineexam_id=onlineexam.id ) as `total_ques`, (select count(*) from onlineexam_questions INNER JOIN questions on questions.id=onlineexam_questions.question_id where onlineexam_questions.onlineexam_id=onlineexam.id and questions.question_type="descriptive" ) as `total_descriptive_ques`')->from('onlineexam');
        if ($id != null) {
            $this->db->where('onlineexam.id', $id);
            $this->db->where('onlineexam.session_id', $this->current_session);
        } else {
            $this->db->order_by('onlineexam.id', 'desc');
            $this->db->where('onlineexam.session_id', $this->current_session);
        }
        if ($publish != null) {
            $this->db->where('is_active', ($publish == "publish") ? 1 : 0);
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row();
        } else {
            return $query->result();
        }
    }

    public function insertExamQuestion($insert_data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('question_id', $insert_data['question_id']);
        $this->db->where('onlineexam_id', $insert_data['onlineexam_id']);
        $q = $this->db->get('onlineexam_questions');

        if ($q->num_rows() > 0) {
            $result = $q->row();
            $this->db->where('id', $result->id);
            $this->db->delete('onlineexam_questions');
            $message   = DELETE_RECORD_CONSTANT . " On  onlineexam questions id " . $result->id;
            $action    = "Delete";
            $record_id = $result->id;
            $this->log($message, $record_id, $action);

        } else {
            $this->db->insert('onlineexam_questions', $insert_data);
            $id        = $this->db->insert_id();
            $message   = INSERT_RECORD_CONSTANT . " On  onlineexam questions id " . $id;
            $action    = "Insert";
            $record_id = $id;
            $this->log($message, $record_id, $action);

        }
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

    public function remove($id)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('onlineexam');
        $message   = DELETE_RECORD_CONSTANT . " On  online exam id " . $id;
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

    public function searchOnlineExamStudents($class_id, $section_id, $onlineexam_id)
    {

        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,students.middlename,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,IFNULL(onlineexam_students.id, 0) as onlineexam_student_id,IFNULL(onlineexam_students.student_session_id, 0) as onlineexam_student_session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('onlineexam_students', 'onlineexam_students.student_session_id = student_session.id and onlineexam_students.onlineexam_id=' . $onlineexam_id, 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('student_session.class_id', $class_id);
          $this->db->where('students.is_active', 'yes');
        if ($section_id != "") {
            $this->db->where('student_session.section_id', $section_id);
        }
        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();

    }

    public function searchAllOnlineExamStudents($onlineexam_id, $class_id = null, $section_id = null)
    {
        $this->db->select('class_sections.id as class_section_id,classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,students.middlename,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,IFNULL(onlineexam_students.id, 0) as onlineexam_student_id,IFNULL(onlineexam_students.student_session_id, 0) as onlineexam_student_session_id,IFNULL(onlineexam_students.rank, 0) as rank,onlineexam_students.is_attempted')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('class_sections', 'class_sections.class_id = classes.id and class_sections.section_id = sections.id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('onlineexam_students', 'onlineexam_students.student_session_id = student_session.id and onlineexam_students.onlineexam_id=' . $onlineexam_id);
        $this->db->where('student_session.session_id', $this->current_session);
         $this->db->where('students.is_active', 'yes');
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        $this->db->order_by('onlineexam_students.rank', 'ASC');
        $this->db->order_by('onlineexam_students.is_attempted', 'DESC');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function addStudents($data_insert, $data_delete, $onlineexam_id)
    {

        $this->db->trans_begin();

        if (!empty($data_insert)) {

            $this->db->insert_batch('onlineexam_students', $data_insert);
        }
        if (!empty($data_delete)) {

            $this->db->where('onlineexam_id', $onlineexam_id);
            $this->db->where_in('student_session_id', $data_delete);
            $this->db->delete('onlineexam_students');
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function updateStudentRank($onlineexam_students, $exam_id)
    {
        $this->db->trans_begin();
        $this->db->where('id', $exam_id);
        $this->db->update('onlineexam', array('is_rank_generated' => 1));
        $this->db->update_batch('onlineexam_students', $onlineexam_students, 'id');

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }

    }

    public function getStudentAttemts($onlineexam_student_id)
    {

        $this->db->where('onlineexam_student_id', $onlineexam_student_id);
        $total_rows = $this->db->count_all_results('onlineexam_attempts');
        return $total_rows;
    }
    public function addStudentAttemts($data)
    {
        $this->db->insert('onlineexam_attempts', $data);
        return $this->db->insert_id();
    }

    public function examstudentsID($student_session_id, $onlineexam_id)
    {
        $this->db->from('onlineexam_students');
        $this->db->where('student_session_id', $student_session_id);
        $this->db->where('onlineexam_id', $onlineexam_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function updateExamResult($onlineexam_student_id)
    {

        $this->db->where('id', $onlineexam_student_id);
        $this->db->update('onlineexam_students', array('is_attempted' => 1));
    }

    public function getStudentexam($student_session_id)
    {
        $query = "SELECT onlineexam.*,onlineexam_students.id as `onlineexam_student_id`,(select count(*) from onlineexam_attempts WHERE onlineexam_attempts.onlineexam_student_id = onlineexam_students.id) as counter FROM `onlineexam` INNER JOIN onlineexam_students on onlineexam_students.onlineexam_id=onlineexam.id WHERE onlineexam_students.student_session_id=" . $this->db->escape($student_session_id) . " and onlineexam.is_active=1 order by onlineexam.exam_from desc";

        $query = $this->db->query($query);
        return $query->result();

    }

    public function getExamQuestions($id = null, $random_type = false)
    {

        $this->db->select('onlineexam_questions.*,questions.subject_id,questions.question,questions.opt_a,questions.opt_b,questions.opt_c,questions.opt_d,questions.opt_e,questions.correct,questions.question_type,questions.level,questions.class_id,questions.section_id')->from('onlineexam_questions');
        $this->db->join('questions', 'questions.id = onlineexam_questions.question_id');
        $this->db->where('onlineexam_questions.onlineexam_id', $id);
        if ($random_type) {
            $this->db->order_by('rand()');
        } else {
            $this->db->order_by('onlineexam_questions.id', 'DESC');
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function onlineexamReport($condition)
    {

        // $this->db->select('*')->from('onlineexam')->where($condition);
        // $query = $this->db->get();
        // return $query->result();
        $query = "SELECT onlineexam.*,(select count(*) from onlineexam_students WHERE onlineexam_students.onlineexam_id = onlineexam.id) as assign,(select count(*) from onlineexam_questions where onlineexam_questions.onlineexam_id=onlineexam.id) as questions FROM `onlineexam`  where " . $condition . " order by onlineexam.id asc";

        $query = $this->db->query($query);
        return $query->result();

    }

    public function onlineexamatteptreport($condition)
    {

        $query = "SELECT student_session.id,students.admission_no,students.id as sid, CONCAT_WS(' ',firstname,middlename,lastname) as name,firstname,middlename,lastname,GROUP_CONCAT(onlineexam.id,'@',onlineexam.exam,'@',onlineexam.attempt,'@',onlineexam.exam_from,'@',onlineexam.exam_to,'@',onlineexam.duration,'@',onlineexam.passing_percentage,'@',onlineexam.is_active,'@',onlineexam.publish_result) as exams,GROUP_CONCAT(onlineexam_students.onlineexam_id) as attempt,`classes`.`id` AS `class_id`, `student_session`.`id` as `student_session_id`, `students`.`id`, `classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, `students`.`id`, `students`.`admission_no` FROM `student_session` INNER JOIN onlineexam_students on onlineexam_students.student_session_id=student_session.id INNER JOIN students on students.id=student_session.student_id JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` INNER JOIN onlineexam on onlineexam_students.onlineexam_id=onlineexam.id WHERE  student_session.session_id=" . $this->db->escape($this->current_session) . " and students.is_active='yes' " . $condition . " group by students.id";

        $query = $this->db->query($query);

        return $query->result_array();
    }


    public function getstudentByexam_id($id){
        $this->db->select('students.*,classes.class,sections.section')->from('onlineexam_students')->join('student_session','student_session.id=onlineexam_students.student_session_id')->join('students','students.id=student_session.student_id');
         $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('onlineexam_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_msnstatusByexam_id($id){
         return $this->db->select('onlineexam.publish_exam_notification,onlineexam.publish_result_notification')->where('onlineexam.id',$id)->get('onlineexam')->row_array();

    }

}
