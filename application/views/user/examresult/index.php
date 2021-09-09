<div class="content-wrapper" style="min-height: 946px;">
   <section class="content-header">
      <h1>
         <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-warning">
               <div class="box-header ptbnull">
                  <h3 class="box-title titlefix"><?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?> </h3>
                  <div class="box-tools pull-right">
                     <div class="dt-buttons btn-group btn-group2 pt5"> 
                        <a class="dt-button btn btn-default btn-xs no_print" id="print" onclick="printDiv()" ><i class="fa fa-print"></i></a> 
                     </div>
                  </div>
               </div>
               <div class="box-body table-responsive" id="exam">
                  <div class="download_label"><?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
                  <?php
                     if (!empty($exam_result_list)) {
                        foreach ($exam_result_list as $exam_key => $exam_result) {
                             ?>
                           <div class="tshadow mb25">
                              <h4 class="pagetitleh"> 
                                 <?php
                                    echo $exam_key;
                                    ?>
                              </h4>
                              
                              <div class="table-responsive">
                                 <table class="table table-striped table-hover ptt10" id="headerTable">
                                    <thead>
                                       <th><?php echo $this->lang->line('subject'); ?></th>
                                       <th><?php echo $this->lang->line('exam_name'); ?></th>
                                       <th><?php echo $this->lang->line('grade') . " " . $this->lang->line('point'); ?></th>
                                       <th><?php echo $this->lang->line('student') . " " . $this->lang->line('point') ?></th>
                                       <th>
                                          <?php echo $this->lang->line('status') . " : " . $this->lang->line('pass_and_failed'); ?>
                                       </th>
                                       <th><?php echo $this->lang->line('note'); ?></th>
                                    </thead>
                                    <tbody>
                                       <?php 
                                       $student_total_point = 0;
                                       $count = 0;
                                       foreach ($exam_result as $exam_row) { 
                                          $student_total_point += $exam_row['student_point'];
                                          $count += 1;
                                       ?>
                                          <tr>
                                             <td><?php echo ($exam_row['subject_name']); ?></td>
                                             <td><?php echo $exam_row['exam_name']; ?></td>
                                             <td><?php echo ($exam_row['gradepoint']); ?></td>
                                             <td><?php echo ($exam_row['student_point']); ?></td>
                                             <td>
                                                <?php if(!empty($exam_row['student_point'] ) && !empty($exam_row['gradepoint']) && $exam_row['student_point'] >= $exam_row['gradepoint']) { ?>
                                                   <label class="label label-success"><?php echo $this->lang->line('pass');//pass ?></label>
                                                <?php } else {?>
                                                   <label class="label label-danger"><?php echo $this->lang->line('fail');//fail ?></label>
                                                <?php } ?>
                                             </td>                                                      
                                             <td><?php echo ($exam_row['teacher_note']); ?></td>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                              </div>
                              
                              
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="bgtgray">                                                   
                                       <div class="col-sm-3 pull "></div>
                                       <div class="col-sm-3 border-right "></div>
                                       <div class="col-sm-3 border-right ">
                                          <div class="description-block">
                                             <h5 class="description-header"><?php echo $this->lang->line('total') . " " . $this->lang->line('point') . " " . $this->lang->line('student') ?> : <span class="description-text">
                                                <?php echo $student_total_point; ?></span>
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="col-sm-3 border-right ">
                                          <div class="description-block">
                                             <h5 class="description-header">
                                                <?php echo $this->lang->line('average') . " " . $this->lang->line('point') . " " . $this->lang->line('student') ?> : 
                                                <span class="description-text">
                                                <?php //
                                                 $student_average_point = $student_total_point / $count;
                                                 echo $student_average_point; 
                                                ?>
                                                </span>
                                             </h5>
                                          </div>
                                       </div>                                                   
                                    </div>
                                 </div>
                              </div>
                           </div>
                  
                  <?php 
                        } 
                     }
                  ?>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<?php
   function findGradePoints($exam_grade, $exam_type, $percentage) {
   
       foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
           if ($exam_grade_value['exam_key'] == $exam_type) {
   
               if (!empty($exam_grade_value['exam_grade_values'])) {
                   foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                       if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                           return $grade_value->point;
                       }
                   }
               }
           }
       }
       return 0;
   }
   
   function findExamGrade($exam_grade, $exam_type, $percentage) {
   
       foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
           if ($exam_grade_value['exam_key'] == $exam_type) {
   
               if (!empty($exam_grade_value['exam_grade_values'])) {
                   foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                       if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                           return $grade_value->name;
                       }
                   }
               }
           }
       }
       return "";
   }

   function findExamGradeTypeValue($exam_grade, $exam_type) {
   
       foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
           if ($exam_grade_value['exam_key'] == $exam_type) {
               return $exam_grade_value['exm_type_value'];
           }
       }
       return "";
   }
   
   function getConsolidateRatio($exam_connection_list, $examid, $get_marks) {
   
       if (!empty($exam_connection_list)) {
           foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {
   
               if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
                   return ($get_marks * $exam_connection_value->exam_weightage) / 100;
               }
           }
       }
       return 0;
   }
   
   function getCalculatedExamGradePoints($array, $exam_id, $exam_grade, $exam_type) {
   
       $object = new stdClass();
       $return_total_points = 0;
       $return_total_exams = 0;
       if (!empty($array)) {
   
           // print_r($array['exam_result_' . $exam_id]);
           if (!empty($array['exam_result_' . $exam_id])) {
               foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {
                   $return_total_exams++;
                   $percentage_grade = ($exam_value->get_marks * 100) / $exam_value->max_marks;
                   $point = findGradePoints($exam_grade, $exam_type, $percentage_grade);
                   $return_total_points = $return_total_points + $point;
               }
           }
       }
   
       $object->total_points = $return_total_points;
       $object->total_exams = $return_total_exams;
   
       return $object;
   }
   
   function getCalculatedExam($array, $exam_id) {
       // echo "<pre/>";
   //                                                                                                    print_r($array);
       $object = new stdClass();
       $return_max_marks = 0;
       $return_get_marks = 0;
       $return_credit_hours = 0;
       $return_exam_status = false;
       if (!empty($array)) {
           $return_exam_status = 'pass';
           // print_r($array['exam_result_' . $exam_id]);
           if (!empty($array['exam_result_' . $exam_id])) {
               foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {
   
   
                   if ($exam_value->get_marks < $exam_value->min_marks || $exam_value->attendence != "present") {
                       $return_exam_status = "fail";
                   }
   
                   $return_max_marks = $return_max_marks + ($exam_value->max_marks);
                   $return_get_marks = $return_get_marks + ($exam_value->get_marks);
                   $return_credit_hours = $return_credit_hours + ($exam_value->credit_hours);
               }
           }
       }
       $object->credit_hours = $return_credit_hours;
       $object->get_marks = $return_get_marks;
       $object->max_marks = $return_max_marks;
       $object->exam_status = $return_exam_status;
       return $object;
   }
   ?>
<script type="text/javascript">
   var base_url = '<?php echo base_url() ?>';
   function printDiv(elem) {
       Popup(jQuery(elem).html());
   }
   
   function Popup(data)
   {
   
       var frame1 = $('<iframe />');
       frame1[0].name = "frame1";
       frame1.css({"position": "absolute", "top": "-1000000px"});
       $("body").append(frame1);
       var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
       frameDoc.document.open();
       frameDoc.document.write('<html>');
       frameDoc.document.write('<head>');
       frameDoc.document.write('<title></title>');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
       frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
       frameDoc.document.write('</head>');
       frameDoc.document.write('<body>');
       frameDoc.document.write(data);
       frameDoc.document.write('</body>');
       frameDoc.document.write('</html>');
       frameDoc.document.close();
       setTimeout(function () {
           window.frames["frame1"].focus();
           window.frames["frame1"].print();
           frame1.remove();
       }, 500);
   
   
       return true;
   }
   
   $(document).ready(function () {
       $.extend($.fn.dataTable.defaults, {
           searching: false,
           ordering: false,
           paging: false,
           bSort: false,
           info: false
       });
   
       $("#feetable").DataTable({
           searching: false,
           ordering: false,
           paging: false,
           bSort: false,
           info: false,
           dom: "Bfrtip",
           buttons: [
               {
                   extend: 'copyHtml5',
                   text: '<i class="fa fa-files-o"></i>',
                   titleAttr: 'Copy',
                   title: $('.download_label').html(),
                   exportOptions: {
                       columns: ':visible'
                   }
               },
               {
                   extend: 'excelHtml5',
                   text: '<i class="fa fa-file-excel-o"></i>',
                   titleAttr: 'Excel',
                   title: $('.download_label').html(),
                   exportOptions: {
                       columns: ':visible'
                   }
               },
               {
                   extend: 'csvHtml5',
                   text: '<i class="fa fa-file-text-o"></i>',
                   titleAttr: 'CSV',
                   title: $('.download_label').html(),
                   exportOptions: {
                       columns: ':visible'
                   }
               },
               {
                   extend: 'pdfHtml5',
                   text: '<i class="fa fa-file-pdf-o"></i>',
                   titleAttr: 'PDF',
                   title: $('.download_label').html(),
                   exportOptions: {
                       columns: ':visible'
   
                   }
               },
               {
                   extend: 'print',
                   text: '<i class="fa fa-print"></i>',
                   titleAttr: 'Print',
                   title: $('.download_label').html(),
                   customize: function (win) {
                       $(win.document.body)
                               .css('font-size', '10pt');
   
                       $(win.document.body).find('table')
                               .addClass('compact')
                               .css('font-size', 'inherit');
                   },
                   exportOptions: {
                       columns: ':visible'
                   }
               },
               {
                   extend: 'colvis',
                   text: '<i class="fa fa-columns"></i>',
                   titleAttr: 'Columns',
                   title: $('.download_label').html(),
                   postfixButtons: ['colvisRestore']
               },
           ]
       });
   });
   
   
   $(document).ready(function () {
       $('.detail_popover').popover({
           placement: 'right',
           title: '',
           trigger: 'hover',
           container: 'body',
           html: true,
           content: function () {
               return $(this).closest('td').find('.fee_detail_popover').html();
           }
       });
   });
   
   $(document).ready(function () {
       $('table.display').DataTable();
   });
   
   
</script>
<script type="text/javascript">
   $(".myTransportFeeBtn").click(function () {
       $("span[id$='_error']").html("");
       $('#transport_amount').val("");
       $('#transport_amount_discount').val("0");
       $('#transport_amount_fine').val("0");
       var student_session_id = $(this).data("student-session-id");
       $('.transport_fees_title').html("<b>Upload Document</b>");
       $('#transport_student_session_id').val(student_session_id);
       $('#myTransportFeesModal').modal({
           backdrop: 'static',
           keyboard: false,
           show: true
       });
   });
   
   document.getElementById("print").style.display = "block";
   
   
   function printDiv() { 
   document.getElementById("print").style.display = "none";
   
   $('.bg-green').removeClass('label');
   $('.label-danger').removeClass('label');
   $('.label-success').removeClass('label');
   var divElements = document.getElementById('exam').innerHTML;
   var oldPage = document.body.innerHTML;
   document.body.innerHTML = 
   "<html><head><title></title></head><body>" + 
   divElements + "</body>";
   window.print();
   document.body.innerHTML = oldPage;
   
   location.reload(true);
   }
   
   
</script>