<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examgrade_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {

        $examgrade_condition = 0;
        $userdata = $this->customlib->getUserData();

        $role_id = $userdata["role_id"];


        if (isset($role_id) && ($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            if ($userdata["class_teacher"] == 'yes') {



                $my_classes = $this->teacher_model->my_classes($userdata['id']);


                if (!empty($my_classes)) {
                    $examgrade_condition = 0;
                // } else {
                //     $examgrade_condition = 1;
                //     $my_examgrades = $this->teacher_model->get_examgrades($userdata['id']);
                }
            }
        }
        $this->db->select()->from('examgrades');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            // if ($examgrade_condition == 1) {
            //     $this->db->where_in('examgrades.id', $my_examgrades);
            // }
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function remove($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('examgrades');
        $message = DELETE_RECORD_CONSTANT . " On examgrades id " . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /* Optional */
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
    }

    public function add($data) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('examgrades', $data);
            $message = UPDATE_RECORD_CONSTANT . " On examgrades id " . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
            } else {
                //return $return_value;
            }
        } else {
            $this->db->insert('examgrades', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On examgrades id " . $id;
            $action = "Insert";
            $record_id = $id;
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

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

    function check_data_exists($data) {
        $this->db->where('name', $data['name']);
        $query = $this->db->get('examgrades');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
