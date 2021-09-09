<?php
if (!empty($chat_user)) {
    echo "<ul class='list-group' id='contact-list'>";
    foreach ($chat_user as $user_key => $user_value) {
        $userType = ($user_value->student_id != "") ? 'Student' : (($user_value->parent_id != "") ? 'Parent' : 'Staff' );
        $userId = ($user_value->student_id != "") ? $user_value->student_id : (($user_value->parent_id != "") ? $user_value->parent_id : $user_value->staff_id);
        ?>
        <li class="list-group-item" data-user-type="<?php echo $userType; ?>" data-user-id="<?php echo $userId; ?>">
            <div class="col-xs-2 col-sm-1">
                <?php
                if ($user_value->image == "") {
                    $img = base_url() . "uploads/staff_images/no_image.png";
                } else {
                    $img = ($user_value->student_id == "") ? base_url() . "uploads/staff_images/" . $user_value->image : base_url() . $user_value->image;
                }
                ?>

                <img src="<?php echo $img; ?>" alt="Glenda Patterson" class="img-responsive">
            </div>
            <div class="col-xs-10 col-sm-9">
                <span class="name"> <?php
              
                    if ($user_value->student_id != "") {
                        echo $this->customlib->getFullName($user_value->first_name,$user_value->middle_name,$user_value->last_name,$sch_setting->middlename,$sch_setting->lastname);
                    } else {
                       echo ($user_value->surname == "")? $user_value->name : $user_value->name." ".$user_value->surname; 
                    }
                    ?>

                    <?php 
                    if((time()-$user_value->history_time)<$limit_time){ 
                        echo "-online";
                    }
                    ?>
                        
                    </span>
                <br>

                <span>
                    <?php
                    if ($user_value->student_id != "") 
                    {
                        echo "(" . $this->lang->line('student') . ")";
                    } 
                    else if ($user_value->parent_id != "") 
                    {
                        echo "(" . $this->lang->line('parent') . ")";
                    } 
                    else 
                    {
                        echo "(" . $user_value->rolename. ")";
                    }
                    ?>
                </span>
            </div>
            <div class="clearfix"></div>
        </li>
        <?php
    }
    echo "</ul>";
}
?>