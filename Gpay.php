<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gpay extends CI_Controller {

    public function index() {
        $this->load->view('gpay_view');
    }

    public function process_token() {
        $json = file_get_contents("php://input");
        $paymentData = json_decode($json, true);

        // This is the token from Google Pay
        $token = $paymentData['paymentMethodData']['tokenizationData']['token'];

        // Send this token to your payment processor (e.g., Stripe, Razorpay)
        // Example: If using Stripe:
        /*
        require_once(APPPATH . 'libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey('sk_test_XXXX');

        $decodedToken = json_decode($token, true);
        $charge = \Stripe\Charge::create([
            'amount' => 1000, // amount in cents
            'currency' => 'usd',
            'source' => $decodedToken['id'],
            'description' => 'Google Pay Payment'
        ]);
        */

        // For now, return dummy success
        echo json_encode(['status' => 'success', 'token_received' => true]);
    }
}
