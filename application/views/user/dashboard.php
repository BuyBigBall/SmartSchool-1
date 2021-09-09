<link rel="stylesheet" href="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>backend/calender/zabuto_calendar.min.js"></script>
<style>
    .grade-1 {
        background-color: #FA2601;
    }
    .grade-2 {
        background-color: #FA8A00;
    }
    .grade-3 {
        background-color: #FFEB00;
    }
    .grade-4 {
        background-color: #27AB00;
    }
    .grade-5 {
        background-color: #a7a7a7;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('my_profile'); ?> <small><?php echo $this->lang->line('student1'); ?></small>
      </h1>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-md-7">
            <div class="row">
               <div class="col-md-5">
                  <div class="box box-primary">
                     <div class="box-header with-border">
                        <div class="row">
                           <div class="col-md-12">
                              <h3 class="box-title"><?php echo $this->lang->line('total')." ".$this->lang->line('fees')." ".$this->lang->line('unpaid')." ( " .count($student_unpaid_fees). " ) "; ?></h3>
                           </div>
                        </div>
                     </div>
                     <div class="box-body">
                        <div class="table-responsive">
                           <?php if(!empty($student_unpaid_fees)){ ?>
                              <table class="table table-striped table-bordered table-hover  table-fixed-header">
                                 <thead>
                                    <tr>
                                       <th align="left"><?php echo $this->lang->line('fees_group'); ?></th>
                                       <th align="left"><?php echo $this->lang->line('due_date'); ?></th>
                                       <th align="left"><?php echo $this->lang->line('amount'); ?></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    foreach ($student_unpaid_fees as $key => $fee) {
                                    ?>
                                       <tr class="font12">
                                          <td align="left"><?php echo $fee['name']; ?></td>
                                          <td align="left"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee['due_date'])); ?></td>
                                          <td align="left"><?php echo $fee['amount']; ?></td>
                                       </tr>
                                    <?php
                                    }
                                    ?>
                                 </tbody>
                              </table>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="box box-primary">
                     <div class="box-header with-border">
                        <div class="row">
                           <div class="col-md-12">
                              <h3 class="box-title"><?php echo $this->lang->line('total')." ".$this->lang->line('exam')." ".$this->lang->line('uncomplete')." ( ".$total_incompleted_exam." ) "; ?></h3>
                           </div>
                        </div>
                     </div>
                     <div class="box-body">
                        <div class="table-responsive">
                           <?php if(!empty($incompleted_exam)){ ?>
                              <table class="table table-striped table-bordered table-hover  table-fixed-header">
                                 <thead>
                                    <tr>
                                       <th align="left"><?php echo $this->lang->line('subject'); ?></th>
                                       <th align="left"><?php echo $this->lang->line('count'); ?></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    foreach ($incompleted_exam as $key => $exam) {
                                    ?>
                                       <tr class="font12">
                                          <td align="left"><?php echo $exam['subject_name']; ?></td>
                                          <td align="left"><?php echo $exam['cnt']; ?></td>
                                       </tr>
                                    <?php
                                    }
                                    ?>
                                 </tbody>
                              </table>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-5">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <div class="row">
                     <div class="col-md-12">
                        <h3 class="box-title"><?php echo $this->lang->line('all_notification_for_student')." ( ".$total_unread_notification." ) "; ?></h3>
                     </div>
                  </div>
               </div>
               <div class="box-body">
                  <div class="table-responsive">
                     <?php if(!empty($unread_notifications)){ ?>
                        <table class="table table-striped table-bordered table-hover  table-fixed-header">
                           <thead>
                              <tr>
                                 <th align="left"><?php echo $this->lang->line('title'); ?></th>
                                 <th align="left"><?php echo $this->lang->line('date'); ?></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              foreach ($unread_notifications as $key => $notification) {
                              ?>
                                 <tr class="font12">
                                    <td align="left"><?php echo $notification['title']; ?></td>
                                    <td align="left"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($notification['date'])); ?></td>
                                 </tr>
                              <?php
                              }
                              ?>
                           </tbody>
                        </table>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <div class="row">
                     <div class="col-md-12">
                        <h3 class="box-title"><?php echo $this->lang->line('attendance')." ".$this->lang->line('student'); ?></h3>
                     </div>
                  </div>
               </div>
               <div class="box-body">
                     <div id="my-calendar"></div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>


<script type="application/javascript">
<?php
$language1 = $this->customlib->getLanguage();
$language_name1 = $language1["short_code"];

$langcode = array('ar', 'de', 'en', 'es', 'fr', 'it', 'nl', 'pl', 'pt', 'ru', 'se', 'tr');

if (in_array($language_name1, $langcode)) {
    ?>
      $(document).ready(function () {
         $("#my-calendar").zabuto_calendar({language: "<?php echo $language_name1; ?>"});
      });
<?php }
?>
</script> 
<script type="application/javascript">
   $(document).ready(function () {
      var  base_url = '<?php echo base_url() ?>';
      $("#my-calendar").zabuto_calendar({
         legend: [
            {type: "block", label: "<?php echo $this->lang->line('absent') ?>", classname: 'grade-1'},
            {type: "block", label: "<?php echo $this->lang->line('present') ?>", classname: 'grade-4'},
            {type: "block", label: "<?php echo $this->lang->line('permission') ?>", classname: 'grade-3'},
            {type: "block", label: "<?php echo $this->lang->line('sick') ?>", classname: 'grade-2'},
            // {type: "block", label: "<?php echo $this->lang->line('holiday') ?>", classname: 'grade-5'},
         ],
         ajax: {
            url: base_url+"user/attendence/getAttendence?grade=1",
         }
      });
   });
</script>





