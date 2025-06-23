<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php'; // Load Composer autoload

use Twilio\Rest\Client;

class Whatsapp extends CI_Controller {

    private $sid = 'ACbb32ddc557da1374eec9b6ff626b9fec';
    private $token = '0acd370d3ab9a6c6ecdd5541df3e87d2';
    private $twilio_whatsapp_number = 'whatsapp:+14155238886'; // default Twilio sandbox number

public function send() {
    $client = new Client($this->sid, $this->token);

    // You must define the file name or get it dynamically
    $file_name = "invoice.pdf"; // Replace this with dynamic value if needed
    $file_url = "http://192.168.1.170/api/uploads/" . $file_name;

    try {
        $message = $client->messages->create(
            'whatsapp:+919510252907', // Replace with actual recipient
            [
                'from' => $this->twilio_whatsapp_number,
                'body' => "Here is your invoice 📄",
                'mediaUrl' => [$file_url]  // This is required for sending files
            ]
        );

        if ($message) {
            echo "Message sent. SID: " . $message->sid;
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

}
?>

