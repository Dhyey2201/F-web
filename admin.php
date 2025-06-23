<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Flatkit Dashboard</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
		body {
			background:rgb(249, 248, 252);
			;
			font-family: sans-serif;
		}

		/* .sidebar {
			background-color: #fff;
			padding: 20px;
			height: 100vh;
			box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
			color: #333;
		} */



		.content {
			padding: 20px;
		}

		.card {
			/* margin-left: 20px; */
			margin-bottom: 20px;
			border: 1;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

		}

		.card21 {
			margin-top: 30px;
			border: 2;
			height: 725px;
			width: 1710px;
		}

		.card-body2 {
			margin-top: 30px;
			border: 2;
			height: 725px;
			width: 1710px;
			background-color: #e0f7fa;
		}

		.card-body {
			padding: 10px;

		}

		.project-item {
			display: flex;
			align-items: center;
			padding: 10px 0;
			border-bottom: 1px solid #eee;
		}

		.project-item:last-child {
			border-bottom: none;
		}

		.project-item .icon {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background-color: #e0f7fa;
			color: #900c3f;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-right: 15px;
		}

		.stats-item {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 10px 0;
			border-bottom: 1px solid #eee;
		}

		.stats-item:last-child {
			border-bottom: none;
		}

		.btn-outline-secondary {
			color: #6c757d;
			border-color: #6c757d;
		}

		.btn-outline-secondary:hover {
			background-color: #6c757d;
			color: white;
		}

		.card-body.text-center h2 {
			color: #900c3f;
			font-weight: 700;
		}

		.card-body.text-center p {
			color: #666;
		}



		.table-like {
			display: flex;
			flex-direction: column;
			border: 1px solid #ddd;
			border-radius: 5px;
			overflow: hidden;
			background-color: #fff;
			width: 100%;
			margin-right: 300;
			overflow-x: auto
		}

		.table-like .row {
			display: flex;
			border-bottom: 2px solid #ddd;
		}

		.table-like .row.header {
			/* background-color: #900c3f; */
			color: rgb(6, 2, 17);
			font-weight: bold;
		}

		.table-like .row:last-child {
			border-bottom: 2;
		}

		.table-like .cell {
			padding: 10px;
			min-width: 100px;
			/* Minimum width to maintain structure */
			max-width: 300px;
			/* Prevents excessive widening */
			flex: 1;
			/* Makes cells flexible */
			text-align: center;
			border: 1px solid #ddd;
			white-space: nowrap;
			/* Prevents text wrapping */
			overflow: hidden;
			/* Hides overflowing text */
			text-overflow: ellipsis;
			/* Adds "..." to long text */
		}

		.table-like .cell.wrap-text {
			white-space: normal;
			/* Allows text wrapping */
			word-wrap: break-word;
			overflow-wrap: break-word;
		}

		.table-like .cell:not(:last-child) {
			border-right: 2px solid #ddd;
		}

		#table-container {
			width: 1540px;
			height: 500px;
			overflow-x: auto;
			overflow-y: auto;
			border: 1px solid #ccc;
			display: block;
			white-space: nowrap;
		}

		.row {
			display: flex;
			min-width: 100%;
		}

		.header {
			position: sticky;
			top: 0;
			background: #fff;
			z-index: 10;
			font-weight: bold;
		}

		.cell {
			padding: 10px;
			width: 100px;
			border: 1px solid #ddd;
			flex: 1;
			/* Make cells flexible */
			text-align: center;
		}

		/* Center the form */
		#status-form {
			display: flex;
			justify-content: center;
			padding-left: 100px;
			padding-right: 100px;

			align-items: center;
			width: 1710px;
			height: 300px;
			/* Makes it vertically centered */
			background: linear-gradient(135deg,rgb(245, 244, 250),rgb(245, 244, 250));
			/* Cool gradient background */
		}

		/* Form styling */
		#status {
			background: white;
			padding: 20px;
			border-radius: 12px;
			box-shadow: 0px 4px 8pxrgb(119, 182, 224);
			width: 350px;

			text-align: center;
			transition: transform 0.3s ease-in-out;
			align-items: center;
		}

		#status:hover {
			transform: scale(1.05);
			/* Slight zoom effect on hover */
		}

		/* Form title */
		#status h2 {
			font-size: 20px;
			color: #333;
			margin-bottom: 15px;
		}

		/* Input styling */
		#order_id {
			width: 80%;
			padding: 10px;
			margin-bottom: 15px;
			border: 2px solid #ddd;
			border-radius: 5px;
			outline: none;
			font-size: 16px;
			transition: border 0.3s ease-in-out;
		}

		#order_id:focus {
			border: 2px #900;
			;
			/* Highlight on focus */
		}

		/* Checkbox Group */
		.checkbox-group {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-bottom: 15px;
		}

		.checkbox-group label {
			background: #f7f7f7;
			padding: 8px;
			width: 80%;
			border-radius: 5px;
			margin: 5px 0;
			display: flex;
			align-items: center;
			cursor: pointer;
			transition: background 0.3s ease-in-out;
		}

		.checkbox-group label:hover {
			background: #ffd3b6;
		}

		/* Checkbox custom styling */
		.checkbox-group input[type="checkbox"] {
			margin-right: 10px;
			transform: scale(1.2);
		}

		/* Submit Button */
		button {
			background: rgb(252, 178, 167);
			;
			color: white;
			padding: 10px 15px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			transition: background 0.3s ease-in-out, transform 0.2s;
		}

		button:hover {
			background: rgb(252, 178, 167);
			transform: translateY(-2px);
		}
	</style>
</head>
<div>
	<div class="container-fluid">
		<div class="row">
			<aside id="sidebar"
				class="w-64 bg-gray-800 text-white p-4 min-h-screen transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out fixed md:relative z-50">
				<div class="space-y-6">
					<h5 class="text-2xl font-bold text-green-400 mb-10">ADMIN</h5>
					<ul class="space-y-2">
						<li class="p-3 hover:text-green-300 cursor-pointer" id="dashboard">Dashboard</li>
						<li class="p-3 hover:text-green-300 cursor-pointer" id="user">User</li>
						<li class="p-3 hover:text-green-300 cursor-pointer" id="Category">Category</li>
						<li class="p-3 hover:text-green-300 cursor-pointer" id="Sub-Category">Sub-Category</li>
						<li class="p-3 hover:text-green-300 cursor-pointer" id="products">Products</li>
						<li class="p-3 hover:text-green-300 cursor-pointer" id="order">Orders</li>
						<li class="p-3 hover:text-green-300 cursor-pointer" id="Order_items">Order-items</li>
						<li class="p-3 hover:text-green-300 cursor-pointer" id="payment">Payment</li>
						<li class="p-3 hover:text-green-300 cursor-pointer" id="ratting">Ratting</li>
						<li class="p-3 hover:text-green-300 cursor-pointer">Help</li>
					</ul>
					<div class="pt-6 border-t text-sm text-gray-400">Jean Reyes</div>
				</div>
			</aside>
			<main id="main-content" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 content">
				<div id="header-section" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 id="welcome-title" class="h2">Welcome to Flatkit</h1>
					<div id="manage-projects" class="btn-toolbar mb-2 mb-md-0">
						<button type="button" class="btn btn-sm btn-outline-secondary">Start manage: Projects</button>
					</div>
				</div>
				<div id="stats-row" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 p-4">
					<!-- Card 1 -->
					<div class="bg-blue-500 text-white rounded-xl shadow-md p-4 text-center">
						<h2 id="stats-1-value" class="text-2xl font-bold">123</h2>
						<p id="stats-1-desc" class="text-sm">Users</p>
					</div>

					<!-- Card 2 -->
					<div class="bg-green-500 text-white rounded-xl shadow-md p-4 text-center">
						<h2 id="stats-2-value" class="text-2xl font-bold">456</h2>
						<p id="stats-2-desc" class="text-sm">Orders</p>
					</div>

					<!-- Card 3 -->
					<div class="bg-yellow-400 text-gray-900 rounded-xl shadow-md p-4 text-center">
						<h2 id="stats-3-value" class="text-2xl font-bold">78%</h2>
						<p id="stats-3-desc" class="text-sm">Conversion</p>
					</div>

					<!-- Card 4 -->
					<div class="bg-purple-500 text-white rounded-xl shadow-md p-4 text-center">
						<h2 id="stats-4-value" class="text-2xl font-bold">892</h2>
						<p id="stats-4-desc" class="text-sm">Visitors</p>
					</div>

					<!-- Card 5 -->
					<div class="bg-red-500 text-white rounded-xl shadow-md p-4 text-center">
						<h2 id="stats-5-value" class="text-2xl font-bold">12</h2>
						<p id="stats-5-desc" class="text-sm">Issues</p>
					</div>

					<!-- Card 6 -->
					<div class="bg-teal-500 text-white rounded-xl shadow-md p-4 text-center">
						<h2 id="stats-6-value" class="text-2xl font-bold">₹4.5k</h2>
						<p id="stats-6-desc" class="text-sm">Revenue</p>
					</div>
				</div>


			<div class="flex flex-wrap gap-4 p-4">
  <!-- Add Category Button -->
  <a href="<?php echo base_url('CategoryController/cat_in') ?>">
    <button id="addCategoryBtn" class="inline-flex items-center px-4 py-3 bg-green-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-green-700 justified-end transition">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      Add Category
    </button>
  </a>

  <!-- Add Sub-Category Button -->
  <a href="<?php echo base_url('sc_controller/scshow') ?>">
    <button id="addsubCategoryBtn" class="inline-flex items-center px-4 py-3 bg-yellow-500 text-white text-sm font-semibold rounded-lg shadow hover:bg-yellow-600 transition">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      Add Sub-Category
    </button>
  </a>

  <!-- Add Products Button -->
  <a href="<?php echo base_url('product/proshow') ?>">
    <button id="addproCategoryBtn" class="inline-flex items-center px-4 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-indigo-700 transition">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      Add Products
    </button>
  </a>
</div>



				<div class="table">
					<h1 class=" font-semibold text-3xl mb-2">Data TABLE</h1>
					<div id="table-container" class="table-like rounded-xl" style="align-content: justified-center center;">
						<!-- Header and Data Rows will be dynamically added here -->
					</div>
				</div>
				<div id="status-form">
					<form id="status" action="<?php echo base_url('order/update') ?>" method="POST">
						<input type="text" name="order_id" id="order_id">
						<label>
							<input type="checkbox" name="order_status[]" value="Order_Confirmed"> Order Confirmed
						</label><br>
						<label>
							<input type="checkbox" name="order_status[]" value="Shipped"> Shipped
						</label><br>
						<label>
							<input type="checkbox" name="order_status[]" value="Out_For_Delivery"> Out for Delivery
						</label><br>
						<label>
							<input type="checkbox" name="order_status[]" value="Delivered"> Delivered
						</label><br>

						<button type="submit" class="bg-indigo-400 text-white p-2">Submit</button>
					</form>
				</div>
			</main>
		</div>
	</div>



	<script>
		$(document).ready(function() {
			$('#status-form,table-container,#table,#addCategoryBtn,#addsubCategoryBtn,#addproCategoryBtn').hide(); // Automatically hide the form on page load

			// When clicking the "Dashboard" menu item, hide the form
			$('#order').click(function() {
				$('#status-form').show();
			});

			$('#Category').click(function() {
				$('#addCategoryBtn').show();
			})
			$('#Sub-Category').click(function() {
				$('#addsubCategoryBtn').show();
			})
		});

		$(document).ready(function() {

			$('#user').click(function() {
				$('#stats-2-value,#stats-3-value,#stats-4-value,#stats-5-value,#stats-6-value,#status,#addCategoryBtn,#addsubCategoryBtn,#addproCategoryBtn').hide()
				$.ajax({
					url: '<?php echo base_url('api/users') ?>', // Ensure this URL is correct
					method: 'GET',
					dataType: 'json', // Explicitly specify JSON data type
					success: function(data) {
						console.log('Data received:', data); // Debug: Log the data

						if (data && data.length > 0) {
							let keys = Object.keys(data[0]); // Extract column headers

							// Generate header row
							let headerRow = `<div class="row  header">`;
							keys.forEach(function(key) {
								headerRow += `<div class="cell">${key}</div>`;

							});
							headerRow += `<div class="cell">Actions</div>`
							headerRow += `</div>`;



							// Clear previous content and append new header
							$('#table-container').html(headerRow);

							// Generate table rows

							data.forEach(function(item) {
								let rowHtml = `<div class="row" data-id="${item.id}">`;

								keys.forEach(function(key) {
									rowHtml += `<div class="cell wrap-text" contenteditable="true" data-id="${item.id}" data-column="${key}">${item[key]}</div>`;
								});

								// Add delete button
								rowHtml += `<div class="cell"><button class="delete-btn1 bg-red-500 text-white p-2" data-id="${item.id}">Delete</button></div>`;

								rowHtml += `</div>`;
								$('#table-container').append(rowHtml);
							});

						} else {
							console.log('No data available.'); // Debug: Log if no data is available
							$('#table-container').html('<div class="row">No data available.</div>');
						}
					},
					error: function(xhr, status, error) {
						console.error('Error fetching data:', error); // Debug: Log the error
						console.log('Status:', status); // Debug: Log the status
						console.log('Response:', xhr.responseText); // Debug: Log the response
						$('#table-container').html('<div class="row">Error loading data.</div>');
					}
				});

				$(document).on('click', '.delete-btn1', function() {
					const id = $(this).data('id');
					const row = $(this).closest('.row');

					if (confirm('Are you sure you want to delete this record?')) {
						$.ajax({
							url: '<?php echo base_url('api/user_delete') ?>', // Replace with your actual delete endpoint
							method: 'POST',
							data: {
								id: id
							},
							success: function(response) {
								console.log('Delete Success:', response);
								row.remove(); // Remove the row from DOM
							},
							error: function(error) {
								console.error('Delete Error:', error);
							}
						});
					}
				});


				$.ajax({
					url: '<?php echo base_url('api/num_rows') ?>',
					method: 'GET',
					dataType: 'json',
					success: function(data) {
						console.log(data)


						$('#stats-1-value').html(data);
					}

				})
			});

			$.ajax({
					url: '<?php echo base_url('api/num_rows') ?>',
					method: 'GET',
					dataType: 'json',
					success: function(data) {
						console.log(data)


						$('#stats-1-value').html(data);
					}

				})

			$(document).on('keydown', '.cell[contenteditable=true]', function(e) {
				if (e.which == 13) {
					let cell = $(this)
					let id = cell.data('id')
					let column = cell.data('column')
					let value = cell.text().trim();

					$.ajax({
						url: '<?php echo base_url('api/update_table') ?>',
						method: 'POST',
						data: {
							id: id,
							column: column,
							value: value
						},
						success: function(response) {
							console.log('Update Success:', response);
						},
						error: function(error) {
							console.error('Error fetching data:', error);
						}
					})
				}
			})
		});
	</script>


	<script>
		$(document).ready(function() {


			$('#Category').click(function() {
				$('#stats-2-value,#stats-3-value,#stats-4-value,#stats-5-value,#stats-6-value,#status,#addsubCategoryBtn,#addproCategoryBtn').hide()
				$.ajax({
					url: '<?php echo base_url('CategoryController/get_ca') ?>',
					method: 'GET',
					dataType: 'json',
					success: function(data) {
						// console.log(data);

						if (data && data.length > 0) {

							let keys = Object.keys(data[0]);
							// console.log(keys);

							let headerRow = `<div class="row header">`;

							keys.forEach(function(key) {
								headerRow += `<div class="cell">${key}</div>`;
							});
							headerRow += `<div class="cell">Actions</div>`

							headerRow += `</div>`;

							$('#table-container').html(headerRow);

							data.forEach(function(item) {
								let rowHtml = `<div class='row'>`;

								keys.forEach((element) => {
									rowHtml += `<div class="cell wrap-text" contenteditable="true" data-id="${item['co-id']}" data-column="${element}">${item[element]}</div>`;
								});
								rowHtml += `<div class="cell"><button class="delete-btn2  bg-red-500 text-white p-2" data-id="${item['co-id']}">Delete</button></div>`;

								rowHtml += `</div>`;
								$('#table-container').append(rowHtml);
							});


						} else {
							console.log('No data available.');
							$('#table-container').html('<div class="row">No data available.</div>');
						}

					},
					error: function(xhr, status, error) {
						console.error('Error fetching data:', error);
						console.log('Status:', status);
						console.log('Response:', xhr.responseText);
						$('#table-container').html('<div class="row">Error loading data.</div>');
					}
				})
				$.ajax({
					url: '<?php echo base_url('categoryController/num_cat') ?>',
					method: 'GET',
					dataType: 'json',
					success: function(data) {
						console.log(data)


						$('#stats-1-value').html(data);
					}

				})
			})
			$(document).on('keydown', '.cell[contenteditable="true"]', function(e) {
				if (e.which == 13) { // Enter key pressed
					e.preventDefault(); // Prevent new line in contenteditable div

					let cell = $(this);
					let id = cell.data('id'); // Get row ID
					let column = cell.data('column'); // Get column name
					let newValue = cell.text().trim(); // Get updated value

					console.log("Updating: ", {
						id,
						column,
						newValue
					});

					// Send updated value to the database
					$.ajax({
						url: '<?php echo base_url('CategoryController/table_update') ?>',
						method: 'POST',
						data: {
							id: id,
							column: column,
							value: newValue
						},
						success: function(response) {
							console.log('Update Success:', response);

						},
						error: function(xhr, status, error) {
							console.error('Update Error:', error);

						}
					});
				}
			});

			$(document).on('click', '.delete-btn2', function() {
				const id = $(this).data('id');
				console.log(id);
				const row = $(this).closest('.row');

				if (confirm('Are you sure you want to delete this record?')) {
					$.ajax({
						url: '<?php echo base_url('Categorycontroller/delete_category') ?>', // Replace with your actual delete endpoint
						method: 'POST',
						data: {
							id: id
						},
						success: function(response) {
							console.log('Delete Success:', response);
							// Remove the row from DOM
						},
						error: function(error) {
							console.error('Delete Error:', error);
						}
					});
				}
			});

		})
	</script>


	<script>
		$(document).ready(function() {

			$('#Sub-Category').click(function() {
				$('#stats-2-value,#stats-3-value,#stats-4-value,#stats-5-value,#stats-6-value').show();
				$('#status,#addCategoryBtn,#addproCategoryBtn').hide()
				$.ajax({
					url: '<?php echo base_url('sc_controller/scget2') ?>',
					method: "GET",
					dataType: "json",
					success: function(data) {

						if (data && data.length > 0) {
							let keys = Object.keys(data[0]);

							let headerRow = `<div class='row header'>`

							keys.forEach(function(key) {
								headerRow += `<div class="cell">${key}</div>`

							})
							headerRow += `<div class="cell">Actions</div>`

							headerRow += `</div>`;

							$('#table-container').html(headerRow);

							data.forEach(function(item) {

								let row = `<div class="row">`

								keys.forEach(function(key) {
									row += `<div class="cell wrap-text" contenteditable='true' data-id=${item.sc_id} data-column=${key}>${item[key]}</div>`
								})
								row += `<div class="cell"><button class="delete-btn3  bg-red-500 text-white p-2" data-id="${item['sc_id']}">Delete</button></div>`;
								row += `<div>`

								$('#table-container').append(row);
							})

						} else {
							console.log('data not fount');
						}
					},
					error: function(error) {
						console.error('Error fetching data:', error)
					}
				})

				$.ajax({
					url: '<?php echo base_url('sc_controller/num_sc') ?>',
					method: 'GET',
					dataType: "json",
					success: function(data) {
						$('#stats-1-value').html(data)
					}
				})

				$.ajax({
					url: '<?php echo base_url('sc_controller/man_sc') ?>',
					method: 'GET',
					dataType: "json",
					success: function(data) {
						$('#stats-2-value').html(data)
					}
				})
				$.ajax({
					url: '<?php echo base_url('sc_controller/woman_sc') ?>',
					method: 'GET',
					dataType: "json",
					success: function(data) {
						$('#stats-3-value').html(data)
					}
				})
				$.ajax({
					url: '<?php echo base_url('sc_controller/teen_sc') ?>',
					method: 'GET',
					dataType: "json",
					success: function(data) {
						$('#stats-4-value').html(data)
					}
				})
				$.ajax({
					url: '<?php echo base_url('sc_controller/kid_sc') ?>',
					method: 'GET',
					dataType: "json",
					success: function(data) {
						$('#stats-5-value').html(data)
					}
				})
				$.ajax({
					url: '<?php echo base_url('sc_controller/baby_sc') ?>',
					method: 'GET',
					dataType: "json",
					success: function(data) {
						$('#stats-6-value').html(data)
					}
				})

			})

			$(document).on('click', '.delete-btn3', function() {
				const id = $(this).data('id');


				console.log(id);
				const row = $(this).closest('.row');

				if (confirm('Are you sure you want to delete this record?')) {
					$.ajax({
						url: '<?php echo base_url('sc_controller/sc_del') ?>', // Replace with your actual delete endpoint
						method: 'POST',
						data: {
							id: id
						},
						success: function(response) {
							console.log('Delete Success:', response);
							// Remove the row from DOM
						},
						error: function(error) {
							console.error('Delete Error:', error);
						}
					});
				}
			});


			$(document).on('keydown', '.cell[contenteditable="true"]', function(e) {
				if (e.which == 13) {
					e.preventDefault();

					let cell = $(this);
					let id = cell.data('id');
					let column = cell.data('column');
					let newValue = cell.text().trim();

					console.log("Updating: ", {
						id,
						column,
						newValue
					});


					$.ajax({
						url: '<?php echo base_url('sc_controller/update_table') ?>',
						method: 'POST',
						data: {
							id: id,
							column: column,
							value: newValue
						},
						success: function(response) {
							console.log('Update Success:', response);

						},
						error: function(xhr, status, error) {
							console.error('Update Error:', error)
						}


					});
				}
			});



		})
	</script>
	<script>
		$(document).ready(function() {
			$('#products').click(function() {
				$('#stats-2-value,#stats-3-value,#stats-4-value,#stats-5-value,#stats-6-value,#status,#addCategoryBtn,#addsubCategoryBtn').hide()
				$('#addproCategoryBtn').show();
				$.ajax({
					url: '<?php echo base_url('product/getpro') ?>',
					methord: "GET",
					dataType: 'json',
					success: function(data) {
						console.log(data)
						if (data && data.length > 0) {
							let keys = Object.keys(data[0]);
							let header = `<div class="row header">`

							keys.forEach(function(key) {

								header += `<div class='cell'>${key}</div>`

							})
							header += `<div class="cell">Actions</div>`
							header += `<div class="cell">Actions</div>`
							header += `</div>`

							$('#table-container').html(header)

							data.forEach(function(item) {
								let rowe = `<div class='row'>`

								keys.forEach(function(key) {
									rowe += `<div class='cell wrap-text' contenteditable='true' data-id='${item.pro_id}' data-column='${key}'>${item[key]}</div>`

								})
								rowe += `<div class="cell">
											<button class="delete-btn4 bg-red-500 text-white p-2 mr-2" data-id="${item["pro_id"]}">Delete</button>
											
										</div>`;
										rowe += `<div class="cell">
											<button class="update-btn4 bg-black text-white p-2 mr-2" data-id="${item["pro_id"]}">Edit</button>
											
										</div>`;


										


								$('#table-container').append(rowe)

							})
						}
					},
					error: function(error) {
						console.error('Error fetching data:', error)
					}
				})
				$.ajax({
					url: '<?php echo base_url('product/num_pro') ?>',
					method: 'GET',
					dataType: 'json',
					success: function(data) {
						$('#stats-1-value').html(data)
					}
				})
				$('#status').hide;


			})
			$(document).on('keydown', '.cell[contenteditable="true"]', function(e) {
				if (e.which == 13) {
					e.preventDefault();
					let cell = $(this);
					let id = cell.data('id');
					let column = cell.data('column');
					let newValue = cell.text().trim();

					console.log("Updating: ", {
						id,
						column,
						newValue
					});


					$.ajax({
						url: '<?php echo base_url('product/update_table') ?>',
						method: 'POST',
						data: {
							id: id,
							column: column,
							value: newValue
						},
						success: function(response) {
							console.log('Update Success:', response);

						},
						error: function(xhr, status, error) {
							console.error('Update Error:', error)
						}


					});
				}
			});
			$(document).on('click', '.delete-btn4', function() {
				const id = $(this).data('id');


				console.log(id);
				const row = $(this).closest('.row');

				if (confirm('Are you sure you want to delete this record?')) {
					$.ajax({
						url: '<?php echo base_url('product/pro_del') ?>', // Replace with your actual delete endpoint
						method: 'POST',
						data: {
							id: id
						},
						success: function(response) {
							console.log('Delete Success:', response);
							row.remove(); // Remove the row from DOM
						},
						error: function(error) {
							console.error('Delete Error:', error);
						}
					});
				}
			});

			$(document).on('click', '.update-btn4', function() {
				const id = $(this).data('id');


				console.log(id);
				const row = $(this).closest('.row');

				if (confirm('Are you sure you want to update this record?')) {
					$.ajax({
						url: '<?php echo base_url('product/up_pro') ?>', // Replace with your actual delete endpoint
						method: 'POST',
						data: {
							id: id
						},
						success: function(response) {
							console.log('Delete Success:', response);
							window.location.href="<?php echo base_url('product/up_pro1') ?>"
						},
						error: function(error) {
							console.error('Delete Error:', error);
						}
					});
				}
			});



		})
	</script>

	<script>
		$(document).ready(function() {
			$('#order').click(function() {
				$('#stats-2-value,#stats-3-value,#stats-4-value,#stats-5-value,#stats-6-value,#addCategoryBtn,#addsubCategoryBtn,#addproCategoryBtn').hide()
				$('#status').show()
				$.ajax({
					url: '<?php echo 'http://192.168.1.170/api/order/orget' ?>',
					method: "GET",
					dataType: 'json',
					success: function(data) {
						console.log(data)
						if (data && data.length > 0) {
							let keys = Object.keys(data[0]);
							let header = `<div class="row header">`

							keys.forEach(function(key) {

								header += `<div class='cell'>${key}</div>`

							})
							header += `<div class="cell">Actions</div>`
							header += `</div>`

							$('#table-container').html(header)

							data.forEach(function(item) {
								let rowe = `<div class='row'>`

								keys.forEach(function(key) {
									rowe += `<div class='cell wrap-text' contenteditable='true' data-id='${item.o_id}' data-column='${key}'>${item[key]}</div>`

								})
								rowe += `<div class="cell"><button class="delete-btn6  bg-red-500 text-white p-2" data-id="${item.o_id}">Delete</button></div>`;
								rowe += `</div>`

								$('#table-container').append(rowe)

							})
						}
					},
					error: function(error) {
						console.error('Error fetching data:', error)
					}
				})
				$.ajax({
					url: '<?php echo base_url('order/num_or') ?>',
					method: 'GET',
					dataType: 'json',
					success: function(data) {
						$('#stats-1-value').html(data)
					}
				})


			})
			$(document).on('keydown', '.cell[contenteditable="true"]', function(e) {
				if (e.which == 13) {
					e.preventDefault();

					let cell = $(this);
					let id = cell.data('id');
					let column = cell.data('column');
					let newValue = cell.text().trim();

					console.log("Updating: ", {
						id,
						column,
						newValue
					});


					$.ajax({
						url: '<?php echo base_url('order/update_table'); ?>',
						method: 'POST',
						data: {
							id: id,
							column: column,
							value: newValue
						},
						success: function(response) {
							console.log('Update Success:', response);

						},
						error: function(xhr, status, error) {
							console.error('Update Error:', error)
						}


					});
				}
			});
			$(document).on('click', '.delete-btn6', function() {
				const id = $(this).data('id');
				const row = $(this).closest('.row');

				if (confirm('Are you sure you want to delete this record?')) {
					$.ajax({
						url: '<?php echo base_url('order/order_del') ?>', // Replace with your actual delete endpoint
						method: 'POST',
						data: {
							id: id
						},
						success: function(response) {
							console.log('Delete Success:', response);
							row.remove(); // Remove the row from DOM
						},
						error: function(error) {
							console.error('Delete Error:', error);
						}
					});
				}
			});


		})

		$(document).ready(function() {
			$("#status").submit(function(e) {
				e.preventDefault();

				var formData = $(this).serialize();

				$.ajax({
					url: "<?php echo base_url('order/update'); ?>",
					type: "POST",
					data: formData,
					dataType: "json",
					success: function(response) {
						if (response.success) {
							alert("Order status updated successfully!");
						} else {
							alert("Failed to update order status.");
						}
					},
					error: function() {
						alert("Error in AJAX request.");
					}
				});
			});
		});
	</script>
	<script>
		$(document).ready(function() {

			$("#Order_items").click(function() {
				$('#stats-2-value,#stats-3-value,#stats-4-value,#stats-5-value,#stats-6-value,#status,#addCategoryBtn,#addsubCategoryBtn,#addproCategoryBtn').hide()
				$.ajax({
					url: '<?php echo base_url('order/get_order_item') ?>', // Ensure this URL is correct
					method: 'GET',
					dataType: 'json', // Explicitly specify JSON data type
					success: function(data) {
						console.log('Data received:', data); // Debug: Log the data

						if (data && data.length > 0) {
							let keys = Object.keys(data[0]); // Extract column headers

							// Generate header row
							let headerRow = `<div class="row header">`;
							keys.forEach(function(key) {
								headerRow += `<div class="cell">${key}</div>`;

							});
							headerRow += `<div class="cell">Actions</div>`
							headerRow += `</div>`;



							// Clear previous content and append new header
							$('#table-container').html(headerRow);

							// Generate table rows

							data.forEach(function(item) {
								let rowHtml = `<div class="row" data-id="${item.id}">`;

								keys.forEach(function(key) {
									rowHtml += `<div class="cell wrap-text" contenteditable="true" data-id="${item.id}" data-column="${key}">${item[key]}</div>`;
								});

								// Add delete button
								rowHtml += `<div class="cell"><button class="delete-btn5  bg-red-500 text-white p-2" data-id="${item.order_itme_id}">Delete</button></div>`;

								rowHtml += `</div>`;
								$('#table-container').append(rowHtml);
							});

						} else {
							console.log('No data available.'); // Debug: Log if no data is available
							$('#table-container').html('<div class="row">No data available.</div>');
						}
					},
					error: function(xhr, status, error) {
						console.error('Error fetching data:', error); // Debug: Log the error
						console.log('Status:', status); // Debug: Log the status
						console.log('Response:', xhr.responseText); // Debug: Log the response
						$('#table-container').html('<div class="row">Error loading data.</div>');
					}
				});

				$(document).on('click', '.delete-btn5', function() {
					const id = $(this).data('id');
					const row = $(this).closest('.row');

					if (confirm('Are you sure you want to delete this record?')) {
						$.ajax({
							url: '<?php echo base_url('order/order_del2') ?>', // Replace with your actual delete endpoint
							method: 'POST',
							data: {
								id: id
							},
							success: function(response) {
								console.log('Delete Success:', response);
								row.remove(); // Remove the row from DOM
							},
							error: function(error) {
								console.error('Delete Error:', error);
							}
						});
					}
				});


				$.ajax({
					url: '<?php echo base_url('api/num_rows') ?>',
					method: 'GET',
					dataType: 'json',
					success: function(data) {
						console.log(data)


						$('#stats-1-value').html(data);
					}

				})
			});

			$(document).on('keydown', '.cell[contenteditable=true]', function(e) {
				if (e.which == 13) {
					let cell = $(this)
					let id = cell.data('id')
					let column = cell.data('column')
					let value = cell.text().trim();

					$.ajax({
						url: '<?php echo base_url('order/update_items') ?>',
						method: 'POST',
						data: {
							id: id,
							column: column,
							value: value
						},
						success: function(response) {
							console.log('Update Success:', response);
						},
						error: function(error) {
							console.error('Error fetching data:', error);
						}
					})
				}
			})
		});
	</script>
	<script>
		$(document).ready(function() {

			$("#payment").click(function() {
				$('#stats-2-value,#stats-3-value,#stats-4-value,#stats-5-value,#stats-6-value,#status,#addCategoryBtn,#addsubCategoryBtn,#addproCategoryBtn').hide()
				$.ajax({
					url: '<?php echo base_url('payment/get_pays') ?>', // Ensure this URL is correct
					method: 'GET',
					dataType: 'json', // Explicitly specify JSON data type
					success: function(data) {
						console.log('Data received:', data); // Debug: Log the data

						if (data && data.length > 0) {
							let keys = Object.keys(data[0]); // Extract column headers

							// Generate header row
							let headerRow = `<div class="row header">`;
							keys.forEach(function(key) {
								headerRow += `<div class="cell">${key}</div>`;

							});
							headerRow += `<div class="cell">Actions</div>`
							headerRow += `</div>`;



							// Clear previous content and append new header
							$('#table-container').html(headerRow);

							// Generate table rows

							data.forEach(function(item) {
								let rowHtml = `<div class="row" data-id="${item.pay_id}">`;

								keys.forEach(function(key) {
									rowHtml += `<div class="cell wrap-text" contenteditable="true" data-id="${item.pay_id}" data-column="${key}">${item[key]}</div>`;
								});

								// Add delete button
								rowHtml += `<div class="cell"><button class="delete-btn7  bg-red-500 text-white p-2" data-id="${item.pay_id}">Delete</button></div>`;

								rowHtml += `</div>`;
								$('#table-container').append(rowHtml);
							});

						} else {
							console.log('No data available.'); // Debug: Log if no data is available
							$('#table-container').html('<div class="row">No data available.</div>');
						}
					},
					error: function(xhr, status, error) {
						console.error('Error fetching data:', error); // Debug: Log the error
						console.log('Status:', status); // Debug: Log the status
						console.log('Response:', xhr.responseText); // Debug: Log the response
						$('#table-container').html('<div class="row">Error loading data.</div>');
					}
				});

				$(document).on('click', '.delete-btn7', function() {
					const id = $(this).data('id');
					const row = $(this).closest('.row');

					if (confirm('Are you sure you want to delete this record?')) {
						$.ajax({
							url: '<?php echo base_url('payment/pay_del') ?>', // Replace with your actual delete endpoint
							method: 'POST',
							data: {
								id: id
							},
							success: function(response) {
								console.log('Delete Success:', response);
								row.remove(); // Remove the row from DOM
							},
							error: function(error) {
								console.error('Delete Error:', error);
							}
						});
					}
				});


				$.ajax({
					url: '<?php echo base_url('api/num_rows') ?>',
					method: 'GET',
					dataType: 'json',
					success: function(data) {
						console.log(data)


						$('#stats-1-value').html(data);
					}

				})
			});

			$(document).on('keydown', '.cell[contenteditable=true]', function(e) {
				if (e.which == 13) {
					let cell = $(this)
					let id = cell.data('id')
					let column = cell.data('column')
					let value = cell.text().trim();

					$.ajax({
						url: '<?php echo base_url('order/update_items') ?>',
						method: 'POST',
						data: {
							id: id,
							column: column,
							value: value
						},
						success: function(response) {
							console.log('Update Success:', response);
						},
						error: function(error) {
							console.error('Error fetching data:', error);
						}
					})
				}
			})
		});
	</script>


<script>
		$(document).ready(function() {

			$("#ratting").click(function() {
				$('#stats-1-value,#stats-2-value,#stats-3-value,#stats-4-value,#stats-5-value,#stats-6-value,#status,#addCategoryBtn,#addsubCategoryBtn,#addproCategoryBtn').hide()
				$.ajax({
					url: '<?php echo base_url('rating/rat_get') ?>', // Ensure this URL is correct
					method: 'GET',
					dataType: 'json', // Explicitly specify JSON data type
					success: function(data) {
						console.log('Data received:', data); // Debug: Log the data

						if (data && data.length > 0) {
							let keys = Object.keys(data[0]); // Extract column headers

							// Generate header row
							let headerRow = `<div class="row header">`;
							keys.forEach(function(key) {
								headerRow += `<div class="cell">${key}</div>`;

							});
							
							headerRow += `</div>`;



							// Clear previous content and append new header
							$('#table-container').html(headerRow);

							// Generate table rows

							data.forEach(function(item) {
								let rowHtml = `<div class="row" data-id="${item.r_id}">`;

								keys.forEach(function(key) {
									rowHtml += `<div class="cell wrap-text" contenteditable="true" data-id="${item.r_id}" data-column="${key}">${item[key]}</div>`;
								});

								// Add delete button
							

								rowHtml += `</div>`;
								$('#table-container').append(rowHtml);
							});

						} else {
							console.log('No data available.'); // Debug: Log if no data is available
							$('#table-container').html('<div class="row">No data available.</div>');
						}
					},
					error: function(xhr, status, error) {
						console.error('Error fetching data:', error); // Debug: Log the error
						console.log('Status:', status); // Debug: Log the status
						console.log('Response:', xhr.responseText); // Debug: Log the response
						$('#table-container').html('<div class="row">Error loading data.</div>');
					}
				});

				$(document).on('click', '.delete-btn8', function() {
					const id = $(this).data('id');
					const row = $(this).closest('.row');

					if (confirm('Are you sure you want to delete this record?')) {
						$.ajax({
							url: '<?php echo base_url('payment/pay_del') ?>', // Replace with your actual delete endpoint
							method: 'POST',
							data: {
								id: id
							},
							success: function(response) {
								console.log('Delete Success:', response);
								row.remove(); // Remove the row from DOM
							},
							error: function(error) {
								console.error('Delete Error:', error);
							}
						});
					}
				});


				$.ajax({
					url: '<?php echo base_url('api/num_rows') ?>',
					method: 'GET',
					dataType: 'json',
					success: function(data) {
						console.log(data)


						$('#stats-1-value').html(data);
					}

				})
			});

			$(document).on('keydown', '.cell[contenteditable=true]', function(e) {
				if (e.which == 13) {
					let cell = $(this)
					let id = cell.data('id')
					let column = cell.data('column')
					let value = cell.text().trim();

					$.ajax({
						url: '<?php echo base_url('payment/update_table') ?>',
						method: 'POST',
						data: {
							id: id,
							column: column,
							value: value
						},
						success: function(response) {
							console.log('Update Success:', response);
						},
						error: function(error) {
							console.error('Error fetching data:', error);
						}
					})
				}
			})
		});
	</script>


	</body>

</html>
