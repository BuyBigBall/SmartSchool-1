<?php
if (!empty($chatList)) { ?>
    <li style="margin: 0px;">
        <div>            
            <input id = "select-all" name="select-all" class="del-chk" type="checkbox" value="0" style="visibility:hidden;">
            <input type="button" class="chat-btn" id="delete_btn" name="" value="delete message" style="margin-left:10px;visibility:hidden;">
        </div>
    </li>
    <?php 
    foreach ($chatList as $chat_key => $chat_value) {
        $chat_type = ($chat_value->chat_user_id != $chat_user->id) ? 'replies' : 'sent';
        $date_time = ($chat_value->chat_user_id != $chat_user->id) ? 'time_date_send' : 'time_date';
        ?>
        <?php
        if ($chat_value->is_first) {
            ?>
            <li class="text text-center" style="margin: 0px;">
                <h4 class="chattitle"><span class=""><?php echo $this->lang->line('you_are_now_connected_on_chat') ?></span></h4>
            </li>
            <?php
        } else {
            ?>
            <li class="<?php echo $chat_type; ?>">
                <?php if($chat_type == 'sent'){ ?> 
                    <input id = "<?php echo $chat_value->id; ?>" name="chatbox" class="chatbox" type="checkbox" value="<?php echo $chat_value->id; ?>" style="visibility:hidden;float:left;">
                <?php }else{ ?>                
                    <input id = "<?php echo $chat_value->id; ?>" name="chatbox" class="chatbox" type="checkbox" value="<?php echo $chat_value->id; ?>" style="float: right;visibility:hidden;float:left;">
                <?php } ?>
                <p><?php echo $chat_value->message; ?></p>
                <span class="<?php echo $date_time; ?>"> <?php echo $this->customlib->dateyyyymmddToDateTimeformat($chat_value->created_at); ?></span>
            </li>
            <?php
        }
        ?>
        <?php
    }
}
?>