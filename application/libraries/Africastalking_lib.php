<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once APPPATH . 'third_party/afrikatalking/vendor/autoload.php';
   use AfricasTalking\SDK\AfricasTalking;
class Africastalking_lib {

    public function __construct() {
        $this->CI = &get_instance();

    }

    public function get() {
        $username = "mcworks@hotmail.com";// use 'sandbox' for development in the test environment
        $apiKey   = '9e7d1591768904fe3924f1729f3453eae61be394f20b132938410043079bc292'; // use your sandbox app API key for development in the test environment
        $AT = new AfricasTalking($username, $apiKey);


// Get one of the services
$payments      = $AT->payments();
$response = $payments->mobileCheckout(array(
        "productName" => "Iphone7",
        "phoneNumber" => '+256-323200603',
        "currencyCode" => 'KES',
        "amount" => '100'
    ));
  // header("Content-Type: application/json; charset=UTF-8");
   echo "<pre>"; print_r($payments); echo "</pre>";die;
//$payments->mobileCheckout(array('productName'=>'sachin','providerChannel'=>'','phoneNumber'=>'','currencyCode'=>'','amount'=>100,'metadata'=>array()), array('idempotencyKey'=>''));
    }

}
