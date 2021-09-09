<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Chatuser_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed 
     */
    public function searchForUser($keyword, $chat_user_id, $user_type = 'staff', $login_id) {

        // Search Students and staffs for staff
        if ($user_type == 'staff' || $user_type == '') 
        {
            // ( added 'Null as parent_id, roles.name as rolename,')
            $sql = "SELECT roles.name as rolename, Null as parent_id, staff.id as `staff_id`,Null as `student_id`, staff.name, staff.surname , Null as `first_name`,Null as `middle_name`,Null as `last_name`,staff.image,history.`event_time` AS history_time FROM `staff` LEFT JOIN history ON staff.id = history.`user_id` AND history.`user_type` = 'staff'  LEFT JOIN staff_roles ON staff_roles.`staff_id` = staff.`id` LEFT JOIN roles ON roles.`id` = staff_roles.`role_id` WHERE staff.name LIKE '%" . $keyword . "%'  and staff.is_active= 1 and staff.id NOT IN(SELECT chat_users.staff_id FROM `chat_users` inner JOIN (SELECT chat_connections.id, CASE  WHEN chat_user_one =" . $chat_user_id . " THEN chat_user_two ELSE chat_connections.chat_user_one END as 'chat_user_id' FROM `chat_connections` WHERE  (chat_user_one=" . $chat_user_id . " or chat_user_two=" . $chat_user_id . ")) as chat_connections on chat_connections.chat_user_id=chat_users.id WHERE staff_id IS NOT NULL) and staff.id != " . $login_id . " Union  SELECT 'Student' as rolename, Null as parent_id, Null as `staff_id`,students.id as `student_id`,Null as `name`,Null as `surname`,students.firstname,students.middlename,students.lastname,students.image,history.`event_time` AS history_time FROM `students` LEFT JOIN history ON students.id = history.`user_id` AND history.`user_type` = 'student' WHERE (students.firstname LIKE '%" . $keyword . "%' or students.middlename LIKE '%" . $keyword . "%' or students.lastname LIKE '%" . $keyword . "%')  and students.is_active='yes' and students.id NOT IN(SELECT chat_users.student_id FROM `chat_users` inner JOIN (SELECT chat_connections.id, CASE  WHEN chat_user_one =" . $chat_user_id . " THEN chat_user_two ELSE chat_connections.chat_user_one END as 'chat_user_id' FROM `chat_connections` WHERE  (chat_user_one=" . $chat_user_id . " or chat_user_two=" . $chat_user_id . ")) as chat_connections on chat_connections.chat_user_id=chat_users.id WHERE student_id IS NOT NULL AND user_type='student')";
        } 
        // Search Stuff for student
        else if ($user_type == 'student') 
        {
            // ( added 'Null as parent_id, roles.name as rolename,')
            $sql = "SELECT roles.name as rolename, Null as parent_id, staff.id as `staff_id`,Null as `student_id`,staff.name, staff.surname ,staff.image, history.`event_time` AS history_time FROM `staff` LEFT JOIN history ON staff.`id` = history.`user_id` AND history.`user_type` = 'staff' LEFT JOIN staff_roles ON staff_roles.`staff_id` = staff.`id` LEFT JOIN roles ON roles.`id` = staff_roles.`role_id` WHERE staff.name LIKE '%" . $keyword . "%' and staff.is_active= 1 and staff.id NOT IN(SELECT chat_users.staff_id FROM `chat_users` inner JOIN (SELECT chat_connections.id, CASE  WHEN chat_user_one =" . $chat_user_id . " THEN chat_user_two ELSE chat_connections.chat_user_one END as 'chat_user_id' FROM `chat_connections` WHERE  (chat_user_one=" . $chat_user_id . " or chat_user_two=" . $chat_user_id . ")) as chat_connections on chat_connections.chat_user_id=chat_users.id WHERE staff_id IS NOT NULL)";
        }

        // added all type chat users for Super admin
        if($user_type == '')
        {
            // Search staffs and students for staffs ( added 'Null as parent_id, roles.name as rolename,')
            $query = $this->db->query($sql);
            $result = $query->result();

            //Search parents for staffs
            $sql = "SELECT 'Parent' as rolename, parents.parent_id as parent_id, Null as `staff_id`,Null as `student_id`, parents.guardian_name as name, '' as surname ,Null as image, history.`event_time` AS history_time 
                FROM (SELECT * FROM students WHERE is_active='yes') as parents
                LEFT JOIN history ON parents.`parent_id` = history.`user_id` AND history.`user_type` = 'parent' 
                WHERE parents.guardian_name LIKE '%" . $keyword . "%' 
                    and parents.parent_id NOT IN
                    (
                        SELECT chat_users.student_id 
                        FROM `chat_users` 
                        inner JOIN (
                                SELECT chat_connections.id, CASE  WHEN chat_user_one =" . $chat_user_id . " THEN chat_user_two ELSE chat_connections.chat_user_one END as 'chat_user_id' 
                                FROM `chat_connections` 
                                WHERE  (chat_user_one=" . $chat_user_id . " or chat_user_two=" . $chat_user_id . ")) as chat_connections 
                        on chat_connections.chat_user_id=chat_users.id 
                    WHERE student_id IS NOT NULL AND user_type='parent') ";
            $query = $this->db->query($sql);
            $result = $result + $query->result();

            return $result;
        }

        $query = $this->db->query($sql);
        return $query->result();
    }    

    public function myUser($staff_id, $chat_connection_id, $user_type = 'staff') {
        if ($user_type == 'staff') {

            $sql = " SELECT * from chat_connections WHERE chat_connections.chat_user_one= (SELECT id FROM `chat_users` WHERE staff_id=" . $staff_id . ") or chat_connections.chat_user_two = (SELECT id FROM `chat_users` WHERE staff_id=" . $staff_id . ") ORDER BY `chat_connections`.`id` DESC";
        } else {// if ($user_type == 'student' || $user_type == 'parent') {
            $sql = " SELECT * from chat_connections WHERE chat_connections.chat_user_one= (SELECT id FROM `chat_users` WHERE student_id=" . $staff_id . " AND user_type='" . $user_type ."') or chat_connections.chat_user_two = (SELECT id FROM `chat_users` WHERE student_id=" . $staff_id . " AND user_type='" . $user_type ."') ORDER BY `chat_connections`.`id` DESC";
        } 
        $query = $this->db->query($sql);

        $chat_users = $query->result();
        foreach ($chat_users as $chat_users_key => $chat_users_value) {
            $messages = $this->getLastMessages($chat_users_value->id);
            $messages = $this->getLastMessages($chat_users_value->id);
            $chat_users_value->{'messages'} = $messages;

            $chat_user_id = $chat_users_value->chat_user_one;
            if ($chat_users_value->chat_user_one == $chat_connection_id) {
                $chat_user_id = $chat_users_value->chat_user_two;
            }

            $chat_users_value->{'user_details'} = $this->getChatUserDetail($chat_user_id);
        }
        $return_result = array(
            'chat_users' => $chat_users,
            'chat_user_notification' => $this->getChatNotification($chat_connection_id),
        );

        return json_encode($return_result);
    }

    public function getLastMessages($chat_connection_id) {
        $sql = "SELECT * FROM chat_messages WHERE id=(SELECT max(id) FROM `chat_messages` WHERE chat_connection_id=" . $chat_connection_id . ")";

        $query = $this->db->query($sql);
        $chat_messages = $query->row();
        return $chat_messages;
    }

     public function getChatUserDetail($chat_user_id, $user_type='staff') {
        $sql = "SELECT chat_users.id as `chat_user_id`, chat_users.user_type,chat_users.student_id,staff_id ";
        $sql .= ",students.firstname,students.middlename,students.lastname";
        $sql .= ",students.guardian_name,students.guardian_relation";
        $sql .= ",staff.name,staff.surname";
        $sql .= ",(CASE WHEN staff_id IS NULL THEN (SELECT
students.image as `image` FROM students WHERE students.id=chat_users.student_id) ELSE (SELECT staff.image as `image` FROM staff WHERE staff.id=chat_users.staff_id) END) as image";
        $sql .= ", history.`event_time` AS history_time ";
        $sql .= " FROM `chat_users` ";
        $sql .= " left JOIN students on students.id=chat_users.student_id ";
        $sql .= " left JOIN staff on staff.id=chat_users.staff_id ";
        $sql .= " LEFT JOIN history ON chat_users.`user_type` = history.`user_type` AND (CASE WHEN (chat_users.`user_type`='student') THEN chat_users.`student_id` = history.`user_id` ELSE staff_id = history.`user_id` END) ";
        $sql .= " WHERE chat_users.id=" . $chat_user_id;
        if($user_type=='parent')
            $sql .= " AND chat_users.user_type='parent'";
        //print($sql); exit;
        $query = $this->db->query($sql);
        $chat_user = $query->row();

        return $chat_user;
    }

    public function deleteMessage($id, $chat_user_id){

        $sql = "SELECT * FROM chat_messages WHERE id= ".$id;
        $query = $this->db->query($sql);
        $chat_message = $query->row();
        
        if( $chat_message->delete1 != '0' ){
            $data = array('deleted2' => $chat_user_id);
        }else{
            $data = array('deleted1' => $chat_user_id);
        }

        $this->db->where("id", $id)->update("chat_messages", $data);
    }

    public function myChatAndUpdate($chat_connection_id, $chat_user_id) {
        $update_read = array('is_read' => 1);
        $this->db->where('chat_connection_id', $chat_connection_id);
        $this->db->where('chat_user_id', $chat_user_id);
        $this->db->update('chat_messages', $update_read);
        $sql  = " SELECT * FROM `chat_messages` WHERE chat_connection_id=" . $chat_connection_id;
        $sql .= " AND deleted1 != ".$chat_user_id." AND deleted2 != ".$chat_user_id;
        $query = $this->db->query($sql);
        $chat_messages = $query->result();
        return $chat_messages;
    }

    public function countTotalUnreadMessage($reciver_id){
        $sql  = " SELECT * ";
        $sql .= " FROM (";
        $sql .= "     SELECT cm.* ";
        $sql .= "     ,cu.`user_type`";
        $sql .= "     ,(CASE WHEN cu.user_type = 'student' THEN cu.`student_id` ELSE cu.`staff_id` END) AS receier_id "; 
        $sql .= "     FROM chat_messages cm ";
        $sql .= "     LEFT JOIN chat_users cu ON cm.`chat_user_id` = cu.`id` ";
        $sql .= "     WHERE cm.`is_read` = '0' ) t ";
        $sql .= " WHERE t.receier_id =".$reciver_id;
        
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getMyID($id, $user_type = 'staff') {
        if ($user_type == 'staff') {
            $sql = "SELECT * FROM `chat_users` WHERE staff_id=" . $id . " and user_type='staff'";
        }
        elseif ($user_type == 'student') {
            $sql = "SELECT * FROM `chat_users` WHERE student_id=" . $id . " and user_type='student'";
        }
        else{
            $sql = "SELECT * FROM `chat_users` WHERE student_id=" . $id . " and user_type='" . $user_type . "'";
        }
        $query = $this->db->query($sql);
        $chat_messages = $query->row();
        return $chat_messages;
    }

    public function getChatNotification($chat_user_id) {

        $sql = "SELECT COUNT(*) as `no_of_notification`, chat_connection_id FROM `chat_messages`   WHERE chat_connection_id in (SELECT chat_connections.id FROM `chat_connections` WHERE chat_user_one=" . $chat_user_id . " or chat_user_two=" . $chat_user_id . ") and chat_user_id=" . $chat_user_id . "  and is_read = 0 GROUP by chat_connection_id ORDER BY `chat_connection_id` ASC";
        $query = $this->db->query($sql);
        $chat_notification = $query->result();
        return $chat_notification;
    }

    public function getChatConnectionByID($id) {
        $this->db->select()->from('chat_connections');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function addMessage($insert) {
        $this->db->insert('chat_messages', $insert);
        return $this->db->insert_id();
    }

    public function getUpdatedchat($chat_connection_id, $last_chat_id, $chat_user_id) {
        $update_read = array('is_read' => 1);
        $this->db->where('chat_connection_id', $chat_connection_id);
        $this->db->where('chat_user_id', $chat_user_id);
        $this->db->update('chat_messages', $update_read);

        $sql = "SELECT * FROM `chat_messages` WHERE chat_connection_id=" . $chat_connection_id . " and id > " . $last_chat_id . " ORDER BY `chat_messages`.`chat_connection_id` ASC";
        $query = $this->db->query($sql);
        $chat_messages = $query->result();
        return $chat_messages;
    }

    public function addNewUser($first_entry, $insert_data, $panel = "staff", $id, $insert_message) {

        $chat_connections = array('chat_user_one' => '', 'chat_user_two' => '');
        $this->db->where('staff_id', $first_entry['staff_id']);
        $this->db->where('user_type', $first_entry['user_type']);
        $q = $this->db->get('chat_users');
        if ($insert_data['user_type'] == 'staff') {
            $this->db->where('staff_id', $insert_data['staff_id']);
            $this->db->where('user_type', $insert_data['user_type']);
            $q1 = $this->db->get('chat_users');
        } elseif ($insert_data['user_type'] == 'student') {
            $this->db->where('student_id', $insert_data['student_id']);
            $this->db->where('user_type', $insert_data['user_type']);
            $q1 = $this->db->get('chat_users');
        } elseif ($insert_data['user_type'] == 'parent') {
            $this->db->where('student_id', $insert_data['parent_id']);
            $this->db->where('user_type', $insert_data['user_type']);
            $q1 = $this->db->get('chat_users');
        }

        //print($q->num_rows() . ' ' . $q1->num_rows()); exit;
        if ($q->num_rows() > 0 && $q1->num_rows() > 0) {
            $chat_connections['chat_user_one'] = $q->row()->id;
            $chat_connections['chat_user_two'] = $q1->row()->id;
            $this->db->insert('chat_connections', $chat_connections);
            $new_user_chat_connection_id = $this->db->insert_id();
            $insert_message['chat_user_id'] = $chat_connections['chat_user_two'];
            $insert_message['chat_connection_id'] = $new_user_chat_connection_id;
            $this->db->insert('chat_messages', $insert_message);
            return json_encode(array('new_user_id' => $chat_connections['chat_user_two'], 'new_user_chat_connection_id' => $new_user_chat_connection_id));
        } else if ($q->num_rows() == 0 && $q1->num_rows() > 0) {

            $this->db->insert('chat_users', $first_entry);
            $chat_connections['chat_user_one'] = $this->db->insert_id();
            $chat_connections['chat_user_two'] = $q1->row()->id;
            $this->db->insert('chat_connections', $chat_connections);
            $new_user_chat_connection_id = $this->db->insert_id();
            $insert_message['chat_user_id'] = $chat_connections['chat_user_two'];
            $insert_message['chat_connection_id'] = $new_user_chat_connection_id;
            $this->db->insert('chat_messages', $insert_message);

            return json_encode(array('new_user_id' => $chat_connections['chat_user_two'], 'new_user_chat_connection_id' => $new_user_chat_connection_id));
        } else if ($q->num_rows() > 0 && $q1->num_rows() == 0) {
            $chat_connections['chat_user_one'] = $q->row()->id;
            if ($panel == "staff") {
                $insert_data['create_staff_id'] = $id;
            }
            $this->db->insert('chat_users', $insert_data);
            $chat_connections['chat_user_two'] = $this->db->insert_id();
            $this->db->insert('chat_connections', $chat_connections);
            $new_user_chat_connection_id = $this->db->insert_id();
            $insert_message['chat_user_id'] = $chat_connections['chat_user_two'];
            $insert_message['chat_connection_id'] = $new_user_chat_connection_id;
            $this->db->insert('chat_messages', $insert_message);
            return json_encode(array('new_user_id' => $chat_connections['chat_user_two'], 'new_user_chat_connection_id' => $new_user_chat_connection_id));
        } else {
            $this->db->insert('chat_users', $first_entry);
            $chat_connections['chat_user_one'] = $this->db->insert_id();
            if ($panel == "staff") {
                $insert_data['create_staff_id'] = $id;
            }
            $this->db->insert('chat_users', $insert_data);
            $chat_connections['chat_user_two'] = $this->db->insert_id();
            $this->db->insert('chat_connections', $chat_connections);
            $new_user_chat_connection_id = $this->db->insert_id();

            $insert_message['chat_user_id'] = $chat_connections['chat_user_two'];
            $insert_message['chat_connection_id'] = $new_user_chat_connection_id;
            $this->db->insert('chat_messages', $insert_message);

            return json_encode(array('new_user_id' => $chat_connections['chat_user_two'], 'new_user_chat_connection_id' => $new_user_chat_connection_id));
        }
    }

    public function addNewUserForStudent($first_entry, $insert_data, $panel = "student", $id, $insert_message) {
        $chat_connections = array('chat_user_one' => '', 'chat_user_two' => '');
        $this->db->where('student_id', $first_entry['student_id']);
        $this->db->where('user_type', $first_entry['user_type']);
        $q = $this->db->get('chat_users');
        $this->db->where('staff_id', $insert_data['staff_id']);
        $this->db->where('user_type', $insert_data['user_type']);
        $q1 = $this->db->get('chat_users');
        if ($q->num_rows() > 0 && $q1->num_rows() > 0) {
            $chat_connections['chat_user_one'] = $q->row()->id;
            $chat_connections['chat_user_two'] = $q1->row()->id;
            $this->db->insert('chat_connections', $chat_connections);
            $new_user_chat_connection_id = $this->db->insert_id();
            $insert_message['chat_user_id'] = $chat_connections['chat_user_two'];
            $insert_message['chat_connection_id'] = $new_user_chat_connection_id;
            $this->db->insert('chat_messages', $insert_message);
            return json_encode(array('new_user_id' => $chat_connections['chat_user_two'], 'new_user_chat_connection_id' => $new_user_chat_connection_id));
        } else if ($q->num_rows() > 0 && $q1->num_rows() == 0) {
            $chat_connections['chat_user_one'] = $q->row()->id;
            if ($panel == "student") {
                $insert_data['create_student_id'] = $id;
            }
            $this->db->insert('chat_users', $insert_data);
            $chat_connections['chat_user_two'] = $this->db->insert_id();
            $this->db->insert('chat_connections', $chat_connections);
            $new_user_chat_connection_id = $this->db->insert_id();
            $insert_message['chat_user_id'] = $chat_connections['chat_user_two'];
            $insert_message['chat_connection_id'] = $new_user_chat_connection_id;
            $this->db->insert('chat_messages', $insert_message);
            return json_encode(array('new_user_id' => $chat_connections['chat_user_two'], 'new_user_chat_connection_id' => $new_user_chat_connection_id));
        } else if ($q->num_rows() == 0 && $q1->num_rows() > 0) {

            $chat_connections['chat_user_two'] = $q1->row()->id;
            $this->db->insert('chat_users', $first_entry);
            $chat_connections['chat_user_one'] = $this->db->insert_id();
            $this->db->insert('chat_connections', $chat_connections);
            $new_user_chat_connection_id = $this->db->insert_id();
            $insert_message['chat_user_id'] = $chat_connections['chat_user_two'];
            $insert_message['chat_connection_id'] = $new_user_chat_connection_id;
            $this->db->insert('chat_messages', $insert_message);
            return json_encode(array('new_user_id' => $chat_connections['chat_user_two'], 'new_user_chat_connection_id' => $new_user_chat_connection_id));
        } else {
            $this->db->insert('chat_users', $first_entry);
            $chat_connections['chat_user_one'] = $this->db->insert_id();
            if ($panel == "student") {
                $insert_data['create_student_id'] = $id;
            }
            $this->db->insert('chat_users', $insert_data);
            $chat_connections['chat_user_two'] = $this->db->insert_id();
            $this->db->insert('chat_connections', $chat_connections);
            $new_user_chat_connection_id = $this->db->insert_id();
            $insert_message['chat_user_id'] = $chat_connections['chat_user_two'];
            $insert_message['chat_connection_id'] = $new_user_chat_connection_id;
            $this->db->insert('chat_messages', $insert_message);
            return json_encode(array('new_user_id' => $chat_connections['chat_user_two'], 'new_user_chat_connection_id' => $new_user_chat_connection_id));
        }
    }

    public function mynewuser($user_id, $userlist, $user_type='staff') {
        $ids = "";
        if (!empty($userlist)) {
            $ids = join("','", $userlist);
            $ids = " and id NOT IN ('$ids') ";
        }

        $sql = "SELECT * FROM `chat_connections` WHERE (chat_user_one =" . $user_id . " or chat_user_two=" . $user_id . " )" . $ids . "ORDER BY `chat_connections`.`id` ASC";
        $query = $this->db->query($sql);
        $chat_users = $query->result();
        foreach ($chat_users as $chat_users_key => $chat_users_value) {
            $messages = $this->getLastMessages($chat_users_value->id);
            $messages = $this->getLastMessages($chat_users_value->id);
            $chat_users_value->{'messages'} = $messages;

            $chat_user_id = $chat_users_value->chat_user_one;
            if ($chat_users_value->chat_user_one == $user_id) {
                $chat_user_id = $chat_users_value->chat_user_two;
            }

            $chat_users_value->{'user_details'} = $this->getChatUserDetail($chat_user_id);
        }
        $return_result = array(
            'chat_users' => $chat_users,
            'chat_user_notification' => $this->getChatNotification($user_id),
        );

        return json_encode($return_result);
    }

}
