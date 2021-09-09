<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>

<div class="content-wrapper">
    <section class="content">
        <?php $this->load->view('reports/_online_examinations'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                    <form role="form" action="<?php echo site_url('report/onlineexams') ?>" method="post" class="">
                        <div class="box-body row">

                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('search') . " " . $this->lang->line('type'); ?></label>
                                    <select class="form-control" name="search_type" onchange="showdate(this.value)">

                                        <?php foreach ($searchlist as $key => $search) {
                                            ?>
                                            <option value="<?php echo $key ?>" <?php
                                            if ((isset($search_type)) && ($search_type == $key)) {

                                                echo "selected";
                                            }
                                            ?>><?php echo $search ?></option>
                                                <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('search_type'); ?></span>
                                </div>
                            </div>

                            <div id='date_result'>

                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('date') . " " . $this->lang->line('type'); ?></label>
                                    <select class="form-control" name="date_type" >

                                        <?php foreach ($date_type as $key => $search) {
                                            ?>
                                            <option value="<?php echo $key ?>" <?php
                                            if ((isset($date_typeid)) && ($date_typeid == $key)) {
                                                echo "selected";
                                            }
                                            ?>><?php echo $search ?></option>
                                                <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('search_type'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div class="">
                        <div class="box-header ptbnull"></div>
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"><i class="fa fa-money"></i> <?php echo $this->lang->line('exams') . " " . $this->lang->line('report'); ?></h3>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('exams') . " " . $this->lang->line('report'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>

                                        <th><?php echo $this->lang->line('exam') ?></th>
                                        <th><?php echo $this->lang->line('attempt') ?></th>
                                        <th><?php echo $this->lang->line('exam') . " " . $this->lang->line('from') ?></th>
                                        <th><?php echo $this->lang->line('exam') . " " . $this->lang->line('to'); ?></th>
                                        <th><?php echo $this->lang->line('duration') ?></th>

                                        <th class="text text-center"><?php echo $this->lang->line('student') ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('questions') ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('exam') . " " . $this->lang->line('publish') ?></th>
                                        <th class="text text-center"><?php echo $this->lang->line('result') . " " . $this->lang->line('publish') ?></th>


                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                 
                                    foreach ($resultlist as $subject_key => $subject_value) {

                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $subject_value->exam; ?></td>
                                            <td class="mailbox-name"> <?php echo $subject_value->attempt; ?></td>
                                            <td class="mailbox-name"> <?php echo $this->customlib->dateyyyymmddToDateTimeformat($subject_value->exam_from, false);  ?> </td>

                                            <td class="mailbox-name"> <?php echo $this->customlib->dateyyyymmddToDateTimeformat($subject_value->exam_to, false);  ?> </td>

                                            <td class="mailbox-name"> <?php echo $subject_value->duration; ?></td>
                                            <td class="mailbox-name text-center"> <?php echo $subject_value->assign; ?></td>
                                            <td class="mailbox-name text-center"> <?php echo $subject_value->questions; ?></td>

                                            <td class="text text-center"><?php echo ($subject_value->is_active == 1) ? "<i class='fa fa-check-square-o'></i><span style='display:none'>Yes</span>" : "<i class='fa fa-exclamation-circle'></i><span style='display:none'>No</span>"; ?></td>
                                            <td class="text text-center"><?php echo ($subject_value->publish_result == 1) ? "<i class='fa fa-check-square-o'></i><span style='display:none'>Yes</span>" : "<i class='fa fa-exclamation-circle'></i><span style='display:none'>No</span>"; ?></td>


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
<script>
<?php
if ($search_type == 'period') {
    ?>

        $(document).ready(function () {
            showdate('period');
        });

    <?php
}
?>

</script>