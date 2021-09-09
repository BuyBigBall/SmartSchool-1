<div class="content-wrapper"> 
    <section class="content-header">
        <h1><i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">    
            <?php
            if ($this->rbac->hasPrivilege('topic', 'can_add')) {
                ?>       
                <div class="col-md-4">       
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add') . " " . $this->lang->line('topic'); ?></h3>
                        </div>  
                        <form   id="topic_form" name="lesson_form" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?> 
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                    <select autofocus="" id="searchclassid" name="class_id" onchange="getSectionByClass(this.value, 0, 'secid')"  class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($classlist as $class) {
                                            ?>
                                            <option <?php
                                            if ($class_id == $class["id"]) {
                                                echo "selected";
                                            }
                                            ?> value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                    <span class="class_id_error text-danger"><?php echo form_error('class_id'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                    <select  id="secid" name="section_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="section_id_error text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label><?php echo $this->lang->line('subject') . " " . $this->lang->line('group') ?></label><small class="req"> *</small>
                                    <select  id="subject_group_id" name="subject_group_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="section_id_error text-danger"></span>
                                </div>

                                <div class="">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('subject'); ?></label><small class="req"> *</small>
                                        <select  id="subid" name="subject_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="section_id_error text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('lesson'); ?></label><small class="req"> *</small>
                                    <select  id="lessonid" name="lesson_id" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="section_id_error text-danger"></span>
                                </div><br><br>
                                <div class="form-group">
                                    <label class="btn btn-xs btn-info pull-right" onclick="add_topic()"><?php echo $this->lang->line('add') . " " . $this->lang->line('more'); ?></label>


                                </div>
                                <div id="topic_result"></div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('topic', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">              
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('topic') . " " . $this->lang->line('list') ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">                            
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="table-responsive mailbox-messages" id="transfee">

                            <div class="download_label"><?php echo $this->lang->line('topic') . " " . $this->lang->line('list') ?></div>		  
                            <a class="btn btn-default btn-xs pull-right" id="print" onclick="printDiv()" ><i class="fa fa-print"></i></a> <a class="btn btn-default btn-xs pull-right" id="btnExport" onclick="fnExcelReport();"> <i class="fa fa-file-excel-o"></i> </a>

                            <table class="table table-hover table-striped" id="headerTable">
                                <thead>
                                    <tr class="hide" id="visible">
                                        <td colspan="6"><center><b><?php echo $this->lang->line('topic') . " " . $this->lang->line('list') ?></b></center></td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('class'); ?></th>
                                    <th><?php echo $this->lang->line('section'); ?></th>
                                    <th><?php echo $this->lang->line('subject') . " " . $this->lang->line('group') ?></th>
                                    <th><?php echo $this->lang->line('subject'); ?></th>
                                    <th><?php echo $this->lang->line('lesson'); ?></th>
                                    <th><?php echo $this->lang->line('topic'); ?></th>
                                    <th class="mailbox-date text-right"><?php echo $this->lang->line('action'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $key => $result_value) {
                                        if (in_array($result_value['classid'], $class_array)) {
                                            $lesson_id = $key;
                                            ?>	
                                            <tr>																			
                                                <td><?php echo $result_value['cname']; ?></td>
                                                <td><?php echo $result_value['sname']; ?></td>
                                                <td><?php echo $result_value['sgname']; ?></td>
                                                <td><?php echo $result_value['subname']; ?></td>
                                                <td><?php echo $result_value['lessonname']; ?></td>

                                                <td><?php
                                                    foreach (($topicresult[$lesson_id]) as $rl_value) {
                                                        echo $rl_value['name'] . '<br>';
                                                    };
                                                    ?></td>
                                                <td class="mailbox-date pull-right no-print">
                                                    <?php if ($this->rbac->hasPrivilege('topic', 'can_edit')) { ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/lessonplan/edittopic/<?php echo $result_value['lesson_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                                                    <?php } if ($this->rbac->hasPrivilege('topic', 'can_delete')) { ?>
                                                        <a data-placement="left" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="deletetopicbulk('<?php echo $result_value['lesson_id'] ?>');"><i class="fa fa-remove"></i></a> 
        <?php } ?>

                                                </td>
                                            </tr>
    <?php }
}
?>                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="mailbox-controls">  
                            <div class="pull-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">          
            <div class="col-md-12">
            </div>
        </div> 
    </section>

</div>
<script>
    function deletetopicbulk(lesson_id) {
        if (confirm('<?PHP echo $this->lang->line('delete_confirm') ?>')) {
            $.ajax({
                url: base_url + 'admin/lessonplan/deletetopicbulk/' + lesson_id,
                success: function (res) {
                    successMsg(res.message);
                    window.location.replace("<?php echo base_url("admin/lessonplan/topic") ?>");
                }

            })
        }
    }
</script>
<script>
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
    $(document).on('change', '#secid', function () {
        var class_id = $('#searchclassid').val();
        var section_id = $(this).val();
        getSubjectGroup(class_id, section_id, 0, 'subject_group_id');
    });
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

    $(document).on('change', '#subid', function () {
        $('#lessonid').html('');
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        var sub_id = $('#subid').val();
        var class_id = $('#searchclassid').val();
        var section_id = $('#secid').val();
        var subject_group_id = $('#subject_group_id').val();
        $.ajax({
            type: "POST",
            url: base_url + "admin/lessonplan/getlessonBysubjectid/" + sub_id,
            data: {'subjectid': sub_id, 'class_id': class_id, 'section_id': section_id, 'subject_group_id': subject_group_id},
            dataType: "json",
            beforeSend: function () {
                $('#lessonid').addClass('dropdownloading');
            },
            success: function (data) {

                $.each(data, function (i, obj)
                {
                    var sel = "";
                    if (lessonid == obj.id) {
                        sel = "selected";
                    }
                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + "</option>";
                });
                $('#lessonid').append(div_data);
            },
            complete: function () {
                $('#lessonid').removeClass('dropdownloading');
            }
        });

    });


    add_topic();

    function add_topic() {

        var id = makeid(8);
        $('#topic_result').append('<div class="form-group" id="' + id + '"><label><?php echo $this->lang->line("topic") . " " . $this->lang->line('name'); ?></label><small class="req"> *</small><input type="text" name="topic[]" class="lessinput" /><span  onclick="remove_topic(' + id + ')" class="section_id_error text-danger">&nbsp;<i class="fa fa-remove"></i></span></div>');
    }

    function remove_topic(id) {
        $('#' + id).html("");
    }

    function makeid(length) {
        var result = '';
        var characters = '0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    $("#topic_form").on('submit', (function (e) {
        e.preventDefault();

        var $this = $(this).find("button[type=submit]:focus");
        var inps = document.getElementsByName('topic[]');
        for (var i = 0; i < inps.length; i++) {
            var inp = inps[i];
            if (inp.value == '') {
                // errorMsg('<?php echo $this->lang->line('topic'); ?> field is required.');
                // exit()
            } else {

            }
        }
        $.ajax({
            url: "<?php echo site_url("admin/lessonplan/createtopic") ?>",
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

                if (res.status == "fail") {

                    var message = "";
                    $.each(res.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);

                } else {

                    successMsg(res.message);

                    window.location.reload(true);
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
    }));

</script>
<script>



    document.getElementById("print").style.display = "block";
    document.getElementById("btnExport").style.display = "block";

    function printDiv() {
        document.getElementById("print").style.display = "none";
        document.getElementById("btnExport").style.display = "none";
        $("#visible").removeClass("hide");
        var divElements = document.getElementById('transfee').innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML =
                "<html><head><title></title></head><body>" +
                divElements + "</body>";
        window.print();
        document.body.innerHTML = oldPage;

        location.reload(true);
    }

    function fnExcelReport()
    {
        var tab_text = "<table border='2px'><tr >";
        var textRange;
        var j = 0;
        tab = document.getElementById('headerTable'); // id of table

        for (j = 0; j < tab.rows.length; j++)
        {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        $("#visible").removeClass("hide");
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");
        $("#visible").addClass("hide");
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
        } else                 //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

        return (sa);
    }
</script>