<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title>School Management System</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css"> 
        <script type="text/javascript"
                src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-2uDtZD3V5ZA_pNYW"></script> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </head>
    <body style="background: #ededed;">
        <div class="container">
            <form id="payment-form" method="post" action="<?= site_url() ?>/admin/admin/response">
                <input type="hidden" name="result_type" id="result-type" value=""></div>
                <input type="hidden" name="result_data" id="result-data" value=""></div>
            </form>
            <div class="row">
                <div class="paddtop20">
                    <div class="col-md-8 col-md-offset-2 text-center">

                        <img src="<?php echo base_url('uploads/school_content/logo/' . $setting[0]['image']); ?>">

                    </div>
                    <?php echo validation_errors(); ?>
                    <div class="col-md-6 col-md-offset-3 mt20">
                        <div class="paymentbg">
                            <div class="invtext"><?php echo $this->lang->line('fees_payment_details'); ?> </div>
                            <br>
                            <?php if ($api_error) {
                                ?>
                                <div class="alert alert-danger"><?php print_r($api_error); ?> </div>
                            <?php }
                            ?>


                            <div class="padd2 paddtzero">

                                <form action="<?php echo base_url(); ?>students/midtrans/midtrans_pay" method="post">
                                    <table class="table2" width="100%">
                                        <tr>
                                            <th><?php echo $this->lang->line('decription'); ?></th>
                                            <th class="text-right"><?php echo $this->lang->line('amount') ?></th>
                                        </tr>
                                        <tr>
                                            <td> <?php
                                                echo $params['payment_detail']->fee_group_name . "<br/><span>" . $params['payment_detail']->code;
                                                ?></span></td>
                                            <td class="text-right"><?php echo $setting[0]['currency_symbol'] . $params['total']; ?></td>
                                        </tr>

                                        <tr>
                                        <td> 
                                       <span><?php echo $this->lang->line('fine');?></span></td>
                                        <td class="text-right"><?php echo $setting[0]['currency_symbol'] . $params['fine_amount_balance']; ?></td>
                                    </tr>
                                    <tr class="bordertoplightgray">
                                        <td colspan="2" class="text-right"><?php echo $this->lang->line('total');?>: <?php echo $setting[0]['currency_symbol'] . number_format((float)($params['fine_amount_balance']+$params['total']), 2, '.', ''); ?></td>
                                    </tr>

                                        <hr>
                                        <tr class="bordertoplightgray">
                                            <td  bgcolor="#fff"><button type="button" onclick="window.history.go(-1); return false;" name="search"  value="" class="btn btn-info"><i class="fa fa fa-chevron-left"></i> <?php echo $this->lang->line('back'); ?> </button>  </td>
                                            <td  bgcolor="#fff" class="text-right"> <button type="button"  name="search" id="pay-button"  value="" class="btn btn-info"><i class="fa fa fa-chevron-right"></i> <?php echo $this->lang->line('pay_with_midtrans'); ?></button>  </td>
                                        </tr>
                                    </table>


                                </form>

                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>  
    </body>
    <script type="text/javascript">
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type, data) {
            $("#result-type").val(type);
            $("#result-data").val(JSON.stringify(data));
            //resultType.innerHTML = type;
            //resultData.innerHTML = JSON.stringify(data);
        }
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            snap.pay('<?php echo $snap_Token; ?>', {// store your snap token here
                onSuccess: function (result) {
                    changeResult('success', result);
                    $.ajax({
                        url: '<?php echo base_url(); ?>students/midtrans/success',
                        type: 'POST',
                        data: $('#payment-form').serialize(),
                        dataType: "json",
                        success: function (msg) {

                            window.location.href = "<?php echo base_url(); ?>students/payment/successinvoice/" + msg.invoice_id + "/" + msg.sub_invoice_id;

                        } 
                    });
                },
                onPending: function (result) {
                    console.log('pending');
                    console.log(result);
                },
                onError: function (result) {
                    console.log('error');
                    console.log(result);
                },
                onClose: function () {
                    console.log('customer closed the popup without finishing the payment');
                }
            })

        });
    </script>
</html>