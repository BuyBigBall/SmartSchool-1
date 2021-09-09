<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use Omnipay\Omnipay;

require_once(APPPATH . 'third_party/omnipay/vendor/autoload.php');

class Payment extends Student_Controller {
 
    public $payment_method;
    public $school_name;
    public $school_setting;
    public $setting;

    function __construct() {
        parent::__construct();
        $this->load->library('Customlib');
        $this->load->library('Paypal_payment');
        $this->load->library('Stripe_payment');
        $this->load->library('Twocheckout_payment');
        $this->payment_method = $this->paymentsetting_model->get();
        $this->school_name = $this->customlib->getAppName();
        $this->school_setting = $this->setting_model->get();
        $this->setting = $this->setting_model->get();
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    public function pay($student_fees_master_id, $fee_groups_feetype_id, $student_id) {
        $this->session->unset_userdata("params");
        ///=======================get balance fees

        if (!empty($this->payment_method)) {
            $data = array();
            $data['fee_groups_feetype_id'] = $fee_groups_feetype_id;
            $data['student_fees_master_id'] = $student_fees_master_id;
            $result = $this->studentfeemaster_model->studentDeposit($data);
            $amount_balance = 0;
            $amount = 0;
            $amount_fine = 0;
            $amount_discount = 0;
            $fine_amount_balance=0;
            $amount_detail = json_decode($result->amount_detail);

            if (strtotime($result->due_date) < strtotime(date('Y-m-d'))) {
             $fine_amount_balance = $result->fine_amount;
            }


            if (is_object($amount_detail)) {
                foreach ($amount_detail as $amount_detail_key => $amount_detail_value) {
                    $amount = $amount + $amount_detail_value->amount;
                    $amount_discount = $amount_discount + $amount_detail_value->amount_discount;
                    $amount_fine = $amount_fine + $amount_detail_value->amount_fine;
                }
            }


            $amount_balance = $result->amount - ($amount + $amount_discount);
            if ($result->is_system) {

                $amount_balance = $result->student_fees_master_amount - ($amount + $amount_discount);
            }
            $fine_amount_balance=$fine_amount_balance-$amount_fine;

            $student_record = $this->student_model->get($student_id);
            $pay_method = $this->paymentsetting_model->getActiveMethod();
            if ($pay_method->payment_type == "paypal") {
                //==========Start Paypal==========
                if ($pay_method->api_username == "" || $pay_method->api_password == "" || $pay_method->api_signature == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Paypal settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {

                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_secret_key,
                        'api_publishable_key' => $pay_method->api_publishable_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                        'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['firstname'],$student_record['firstname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );

                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/paypal"));
                }
                //==========End Paypal==========
            } else if ($pay_method->payment_type == "paystack") {
                ///=====================
                if ($pay_method->api_secret_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Paystack settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_secret_key,
                        'api_publishable_key' => $pay_method->api_publishable_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                        'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );



                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/paystack"));
                }

                //=======================
            } else if ($pay_method->payment_type == "stripe") {
                ///=====================
                if ($pay_method->api_secret_key == "" || $pay_method->api_publishable_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Stripe settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_secret_key,
                        'api_publishable_key' => $pay_method->api_publishable_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                        'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );

                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/stripe"));
                }

                //=======================
            } else if ($pay_method->payment_type == "payu") {

                if ($pay_method->api_secret_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Payu settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];

                    $params = array(
                        'key' => $pay_method->api_secret_key,
                        'api_publishable_key' => $pay_method->api_publishable_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'email' => $student_record['email'],
                        'guardian_phone' => $student_record['guardian_phone'],
                        'address' => $student_record['permanent_address'],
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );

                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/payu"));
                }
            } else if ($pay_method->payment_type == "ccavenue") {
                if ($pay_method->api_secret_key == "" || $pay_method->salt == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Ccavenue settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_secret_key,
                        'api_publishable_key' => $pay_method->api_publishable_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                         'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );

                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/ccavenue"));
                }
            } else if ($pay_method->payment_type == "instamojo") {

                if ($pay_method->api_secret_key == "" || $pay_method->api_publishable_key == "" || $pay_method->salt == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Instamojo settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_secret_key,
                        'api_publishable_key' => $pay_method->api_publishable_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                         'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );

                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/instamojo"));
                }
            } else if ($pay_method->payment_type == "razorpay") {

                if ($pay_method->api_secret_key == "" || $pay_method->api_publishable_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Razorpay settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_publishable_key,
                        'api_publishable_key' => $pay_method->api_secret_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                         'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );

                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/razorpay"));
                }
            } else if ($pay_method->payment_type == "paytm") {
                if ($pay_method->api_secret_key == "" || $pay_method->api_publishable_key == "" || $pay_method->paytm_website == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Paytm settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_publishable_key,
                        'api_publishable_key' => $pay_method->api_secret_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                         'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );

                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/paytm"));
                }
            } else if ($pay_method->payment_type == "midtrans") {
                if ($pay_method->api_secret_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Midtrans settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_secret_key,
                        //'api_publishable_key' => $pay_method->api_secret_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                         'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );

                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/midtrans"));
                }
            }else if ($pay_method->payment_type == "pesapal") {
                 if ($pay_method->api_secret_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Midtrans settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);

                } else {

                $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                $page = new stdClass();
                $page->symbol = $this->setting[0]['currency_symbol'];
                $page->currency_name = $this->setting[0]['currency'];
                $params = array(
                    'key' => $pay_method->api_secret_key,
                    //'api_publishable_key' => $pay_method->api_secret_key,
                    'invoice' => $page,
                    'total' => $amount_balance,
                    'fine_amount_balance'=>$fine_amount_balance,
                    'student_session_id' => $student_record['student_session_id'],
                    'guardian_phone' => $student_record['guardian_phone'],
                     'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                    'student_fees_master_id' => $student_fees_master_id,
                    'fee_groups_feetype_id' => $fee_groups_feetype_id,
                    'student_id' => $student_id,
                    'payment_detail' => $payment_details
                );

                $this->session->set_userdata("params", $params);
                redirect(base_url("students/pesapal"));
            }
              
            }else if ($pay_method->payment_type == "flutterwave") {
                 if ($pay_method->api_publishable_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">flutterwave settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);

                } else {

                $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                $page = new stdClass();
                $page->symbol = $this->setting[0]['currency_symbol'];
                $page->currency_name = $this->setting[0]['currency'];
                $params = array(
                    'key' => $pay_method->api_secret_key,
                    //'api_publishable_key' => $pay_method->api_secret_key,
                    'invoice' => $page,
                    'total' => $amount_balance,
                    'fine_amount_balance'=>$fine_amount_balance,
                    'student_session_id' => $student_record['student_session_id'],
                    'guardian_phone' => $student_record['guardian_phone'],
                     'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                    'student_fees_master_id' => $student_fees_master_id,
                    'fee_groups_feetype_id' => $fee_groups_feetype_id,
                    'student_id' => $student_id,
                    'payment_detail' => $payment_details
                );

                $this->session->set_userdata("params", $params);
                redirect(base_url("students/flutterwave"));
            }
              
            } else if ($pay_method->payment_type == "ipayafrica") {
                 if ($pay_method->api_publishable_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">iPay Africa settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);

                } else {

                $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                $page = new stdClass();
                $page->symbol = $this->setting[0]['currency_symbol'];
                $page->currency_name = $this->setting[0]['currency'];
                $params = array(
                    'key' => $pay_method->api_secret_key,
                    //'api_publishable_key' => $pay_method->api_secret_key,
                    'invoice' => $page,
                    'total' => $amount_balance,
                    'fine_amount_balance'=>$fine_amount_balance,
                    'student_session_id' => $student_record['student_session_id'],
                    'guardian_phone' => $student_record['guardian_phone'],
                     'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                    'student_fees_master_id' => $student_fees_master_id,
                    'fee_groups_feetype_id' => $fee_groups_feetype_id,
                    'student_id' => $student_id,
                    'payment_detail' => $payment_details
                );

                $this->session->set_userdata("params", $params);
                redirect(base_url("students/ipayafrica"));
            }
              
            }   else if ($pay_method->payment_type == "jazzcash") {
                if ($pay_method->api_secret_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">JazzCash settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_secret_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                         'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );
 
                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/jazzcash"));
                }
            }   else if ($pay_method->payment_type == "billplz") {
                if ($pay_method->api_secret_key == "") {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger">Billplz settings not available</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $payment_details = $this->feegrouptype_model->getFeeGroupByID($fee_groups_feetype_id);
                    $page = new stdClass();
                    $page->symbol = $this->setting[0]['currency_symbol'];
                    $page->currency_name = $this->setting[0]['currency'];
                    $params = array(
                        'key' => $pay_method->api_secret_key,
                        'invoice' => $page,
                        'total' => $amount_balance,
                        'fine_amount_balance'=>$fine_amount_balance,
                        'student_session_id' => $student_record['student_session_id'],
                        'guardian_phone' => $student_record['guardian_phone'],
                         'name' => $this->customlib->getFullName($student_record['firstname'],$student_record['middlename'],$student_record['lastname'],$this->sch_setting_detail->middlename,$this->sch_setting_detail->lastname),
                        'student_fees_master_id' => $student_fees_master_id,
                        'fee_groups_feetype_id' => $fee_groups_feetype_id,
                        'student_id' => $student_id,
                        'payment_detail' => $payment_details
                    );
 
                    $this->session->set_userdata("params", $params);
                    redirect(base_url("students/billplz"));
                }
            }else {
                $this->session->set_flashdata('error', 'Something wrong');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger">Payment settings not available</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function paymentfailed() {
        $this->session->set_userdata('top_menu', 'Fees');
        $data['title'] = 'Invoice';
        $data['message'] = "dfsdfds";
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $this->load->view('layout/student/header', $data);
        $this->load->view('user/paymentfailed', $data);
        $this->load->view('layout/student/footer', $data);
    }

    public function successinvoice($invoice_id, $sub_invoice_id) {
        $this->session->set_userdata('top_menu', 'Fees');
        $data['title'] = 'Invoice';
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $studentfee = $this->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
        $a = json_decode($studentfee->amount_detail);
        $record = $a->{$sub_invoice_id};

        $data['studentfee'] = $studentfee;
        $data['studentfee_detail'] = $record;
        $this->load->view('layout/student/header', $data);
        $this->load->view('user/invoice', $data);
        $this->load->view('layout/student/footer', $data);
    }

}
