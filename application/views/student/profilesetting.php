<style type="text/css">
    .material-switch > input[type="checkbox"] {
        display: none;
    }

    .material-switch > label {
        cursor: pointer;
        height: 0px;
        position: relative;
        width: 40px;
    }

    .material-switch > label::before {
        background: rgb(0, 0, 0);
        box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        content: '';
        height: 16px;
        margin-top: -8px;
        position:absolute;
        opacity: 0.3;
        transition: all 0.4s ease-in-out;
        width: 40px;
    }
    .material-switch > label::after {
        background: rgb(255, 255, 255);
        border-radius: 16px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        content: '';
        height: 24px;
        left: -4px;
        margin-top: -8px;
        position: absolute;
        top: -4px;
        transition: all 0.3s ease-in-out;
        width: 24px;
    }
    .material-switch > input[type="checkbox"]:checked + label::before {
        background: inherit;
        opacity: 0.5;
    }
    .material-switch > input[type="checkbox"]:checked + label::after {
        background: inherit;
        left: 20px;
    }
    .table .pull-right {text-align: initial; width: auto; float: right !important;}
}
</style>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
             <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('student')." ".$this->lang->line('profile')." ".$this->lang->line('update'); ?></h3>
                        </div>
                            <div class="box-body">
                      <form action="<?php echo site_url('student/profilesetting') ?>" method="post" accept-charset="utf-8">
                        <input type="hidden" name="sch_id" value="<?php echo $result->id; ?>">
                                        <div class="form-group row">
                                         <label class="col-sm-4"><?php echo $this->lang->line('allow')." ".$this->lang->line('editable')." ".$this->lang->line('form')." ".$this->lang->line('fields'); ?></label>
                                            <div class="col-sm-8">
                                                <label class="radio-inline">
                                                    <input type="radio" name="student_profile_edit" value="0" <?php
                                                    if ($result->student_profile_edit == 0) {
                                                        echo "checked";
                                                    }
                                                    ?> ><?php echo $this->lang->line('disabled'); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="student_profile_edit" value="1" <?php
                                                    if ($result->student_profile_edit == 1) {
                                                        echo "checked";
                                                    }
                                                    ?>><?php echo $this->lang->line('enabled'); ?>
                                                </label>
                                            </div>
                                         </div>
                              
  <div class="form-group row"> 
    <div class="col-sm-10"> 
      <button type="submit" class="btn btn-primary"> <?php echo $this->lang->line('save'); ?></button>
    </div>
  </div>
</form>
		<div class="box-header">		
		<h3 class="box-title"><?php echo $this->lang->line('allowed_edit_form_fields_on_student_profile'); ?></h3></div>                                   
                                    <div class="download_label"><?php echo $this->lang->line('allowed_edit_form_fields_on_student_profile'); ?></div>
                             <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>
										
                                    </tr>
                                </thead>
                                <tbody> 
                                <?php  
                               
                                                            if (!empty($fields)) {
                                                                $hide=0;
                                foreach ($fields as $fields_key => $fields_value) {
                                    if (array_key_exists($fields_key,$sch_setting_detail))
                              {
                              

                                            if (($sch_setting_detail->$fields_key)) {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $fields_value; ?></td>
                                                    <td  class="text-right">
                                                        <div class="material-switch pull-right">
                                                    <input id="field_<?php echo $fields_key?>" name="<?php echo $fields_key; ?>" type="checkbox" data-role="field_<?php $fields_key?>" class="chk"  value="" <?php echo set_checkbox($fields_key, $fields_key, findSelected($inserted_fields,$fields_key)); ?>/>
                                                            <label for="field_<?php echo $fields_key?>" class="label-success"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                              <?php
                                            }
                                        }else{
                                            $hide=0;
                                            if($fields_key=='if_guardian_is'){
                                                if($sch_setting_detail->guardian_name==0){
                                                   $hide=1;  
                                                }
                                            }
                                            if($hide==0){
                                            ?>
                                                <tr>
                                                    <td><?php echo $fields_value; ?></td>
                                                    <td  class="text-right">
                                                    <div class="material-switch pull-right">
                                                    <input id="field_<?php echo $fields_key?>" name="<?php echo $fields_key; ?>" type="checkbox" data-role="field_<?php $fields_key?>" class="chk"  value="" <?php echo set_checkbox($fields_key, $fields_key, findSelected($inserted_fields,$fields_key)); ?>/>
                                                    <label for="field_<?php echo $fields_key?>" class="label-success"></label>
                                                    </div>
                                                    </td>
                                                </tr>
                                <?php
                            }
                                        }
                                        }
                                        }

                                        ?>

                                </tbody>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php 

function findSelected($inserted_fields,$find){
    foreach ($inserted_fields as $inserted_key => $inserted_value) {
      if ($find == $inserted_value->name && $inserted_value->status) {
        return true;
       }

    }
    return false;
}
 ?>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.chk', function(event) {      
   
    var name=$(this).attr('name');
            var status=1;
    if(this.checked) {
     status=1;
    } else {
     status=0;
    }
     if(confirm("<?php echo $this->lang->line('confirm_status'); ?>")){
      
        changeStatus(name, status);
    }
    else{
             event.preventDefault();
       
    }
});
      
    });

    function changeStatus(name, status) {

        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "student/changeprofilesetting",
            data: {'name': name, 'status': status},
            dataType: "json",
            success: function (data) {
                successMsg(data.msg);
            }
        });
    }


</script>