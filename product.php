<?php
defined('BASEPATH') or exit('No direct script access allowed');

class product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('productmodel');
		$this->load->library('session');
		$this->load->helper('url');
	}
	public function getpro()
	{
		echo json_encode($this->productmodel->getpro());
	}

	public function pro_del()
	{
		$id = $this->input->post('id');
		$this->db->where('pro_id', $id)->delete("products");
	}
	public function post_data()
	{
		$id = $this->input->post('co-id');
		$get_data = $this->db->get_where('products', ['co-id' => $id])->result_array();
		$base_url = base_url('image/multi/');


		foreach ($get_data as &$key) {
			if (isset($key['pro_image'])) {
				$key['pro_image'] = $base_url . $key['pro_image'];
			} else {
				$key['pro_image'] = []; // If 'multi_img' does not exist, set it to an empty array
			}


			if (isset($key['multi_img'])) {
				$key['multi_img'] = explode(",", $key['multi_img']);
				foreach ($key['multi_img'] as &$multi_image) {
					$multi_image = $base_url . $multi_image;
				}
			} else {
				$key['multi_img'] = []; // If 'multi_img' does not exist, set it to an empty array
			}
	

			if (!empty($key['color_img'])) {
				$decoded = json_decode($key['color_img'], true);
				if (is_array($decoded)) {
					foreach ($decoded as &$multi_image) {
						$multi_image = $base_url . $multi_image;
					}
					$key['color_img'] = $decoded;
				} else {
					$key['color_img'] = [];
				}
			} else {
				$key['color_img'] = [];
			}
			
		}

		if ($get_data) {
			// header("Content-Type: application/json");
			echo json_encode($get_data);
		};
	}

	public function getproid($id)
	{
		$proid = $this->productmodel->get_id($id);
		$this->session->set_userdata('pro_id', $proid);
	}

	public function num_pro()
	{
		echo json_encode($this->productmodel->num_pro());
	}


	public function beforproget()
	{




		$data = $this->productmodel->getpro();

		$base_url = base_url('image/multi/');

		foreach ($data as &$key) {
			if (isset($key['pro_image'])) {
				$key['pro_image'] = $base_url . $key['pro_image'];
			} else {
				$key['pro_image'] = [];
			}


			if (isset($key['multi_img'])) {
				$key['multi_img'] = explode(",", $key['multi_img']);
				foreach ($key['multi_img'] as &$multi_image) {
					$multi_image = $base_url . $multi_image;
				}
			} else {
				$key['multi_img'] = [];
			}

			// if (isset($key['color_img'])) {
			// 	$key['color_img'] = json_decode($key['color_img'], true);
			// 	foreach ($key['color_img'] as &$multi_image) {
			// 		$multi_image = $base_url . $multi_image;
			// 	}
			// } else {
			// 	$key['color_img'] = [];
			// }
		}




		$data1['dis'] = $this->db->get_where('products', ['discount' => "70"])->result_array();

		foreach ($data1['dis'] as &$dis) {
			if (isset($dis['pro_image'])) {
				$dis['pro_image'] = $base_url . $dis['pro_image'];
			}
		}

		$data1['dis1'] = $this->db->get_where('products', ['discount' => "50"])->result_array();

		foreach ($data1['dis1'] as &$dis) {
			if (isset($dis['pro_image'])) {
				$dis['pro_image'] = $base_url . $dis['pro_image'];
			}
		}





		$data1['prodata'] = $data;

		$data1['sc'] = $this->db->get("subcategory")->result_array();




		$this->load->view('beforlogin', $data1);
		// echo json_encode($data);
	}

	public function proget()
	{




		$data = $this->productmodel->getpro();
		$base_url = base_url('image/multi/');

		foreach ($data as &$key) {
			if (isset($key['pro_image'])) {
				$key['pro_image'] = $base_url . $key['pro_image'];
			} else {
				$key['pro_image'] = []; // If 'multi_img' does not exist, set it to an empty array
			}


			if (isset($key['multi_img'])) {
				$key['multi_img'] = explode(",", $key['multi_img']);
				foreach ($key['multi_img'] as &$multi_image) {
					$multi_image = $base_url . $multi_image;
				}
			} else {
				$key['multi_img'] = []; // If 'multi_img' does not exist, set it to an empty array
			}

			// if (isset($key['color_img'])) {
			//     $key['color_img'] = json_decode($key['color_img'], true);
			// 	foreach ($key['color_img'] as &$multi_image) {
			// 		$multi_image = $base_url . $multi_image;
			// 	}

			// } else {
			//     $key['color_img'] = [];
			// }
		}


		$data1['userget'] = $this->session->userdata('userdata');
		// $data1['cart']=$this->session->userdata('cart');
		$id = $this->session->userdata('userdata');
		$cart = $this->db->get_where('whishlist', ['id' => $id->id])->result_array();
		$cart1 = $this->db->get_where('cart', ['id' => $id->id])->result_array();

		$data1['dis'] = $this->db->get_where('products', ['discount' => "70"])->result_array();
		foreach ($data1['dis'] as &$dis) {
			if (isset($dis['pro_image'])) {
				$dis['pro_image'] = $base_url . $dis['pro_image'];
			}
		}
		$data1['dis1'] = $this->db->get_where('products', ['discount' => "50"])->result_array();

		foreach ($data1['dis1'] as &$dis) {
			if (isset($dis['pro_image'])) {
				$dis['pro_image'] = $base_url . $dis['pro_image'];
			}
		}



		$data1['cart1'] = $cart1;
		$data1['prodata'] = $data;
		$data1['cart'] = $cart;
		$data1['sc'] = $this->db->get("subcategory")->result_array();




		$this->load->view('ui1', $data1);
		// echo json_encode($data);
	}





    public function user_orders()
    {
        // Simulate API/DB data (replace with actual DB call if needed)
        $json_data = file_get_contents(FCPATH . 'assets/sample_data.json'); // Or load from DB
        $decoded = json_decode($json_data, true);

        // Optional: Filter or sort if needed

        $data['order_products'] = $decoded;
        $this->load->view('product_view', $data);
    }



	public function proget1()
	{
		$data = $this->productmodel->getpro();

		$base_url = base_url('image/multi/');

		foreach ($data as &$key) {
			if (isset($key['pro_image'])) {
				$key['pro_image'] = $base_url . $key['pro_image'];
			} else {
				$key['pro_image'] = []; // If 'multi_img' does not exist, set it to an empty array
			}


			if (isset($key['multi_img'])) {
				$key['multi_img'] = explode(",", $key['multi_img']);
				foreach ($key['multi_img'] as &$multi_image) {
					$multi_image = $base_url . $multi_image;
				}
			} else {
				$key['multi_img'] = []; // If 'multi_img' does not exist, set it to an empty array
			}

			if (!empty($key['color_img']) && is_array($key['color_img'])) {
				$key['color_img'] = json_decode($key['color_img'], true);
				foreach ($key['color_img'] as &$multi_image) {
					$multi_image = $base_url . $multi_image;
				}
			} else {
				$key['color_img'] = [];
			}
		}
		echo json_encode($data);
	}


	public function update_table()
	{
		$id = $this->input->post('id');
		$column = $this->input->post('column');
		$value = $this->input->post('value');


		$update = $this->db->where('pro_id', $id)->update('products', [$column => $value]);
		echo $update;
		if ($update) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No changes made']);
		}
	}


	public function proin()
	{
		// Set default response header
		$this->output->set_content_type('application/json');

		// Basic configuration for image uploads
		$config = [
			'upload_path' => './image/multi/',
			'allowed_types' => 'jpg|jpeg|png|gif',
			'max_size' => 10192,
			'encrypt_name' => TRUE
		];

		// Handle main product image upload
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('pro_image')) {
			return $this->output->set_output(json_encode([
				'status' => 'error',
				'message' => 'Failed to upload main image',
				'error' => $this->upload->display_errors('', '')
			]));
		}

		$upload_data = $this->upload->data();
		$main_image_path =  $upload_data['file_name'];

		// Handle multiple image uploads
		$multi_images = [];

		if (!empty($_FILES['multi_img']['name'][0])) {
			$files = $_FILES['multi_img'];
			$file_count = count($files['name']);

			for ($i = 0; $i < $file_count; $i++) {
				$_FILES['temp_file'] = [
					'name' => $files['name'][$i],
					'type' => $files['type'][$i],
					'tmp_name' => $files['tmp_name'][$i],
					'error' => $files['error'][$i],
					'size' => $files['size'][$i]
				];

				// Reinitialize the upload library for each file
				$this->upload->initialize($config);




				if ($this->upload->do_upload('temp_file')) {
					$upload = $this->upload->data();
					$multi_images[] =  $upload['file_name'];
				} else {
					// Log the error but continue with other uploads
					log_message('error', 'Failed to upload file ' . $files['name'][$i] . ': ' .
						$this->upload->display_errors('', ''));
				}
			}
		}


		// multi colour image upload 
		//create an array
		// Handle multi-colour image uploads
		$color_images = [];
		$color_name = $this->input->post('color');

		$colors_raw = explode(',', $color_name);

		// Step 2: Trim each color
		$color_names = array_map(function ($color) {
			return trim($color, " '"); // trims spaces and single quotes
		}, $colors_raw);





		// die(json_encode($color_images));
		if (!empty($_FILES['color_img']['name'][0])) {
			$color_files = $_FILES['color_img'];
			$color_count = count($color_files['name']);

			for ($i = 0; $i < $color_count; $i++) {
				$_FILES['temp_color'] = [
					'name' => $color_files['name'][$i],
					'type' => $color_files['type'][$i],
					'tmp_name' => $color_files['tmp_name'][$i],
					'error' => $color_files['error'][$i],
					'size' => $color_files['size'][$i]
				];


				$this->upload->initialize($config);

				if ($this->upload->do_upload('temp_color')) {
					$file_data = $this->upload->data();
					$color_name = $color_names[$i];

					$color_images[$color_name] = $file_data['file_name'];
				} else {
					log_message('error', 'Failed to upload color file ' . $color_files['name'][$i] . ': ' . $this->upload->display_errors('', ''));
				}
			}
		}



		// Prepare product data for database
		$product_data = [
			'pro_brand' => $this->input->post('pro_brand'),
			'pro_name' => $this->input->post('pro_name'),
			'pro_discription' => $this->input->post('pro_discription'),
			'pro_price' => $this->input->post('pro_price'),
			'co-id' => $this->input->post('co-id'),
			'pro_image' => $main_image_path,
			'sc_id' => $this->input->post('sc_id'),
			'multi_img' => !empty($multi_images) ? implode(',', $multi_images) : '',
			'color_img' => json_encode($color_images),
			'pro_size' => $this->input->post('pro_size'),

		];

		// Insert into database
		$result = $this->productmodel->inpro($product_data);



		if ($result) {
			return $this->output->set_output(json_encode([
				'status' => 'success',
				'message' => 'Product created successfully',
				'data' => [
					'main_image' => $main_image_path,
					'additional_images' => $multi_images,
					'color_image' => $color_images,
				]
			]));
		}

		return $this->output->set_output(json_encode([
			'status' => 'error',
			'message' => 'Failed to create product'
		]));
	}

	public function proshow()
	{
		$this->load->view('productui');
	}

	#update

	public function up_pro()
	{
		$id = $this->input->post('id');


		#delete image
		$data['prodata'] = $this->productmodel->get_id($id);

		$this->session->set_userdata('pro_data', $data['prodata']);

		$this->load->view('pro_update', $data);
	}
	public function up_pro1()
	{



		#delete image

		$data['prodata'] = $this->session->userdata('pro_data');

		$this->load->view('pro_update', $data);
	}


	public function uppro()
	{
		$id = $this->input->post('id');
		#delete image
		$image_id1 = $this->productmodel->get_id($id);
		// echo json_encode($image_id1);

		if (!$image_id1) {
			header("content-type:application/json");
			echo json_encode(['status' => 'fail', 'message' => 'id nor in the record']);
		}

		$image_id = str_replace('', '', $image_id1['pro_image']);

		// die($image_id);
		if (file_exists($image_id)) {
			unlink($image_id);
		}
		#update image
		$config['upload_path'] = './image/multi/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048;
		$config['encrypt_name'] = true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('pro_image')) {
			// header('content-types:application/json');
			echo json_encode(['states' => 'fail', 'message' => 'fial to upload image']);
		}

		$image_data = $this->upload->data();

		$image_path =  $image_data['file_name'];


		$config['upload_path'] = './image/multi/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048;
		$config['encrypt_name'] = true;

		$multi_images = [];

		if (!empty($_FILES['multi_img']['name'][0])) {
			$files = $_FILES['multi_img'];
			$file_count = count($files['name']);

			for ($i = 0; $i < $file_count; $i++) {
				$_FILES['temp_file'] = [
					'name' => $files['name'][$i],
					'type' => $files['type'][$i],
					'tmp_name' => $files['tmp_name'][$i],
					'error' => $files['error'][$i],
					'size' => $files['size'][$i]
				];



				// Reinitialize the upload library for each file
				$this->upload->initialize($config);




				if (!$this->upload->do_upload('temp_file')) {
					log_message('error', 'Failed to upload file ' . $files['name'][$i] . ': ' .
						$this->upload->display_errors('', ''));
				} else {
					$upload = $this->upload->data();
					$multi_images[] =  $upload['file_name'];
					// Log the error but continue with other uploads

				}
			}
		}


		$color_images = [];
		$color_name = $this->input->post('color');

		$colors_raw = explode(',', $color_name);

		// Step 2: Trim each color
		$color_names = array_map(function ($color) {
			return trim($color, " '"); // trims spaces and single quotes
		}, $colors_raw);





		// die(json_encode($color_images));
		if (!empty($_FILES['color_img']['name'][0])) {
			$color_files = $_FILES['color_img'];
			$color_count = count($color_files['name']);

			for ($i = 0; $i < $color_count; $i++) {
				$_FILES['temp_color'] = [
					'name' => $color_files['name'][$i],
					'type' => $color_files['type'][$i],
					'tmp_name' => $color_files['tmp_name'][$i],
					'error' => $color_files['error'][$i],
					'size' => $color_files['size'][$i]
				];


				$this->upload->initialize($config);

				if ($this->upload->do_upload('temp_color')) {
					$file_data = $this->upload->data();
					$color_name = $color_names[$i];

					$color_images[$color_name] =  $file_data['file_name'];
				} else {
					log_message('error', 'Failed to upload color file ' . $color_files['name'][$i] . ': ' . $this->upload->display_errors('', ''));
				}
			}
		}





		$prodata1 = array(
			'pro_brand' => $this->input->post('pro_brand'),
			'pro_name' => $this->input->post('pro_name'),
			'pro_discription' => $this->input->post('pro_discription'),
			'pro_price' => $this->input->post('pro_price'),
			'pro_size' => $this->input->post('pro_size'),
			'co-id' => $this->input->post('co-id'),
			'pro_image' => $image_path,
			'multi_img' => !empty($multi_images) ? implode(',', $multi_images) : '',
			'sc_id' => $this->input->post('sc_id'),
			'color_img' => json_encode($color_images),
		);
		// die(json_encode($scdata1));

		if ($this->productmodel->uppro($id, $prodata1)) {
			header('content-type:application/json');
			echo json_encode(['status' => 'successfull', 'message' => 'update successfully']);
		} else {
			header('content-type:application/json');
			echo json_encode(['status' => 'failure', 'message' => 'update failure']);
		}
	}
	#show data on other user page
	public function Usershow($pro_id)
	{
		$pro_data = $this->productmodel->get_id($pro_id);
		$base_url = base_url('image/multi/');
	
		// Add full URL to pro_image
		// if (isset($pro_data['pro_image'])) {
		// 	$pro_data['pro_image'] = $base_url . $pro_data['pro_image'];
		// }
	
		// Add full URL to multi_img array
		if (isset($pro_data['multi_img'])) {
			$pro_data['multi_img'] = explode(",", $pro_data['multi_img']);
			foreach ($pro_data['multi_img'] as &$multi_image) {
				$multi_image = $base_url . $multi_image;
			}
		}
	
		// Convert color_img from fake JSON string to proper key-value array
		$result = [];
		if (isset($pro_data['color_img'])) {
			$color_img_raw = trim($pro_data['color_img'], '{}'); // Remove {}
			$color_items = explode(',', $color_img_raw); // Split on comma
	
			foreach ($color_items as $item) {
				$kv = explode(':', $item);
				if (count($kv) === 2) {
					$key = trim($kv[0], '" ');
					$value = trim($kv[1], '" ');
					$result[$key] = $base_url . $value;
				}
			}
	
			// Replace raw color_img with processed version
			$pro_data['color_img'] = $result;
		}
	
		// Ratings
		$pdata['rating'] = $this->db->get_where('ratings', ['pro_id' => $pro_id])->result_array();
	
		// Similler data
		$sc = $pro_data["sc_id"];
		$pdata['similler'] = $this->db->get_where('products', ['sc_id' => $sc])->result_array();
		foreach ($pdata['similler'] as &$key) {
			if (isset($key['pro_image'])) {
				$key['pro_image'] = $base_url . $key['pro_image'];
			} else {
				$key['pro_image'] = []; // If 'multi_img' does not exist, set it to an empty array
			}
		}


	
		// Cart data
		$id = $this->session->userdata('userdata');
		$cart = $this->db->get_where('cart', ['id' => $id->id])->result_array();
		$this->session->set_userdata('cart1', $cart);
	
		$pdata['cart'] = count($cart);
		$pdata['p_data'] = $pro_data;
		$pdata['userget'] = $this->session->userdata('userdata');
	
		// Send only product data as JSON response for debugging
	
		// Or load view (if die is removed)
		$this->load->view('ui2', $pdata);
	}

	public function beforUsershow($pro_id)
	{
		$pro_data = $this->productmodel->get_id($pro_id);
		$sc = $pro_data["sc_id"];
		$base_url = base_url('image/multi/');
		// foreach($pro_data as $pro){
		// 	foreach($pro as $p){

				// Add full URL to pro_image
				if (isset($pro_data['pro_image'])) {
					$pro_data['pro_image'] = $base_url . $pro_data['pro_image'];
				}
			
				// Add full URL to multi_img array
				if (isset($pro_data['multi_img'])) {
					$pro_data['multi_img'] = explode(",", $pro_data['multi_img']);
					foreach ($pro_data['multi_img'] as &$multi_image) {
						$multi_image = $base_url . $multi_image;
					}
				}
			
				// Convert color_img from fake JSON string to proper key-value array
				$result = [];
				if (isset($pro_data['color_img'])) {
					$color_img_raw = trim($pro_data['color_img'], '{}'); // Remove {}
					$color_items = explode(',', $color_img_raw); // Split on comma
			
					foreach ($color_items as $item) {
						$kv = explode(':', $item);
						if (count($kv) === 2) {
							$key = trim($kv[0], '" ');
							$value = trim($kv[1], '" ');
							$result[$key] = $base_url . $value;
						}
					}
			
					// Replace raw color_img with processed version
					$pro_data['color_img'] = $result;
				}
			

		$pdata['rating'] = $this->db->get_where('ratings', ['pro_id' => $pro_id])->result_array();


		$simillerdata = $this->db->get_where('products', ['sc_id' => $sc])->result_array();
		$pdata['similler'] = $simillerdata;


		foreach ($pdata['similler'] as &$key) {
			if (isset($key['pro_image'])) {
				$key['pro_image'] = $base_url . $key['pro_image'];
			} else {
				$key['pro_image'] = []; // If 'multi_img' does not exist, set it to an empty array
			}
		}

		
		$pdata['p_data'] = $pro_data;

		$pdata['userget'] = $this->session->userdata('userdata');
		$this->load->view('beforlogin2', $pdata);
	}


	public function Usershow2()
	{


		$data1['userget'] = $this->session->userdata('userdata');
		$data1['cart_data'] = $this->db->get_where('cart', ['id' => $data1['userget']->id])->result_array();


		$this->load->view('ui3', $data1);
	}

	public function wishlist()
	{
		$data['userget'] = $this->session->userdata('userdata');

		$data['cart_data'] = $this->db->get_where('whishlist', ['id' => $data['userget']->id])->result_array();



		$this->load->view('whislist', $data);
	}

	public function sort_data()
	{

		$sort_data = $this->input->post('sort');

		$sort_by = $this->productmodel->sort_by($sort_data);
		$base_url = base_url('image/multi/');
		foreach ($sort_by  as &$key) {
			if (isset($key['pro_image'])) {
				$key['pro_image'] = $base_url . $key['pro_image'];
			} else {
				$key['pro_image'] = []; // If 'multi_img' does not exist, set it to an empty array
			}
		}


		foreach ($sort_by as $item) {
			echo '<div data-id=' . $item['pro_id'] . ' class="con bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:scale-105 w-full max-w-xs mx-auto cursor-pointer border border-gray-200">
			<div class="relative overflow-hidden rounded-lg">
				<img src="' . $item['pro_image'] . '" alt="Product Image" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 hover:scale-110">
			</div>
			<h3 class="text-lg font-semibold mt-4 text-gray-900 text-center">' . $item['pro_name'] . '</h3>
			<p class="text-gray-600 mt-2 text-sm leading-relaxed text-center">' . $item['pro_discription'] . '</p>
			<div class="mt-3 flex flex-col items-center">
				<span class="text-gray-500 line-through text-lg font-medium">Rs. 2299 (50% OFF)</span>
				<span class="text-green-600 font-bold text-xl bg-green-100 px-3 py-1 rounded-lg shadow-sm">Rs. ' . number_format($item['pro_price'], 2) . '</span>
			</div>
		  </div>';
		}
	}


	public function search()
	{
		$data = $this->input->post('data');

		$data = $this->productmodel->search($data);

		echo json_encode($data);
	}
	public function post_data1()
	{
		$id = $this->input->post('co_id');

		$get_data = $this->db->get_where('products', ['co-id' => $id])->result_array();

		$sc = $this->db->get_where('subcategory', ['co-id' => $id])->result_array();

		$this->session->set_userdata('catpro', $get_data);
		$this->session->set_userdata('sc', $sc);
	}

	public function catproducts()
	{
		$y['catpro'] = $this->session->userdata('catpro');
		$y['scat'] = $this->session->userdata('sc');
		$this->load->view('catproducts', $y);
	}

	public function catproducts1()
	{
		$y['catpro'] = $this->session->userdata('catpro');
		$y['scat'] = $this->session->userdata('sc');
		$this->load->view('beforlogin3', $y);
	}

	public function discount()
	{
		$disid = $this->input->post('dis');

		$w = $this->db->get_where('products', ['discount' => $disid])->result_array();

		$this->session->set_userdata('discount', $w);
	}

	public function size()
	{
		$r = $this->input->post('size');
		$y = $this->db->get('products')->result_array();
		$products = [];

		foreach ($y as $item) {
			$sizes = array_map('trim', explode(",", $item['pro_size']));

			// Match in a case-insensitive way
			if (in_array(strtoupper($r), array_map('strtoupper', $sizes))) {
				$products[] = $item;
			}
		}

		echo json_encode($products);
	}

	public function filter_by_color()
	{
		$color = $this->input->post('color');

		// Get all products (or filter as needed)
		$products = $this->db->get('products')->result_array();

		$filtered = [];

		foreach ($products as $product) {
			// Decode JSON color-image data
			$color_images = json_decode($product['color_img'], true); // stored in DB

			// Check if requested color exists in the JSON keys
			if (isset($color_images[$color])) {
				// Add matching product + color image URL to result
				$product['filtered_image'] = $color_images[$color]; // only selected color image
				$filtered[] = $product;
			}
		}

		

		echo json_encode($filtered);
	}


	public function filter_by_price()
	{
		$min = $this->input->post('min');
		$max = $this->input->post('max');

		$this->db->where('pro_price >=', $min);
		$this->db->where('pro_price <=', $max);
		$query = $this->db->get('products');

		echo json_encode($query->result_array());
	}

	public function filter_by_brand()
	{
		$brand = $this->input->post('brand');

		// Matches brand names that start with the given value
		$this->db->like('pro_brand', $brand, 'after');

		$query = $this->db->get('products');

		echo json_encode($query->result_array());
	}

	public function filter_by_subcategory()
	{
		$subcategory = $this->input->post('subcategory');

		$this->db->where('sc_id', $subcategory);
		$query = $this->db->get('products');

		// Check if query failed
		if (!$query) {
			// Show last query and error
			echo $this->db->last_query();
			print_r($this->db->error());
			return;
		}

		echo json_encode($query->result_array());
	}
}
