<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Midtrans extends Student_Controller {

    public $api_config = "";

    public function __construct() {
        parent::__construct();

        $api_config = $this->paymentsetting_model->getActiveMethod();
        $this->setting = $this->setting_model->get();
        $this->load->library('Midtrans_lib');
    }

    public function index() {

        $data = array();
        $data['params'] = $this->session->userdata('params');
        $data['setting'] = $this->setting;
        $data['api_error'] = array();
        $amount =number_format((float)($data['params']['fine_amount_balance']+$data['params']['total']), 2, '.', '');
        $transaction = array(
            'transaction_details' => array(
                'order_id' => time(),
                'gross_amount' => round($amount), // no decimal allowed
            ),
        );

        $snapToken = $this->midtrans_lib->getSnapToken($transaction, $data['params']['key']);
        $data['snap_Token'] = $snapToken;
        $this->load->view('student/midtrans', $data);
    }

    public function success() {

        $response = json_decode($_POST['result_data']);

        $payment_id = $response->transaction_id;
        $params = $this->session->userdata('params');
        $json_array = array(
            'amount' => $params['total'],
            'date' => date('Y-m-d'),
            'amount_discount' => 0,
            'amount_fine' => $params['fine_amount_balance'],
            'description' => "Online fees deposit through Midtrans TXN ID: " . $payment_id,
            'received_by' => '',
            'payment_mode' => 'Midtrans',
        );
        $data = array(
            'student_fees_master_id' => $params['student_fees_master_id'],
            'fee_groups_feetype_id' => $params['fee_groups_feetype_id'],
            'amount_detail' => $json_array
        );
        $send_to = $params['guardian_phone'];
        $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to);
        echo $inserted_id;

        //   redirect(base_url("students/payment/successinvoice/" . $invoice_detail->invoice_id . "/" . $invoice_detail->sub_invoice_id));
    }

}
