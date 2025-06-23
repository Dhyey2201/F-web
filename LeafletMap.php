<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeafletMap extends CI_Controller {
    public function index() {
        $this->load->view('leaflet_map'); // Load the view
    }
}
?>
