<?php
$language      = $this->customlib->getLanguage();
$language_name = $language["short_code"];
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" id="route">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix pt5">  <?php echo $this->lang->line('online') . " " . $this->lang->line('exam') . " " . $this->lang->line('list'); ?></h3>
                        <?php if ($this->rbac->hasPrivilege('online_examination', 'can_add')) {
                            ?>                        
                        <button class="btn btn-primary btn-sm pull-right question-btn" data-recordid="0"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add') . " " . $this->lang->line('exam') ?></button>
                    <?php
                     }
                     ?>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="mailbox-messages">
                            <div class="download_label"><?php ?> <?php echo $this->lang->line('online') . " " . $this->lang->line('exam') . " " . $this->lang->line('list'); ?></div>
                            <div class="table-responsive">
                             <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('exam'); ?></th>
										<th class="text-center"><?php echo $this->lang->line('quiz'); ?></th>
                                        <th class="text-center" width="150"><?php echo $this->lang->line('questions'); ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('attempt'); ?></th> 
                                        <th><?php echo $this->lang->line('exam') . " " . $this->lang->line('from') ?></th>
                                        <th><?php echo $this->lang->line('exam') . " " . $this->lang->line('to') ?></th>
                                        <th><?php echo $this->lang->line('duration') ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('exam') . " " . $this->lang->line('publish') ?></th>
                                        
                                        <th class="text text-center"><?php echo $this->lang->line('result') . " " . $this->lang->line('publish') ?></th>
                                        <th class="pull-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$count = 1;
foreach ($questionList as $subject_key => $subject_value) {
    $set_enable=false;
    if((($subject_value->publish_result == 0) && (strtotime($subject_value->exam_to) >= strtotime(date('Y-m-d H:i:s')))) && (($subject_value->auto_publish_date == "0000-00-00" || $subject_value->auto_publish_date == "" || $subject_value->auto_publish_date == NULL)  || strtotime($subject_value->auto_publish_date) >= strtotime(date('Y-m-d H:i:s')))){
$set_enable=true;
    }
    ?>
                                        <tr>
                                                  <td class="mailbox-name">
                                                        <a href="#" data-toggle="popover" class="detail_popover"><?php echo $subject_value->exam; ?></a>
                                                        <div class="fee_detail_popover" style="display: none">
                                                            <?php
                                                            if ($subject_value->description == "") {
                                                                ?>
                                                                <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <p class="text text-info"><?php echo $subject_value->description;; ?></p>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>
													<td class="mailbox-name text text-center"><?php
if($subject_value->is_quiz){
    ?>
<i class="fa fa-check-square-o"></i>
    <?php
}else{
    ?>
<i class="fa fa-exclamation-circle"></i>
    <?php
} ?></td>
                                             <td class="mailbox-name text-center" width="150"> <?php echo $subject_value->total_ques; ?><br />
                                                 <span>(<?php echo $this->lang->line('descriptive')?>: <?php echo $subject_value->total_descriptive_ques; ?>)</span>
                                             </td>
                                            <td class="mailbox-name text text-center"> <?php echo $subject_value->attempt; ?></td>   
                                            <td class="mailbox-name">

 <?php echo $this->customlib->dateyyyymmddToDateTimeformat($subject_value->exam_from, false); ?>
                                            </td>
                                            <td class="mailbox-name">
 <?php echo $this->customlib->dateyyyymmddToDateTimeformat($subject_value->exam_to, false); ?>
                                            </td>
                                            <td class="mailbox-name"> <?php echo $subject_value->duration; ?></td>
                                      <td class="text text-center"><?php echo ($subject_value->is_active == 1) ? "<i class='fa fa-check-square-o'></i>" : "<i class='fa fa-exclamation-circle'></i>"; ?>
                                            <?php if ($subject_value->is_active == 1) {?>
                                                <span style="display:none;"  id=""><?php echo $this->lang->line('yes'); ?>
                                                </span>
                                            <?php }?>
                                      </td>
 
                                      <td class="text text-center">
                                <?php echo ($subject_value->publish_result == 1) ? "<i class='fa fa-check-square-o'></i><span style='display:none'>Yes</span>" : "<i class='fa fa-exclamation-circle'></i><span style='display:none'>No</span>"; ?></td>

                                            <td class="pull-right">
                                                <?php
                        


        if ($this->rbac->hasPrivilege('online_assign_view_student', 'can_view')) {
        if ($set_enable) {
         
                ?>
                                  <a href="<?php echo base_url(); ?>admin/onlineexam/assign/<?php echo $subject_value->id ?>"
                                                   class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('assign / view'); ?>">
                                                    <i class="fa fa-tag"></i>
                                                </a>
                                            <?php
    }

    }

    if ($this->rbac->hasPrivilege('add_questions_in_exam', 'can_view')) {
        ?>
                                                <button type="button" class="btn btn-default btn-xs" data-recordid="<?php echo $subject_value->id; ?>" data-is_quiz="<?php echo $subject_value->is_quiz; ?>" data-toggle="modal" data-target="#myQuestionModal" title="<?php echo $this->lang->line('add') . " " . $this->lang->line('question') ?>"><i class="fa fa-question-circle"></i></button>
                                                <?php
}
    if ($this->rbac->hasPrivilege('online_examination', 'can_edit')) {
        ?>
                                                 <button type="button" class="btn btn-default btn-xs question-btn-edit" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>" id="load" data-recordid="<?php echo $subject_value->id; ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>" ><i class="fa fa-pencil"></i></button>
                                                <?php
}
    ?>

    <?php


    if ($this->rbac->hasPrivilege('add_questions_in_exam', 'can_view')) {
        ?>
 <button class="btn btn-default btn-xs exam_ques_list " data-recordid="<?php echo $subject_value->id; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('exam_questions_list'); ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-file-text-o"></i></button>


  <a href="<?php echo base_url(); ?>admin/onlineexam/evalution/<?php echo $subject_value->id ?>"
                                                   class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('exam_evalution');?>">
                                                    <i class="fa fa-newspaper-o"></i>
                                                </a>
                                                <?php 

if($subject_value->publish_result || ($subject_value->auto_publish_date != "0000-00-00" && $subject_value->auto_publish_date != "" && $subject_value->auto_publish_date != NULL && (strtotime($subject_value->auto_publish_date) <= strtotime(date('Y-m-d H:i:s'))))){
?>
 <button class="btn btn-default btn-xs generate_rank" data-exam-title="<?php echo $subject_value->exam?>" data-recordid="<?php echo $subject_value->id; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('generate_rank'); ?>" ><i class="fa fa-list-alt"></i></button>
<?php
}
                                                 ?>

        <?php
    }
    ?>

<?php
if ($this->rbac->hasPrivilege('online_examination', 'can_delete')) {
        ?>
                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/onlineexam/delete/<?php echo $subject_value->id; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            <?php
}
    ?>
                                            </td>
                                        </tr>
                                        <?php
}
$count++;
?>
                                </tbody>
                            </table>
                         </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php

function findOption($questionOpt, $find)
{

    foreach ($questionOpt as $quet_opt_key => $quet_opt_value) {
        if ($quet_opt_key == $find) {
            return $quet_opt_value;
        }
    }
    return false;
}
?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('exam') ?></h4>
            </div>
            <form action="<?php echo site_url('admin/onlineexam/add'); ?>" method="POST" id="formsubject">
                <div class="modal-body">
                    <input type="hidden" name="recordid" value="0">
                 <div>
                     <div class="row">
                    <div class="col-sm-12">
                       
                    <div class="form-group">
                  <label class="checkbox-inline"><input type="checkbox" class="is_quiz" value="1" name="is_quiz"><?php  echo $this->lang->line('quiz'); ?></label>
                  <span class="help-block"><?php echo $this->lang->line('check_on_quiz_message'); ?></span>
                 </div>

                     </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="exam"><?php echo $this->lang->line('exam') . " " . $this->lang->line('title'); ?></label><small class="req"> *</small>
                            <input type="text" class="form-control" id="exam" name="exam">
                            <span class="text text-danger exam_error"></span>
                        </div>
                     </div>

                    </div>
                    <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exam_from"><?php echo $this->lang->line('exam') . " " . $this->lang->line('from') ?></label><small class="req"> *</small>
                            <div class="input-group">
                            <input class="form-control tddm200 datetime_twelve_hour" name="exam_from" type="text" id="exam_from" name="exam_from">
                            <span class="input-group-addon" id="basic-addon2">
                                <i class="fa fa-calendar">
                                </i>
                            </span>

                        </div>
                        <span class="text text-danger exam_from_error"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exam_to"><?php echo $this->lang->line('exam') . " " . $this->lang->line('to'); ?></label><small class="req"> *</small>

                     <div class="input-group">
                            <input class="form-control tddm200 datetime_twelve_hour" name="exam_to" type="text" id="exam_to" name="exam_to">
                            <span class="input-group-addon" id="basic-addon2">
                                <i class="fa fa-calendar">
                                </i>
                            </span>
                        </div>
                    </div>
                </div>
                    <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exam_to"> <?php echo $this->lang->line('auto_result_publish_date')?></label>
                          <div class="input-group">
                            <input class="form-control tddm200 datetime_twelve_hour" name="auto_publish_date" type="text" id="auto_publish_date" name="auto_publish_date">
                            <span class="input-group-addon" id="basic-addon2">
                                <i class="fa fa-calendar">
                                </i>
                            </span>
                        </div>
                       
                    </div>
                </div>
                    </div>
                    <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="duration"><?php echo $this->lang->line('time') . " " . $this->lang->line('duration') ?></label><small class="req"> *</small>
                        <input type="text" class="form-control timepicker" id="duration" name="duration">
                        <!-- <span class="text text-primary">Use 00:00:00 for no time limit</span> -->
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="attempt"><?php echo $this->lang->line('attempt'); ?></label><small class="req"> *</small>
                        <input type="number" min="1" class="form-control" id="attempt" name="attempt" value="1">
                        <span class="text text-danger attempt_error"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                      <div class="form-group">
                        <label for="attempt"><?php echo $this->lang->line('passing') . " " . $this->lang->line('percentage') ?></label><small class="req"> *</small>
                        <input type="number" min="1" max="100" class="form-control" id="passing_percentage" name="passing_percentage">
                        <span class="text text-danger passing_percentage_error"></span>
                    </div>
                </div>
                    </div>
                <div class="row">
                   <div class="form-group col-sm-12">
        
                                     <label class="checkbox-inline">
<input type="checkbox" class="is_active" name="is_active" value="1">
                                            <?php echo $this->lang->line('publish_exam'); ?>
                                        </label>

                                     <label class="checkbox-inline">
<input type="checkbox" class="publish_result" name="publish_result" value="1">
                                           <?php echo $this->lang->line('publish') . " " . $this->lang->line('result'); ?>
                                        </label>
                                  
               
       
                                     <label class="checkbox-inline">
<input type="checkbox" class="is_neg_marking" name="is_neg_marking" value="1">
                                           <?php echo $this->lang->line('negative_marking')?>
                                        </label>

                                      <label class="checkbox-inline">
<input type="checkbox" class="is_marks_display" name="is_marks_display" value="1">
                                          <?php echo $this->lang->line('display_marks_in_exam'); ?>
                                        </label>
                 
                                      <label class="checkbox-inline">
<input type="checkbox" class="is_random_question" name="is_random_question" value="1">
                                         <?php echo $this->lang->line('random_question'); ?>
                                        </label>  

                </div>

                </div>
                <div class="row">
                    
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="description"><?php echo $this->lang->line('description'); ?></label><small class="req"> *</small>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <span class="text text-danger description_error"></span>
                    </div>
                </div>
                </div>


                  </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..."><?php echo $this->lang->line('save') ?></button>
                </div>
           </div>

        </form>
    </div>
</div>

<div id="myQuestionModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('select') . " " . $this->lang->line('questions') ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="modal_exam_id" value="0" id="modal_exam_id">
                <input type="hidden" name="modal_is_quiz" value="0" id="modal_is_quiz">
                <form action="" method="POST" accept-charset="utf-8" id="form_search">


                <div class="row">
                       <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('seach_by_keyword'); ?></label>
                            <input type="text" class="form-control" name="keyword" id="keyword" >
                        </div>
                     </div>

                        <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('question_type'); ?></label>
                           <select class="form-control" name="question_type" id="question_type">
                      <option value=""><?php echo $this->lang->line('select'); ?></option>
                            <?php
foreach ($question_type as $question_type_key => $question_type_value) {
    ?>
    <option value="<?php echo $question_type_key; ?>"><?php echo $question_type_value; ?></option>
                                <?php
}
?>
                        </select>
                        </div>
                     </div>
                        <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('question_level'); ?></label>
                            <select class="form-control" name="question_level" id="question_level">
                       <option value=""><?php echo $this->lang->line('select'); ?></option>
                            <?php
foreach ($question_level as $question_level_key => $question_level_value) {
    ?>
    <option value="<?php echo $question_level_key; ?>"><?php echo $question_level_value; ?></option>
                                <?php
}
?>
                        </select>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('subject') ?></label>
                            <select class="form-control" name="search_box" id="search_box" style="display: inline-block;">
                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                        <?php
foreach ($subjectlist as $subject_key => $subject_value) {
    ?>
                                    <option value="<?php echo $subject_value['id']; ?>"><?php echo $subject_value['name']; ?></option>
                                    <?php
}
?>

                            </select>
                        </div>
                     </div>
                      <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('class') ?></label>
                            <select class="form-control" name="class_id" id="class_id">
                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                            <?php
foreach ($classList as $class_key => $class_value) {
    ?>
    <option value="<?php echo $class_value['id']; ?>"><?php echo $class_value['class']; ?></option>
                                <?php
}
?>
                        </select>
                        </div>
                     </div>
                        <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('section') ?></label>
                          <select  id="section_id" name="section_id" class="form-control" >
                         <option value=""><?php echo $this->lang->line('select'); ?></option>
                    </select>
                        </div>
                     </div>
                    <div class="col-md-2 col-sm-6">
                        <label style="display: block; visibility:hidden;"><?php echo $this->lang->line('search'); ?></label>
                        <button type="button" class="btn btn-info btn-sm post_search_submit"><?php echo $this->lang->line('search'); ?></button>
                    </div>
                 </form>
                </div><!-- ./row -->
                <div class="search_box_result quescroll">

                </div>
                <div class="row">
                <div class="col-sm-12 col-md-5">
                <div class="pt20 font-weight-bold">Showing <span class="row_from"></span> to <span class="row_to"></span> of <span class="row_count"></span> records</div>
                </div>
                <div class="col-sm-12 col-md-7 search_box_pagination">

                              
                </div>
                </div>

               

            </div>

        </div>

    </div>
</div>


<div id="myQuestionListModal" class="modal fade" >
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
           <div class="question_list_result quescroll">
           </div>
           </div><!-- ./row -->
            </div>
        </div>
    </div>

<div class="modal fade" id="mydeleteModal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?php echo site_url('admin/onlineexam/deleteExamQuestions') ?>" id="delete_question" method="POST">
           <input type="hidden" value="0" id="question_id" name="question_id"/>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('delete_question'); ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $this->lang->line('delete_confirm');?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('close')?></button>
         <button type="submit" class="btn btn-primary pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait" value=""><?php echo $this->lang->line('delete'); ?></button></div>
      </div>
        </form>
    </div>
  </div>
</div>


<!-- Modal -->
 <div id="myGenerateRankModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body modalminheight">
       
      </div>     
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>
<script type="text/javascript">
$(document).on('submit','#delete_question',function(e) {
    e.preventDefault();
    var form = $(this);
    var question_id=form.find("input[id='question_id']").val();
    var url = form.attr('action');
    var $this = form.find("button[type=submit]:focus");
    $this.button('loading');
    $.ajax({
    url: url,
    type: "POST",
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
    $this.button('loading');
    },
    success: function (res)
    {
      $('.question_row_'+question_id).remove();
      $this.button('reset');
      if (res.status == 1) {      
      $('#mydeleteModal').modal('hide');
        successMsg(res.message);
      }
    },
    error: function (xhr) { // if error occured
    alert("Error occured.please try again");
    $this.button('reset');
    },
    complete: function () {
    $this.button('reset');
    }

    });
    });


        $('#mydeleteModal').on('shown.bs.modal', function (e) {
          var question_id = $(e.relatedTarget).data('onlineexamQuestionId');
          $("#mydeleteModal input[id='question_id']").val(question_id);

        })



    $(document).ready(function () {
        $('#myModal,#mydeleteModal,#myGenerateRankModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })
        $('#myQuestionModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        })
     
        var date_format_js = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy']) ?>';
     

        $(function () {
             var dateNow = new Date();
            $('.timepicker').datetimepicker({
                format: 'HH:mm:ss',

             defaultDate:moment(dateNow).hours(0).minutes(0).seconds(0).milliseconds(0)
            });
        });

        $('#myModal').on('hidden.bs.modal', function () {

            $(this).find("input,textarea,select")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
        });
        $('#myGenerateRankModal').on('hidden.bs.modal', function () {
          $(".modal-body", this).html();
          $(".modal-title", this).html();
         
        });
        $(document).on('click', '.question-btn', function () {
            var recordid = $(this).data('recordid');
            $('input[name=recordid]').val(recordid);
            $('#myModal').modal('show');

        });

        $('#myQuestionModal').on('show.bs.modal', function (e) {

            //get data-id attribute of the clicked element
            var exam_id = $(e.relatedTarget).data('recordid');
            var is_quiz = $(e.relatedTarget).data('is_quiz');
            if(is_quiz == 1){
                  $("select#question_type option[value*='descriptive']").prop('disabled',true);
            }else{
                  $("select#question_type option[value*='descriptive']").prop('disabled',false);
                
            }
            $('#modal_exam_id').val(exam_id);
            $('#modal_is_quiz').val(is_quiz);

            //populate the textbox
            getQuestionByExam(1, exam_id,is_quiz);
        });


 $(document).on('click', '.generate_rank', function () {
     var $this = $(this);
     examid=$this.data('recordid');
     examtitle=$this.data('examTitle');
      $('#myGenerateRankModal').modal('show');
   getRankRecord(examid,examtitle);
 });

        $('#myQuestionModal').on('hidden.bs.modal', function (e) {

            $(this).find("input,textarea,select").val('');
                $('.search_box_result').html("");
                $('.search_box_pagination').html("");

        });


        $(document).on('click', '.question-btn-edit', function () {
            var $this = $(this);
            var recordid = $this.data('recordid');
            $('input[name=recordid]').val(recordid);
            $.ajax({
                type: 'POST',
                url: baseurl + "admin/onlineexam/getOnlineExamByID",
                data: {'recordid': recordid},
                dataType: 'JSON',
                beforeSend: function () {
                    $this.button('loading');
                },
                success: function (data) {

                    if (data.status) {
                        var date_exam_from = new Date(data.result.exam_from);
                        // var newDate_exam_from = date_exam_from.toString(date_format_js);
                        var date_exam_to = new Date(data.result.exam_to);
                        // var newDate_exam_to = date_exam_to.toString(date_format_js);
                        if(data.result.auto_publish_date != null && data.result.auto_publish_date != "" && data.result.auto_publish_date != "0000-00-00"){
                        var date_auto_publish_date = new Date(data.result.auto_publish_date);
                        // var newDate_auto_publish_date = date_auto_publish_date.toString(date_format_js);
                        $('#auto_publish_date').data("DateTimePicker").date(date_auto_publish_date);
                        }else{
                            var newDate_auto_publish_date="";
                        }
                        $('#duration').val(data.result.duration);
                        $('#passing_percentage').val(data.result.passing_percentage);
                        $('#exam_to').data("DateTimePicker").date(date_exam_to);
                        $('#exam_from').data("DateTimePicker").date(date_exam_from);
                   
                        $('#exam').val(data.result.exam);
                        $('#attempt').val(data.result.attempt);
                        $('#description').val(data.result.description);
                        var is_quiz=(data.result.is_quiz == 0)?false:true;

                        $('input[name=is_quiz]').prop('checked',is_quiz);
                       
                        if(is_quiz){
                        $("input.publish_result").attr("disabled", true);
                        $("input.auto_publish_date").attr("disabled", true);
                        }

                        var chk_status=(data.result.is_active == 0)?false:true;

                        $('input[name=is_active]').prop('checked',chk_status);

                        var chk_is_marks_display=(data.result.is_marks_display == 0)?false:true;

                        $('input[name=is_marks_display]').prop('checked',chk_is_marks_display);

                           var chk_is_neg_marking=(data.result.is_neg_marking == 0)?false:true;

                        $('input[name=is_neg_marking]').prop('checked',chk_is_neg_marking);

                          var chk_result_status=(data.result.publish_result == 0)?false:true;

                        $('input[name=publish_result]').prop('checked',chk_result_status);

                        var chk_is_random_question=(data.result.is_random_question == 0)?false:true;
                        $('input[name=is_random_question]').prop('checked',chk_is_random_question);
                        $('#myModal').modal('show');
                    }
                    $this.button('reset');
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");
                    $this.button('reset');
                },
                complete: function () {
                    $this.button('reset');
                }
            });

        });



    });

    $(document).on('submit',"form#saverank",function(e){

        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        var submit_button = form.find(':submit');
        var post_params = form.serialize();


        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
            beforeSend: function () {
               
                submit_button.button('loading');
            },
            success: function (data)
            {
              var rank_modal_obj=$('#myGenerateRankModal');
                var examtitle=$('.modal-title',rank_modal_obj).html();
                var examid=$('#generate_exam_id',rank_modal_obj).val();
               
                getRankRecord(examid,examtitle);
            },
            error: function (xhr) { // if error occured
                submit_button.button('reset');
                alert("Error occured.please try again");

            },
            complete: function () {
                submit_button.button('reset');
            }
        });


    });


    $("form#formsubject").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        // $("span[id$='_error']").html("");
        var form = $(this);
        var url = form.attr('action');
        var submit_button = form.find(':submit');
        var post_params = form.serialize();


        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
            beforeSend: function () {
                $("[class$='_error']").html("");
                submit_button.button('loading');
            },
            success: function (data)
            {

                if (!data.status) {
                   var message = "";
            $.each(data.error, function (index, value) {

            message += value;

            });
         errorMsg(message);
                } else {
                    location.reload();
                }
            },
            error: function (xhr) { // if error occured
                submit_button.button('reset');
                alert("Error occured.please try again");

            },
            complete: function () {
                submit_button.button('reset');
            }
        });


    });

    function getQuestionByExam(page, exam_id,is_quiz) {

        var search = $("#search_box").val();
        var keyword = $('#form_search #keyword').val();
        var question_type = $('#form_search #question_type').val();
        var question_level = $('#form_search #question_level').val();
        var class_id = $('#form_search #class_id').val();
        var section_id = $('#form_search #section_id').val();
        $.ajax({
            type: "POST",
            url: base_url + 'admin/onlineexam/searchQuestionByExamID',
            data: {'page': page, 'exam_id': exam_id, 'search': search,'keyword':keyword,'question_type':question_type,'question_level': question_level,'class_id':class_id,'section_id':section_id,'is_quiz':is_quiz}, // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
            beforeSend: function () {
                // $("[class$='_error']").html("");
                // submit_button.button('loading');
            },
            success: function (data)
            {

                $('.search_box_result').html(data.content);
                $('.search_box_pagination').html(data.navigation);
                $('.row_from').html(data.show_from);
                $('.row_to').html(data.show_to);
                $('.row_count').html(data.total_display);

            },
            error: function (xhr) { // if error occured
                // submit_button.button('reset');
                alert("Error occured.please try again");

            },
            complete: function () {
                // submit_button.button('reset');
            }
        });

    }

    // $(document).on('keyup', '#search_box', function (e) {

    //     if (e.keyCode == 13) {
    //         var _exam_id = $('#modal_exam_id').val();
    //         getQuestionByExam(1, _exam_id);
    //     }
    // });


    /* Pagination Clicks   */
    $(document).on('click', '.search_box_pagination li.activee', function (e) {
        var _exam_id = $('#modal_exam_id').val();
        var _is_quiz = $('#modal_is_quiz').val();
        var page = $(this).attr('p');

        getQuestionByExam(page, _exam_id,_is_quiz);
    });

    $(document).on('click', '.post_search_submit', function (e) {

        var _exam_id = $('#modal_exam_id').val();
          var __is_quiz = $('#modal_is_quiz').val();

        getQuestionByExam(1, _exam_id,__is_quiz);
    });




    $(document).on('change', '.question_chk', function () {
        var _exam_id = $('#modal_exam_id').val();
        var ques_mark =$(this).closest('div.section-box').find("input[name='question_marks']").val();
        var ques_neg_mark =$(this).closest('div.section-box').find("input[name='question_neg_marks']").val();
        updateCheckbox($(this).val(), _exam_id,ques_mark,ques_neg_mark);

    });

    function updateCheckbox(question_id, exam_id,ques_mark,ques_neg_mark) {
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/onlineexam/questionAdd',
            dataType: 'JSON',
            data: {'question_id': question_id, 'onlineexam_id': exam_id,'ques_mark':ques_mark,'ques_neg_mark':ques_neg_mark},
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status) {
                    successMsg(data.message);
                }
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");

            },
            complete: function () {

            },

        });
    }




    $('#myQuestionModal').on('hidden.bs.modal', function () {
     window.location.reload();
        });
    $('#myQuestionListModal').on('hidden.bs.modal', function () {
     window.location.reload();
        });

    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, section_id);
    });


       function getSectionByClass(class_id, section_id) {

        if (class_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                beforeSend: function () {
                    $('#section_id').addClass('dropdownloading');
                },
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                },
                complete: function () {
                    $('#section_id').removeClass('dropdownloading');
                }
            });
        }
    }




           $(document).on('click', '.exam_ques_list', function () {
            var $this=$(this);
            var recordid = $(this).data('recordid');
            $('input[name=recordid]').val(recordid);
            $.ajax({
                type: 'POST',
                url: baseurl + "admin/onlineexam/getExamQuestions",
                data: {'recordid': recordid},
                dataType: 'JSON',
                beforeSend: function () {
                    $this.button('loading');
                },
                success: function (data) {


                $('#myQuestionListModal').modal('show');
                $('#myQuestionListModal .modal-title').html(data.exam.exam);
                $('#myQuestionListModal .question_list_result').html(data.result);

                    $this.button('reset');
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");
                    $this.button('reset');
                },
                complete: function () {
                    $this.button('reset');
                }
            });
        });


           $(document).on('click', '.subject_pills li', function () {
            var $this=$(this);
             $this.addClass('active').siblings().removeClass('active');
            var subject_pill_selected=($this.find('a').data('subjectId'));
            if(subject_pill_selected != 0){

            $("div[class*='subject_div_']").css("display","none");
            $('.subject_div_'+subject_pill_selected).css("display","block");
            }else{
               $("div[class*='subject_div_']").css("display","block");
            }

        });
    function getRankRecord(examid,examtitle){
      var this_obj=$('#myGenerateRankModal');
        $.ajax({
            type: "POST",
            url: base_url+"/admin/onlineexam/rankgenerate",
            data: {"examid":examid}, // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
            beforeSend: function () {              
              $('.modal-title',this_obj).html(examtitle);
              this_obj.addClass('modal_loading');
             
            },
            success: function (data)
            {
             $('.modal-body',this_obj).html(data.page);
            this_obj.removeClass('modal_loading');
       
            },
            error: function (xhr) { // if error occured
                this_obj.removeClass('modal_loading');
                alert("Error occured.please try again");

            },
            complete: function () {
                  this_obj.removeClass('modal_loading');
            }
        });
}

</script>
<script type="text/javascript">
    $(".is_quiz").change(function() {
    if(this.checked) {

    $("input.publish_result").attr("disabled", true);
    $("input#auto_publish_date").val("").attr("disabled", true);


    }else{
     $("input.publish_result").removeAttr("disabled");
     $("input#auto_publish_date").removeAttr("disabled");

    }
});
</script>