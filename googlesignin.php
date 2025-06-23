		
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

class Googlesignin extends CI_Controller {
    private $client;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('session');

        $this->client = new Google_Client();
        $this->client->setClientId('22203151220-5g8r516vuccp53rtjh4qvg2m07jcdqtg.apps.googleusercontent.com');
        $this->client->setClientSecret('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');
		$this->client->setRedirectUri('http://localhost/api/callback');

	
        $this->client->addScope(['email', 'profile']);
    }

    public function login() {
        try {
            $authUrl = $this->client->createAuthUrl();
	
            redirect($authUrl);
			
        } catch (Exception $e) {
            log_message('error', 'Google Login Error: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Unable to connect to Google. Please try again later.');
            redirect(base_url('signin'));
        }
    }

    public function callback() {
        try {
            $code = $this->input->get('code');
            if (!$code) {
                throw new Exception('Authorization code not received');
            }

            $token = $this->client->fetchAccessTokenWithAuthCode($code);
            if (isset($token['error'])) {
                throw new Exception($token['error_description'] ?? $token['error']);
            }

            $this->client->setAccessToken($token['access_token']);
            $google_oauth = new Google_Service_Oauth2($this->client);
            $user_info = $google_oauth->userinfo->get();

            $user_data = [
                'oauth_provider' => 'google',
                'oauth_uid' => $user_info->id,
                'username' => $user_info->name,
                'email' => $user_info->email,
                'last_login' => date('Y-m-d H:i:s')
            ];

            
            $this->session->set_userdata('user_data', $user_data);
            
           
            $this->User_model->check_and_insert($user_data);
			


            redirect(base_url('product/proget'));

        } catch (Exception $e) {
            log_message('error', 'Google Callback Error: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Authentication failed. Please try again.');
            redirect(base_url('signin'));
        }
    }

    public function logout() {
        if ($this->session->userdata('user_data')) {
            try {
                $this->client->revokeToken();
            } catch (Exception $e) {
                log_message('error', 'Google Token Revoke Error: ' . $e->getMessage());
            }
        }
    
        $this->session->unset_userdata('user_data');
        $this->session->sess_destroy();
    
        echo "<script>
            window.location.href = 'https://accounts.google.com/Logout';
            setTimeout(function() {
                window.location.href = '" . base_url('signin') . "';
            }, 2000); 
        </script>";
    }
}
?>
