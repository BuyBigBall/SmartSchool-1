<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title><?php echo $this->customlib->getAppName(); ?></title> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css"> 
    </head>
    <body style="background: #ededed;">
        <div class="container">
            <div class="row">
 
                <div class="paddtop20">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <img src="<?php echo base_url('uploads/school_content/logo/' . $setting[0]['image']); ?>">
                    </div>
                    <div class="col-md-6 col-md-offset-3 mt20">
                        <div class="paymentbg">
                            <div class="invtext"><?php echo $this->lang->line('fees_payment_details');?></div>
                            <div class="padd2 paddtzero">
                                <table class="table2" width="100%">
                                    <tr>
                                        <th><?php echo $this->lang->line('decription'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('amount')?></th>
                                    </tr>
                                    <tr>
                                        <td> <?php
                                            echo $payment_detail->fee_group_name . "<br/><span>" . $payment_detail->code;
                                            ?></span></td>
                                        <td class="text-right"><?php echo $setting[0]['currency_symbol'] . $params['total']; ?></td>
                                    </tr>

                                   <tr> 
                                        <td> 
                                       <span><?php echo $this->lang->line('fine');?></span>
                                   </td>
                                        <td class="text-right"><?php echo $setting[0]['currency_symbol'] . $params['fine_amount_balance']; ?></td>
                                    </tr>
                                    <tr class="bordertoplightgray">
                                        <td colspan="2" class="text-right"><?php echo $this->lang->line('total');?>: <?php echo $setting[0]['currency_symbol'] . number_format((float)($params['fine_amount_balance']+$params['total']), 2, '.', ''); ?></td>
                                    </tr>
                                </table>
                                <div class="divider"></div>

                                <form class="paddtlrb" method="POST" action="<?php echo site_url('students/ccavenue/pay') ?>">
                                    <button type="button" onclick="window.history.go(-1); return false;" name="search"  value="" class="btn btn-info"><i class="fa fa fa-chevron-left"></i> <?php echo $this->lang->line('back')?></button>    
                                    <button type="submit" name="search" value="" class="btn cfees pull-right"><i class="fa fa fa-money"></i> <?php echo $this->lang->line('pay_with_ccavenue')?> </button>  

                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </body>
</html>