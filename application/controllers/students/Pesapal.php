<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesapal extends Student_Controller {
public $api_config = "";
	public function __construct()
	{
		parent::__construct();

	$api_config = $this->paymentsetting_model->getActiveMethod();
		$this->setting = $this->setting_model->get();
		$this->load->library('pesapal_lib');
	}
 
 
	public function index()
	{
		 
        $data = array();
        $data['params'] = $this->session->userdata('params');
        $data['setting'] = $this->setting;
        $data['api_error']=array();
        $data['student_data']=$this->student_model->get($data['params']['student_id']);
        $this->load->view('student/pesapal/index', $data);

	}

	public function pesapal_pay(){

		$this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|xss_clean');

		if ($this->form_validation->run()==false) {
		$data = array();
		$data['params'] = $this->session->userdata('params');
		$data['setting'] = $this->setting;
		$data['api_error']=$data['api_error']=array();
		$data['student_data']=$this->student_model->get($data['params']['student_id']);
		 $this->load->view('student/pesapal/index', $data);

		}else{


		$pesapal_details=$this->paymentsetting_model->getActiveMethod();
		$params = $this->session->userdata('params');
		$data = array();
		$student_fees_master_id = $params['student_fees_master_id'];
		$fee_groups_feetype_id = $params['fee_groups_feetype_id'];
		$student_id = $params['student_id'];
		$total = $params['total'];

		$data['student_fees_master_id'] = $student_fees_master_id;
		$data['fee_groups_feetype_id'] = $fee_groups_feetype_id;
		$data['student_id'] = $student_id;
		$amount=number_format((float)($params['fine_amount_balance']+$params['total']), 2, '.', '');
		$data['total'] = $amount;
		$data['symbol'] = $params['invoice']->symbol;
		$data['currency_name'] = $params['invoice']->currency_name;
		$data['name'] = $params['name'];
		$data['guardian_phone'] = $params['guardian_phone'];
		$amount = $data['total'];
		$token = $params = NULL;
		$consumer_key = $pesapal_details->api_publishable_key;					
		$consumer_secret = $pesapal_details->api_secret_key;
		$signature_method = new OAuthSignatureMethod_HMAC_SHA1();
		$iframelink = 'https://www.pesapal.com/API/PostPesapalDirectOrderV4';     
		$amount = number_format($amount, 2);
		$desc = "Student Fee Payment";
		$type = 'MERCHANT'; 
		$reference = time();
		$first_name = $data['name']; 
		$last_name = ''; 
		$email = $_POST['email'];
		$phonenumber = $_POST['phone']; 
		$callback_url = base_url('students/pesapal/pesapal_response'); 
		$post_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><PesapalDirectOrderInfo xmlns:xsi=\"http://www.w3.org/2001/XMLSchemainstance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" Amount=\"".$amount."\" Description=\"".$desc."\" Type=\"".$type."\" Reference=\"".$reference."\" FirstName=\"".$first_name."\" LastName=\"".$last_name."\" Email=\"".$email."\" PhoneNumber=\"".$phonenumber."\" xmlns=\"http://www.pesapal.com\" />";
		$post_xml = htmlentities($post_xml);
		$consumer = new OAuthConsumer($consumer_key, $consumer_secret);
		$iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET",
		$iframelink, $params);
		$iframe_src->set_parameter("oauth_callback", $callback_url);
		$iframe_src->set_parameter("pesapal_request_data", $post_xml);
		$iframe_src->sign_request($signature_method, $consumer, $token);
		$consumer = new OAuthConsumer($consumer_key, $consumer_secret);
		$iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET",
		$iframelink, $params);
		$iframe_src->set_parameter("oauth_callback", $callback_url);
		$iframe_src->set_parameter("pesapal_request_data", $post_xml);
		$iframe_src->sign_request($signature_method, $consumer, $token);
		$data['iframe_src']=$iframe_src;
        $this->load->view('student/pesapal/pay', $data);
		
		}
}
      
 
		
		
	

	
    public function pesapal_response(){

			$pesapal_details=$this->paymentsetting_model->getActiveMethod();
			$reference = null;
			$pesapal_tracking_id = null;

			if(isset($_GET['pesapal_merchant_reference'])){
			$reference = $_GET['pesapal_merchant_reference'];
			}

			if(isset($_GET['pesapal_transaction_tracking_id'])){
			$pesapal_tracking_id = $_GET['pesapal_transaction_tracking_id'];
			}

			$consumer_key = $pesapal_details->api_publishable_key;
			$consumer_secret = $pesapal_details->api_secret_key;
			$statusrequestAPI = 'https://www.pesapal.com/api/querypaymentstatus';
			$pesapalTrackingId=$_GET['pesapal_transaction_tracking_id'];
			$pesapal_merchant_reference=$_GET['pesapal_merchant_reference'];



			if($pesapalTrackingId!='')

			{

			   $token = $params = NULL;

			   $consumer = new OAuthConsumer($consumer_key, $consumer_secret);

			   $signature_method = new OAuthSignatureMethod_HMAC_SHA1();


			   $request_status = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $statusrequestAPI, $params);

			   $request_status->set_parameter("pesapal_merchant_reference", $pesapal_merchant_reference);

			   $request_status->set_parameter("pesapal_transaction_tracking_id",$pesapalTrackingId);

			   $request_status->sign_request($signature_method, $consumer, $token);

			 

			   $ch = curl_init();

			   curl_setopt($ch, CURLOPT_URL, $request_status);

			   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			   curl_setopt($ch, CURLOPT_HEADER, 1);

			   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			   if(defined('CURL_PROXY_REQUIRED')) if (CURL_PROXY_REQUIRED == 'True')

			   {

			      $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;

			      curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);

			      curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);

			      curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);

			   }
			   
			   $response = curl_exec($ch);
			   $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			   $raw_header  = substr($response, 0, $header_size - 4);
			   $headerArray = explode("\r\n\r\n", $raw_header);
			   $header      = $headerArray[count($headerArray) - 1];
			   $elements = preg_split("/=/",substr($response, $header_size));
			   $status = $elements[1];
			   if($status=='COMPLETED'){
				    $params = $this->session->userdata('params');
	                $ref_id = $ref;
	                $json_array = array(
	                    'amount' => $params['total'],
	                    'date' => date('Y-m-d'),
	                    'amount_discount' => 0,
	                    'amount_fine' => $params['fine_amount_balance'],
	                    'description' => "Online fees deposit through Paystack Ref ID: " . $ref_id,
	                    'received_by' => '',
	                    'payment_mode' => 'Paystack',
	                );
	                $data = array(
	                    'student_fees_master_id' => $params['student_fees_master_id'],
	                    'fee_groups_feetype_id' => $params['fee_groups_feetype_id'],
	                    'amount_detail' => $json_array
	                );
	                $send_to = $params['guardian_phone'];
	                $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to);
	                $invoice_detail = json_decode($inserted_id);
	                redirect(base_url("students/payment/successinvoice/" . $invoice_detail->invoice_id . "/" . $invoice_detail->sub_invoice_id));
			//https://dev.webfeb.com/ss620dev/api/gateway/pesapal/pesapal_response?pesapal_transaction_tracking_id=2b509e73-5c3b-4624-ac12-ace231499de8&pesapal_merchant_reference=1602598177
			    }else{
			       redirect(base_url("students/payment/paymentfailed"));
			    }
			}
			 

			   curl_close ($ch);

}
    

   
}

