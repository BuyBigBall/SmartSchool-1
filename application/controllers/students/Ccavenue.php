<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ccavenue extends Student_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->setting = $this->setting_model->get();
        $this->load->library('Ccavenue_crypto');
    }

    public function index()
    {
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');
        $data['params']         = $this->session->userdata('params');
        $data['setting']        = $this->setting;
        $data['payment_detail'] = $data['params']['payment_detail'];
        $this->load->view('student/ccavenue', $data);
    }

    public function pay()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $session_data            = $this->session->userdata('params');
            $pay_method              = $this->paymentsetting_model->getActiveMethod();
            $details['tid']          = abs(crc32(uniqid()));
            $details['merchant_id']  = $pay_method->api_secret_key;
            $details['order_id']     = abs(crc32(uniqid()));
            $details['amount']       = number_format((float) ($session_data['fine_amount_balance'] + $session_data['total']), 2, '.', '');
            $details['currency']     = 'INR';
            $details['redirect_url'] = base_url('students/ccavenue/success');
            $details['cancel_url']   = base_url('students/ccavenue/cancel');
            $details['language']     = "EN";
            $details['billing_name']     = $session_data['name'];

            $merchant_data = "";
            foreach ($details as $key => $value) {
                $merchant_data .= $key . '=' . $value . '&';
            }
            $data['encRequest']  = $this->ccavenue_crypto->encrypt($merchant_data, $pay_method->salt);
            $data['access_code'] = $pay_method->api_publishable_key;

            $this->load->view('student/ccavenue_pay', $data);
        } else {
            redirect(base_url('user/user/dashboard'));
        }
    }

    public function success()
    {

        $status     = array();
        $rcvdString = "";
        $params     = $this->session->userdata('params');
        
        if (!empty($params)) {
            $pay_method  = $this->paymentsetting_model->getActiveMethod();
            $encResponse = $_POST["encResp"];
            $rcvdString  = $this->ccavenue_crypto->decrypt($encResponse, $pay_method->salt);

            if ($rcvdString !== '') {

                $decryptValues = explode('&', $rcvdString);
                $dataSize      = sizeof($decryptValues);
                for ($i = 0; $i < $dataSize; $i++) {
                    $information             = explode('=', $decryptValues[$i]);
                    $status[$information[0]] = $information[1];
                }
            }

            if (!empty($status)) {
                if ($status['order_status'] == "Success") {

                    $tracking_id = $status['tracking_id'];
                    $bank_ref_no = $status['bank_ref_no'];

                    $json_array = array(
                        'amount'          => $params['total'],
                        'date'            => date('Y-m-d'),
                        'amount_discount' => 0,
                        'amount_fine'     => $params['fine_amount_balance'],
                        'description'     => "Online fees deposit through CCAvenue. TXN ID: " . $tracking_id . " Bank Ref. No.: " . $bank_ref_no,
                        'received_by'     => '',
                        'payment_mode'    => 'CCAvenue',
                    );

                    $data = array(
                        'student_fees_master_id' => $params['student_fees_master_id'],
                        'fee_groups_feetype_id'  => $params['fee_groups_feetype_id'],
                        'amount_detail'          => $json_array,
                    );

                    $send_to     = $params['guardian_phone'];
                    $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to);

                    if ($inserted_id) {
                        $invoice_detail = json_decode($inserted_id);
                        redirect(base_url("students/payment/successinvoice/" . $invoice_detail->invoice_id . "/" . $invoice_detail->sub_invoice_id));
                    } else {

                    }
                } else if ($status['order_status'] === "Aborted") {
                    echo "<br>We will keep you posted regarding the status of your order through e-mail";

                } else if ($status['order_status'] === "Failure") {
                    redirect(base_url("students/payment/paymentfailed"));} else {
                    echo "<br>Security Error. Illegal access detected";

                }
            }

        } else {
           
        }
    }

    public function cancel()
    {

    }

}
