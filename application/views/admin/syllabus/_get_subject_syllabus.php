<style type="text/css">
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 5px 0;}
    </style>

    <div class="col-lg-12" id="transfeeModal">
    <div class="classtopic">
        <ul class="classlist">
            <li><a data-original-title="<?php echo $this->lang->line('print') ?>" data-toggle="tooltip" class="" id="printModal" onclick="printDivModal()" ><i class="fa fa-print"></i></a></li>
            <li> <a data-original-title="<?php echo $this->lang->line('download_excel') ?>" data-toggle="tooltip" class="" id="btnExportModal" onclick="fnExcelReportModal();"> <i class="fa fa-file-excel-o"></i> </a></li>
            <?php if ($result['attachment'] != '') {?>
                <li><a data-original-title="<?php echo $this->lang->line('download_attachment') ?>" data-toggle="tooltip" href="<?php echo base_url() ?>admin/syllabus/download/<?php echo $result['attachment'] ?>"><i class="fa fa-file-text-o"></i></a></li>
                <?php
}
?>
            <?php if ($result['lacture_youtube_url'] != '') {?>
                <li><a data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('youtube_link') ?>" onclick="run_video('<?php echo $result['lacture_youtube_url'] ?>')" ><i class="fa fa-youtube"></i></a></li>
                <?php
}
?>
            <?php if ($result['lacture_video'] != '') {?>
                <li><a data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('download_video') ?>" href="<?php echo base_url() ?>admin/syllabus/lacture_video_download/<?php echo $result['lacture_video'] ?>"><i class="fa fa-file-video-o"></i></a></li>
                <?php
}
?>


        </ul>

        <table class="table table-bordered pt15 mb0" id="headerTableModal">
            <tr class="hide" id="visibleModal">
                <td colspan="2"><center><b><?php echo $this->lang->line('lesson_plan'); ?></b></center></td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('class') ?></th>
                <td><?php echo $result['cname'] . "(" . $result['sname'] . ")"; ?></td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('subject') ?></th>
                <td><?php
echo $result['subname'];
if ($result['scode'] != '') {
    echo " (" . $result['scode'] . ")";
}
?></td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('date') ?></th>
                <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($result['date'])); ?> <?php echo $result['time_from'] . " " . $this->lang->line('to') . " " . $result['time_to'] ?></td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('lesson'); ?></th>
                <td><?php echo $result['lessonname'] ?></td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('topic') ?></th>
                <td><?php echo $result['topic_name'] ?></td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('sub_topic'); ?></th>
                <td><?php echo $result['sub_topic'] ?></td>
            </tr>
            <tr>
                <td colspan=2><b><?php echo $this->lang->line('general_objectives') ?></b><br><?php echo $result['general_objectives'] ?></td>
            </tr>
            <!-- <tr>
                <td colspan=2><b><?php echo $this->lang->line('teaching_method') ?></b><br><?php echo $result['teaching_method'] ?></td>
            </tr>
            <tr>
                <td colspan=2><b><?php echo $this->lang->line('previous_knowledge') ?></b><br><?php echo $result['previous_knowledge'] ?></td>
            </tr>
            <tr>
                <td colspan=2><b><?php echo $this->lang->line('comprehensive_questions') ?></b><br><?php echo $result['comprehensive_questions'] ?></td>
            </tr> -->
            <tr>
                <td colspan=2><b><?php echo $this->lang->line('presentation') ?></b><br><?php echo $result['presentation'] ?></td>
            </tr>
        </table>
    </div><!--./classtopic-->
</div><!--./col-lg-12-->


</div>
</div>

