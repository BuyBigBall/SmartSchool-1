<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }

    .pagination ul {margin: 0; padding: 0; padding-left: 10px;}
    .pagination ul li{list-style: none; display: inline-block;}
    .pagination ul li a {
        color: #000;
        position: relative;
        float: left;
        min-width: 1.5em;
        padding: 2px 8px;
        font-size: 12px;
        line-height: 1.5;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
    }

    .pagination ul li a.active {
        background-color: #eee;
        color: #23527c;
        border: 1px solid #ddd;
    }

    /*.active{
      background-color: #eee;
      color: #23527c;
      border: 1px solid #ddd;

    }*/

    .pagination  ul li a:hover:not(.active) {background-color: #ddd;}
    .pagination> ul li:first-child>a, .pagination>ul li:first-child>span {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    .pagination> ul li:last-child>a, .pagination>ul li:last-child>span {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo "Audit Trail Report --r"; ?> <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info" id="attendencelist">
                    <div class="box-header with-border" >
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('audit') . " " . $this->lang->line('trail') . " " . $this->lang->line('report') . " " . $this->lang->line('list'); ?></h3>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="lateday">
                                </div>
                            </div>
                        </div></div>
                    <div class="box-body table-responsive">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="download_label"><?php echo $this->lang->line('audit') . " " . $this->lang->line('trail') . " " . $this->lang->line('report') . " " . $this->lang->line('list'); ?></div>
                        <table class="table table-striped table-bordered table-hover all-list" data-export-title="<?php echo $this->lang->line('audit') . " " . $this->lang->line('trail') . " " . $this->lang->line('report') . " " . $this->lang->line('list'); ?>">
                            <thead>
                                <tr>

                                    <th><?php echo $this->lang->line('message'); ?></th>
                                    <th><?php echo $this->lang->line('users'); ?></th>
                                    <th><?php echo $this->lang->line('ip_address'); ?></th>
                                    <th><?php echo $this->lang->line('action'); ?></th>
                                    <th><?php echo $this->lang->line('platform'); ?></th>
                                    <th><?php echo $this->lang->line('agent'); ?></th>
                                    <th><?php echo $this->lang->line('date') . " " . $this->lang->line('time'); ?></th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                </section>
            </div>
        </div>
</div>

<script type="text/javascript">
    (function ($) {
        'use strict';
        $(document).ready(function () {
            initDatatable('all-list', 'admin/audit/getDatatable', [], 100);
        });
    }(jQuery))
</script>