<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/ckeditor/ckeditor.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bullhorn"></i> <?php echo $this->lang->line('communicate'); ?><small><?php echo $this->lang->line('student_fee1'); ?></small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="form1" action="<?php echo base_url() ?>admin/notification/edit/<?php echo $id ?>"  
                    id="employeeform" name="employeeform" 
                    method="post" accept-charset="utf-8"
                    enctype="multipart/form-data" >
                    <?php
                    $prev_roles = explode(',', $notification['roles']);
                    foreach ($prev_roles as $prev_roles_key => $prev_roles_value) {
                        ?>

                        <input type="hidden" name="prev_roles[]" value="<?php echo $prev_roles_value; ?>">
                        <?php
                    }
                    ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-commenting-o"></i> <?php echo $this->lang->line('edit_message'); ?></h3>
                        </div>                     
                        <div class="box-body">

                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label>
                                    <input autofocus="" id="title" name="title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('title', $notification['title']); ?>" />
                                    <span class="text-danger"><?php echo form_error('title'); ?></span>
                                </div>
                                <div class="form-group">
                                        <label class="pr20"><?php echo $this->lang->line('attachment'); ?></label>
                                        <input type="file" id="attached_file" class="filestyle form-control" name="attached_file">
                                        <span class="text-danger"><?php echo form_error('message'); ?></span>
                                </div>                                    
                                <div class="form-group"><label><?php echo $this->lang->line('message'); ?></label>
                                    <textarea id="group_msg_text" name="message" class="form-control compose-textarea ckeditor" cols="35" rows="20">
                                        <?php echo set_value('message', $notification['message']); ?>
                                    </textarea>
                                    <!-- <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px; display:none;">
                                        <?php echo set_value('message', $notification['message']); ?>
                                    </textarea> -->
                                    <span class="text-danger"><?php echo form_error('message'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="box-body">
                                    <?php
                                    if (isset($error_message)) {
                                        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label for="date"><?php echo $this->lang->line('notice_date'); ?></label>
                                        <input id="date" name="date"  placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($notification['date']))); ?>" />
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="publish_date"><?php echo $this->lang->line('publish_on'); ?></label>
                                        <input id="publish_date" name="publish_date"  placeholder="" type="text" class="form-control date"  value="<?php echo set_value('publish_date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($notification['publish_date']))); ?>" />
                                        <span class="text-danger"><?php echo form_error('publish_date'); ?></span>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="#class_id"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if ($class_id == $class['id']) {
                                                    echo "selected=selected";
                                                }
                                                ?>><?php echo $class['class'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                    <div class="form-group" style="margin-bottom:40px;">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                            <ul class='sectionlist' id="sectionlist" style="padding-left:10px;">
                                                
                                            </ul>
                                    </div>
                                    <div class="form-group" style="margin-bottom:40px;">
                                        <?php 
                                            $uploaddir = '../../../uploads/notice_attached/';
                                            if( !empty($notification['filename'])) { ?>
                                            
                                            <ul class="nav nav-pills nav-stacked">
                                            <li><?php echo $this->lang->line('attachment'); ?> : 
                                                <span data-toggle="popover" class="detail_popover" 
                                                    data-original-title="" title="" >
                                                <a href="<?php echo $uploaddir.$notification['attached_file']; ?>" style="margin-left:100px;margin-top:-20px;">
                                                <i class="fa fa-download"></i>
                                                <?php echo $notification['filename']; ?></a> 
                                                </span>
                                            </li>
                                            </ul>
                                        <?php } ?>
                                    </div>                                    
                                    <span class="text-danger"><?php echo form_error('section_id[]'); ?></span>
                                    <!-- <div class="form-horizontal">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('message_to'); ?></label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="student" <?php echo set_checkbox('visible[]', 'student', (set_value('visible[]', $notification['visible_student']) == 'Yes') ? TRUE : FALSE); ?> /> <b><?php echo $this->lang->line('student'); ?></b> </label>
                                        </div>
                                        <div class="checkbox">                                     
                                            <label><input type="checkbox" name="visible[]"  value="parent"  <?php echo set_checkbox('visible[]', 'student', (set_value('visible[]', $notification['visible_parent']) == 'Yes') ? TRUE : FALSE); ?>  /> <b><?php echo $this->lang->line('parent'); ?></b></label>
                                        </div>
                                        <?php
                                        foreach ($roles as $role_key => $role_value) {
                                            ?>
                                            <div class="checkbox">

                                                <label>
                                                    <input type="checkbox" name="visible[]" value="<?php echo $role_value['id']; ?>" 
                                                    <?php echo set_checkbox('visible[]', $role_value['id'], (set_value('visible[]', in_array($role_value['id'], $prev_roles)) == 1) ? TRUE : FALSE); ?>
                                                           /> <b><?php echo $role_value['name']; ?></b> 
                                                </label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div> 
                                    <span class="text-danger"><?php echo form_error('visible[]'); ?></span>
                                    -->
                                </div>
                            </div>                         
                            <div class="box-footer" style="clear: both;">
                                <div class="pull-right">

                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-envelope-o"></i> <?php echo $this->lang->line('send'); ?> </button>
                                </div>
                            </div>                           
                        </div>                      
                    </div>
                </form>              
            </div>
        </div>
        <div class="row">           
            <div class="col-md-12">
            </div>
        </div>  
    </section>
</div>

<script>
    var section_Ids = [<?php echo $section_Id_string ?>];
    $(document).ready( function() {
        GetSectionList('<?php echo $class_id ?>');
    });
    function GetSectionList(class_id)
    {
        $('#sectionlist').html("");
            var base_url = '<?php echo base_url() ?>';
            var ul_data = '<li style="list-style-type: none;"><input id="section_0" type="checkbox" /> <div style="margin-left:25px;margin-top:-22px;"><label for="section_0" style="cursor:pointer;">section 0</label></div></li>';
            ul_data = '';                             
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var checked = '';
                        for(iCount=0; iCount<section_Ids.length; iCount++)
                        {
                            if( section_Ids[iCount]==obj.section_id )
                            {
                                checked = 'checked=checked';
                                break;
                            }
                        }
                        ul_data += '<li style="list-style-type: none;"><input id="section_'+ obj.section_id +'" type="checkbox" name="section_id[]" value="'+ obj.section_id +'" '+ checked +' /> <div style="margin-left:25px;margin-top:-22px;"><label for="section_'+ obj.section_id +'" style="cursor:pointer;">' + obj.section + '</label></div></li>';
                    });

                    $('#sectionlist').append(ul_data);
                }
            });

    }
    $(document).on('change', '#class_id', function (e) {
            var class_id = $(this).val();
            GetSectionList(class_id);
        });

    // $(function () {
    //     $("#compose-textarea").wysihtml5();
    // });
</script>