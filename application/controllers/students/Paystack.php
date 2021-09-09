<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Paystack extends Student_Controller
{

    public $api_config = "";

    public function __construct()
    {
        parent::__construct();
        $this->api_config = $this->paymentsetting_model->getActiveMethod();
        $this->setting    = $this->setting_model->get();
    }

    public function index()
    {

        $data                 = array();
        $data['params']       = $this->session->userdata('params');
        $data['setting']      = $this->setting;
        $data['api_error']    = array();
        $data['student_data'] = $this->student_model->get($data['params']['student_id']);
        $this->load->view('student/paystack', $data);
    }

    public function paystack_pay()
    {

        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $data              = array();
            $data['params']    = $this->session->userdata('params');
            $data['setting']   = $this->setting;
            $data['api_error'] = $data['api_error'] = array();
            $this->load->view('student/instamojo', $data);
        } else {
            $params                         = $this->session->userdata('params');
            $data                           = array();
            $student_fees_master_id         = $params['student_fees_master_id'];
            $fee_groups_feetype_id          = $params['fee_groups_feetype_id'];
            $student_id                     = $params['student_id'];
            $amount                         = number_format((float) ($params['fine_amount_balance'] + $params['total']), 2, '.', '');
            $total                          = $amount;
            $data['student_fees_master_id'] = $student_fees_master_id;
            $data['fee_groups_feetype_id']  = $fee_groups_feetype_id;
            $data['student_id']             = $student_id;
            $data['total']                  = $total * 100;
            $data['symbol']                 = $params['invoice']->symbol;
            $data['currency_name']          = $params['invoice']->currency_name;
            $data['name']                   = $params['name'];
            $data['guardian_phone']         = $params['guardian_phone'];

            if (isset($data)) {
                $result       = array();
                $amount       = $data['total'];
                $ref          = time() . "02";
                $callback_url = base_url() . 'students/paystack/verify_payment/' . $ref;
                $postdata     = array('email' => $_POST['email'], 'amount' => $amount, "reference" => $ref, "callback_url" => $callback_url);
                $url          = "https://api.paystack.co/transaction/initialize";
                $ch           = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); //Post Fields
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $headers = [
                    'Authorization: Bearer ' . $this->api_config->api_secret_key,
                    'Content-Type: application/json',
                ];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $request = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($request, true);

                if ($result['status']) {

                    $redir = $result['data']['authorization_url'];
                    header("Location: " . $redir);
                } else {

                    $data['params']    = $this->session->userdata('params');
                    $data['setting']   = $this->setting;
                    $data['api_error'] = $data['api_error'] = $result['message'];
                    $this->load->view('student/paystack', $data);
                }
            }
        }
    }

    public function verify_payment($ref)
    {
        $result = array();
        $url    = 'https://api.paystack.co/transaction/verify/' . $ref;
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $this->api_config->api_secret_key]
        );
        $request = curl_exec($ch);
        curl_close($ch);

        if ($request) {
            $result = json_decode($request, true);

            if ($result) {
                if ($result['data']) {
                    //something came in
                    if ($result['data']['status'] == 'success') {

                        $params     = $this->session->userdata('params');
                        $ref_id     = $ref;
                        $json_array = array(
                            'amount'          => $params['total'],
                            'date'            => date('Y-m-d'),
                            'amount_discount' => 0,
                            'amount_fine'     => $params['fine_amount_balance'],
                            'description'     => "Online fees deposit through Paystack Ref ID: " . $ref_id,
                            'received_by'     => '',
                            'payment_mode'    => 'Paystack',
                        );
                        $data = array(
                            'student_fees_master_id' => $params['student_fees_master_id'],
                            'fee_groups_feetype_id'  => $params['fee_groups_feetype_id'],
                            'amount_detail'          => $json_array,
                        );
                        $send_to        = $params['guardian_phone'];
                        $inserted_id    = $this->studentfeemaster_model->fee_deposit($data, $send_to);
                        $invoice_detail = json_decode($inserted_id);
                        redirect(base_url("students/payment/successinvoice/" . $invoice_detail->invoice_id . "/" . $invoice_detail->sub_invoice_id));
                    } else {
                        // the transaction was not successful, do not deliver value'
                        //uncomment this line to inspect the result, to check why it failed.
                        redirect(base_url("students/payment/paymentfailed"));
                    }
                } else {

                    redirect(base_url("students/payment/paymentfailed"));
                }
            } else {

                //die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
                redirect(base_url("students/payment/paymentfailed"));
            }
        } else {
            //var_dump($request);
            //die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
            redirect(base_url("students/payment/paymentfailed"));
        }
    }

}
