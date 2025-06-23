<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php'; // Load Firebase SDK

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class Fcm extends CI_Controller {

    private $messaging;

    public function __construct() {
        parent::__construct();
        $factory = (new Factory)->withServiceAccount(APPPATH . 'config/firebase.json');
        $this->messaging = $factory->createMessaging();
    }

    public function send_notification() {
        $fcmToken = $this->input->post('token');


        $message = CloudMessage::fromArray([
            'token' => $fcmToken,
            'notification' => [
                'title' => 'FCM API v1 Notification',
                'body'  => 'This is a test notification from CodeIgniter 3 using FCM API v1',
            ],
            'data' => ['key' => 'value']
        ]);

		try {
			echo json_encode($this->messaging->send($message));
			"✅ Notification sent successfully!";
		} catch (\Kreait\Firebase\Exception\Messaging\InvalidMessage $e) {
			echo "❌ InvalidMessage Error: " . $e->getMessage();
		} catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
			echo "❌ NotFound Error: Invalid FCM Token!";
		} catch (\Exception $e) {
			echo "❌ General Error: " . $e->getMessage();
		}
		
    }
}

