<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhonePe extends CI_Controller {

	// private $merchantId = "PGTESTPAYUAT86";
	private $saltKey = "96434309-7796-489d-8924-ab56988a6076";
	private $saltIndex = "1";
	private $environment = "https://api-preprod.phonepe.com/apis/hermes/pg/v1/pay";

	public function __construct() {
		parent::__construct();
		$this->load->helper('url'); // Load the URL helper
	}

	public function index() {
		$this->load->view('phonepe_view');
	}
	


public function phonepay() {
    $amount = $this->input->post('amount') * 100; // Convert INR to paise
    $transactionId = uniqid();
    
	$payload = [
		"merchantId" => "PGTESTPAYUAT86",
		"merchantTransactionId" => $transactionId,
		"merchantUserId" => "USER_ID",
		"amount" => $amount, 
		"redirectUrl" => $this->config->item('base_url')."phone",  
		"redirectMode" => "REDIRECT", 
		"mobileNumber" => "9876543210",
		"paymentInstrument" => [
			"type" => "PAY_PAGE"
		]
	];

    // Encode payload properly
    $payload_json = json_encode($payload);
    $encoded_payload = base64_encode($payload_json);
    
    // Create hash with correct format
    $hashString = $encoded_payload . "/pg/v1/pay" . $this->saltKey;
    $hash = hash("sha256", $hashString) . "###" . $this->saltIndex;
    
    $headers = [
        "Content-Type: application/json",
        "X-VERIFY: " . $hash
    ];

    $request_body = [
        "request" => $encoded_payload    // Send encoded payload, not double-encoded
    ];

    $ch = curl_init($this->environment);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);  // Enable SSL verification in production
    
    $response = curl_exec($ch);
	
    
    if ($response === false) {
        log_message('error', 'PhonePe cURL Error: ' . curl_error($ch));
        return ['success' => false, 'error' => curl_error($ch)];
    }
    
    curl_close($ch);

	// die($response);
    
    $response_data = json_decode($response, true);

	echo $response_data;
	
    
    if (isset($response_data['success']) && $response_data['success'] === true) {
        if (isset($response_data['data']['instrumentResponse']['redirectInfo']['url'])) {
            redirect($response_data['data']['instrumentResponse']['redirectInfo']['url']);
        } else {
            log_message('error', 'PhonePe Missing Redirect URL: ' . json_encode($response_data));
            return ['success' => false, 'error' => 'Missing redirect URL'];
        }
    } else {
        log_message('error', 'PhonePe Error Response: ' . json_encode($response_data));
        return ['success' => false, 'error' => $response_data];
    }
}
	
public function callback() {
    $response = file_get_contents("php://input");
    log_message('debug', 'PhonePe Callback Raw Response: ' . $response);

    if (!$response) {
        log_message('error', 'PhonePe Callback: No response received');
        show_error('No response received from PhonePe.', 500);
        return;
    }

    $data = json_decode($response, true);
    if (!$data) {
        log_message('error', 'PhonePe Callback: Invalid JSON received');
        show_error('Invalid response from PhonePe.', 500);
        return;
    }

    log_message('debug', 'PhonePe Callback Parsed Data: ' . print_r($data, true));

    // Extracting payment status correctly
    $payment_status = isset($data['code']) ? $data['code'] : "PAYMENT_FAILED";

    // Redirect to success/failure page
    redirect(base_url("PhonePe/payment_status?status=" . $payment_status));
}

public function FCM(){
	$this->load->view('phonepe_status_view');
}


}
