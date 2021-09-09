<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class History_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function setHistory($data){
        if(empty($data['id'])){
            $history = array(
                'user_id' => $data['user_id'],
                'user_type' => $data['user_type'],
                'session_id' => $data['session_id'],
                'event_time' => $data['event_time'],
            );
            $this->db->insert("history", $history);
        }else{
            $history = array('session_id' => $data['session_id'], 'event_time' => $data['event_time']);
            $this->db->where("id", $data['id'])->update("history", $history);
        }
    }

    public function getHistory($user_id = "" ,$user_type = ""){
        $sql  = " SELECT *  FROM history ";  
        $sql .= " WHERE history.`user_id` = " . $this->db->escape($user_id). "  ";
        $sql .= " AND history.`user_type` = " . $this->db->escape($user_type). "  "; 
        $query = $this->db->query($sql);        
        return $query->result();
    }

}
