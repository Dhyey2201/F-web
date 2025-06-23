<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php'; // Load Composer autoload

use Dompdf\Dompdf;
use Twilio\Rest\Client;

class Invoice extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('orderitm_model');
		$this->load->model('productmodel');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
	}
	public function invoicr_view(){
		$this->load->view('invoice_views');
	}



    private $sid = 'ACbb32ddc557da1374eec9b6ff626b9fec'; 
    private $token = '0acd370d3ab9a6c6ecdd5541df3e87d2'; 
    private $twilio_whatsapp_number = 'whatsapp:+14155238886'; 

    // STEP 1: Download or preview invoice
    public function download($invoice_id = null)
    {
        if (!$invoice_id) {
            $invoice_id = rand(1000, 9999); // fallback for demo
        }

        // Generate invoice HTML
        $html = $this->generate_invoice_html($invoice_id);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Download the file
        $dompdf->stream("invoice_$invoice_id.pdf", array("Attachment" => true)); // true = download
    }

  
			public function send($user_id){
			// 1. Load user from DB
			$user = $this->db->get_where('users', ['id' => $user_id])->row();
			

			if (!$user || !$user->contect_number) {
				echo "❌ User or phone not found.";
				return;
			}

			$phone =$user->contect_number; // clean up number
			$whatsapp_number = "whatsapp:+91" . $phone;

			// 2. Generate Invoice PDF (use your existing logic)
			$invoice_id = rand(1000, 9999); // or use real one
			$html = $this->generate_invoice_html($invoice_id);

			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();
			$pdf = $dompdf->output();

			// Save PDF
			$file_name = "invoice_$invoice_id.pdf";
			$file_path = FCPATH . "uploads/" . $file_name;
			file_put_contents($file_path, $pdf);

			// Public URL
			$file_url ="http://192.168.1.170/api/uploads/" . $file_name;

			// 3. Send WhatsApp Message via Twilio
			try {
				$client = new Client($this->sid, $this->token);
				$message = $client->messages->create(
					$whatsapp_number,
					[
						'from' => $this->twilio_whatsapp_number,
						'body' => "Hi {$user->username} <br> $file_url ",
						
					]
				);

				echo "✅ Sent to {$user->username} – Message SID: " . $message->sid;

			} catch (Exception $e) {
				echo "❌ Error: " . $e->getMessage();
			}
		}

	
  
  private function generate_invoice_html($invoice_id) {
    $r = $this->session->userdata('prodata');

    $html = "
        <h2>Invoice #$invoice_id</h2>
        <p>Date: " . date('Y-m-d') . "</p>
        <p>Customer: Test User</p>
        <table border='1' cellpadding='6' cellspacing='0' width='100%'>
            <thead>
                <tr><th>Item</th><th>Qty</th><th>Price</th><th>Total</th></tr>
            </thead>
            <tbody>
    ";

    $grand_total = 0;

    foreach ($r as $product_array) {
        foreach ($product_array as $product) {
            $name = $product['pro_name'];
            $price = (float)$product['pro_price'];
            $qty = 1; 
            $total = $qty * $price;
            $grand_total += $total;

            $html .= "<tr>
                <td>{$name}</td>
                <td>{$qty}</td>
                <td>{$price}</td>
                <td>{$total}</td>
            </tr>";
        }
    }

    $html .= "<tr>
        <td colspan='3' align='right'><strong>Grand Total</strong></td>
        <td><strong>{$grand_total}</strong></td>
    </tr>";

    $html .= "</tbody></table>";

    return $html;
}

}
