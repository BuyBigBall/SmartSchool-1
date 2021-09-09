<?php
$language = $this->customlib->getLanguage();
$language_name = $language["short_code"];
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-flask"></i> <?php echo $this->lang->line('homework'); ?>
            <?php 
                $searchSession = '';
                $selectedClass = '';
            ?>
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?>
                </h3>

            </div>
            <form class="assign_teacher_form" action="<?php echo base_url(); ?>exam/report/bysubject" method="post"
                enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('msg')) { ?>
                            <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                        </div>


                        <div class="col-md-4 col-lg-2 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('session') ?></label>
                                <!-- <small class="req"> *</small> -->
                                <select id="sess_id" name="session_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($sessionlist as $session) {
                                        ?>
                                    <option <?php
                                        if ($session_id == $session["id"]) {
                                            echo "selected";
                                            $searchSession = $session['session'];
                                        }
                                        ?> value="<?php echo $session['id'] ?>"><?php echo $session['session'] ?>
                                    </option>
                                    <?php
                                        }
                                        ?>
                                </select>
                                <span class="session_id_error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                <select autofocus="" id="searchclassid" name="class_id"
                                    onchange="getSectionByClass(this.value, 0, 'secid')" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($classlist as $class) {
                                        ?>
                                    <option <?php
                                        if ($class_id == $class["id"]) {
                                            echo "selected";
                                            $selectedClass = $class['class'];
                                        }
                                        ?> value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
                                    <?php
                                        }
                                        ?>
                                </select>
                                <span class="class_id_error text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('section'); ?></label>
                                <select id="secid" name="section_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="section_id_error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2 col-sm-6">
                            <div class="form-group">
                                <label>Subject Group</label>
                                <select id="subject_group_id" name="subject_group_id" class="form-control" autocomplete="off">
                                    <option value="">Select</option>
                                </select>
                                <span class="section_id_error text-danger" data-nsfw-filter-status="swf"></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('subject'); ?></label>
                                <select id="subid" name="subject_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="section_id_error text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-2 col-sm-6">
                            <div class="form-group"><br />
                            <button type="submit" 
                                id="search_filter" name="search" value="search_filter" style="margin-top:3px;"
                                class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i>
                                <?php echo $this->lang->line('search'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="box-header ptbnull"></div>
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i>
                                <?php echo $this->lang->line('exam_submit_list'); ?></h3>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="download_label"> <?php echo $this->lang->line('exam_submit_list'); ?></div>
                            <div>
                                <table class="table table-hover table-striped table-bordered exam" id="exams_report">
                                    <thead>
                                        <tr>
                                            <th rowspan=2><?php echo $this->lang->line('no') ?></th>
                                            <th rowspan=2><?php echo $this->lang->line('addmission_id') ?></th>
                                            <th rowspan=2><?php echo $this->lang->line('student_name'); ?></th>
                                            <?php foreach($examtypes as $examtype)
                                            {
                                                ?>
                                            <th colspan='<?php echo count($exams[$examtype]) ?>'>
                                                <?php echo !empty($examtype)?$examtype: '-'; ?></th>
                                            <?php 
                                            }
                                            ?>
                                            <th rowspan=2><?php echo $this->lang->line('average') ?></th>
                                            <th class='deleted'></th>
                                        </tr>
                                        <tr>
                                            <?php
                                            $title_key = array();
                                            foreach($examtypes as $examtype)
                                                    foreach($exams[$examtype] as $exam)
                                            {
                                                ?>
                                            <th examdate>
                                                <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($exam)); ?>
                                            </th>
                                            <?php 
                                                $title_key[] = $examtype . "_" . date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($exam));
                                            }
                                            ?>
                                            <th class='deleted'></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- -------------------------------------------------------- -->
                                        <tr style="display: none;">
                                            <td><?php echo $this->lang->line('no') ?></td>
                                            <td><?php echo $this->lang->line('addmission_id') ?></td>
                                            <td><?php echo $this->lang->line('student_name'); ?></td>
                                            <?php   
                                                $e_data = array(); 
                                                $sub_count = 0;                                              
                                                foreach($examtypes as $examtype){ 
                                                    $e_data[$sub_count] = array();
                                                    $e_data[$sub_count]['col_cnt'] = count($exams[$examtype]);
                                                    $examcount = 0;
                                                    // $examtypecount = count($exams[$examtype]);
                                                    foreach($exams[$examtype] as $exam){
                                                        if($examcount == 0){
                                            ?>
                                                            <td><?php echo !empty($examtype)?$examtype: '-'; ?></td>
                                            <?php                
                                                        }else{
                                            ?>
                                                            <td></td>
                                            <?php
                                                        }
                                                        $examcount ++;
                                                    } 
                                                    $sub_count ++;                                          
                                            ?>
                                                    
                                            <?php 
                                                }
                                            ?>
                                            <td><?php echo $this->lang->line('average') ?></td>
                                            <td class='deleted'></td>
                                        </tr>   
                                                                            
                                        <tr style="display: none;">
                                            <td></td><td></td><td></td>
                                            <?php
                                                $title_key = array();
                                                foreach($examtypes as $examtype){
                                                    foreach($exams[$examtype] as $exam){                                            
                                            ?>
                                                        <td examdate>
                                                            <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($exam)); ?>
                                                        </td>
                                            <?php 
                                                        $title_key[] = $examtype . "_" . date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($exam));
                                                    }
                                                }
                                            ?>
                                            <td></td>
                                            <td class='deleted'></td>
                                        </tr>
                                        <!-- ----------------------------------------------------- -->
                                        <?php
                                        $iCount = 0;
                                        foreach ($report as $key => $studentinfo) { $iCount++;
                                            ?>
                                        <tr>
                                            <td><?php echo $iCount ?></td>
                                            <td><?php echo $studentinfo["addmissionid"] ?></td>
                                            <td><?php echo $studentinfo["stdudentname"] ?></td>
                                            <?php foreach($title_key as $key) { 
                                                    if(array_key_exists($key, $studentinfo['points'])) {
                                                    ?>
                                            <td><?php echo !empty($studentinfo['points'][$key]) ? $studentinfo['points'][$key]:'-'; ?>
                                            </td>
                                            <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                            <td>-</td>
                                            <?php                                                    }
                                                }
                                                    ?>
                                            <td average><?php echo round($studentinfo['average'],2) ; ?></td>
                                            <td class='deleted'></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>


<script type="text/javascript">
    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['
    d ' => '
    dd ', '
    m ' => '
    mm ','
    mmm ' => '
    M ', '
    Y ' => '
    yyyy ']) ?>';

    $(document).ready(function () {
        $("#homework_date").datepicker({
            format: date_format,
            autoclose: true,
            weekStart: start_week,
            language: '<?php echo $language_name ?>',
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#submit_date').datepicker('setStartDate', minDate);
        });

        $("#submit_date").datepicker({
            format: date_format,
            autoclose: true,
            weekStart: start_week,
            language: '<?php echo $language_name ?>',
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#homework_date').datepicker('setEndDate', minDate);
        });
    });


    $(document).ready(function () {

        $('#homeworkdate,#submitdate').datepicker({
            format: date_format,
            autoclose: true,
            language: '<?php echo $language_name ?>'
        });


        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });

    function homework_docs(id) {

        $('#homework_docs').modal('show');
        (function ($) {
            'use strict';
            $(document).ready(function () {
                initDatatable('all-list', 'homework/homework_docs/' + id, [], 100);
            });
        }(jQuery))

    }
</script>
<script>
    var searchSection = '';
    var searchSubjectGroup = '';
    var searchSubject = '';
    $(function () {
        $("#compose-textarea,#desc-textarea").wysihtml5();
    });
</script>
<script type="text/javascript">
    $(document).ready(function (e) {
        
        getSectionByClass("<?php echo $class_id ?>", "<?php echo $section_id ?>", 'secid');
        getSubjectGroup("<?php echo $class_id ?>", "<?php echo $section_id ?>", "<?php echo $subject_group_id ?>", 'subject_group_id');
        getsubjectBySubjectGroup("<?php echo $class_id ?>", "<?php echo $section_id ?>", "<?php echo $subject_group_id ?>", "<?php echo $subject_id ?>", 'subid');
        getSubjectBySection("<?php echo $class_id ?>", "<?php echo $section_id ?>", 'subid');
    });


    function evaluation(id) {
        $('#evaluation').modal('show');
        $('#evaluation_details').html("");
        $.ajax({
            url: '<?php echo base_url(); ?>exam/evaluation/' + id,
            success: function (data) {
                $('#evaluation_details').html(data);

            },
            error: function () {
                alert("Fail")
            }
        });
    }

    function addhomework() {

        $('iframe').contents().find('.wysihtml5-editor').html("");

    }
</script>
<script type="text/javascript">
    var save_method; //for save method string
    var update_id; //for save method string

    function getSectionByClass(class_id, section_id, select_control) {
        if (class_id != "") {
            $('#' + select_control).html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                beforeSend: function () {
                    $('#' + select_control).addClass('dropdownloading');
                },
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                            searchSection = obj.section;
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#' + select_control).append(div_data);
                },
                complete: function () {
                    $('#' + select_control).removeClass('dropdownloading');
                }
            });
        }
    }


    // $(document).on('change', '#modal_section_id', function () {
    //     var class_id = $('.modal_class_id').val();
    //     var section_id = $(this).val();
    //     getSubjectGroup(class_id, section_id, 0, 'modal_subject_group_id');
    // });

    $(document).on('change', '#secid', function () {
        var class_id = $('#searchclassid').val();
        var section_id = $(this).val();
        getSubjectGroup(class_id, section_id, 0, 'subject_group_id');
        //getSubjectBySection(class_id, section_id, 'subid');
    });


    function getSubjectBySection(class_id, section_id, subject_target) {
        if (class_id != "" && section_id != "") {

            var div_data = '<option value=""><?php echo $this->lang->line('
            select '); ?></option>';
            //console.log(class_id + ' , ' + section_id);
            $.ajax({
                type: 'POST',
                url: base_url + 'admin/subject/getSubjctByClassandSection',
                data: {
                    'class_id': class_id,
                    'section_id': section_id
                },
                dataType: 'JSON',
                beforeSend: function () {
                    // setting a timeout
                    $('#' + subject_target).html("").addClass('dropdownloading');
                },
                success: function (data) {
                    console.log(data);
                    return;
                    $.each(data, function (i, obj) {
                        var sel = "";
                        if (subject_id == obj.subject_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.subject_id + " " + sel + ">" + obj.name +
                            "</option>";
                    });
                    $('#' + subject_target).append(div_data);
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");

                },
                complete: function () {
                    $('#' + subject_target).removeClass('dropdownloading');
                }
            });
        }
    }
    
    $(document).on('change', '#subject_group_id', function () {
        var class_id = $('#searchclassid').val();
        var section_id = $('#secid').val();
        var subject_group_id = $(this).val();

        getsubjectBySubjectGroup(class_id, section_id, subject_group_id, 0, 'subid');

    });

    function getsubjectBySubjectGroup(class_id, section_id, subject_group_id, subject_group_subject_id, subject_target) {
        if (class_id != "" && section_id != "" && subject_group_id != "") {

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
                type: 'POST',
                url: base_url + 'admin/subjectgroup/getGroupsubjects',
                data: {'subject_group_id': subject_group_id},
                dataType: 'JSON',
                beforeSend: function () {
                    // setting a timeout
                    $('#' + subject_target).html("").addClass('dropdownloading');
                },
                success: function (data) {
                    console.log(data);
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (subject_group_subject_id == obj.id) {
                            sel = "selected";
                            searchSubject = obj.name;
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + "</option>";
                    });
                    $('#' + subject_target).append(div_data);
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");

                },
                complete: function () {
                    $('#' + subject_target).removeClass('dropdownloading');
                }
            });
        }
    }
    
    function getSubjectGroup(class_id, section_id, subjectgroup_id, subject_group_target) {
        if (class_id != "" && section_id != "") {

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
                type: 'POST',
                url: base_url + 'admin/subjectgroup/getGroupByClassandSection',
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: 'JSON',
                beforeSend: function () {
                    // setting a timeout
                    $('#' + subject_group_target).html("").addClass('dropdownloading');
                },
                success: function (data) {

                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (subjectgroup_id == obj.subject_group_id) {
                            sel = "selected";
                            searchSubjectGroup = obj.name;
                        }
                        div_data += "<option value=" + obj.subject_group_id + " " + sel + ">" + obj.name + "</option>";
                    });
                    $('#' + subject_group_target).append(div_data);
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");

                },
                complete: function () {
                    $('#' + subject_group_target).removeClass('dropdownloading');
                }
            });
        }

    }

    function GetColName(colnum)
    {
        colName = ['', 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
                ,'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
                ,'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ'
            ];
            if(colnum>colName.length-1) return 'CA';
            return colName[colnum];
    }

    btnArray = [                
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',

                    title: $('.download_label').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                    ,header : false
                    ,customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var numrows = 7; //header start row
                        var clR = $('row', sheet);

                        //update Row
                        clR.each(function () {
                            var attr = $(this).attr('r');
                            var ind = parseInt(attr);
                            ind = ind + numrows;
                            $(this).attr("r",ind);
                        });

                        // Create row before data
                        $('row c ', sheet).each(function () {
                            var attr = $(this).attr('r');
                            var pre = attr.substring(0, 1);
                            var ind = parseInt(attr.substring(1, attr.length));
                            ind = ind + numrows;
                            $(this).attr("r", pre + ind);
                        });

                        function Addrow(index,data) {
                            msg='<row r="'+index+'">'
                            for(i=0;i<data.length;i++){
                                var key=data[i].key;
                                var value=data[i].value;
                                msg += '<c t="inlineStr" r="' + key + index + '">';
                                msg += '<is>';
                                msg +=  '<t>'+value+'</t>';
                                msg+=  '</is>';
                                msg+='</c>';
                            }
                            msg += '</row>';
                            return msg;
                        }
                        function _createNode( doc, nodeName, opts ) {
                            var tempNode = doc.createElement( nodeName );

                            if ( opts ) {
                                if ( opts.attr ) {
                                    $(tempNode).attr( opts.attr );
                                }

                                if ( opts.children ) {
                                    $.each( opts.children, function ( key, value ) {
                                        tempNode.appendChild( value );
                                    } );
                                }

                                if ( opts.text !== null && opts.text !== undefined ) {
                                    tempNode.appendChild( doc.createTextNode( opts.text ) );
                                }
                            }
                            return tempNode;
                        }
                        
                        var searchSession = '<?php echo $searchSession; ?>';
                        var selectedClass = '<?php echo $selectedClass; ?>';
                       
                        //insert
                        var r1 = Addrow(1, [{ key: 'A', value: '' }]);
                        var r2 = Addrow(2, [{ key: 'A', value: 'Session : ' }, { key: 'C', value: searchSession }]);
                        var r3 = Addrow(3, [{ key: 'A', value: 'Class : ' }, { key: 'C', value: selectedClass }]);
                        var r4 = Addrow(4, [{ key: 'A', value: 'Section : ' }, { key: 'C', value: searchSection }]);
                        var r5 = Addrow(5, [{ key: 'A', value: 'Subject Group : ' }, { key: 'C', value: searchSubjectGroup }]);
                        var r6 = Addrow(6, [{ key: 'A', value: 'Subject : ' }, { key: 'C', value: searchSubject }]);
                        
                        // var headerObj = [{ key: 'A', value: 'No' },{ key: 'B', value: 'Addmission Id' },{ key: 'C', value: 'Student Name' }];
                        // var r7 = Addrow(9, headerObj);
                        
                        sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2+ r3+ r4+ r5+ r6+ sheet.childNodes[0].childNodes[1].innerHTML;
                        
                        //search style bold -------------------------
                        $('row c[r*="2"]', sheet).attr( 's', '2' );//for bold 2
                        $('row c[r*="3"]', sheet).attr( 's', '2' );
                        $('row c[r*="4"]', sheet).attr( 's', '2' );
                        $('row c[r*="5"]', sheet).attr( 's', '2' );
                        $('row c[r*="6"]', sheet).attr( 's', '2' );
                        
                        var row_start = numrows+2;
                        var row_end = numrows+3;
                        var col_count = 4;
                        var count = 0;
                        //header center style -----------------------
                        for(count=row_start;count<=row_end;count++){
                            $('row c[r*="'+count+'"]', sheet).attr( 's', '51' ); //center
                            // $('row c[r*="'+count+'"]', sheet).attr( 's', '2' ); //bold
                        }

                        var mergeCells = $('mergeCells', sheet);
 
                        mergeCells[0].appendChild( _createNode( sheet, 'mergeCell', {
                            attr: {
                                ref: 'A'+row_start+':A'+row_end
                            }
                        } ) );
                        // mergeCells.attr( 'count', mergeCells.attr( 'count' )+1 );
                        mergeCells[0].appendChild( _createNode( sheet, 'mergeCell', {
                            attr: {
                                ref: 'B'+row_start+':B'+row_end
                            }
                        } ) );
                        mergeCells[0].appendChild( _createNode( sheet, 'mergeCell', {
                            attr: {
                                ref: 'C'+row_start+':C'+row_end
                            }
                        } ) );

                        <?php 
                            foreach($e_data as $e_type){
                        ?>                                
                                //subject merge 
                                mergeCells[0].appendChild( _createNode( sheet, 'mergeCell', {
                                    attr: {
                                        ref: GetColName(col_count)+row_start+':'+GetColName(col_count-1+<?php echo $e_type['col_cnt']; ?>)+row_start
                                    }
                                } ) );
                                col_count += (<?php echo $e_type['col_cnt']; ?>);                                
                        <?php
                            }
                        ?>
                        // console.log("col_count:"+col_count);
                        // average merge
                        mergeCells[0].appendChild( _createNode( sheet, 'mergeCell', {
                            attr: {
                                ref: GetColName(col_count)+row_start+':'+GetColName(col_count)+row_end
                            }
                        } ) );
                        
                                                            
                    }
                },
                
            ];
    $(document).ready(function () {

        try{
            $("#exams_report").DataTable({
                dom: "Bfrtip",
                buttons: btnArray,
                "bSort" : false,
            });
        }
        catch(e)
        {
            console.log(e);
        }
    });
</script>
<style>
    table.exam tr td,
    table.exam tr th {
        border-right: solid 1px #ccc;
        border-bottom: solid 1px #ccc;
        text-align: center;
        vertical-align: middle;
    }

    table.exam {
        border-left: solid 1px #ccc;
        border-top: solid 1px #ccc;
    }
</style>