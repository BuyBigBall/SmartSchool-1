<?php
$response_json = isJSON($userList);
if ($response_json) {

    $userList = (json_decode($userList));
    
    if (!empty($userList)) {
        foreach ($userList->chat_users as $user_key => $user_value) {
            if (!empty($user_value->messages)) {
                $count_noti = getConnectionNotification($userList, $user_value->id);
                ?>
                <li class="contact" data-chat-connection-id="<?php echo $user_value->id; ?>">
                    <div class="wrap">
                        <?php
                        if ($user_value->user_details->image == "") {
                            $img = base_url() . "uploads/staff_images/no_image.png";
                        } else {
                            $img = ($user_value->user_details->user_type == "staff") ? base_url() . "uploads/staff_images/" . $user_value->user_details->image : base_url() . $user_value->user_details->image;
                        }
                        ?>
                        <img src="<?php echo $img; ?>" alt="">
                        <div class="meta">
                            <p class="name">
                                <?php
                                $staff_name= ($user_value->user_details->surname == "")? $user_value->user_details->name : $user_value->user_details->name." ".$user_value->user_details->surname; 

                                echo ($user_value->user_details->user_type == "staff") ? 
                                            " " . $staff_name . " ": 
                                            (
                                                ($user_value->user_details->user_type == "parent") ? 
                                                $user_value->user_details->guardian_name    :
                                                " " . $this->customlib->getFullName($user_value->user_details->firstname,$user_value->user_details->middlename,$user_value->user_details->lastname,$sch_setting->middlename,$sch_setting->lastname)
                                            );
                                echo ($user_value->user_details->user_type == "staff") ? " (" . $this->lang->line('staff') . ")" : ( ($user_value->user_details->user_type == "parent") ? ' (Parent)' : " (" . $this->lang->line('student') . ")");

                                if($user_value->user_details->user_type == "parent")
                                echo
                                    " <br />&nbsp; &nbsp; [ " . $this->customlib->getFullName($user_value->user_details->firstname,$user_value->user_details->middlename,$user_value->user_details->lastname,$sch_setting->middlename,$sch_setting->lastname)  . 
                                    "'s " . $user_value->user_details->guardian_relation. " ]" ;
                                ?>
                                <?php 
                                if((time()-$user_value->user_details->history_time)<$limit_time){ 
                                    echo "-online";
                                }
                                ?>

                                </p>


                            <p class="preview">
                                <?php
                                if ($chat_user->id != $user_value->messages->chat_user_id) {
                                    echo "<span>" . $this->lang->line('you') . ": </span>";
                                }
                                ?>
                                <?php echo $user_value->messages->message; ?></p>
                        </div>
                    </div>
                    <?php
                    if ($count_noti > 0) {
                        ?>
                        <span class="chatbadge notification_count"><?php echo $count_noti; ?></span> 
                        <?php
                    } else {
                        ?>
                        <span class="chatbadge notification_count displaynone">0</span> 
                        <?php
                    }
                    ?>

                </li>
                <?php
            }
        }
    }
}

function getConnectionNotification($userList, $chat_connection_id) {
    if (!empty($userList->chat_user_notification)) {
        foreach ($userList->chat_user_notification as $notifiction_key => $notifiction_value) {
            if ($notifiction_value->chat_connection_id == $chat_connection_id) {
                return $notifiction_value->no_of_notification;
            }
        }
    }
    return 0;
}
?>