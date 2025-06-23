<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order Details - Flipkart Clone</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">


	    <!-- Navbar -->

		<header class="flex justify-between items-center px-8 py-4 shadow-sm">
		<div class="container mx-auto px-6 flex items-center justify-between">

			<a href="#" class="fweb font-bold text-2xl text-black ">F-WEB</a>
			<script>
		$(document).on('click', '.fweb', function() {
			const productId = $(this).data('id');
			window.location.href = `<?php echo base_url('pro_get'); ?>`;
		});
	</script>


			<nav class="hidden md:flex space-x-6 text-black">
				<a href="#" data-id="22" class="filter-btn text-black hover:text-yellow-300 transition duration-300">WOMEN</a>
				<a href="#" data-id="21" class="filter-btn text-black hover:text-yellow-300 transition duration-300">MEN</a>
				<a href="#" data-id="23" class="filter-btn text-black hover:text-yellow-300 transition duration-300">TEENAGER</a>
				<a href="#" data-id="24" class="filter-btn text-black hover:text-yellow-300 transition duration-300">KIDS</a>
				<a href="#" data-id="25" class="filter-btn text-black hover:text-yellow-300 transition duration-300">BABY</a>
			</nav>
			<script>
				$(document).ready(function() {
					$(document).on('click', '.filter-btn', function() {
						var co_id = $(this).data('id');
						$.ajax({
							url: "<?php echo base_url('product/post_data1'); ?>",
							type: 'POST',
							data: {
								co_id: co_id,
							},
							success: function(data) {

								console.log(data);
								window.location.href = '<?php echo base_url('product/catproducts'); ?>';
							}
						});

					});
				});
			</script>



			<div class="flex items-center space-x-6">
				<div class="relative hidden md:block">
					<input

						id="search"
						type="text"
						placeholder="Search..."
						class="w-[400px] mt-[10px] p-2 pr-12 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300 bg-white text-black" />

					<!-- Search icon -->
					<i class="fas fa-search absolute right-3 top-[29px] -translate-y-1/2 text-black pointer-events-none"></i>

					<!-- Suggestions dropdown -->
					<div id="suggestions" class="absolute w-full bg-white border rounded-lg mt-1 shadow-lg z-10 hidden"></div>

					<!-- Selected product message -->
					<p id="selectedProduct" class="mt-2 text-gray-600"></p>
				</div>
			</div>


			<div class="flex items-center space-x-2">
				<span href="#" class="text-black font-medium">Hello, <?php echo $userget->username ?></span>
				<a href="#" class="text-black text-2xl" id="profile-icon">
					<i class="fas fa-user-circle"></i>
				</a>
			</div>
			<div class="md:hidden cursor-pointer text-black text-2xl" id="mobile-menu-btn">
				<i class="fas fa-bars"></i>
			</div>
		</div>
		</div>
	</header>
	<script>
		$(document).on('click', '#profile-icon', function() {
			window.location.href = `<?php echo base_url("api/userget") ?>`
		})
	</script>
	<script>
		$(document).ready(function() {
			$('#search').keyup(function() {
				let searchQuery = $(this).val().trim();

				if (searchQuery !== '') {
					$.ajax({
						url: '<?php echo base_url("product/search") ?>',
						method: 'POST',
						data: {
							data: searchQuery
						},
						dataType: 'json',
						success: function(response) {
							let output = '';

							if (response.length > 0) {
								$.each(response, function(index, product) {
									output += `<div class="suggestion-item p-2 hover:bg-gray-200 cursor-pointer" data-id="${product.pro_id}">${product.pro_name}</div>`;
								});
							} else {
								output = '<div class="p-2 text-gray-500">No products found</div>';
							}

							$('#suggestions').html(output).show();
						}
					});
				} else {
					$('#suggestions').html('').hide();
				}
			});

			$(document).on('click', '.suggestion-item', function() {
				const productId = $(this).data('id');
				window.location.href = `<?php echo base_url("product/Usershow/") ?>${productId}`;
			});


			$(document).click(function(event) {
				if (!$(event.target).closest('#search, #suggestions').length) {
					$('#suggestions').hide();
				}
			});
		});
	</script>

	<div class="hidden bg-blue-600 text-white p-4" id="mobile-menu">
		<a href="#" data-id="22" class="filter-btn text-black hover:text-yellow-300 transition duration-300 p-3">WOMEN</a>
		<a href="#" data-id="23" class="filter-btn text-black hover:text-yellow-300 transition duration-300 p-3">MEN</a>
		<a href="#" data-id="24" class="filter-btn text-black hover:text-yellow-300 transition duration-300 p-3">TEENAGER</a>
		<a href="#" data-id="25" class="filter-btn text-black hover:text-yellow-300 transition duration-300 p-3">KIDS</a>
		<a href="#" data-id="26" class="filter-btn text-black hover:text-yellow-300 transition duration-300 p-3">BABY</a>
	</div>


	<script>
		$(document).ready(function() {
			$("#mobile-menu-btn").on("click", function() {
				$("#mobile-menu").toggleClass("hidden");
			});
		});
	</script>	

	<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md mt-6">

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
			<div class="col-span-1 md:col-span-2">
				<?php foreach ($order as $or): ?>
					<div class="w-full">
						<div class="bg-white p-4 rounded-lg shadow mb-4 w-full">
							<h3 class="font-semibold">Shipping details</h3>
							<p class="text-gray-700 mt-2">
							<strong>Shipping address : </strong><strong><?php echo htmlspecialchars($userget->username); ?></strong><br>
								<strong>Shipping address : </strong><?= htmlspecialchars($or['shipping_address']); ?><br>
								<strong>Phone : </strong><?php echo htmlspecialchars($userget->contect_number); ?>
							</p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="col-span-1 md:col-span-1">
				<?php foreach ($order as $or): ?>
					<div class="w-full">
						<div class="bg-white p-4 rounded-lg shadow mb-4">
							<h3 class="font-semibold">Order Summary</h3>
							<p class="text-gray-700 mt-2">
								<strong>Total Price:</strong> <?= htmlspecialchars($or['total_price']); ?><br>
								<strong>Phone:</strong> <?php echo htmlspecialchars($userget->contect_number); ?>
							</p>
							<br><br>
							
						</div>
					</div>
					
					<?php break; ?>
				<?php endforeach; ?>
			</div>
		</div>



<?php
    if (is_array($status_info) && count($status_info) == 1) {
        $status_info = explode(',', $status_info[0]); // Split the single string into an array
    }
    $statuses = ['Order_Confirmed', 'Shipped', 'Out_For_Delivery', 'Delivered'];
    ?>
   <div class="relative mb-12">
    <div class="max-w-6xl mx-auto mt-6 flex flex-col md:flex-row md:items-start relative">
        <!-- Top small dot -->

        <?php foreach ($statuses as $status) : ?>
            <div class="relative flex flex-col items-center md:flex-1 border-l-4 md:border-l-0 md:border-t-4 border-green-500 pt-4 px-4 w-full">
                <div class="absolute w-8 h-8 rounded-full 
                    <?php echo in_array($status, $status_info) ? 'bg-green-500' : 'bg-gray-300'; ?> 
                    -top-8 lg:left-1/2 -left-1 mt-4 transform -translate-x-1/2 lg:mt-4 ">
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center md:text-left"><?php echo $status; ?></h3>
                <p class="text-sm text-gray-600 text-center md:text-left">Date Here</p>
                <p class="text-sm text-gray-500 text-center md:text-left">Description Here</p>
                <p class="text-xs text-gray-400 text-center md:text-left">Time Here</p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Show Invoice Button -->
    <div class="flex flex-col sm:flex-row gap-3 mt-6 mb-8 w-full justify-center items-center px-4">
        <a
            href="<?= base_url('order/invoice') ?>"
            target="_blank"
            class="inline-flex items-center px-5 py-2.5 bg-black text-white justify-center lg:w-full sm:w-auto text-sm font-medium rounded-lg hover:bg-green-500 transition">
            Show Invoice
        </a>
    </div>
</div>







		<div class="overflow-x-auto">



			<?php foreach ($pro_data as $p): ?>
				<?php foreach ($p as $pro):
						$base_url = base_url('image/multi/'); ?>
					<div class="con bg-white mt-4 p-4 rounded-lg shadow flex items-center gap-4"
						data-id="<?= htmlspecialchars($pro['pro_id']); ?>" id="product-<?= htmlspecialchars($pro['pro_id']); ?>">

						<img src="<?= htmlspecialchars($base_url.$pro['pro_image']); ?>" class="con1 rounded w-40 h-40 object-cover" data-id="<?= htmlspecialchars($pro['pro_id']); ?>">

						<div class="flex-1">
							<h3 class="font-semibold"><?= htmlspecialchars($pro['pro_name']); ?></h3>
							<p class="text-gray-500">₹<?= htmlspecialchars($pro['pro_price']); ?></p>
							<p class="text-green-600 font-medium">✔ Delivered on
								<?php foreach ($order as $or) {
									echo  date("d-m-Y", strtotime($or['delivery_time']));;
								} ?>
							</p>

							<button class="text-blue-600 font-medium">Rate & Review Product</button>

							<!-- Rating Stars -->
							<div class="rating mt-2" id="rating-<?= htmlspecialchars($pro['pro_id']); ?>">
                            <span class="star cursor-pointer text-xl" data-rating="1">&#9733;</span>
                            <span class="star cursor-pointer text-xl" data-rating="2">&#9733;</span>
                            <span class="star cursor-pointer text-xl" data-rating="3">&#9733;</span>
                            <span class="star cursor-pointer text-xl" data-rating="4">&#9733;</span>
                            <span class="star cursor-pointer text-xl" data-rating="5">&#9733;</span>
                        </div>
							<!-- Comment Field -->
							<textarea
								class="comment-box mt-3 p-2 border border-gray-300 rounded w-full"
								placeholder="Write a review..."
								data-id="<?= htmlspecialchars($pro['pro_id']); ?>"
								rows="3"></textarea>
						</div>
					</div>
				<?php endforeach; ?>
				<br>
			<?php endforeach; ?>






		</div>

	</div>
	<script>
		$(document).ready(function() {

			$(document).on("click", ".con1", function() {
				var pro_id = $(this).data("id");
				console.log(pro_id);
				window.location.href = "<?php echo base_url('US/'); ?>" + pro_id;
			});


		});
	</script>




	<div id="rating-stars">
		<input type="hidden" id="user_id" value="<?php echo $userget->id ?>">



	</div>


	<style>
		.star {
			font-size: 30px;
			color: gray;
			cursor: pointer;
		}

		.star.selected {
			color: gold;
		}
	</style>
	



	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		$(document).ready(function() {
			$('.star').on('click', function() {
				var rating = $(this).data('rating');
				var productId = $(this).closest('.con').data('id');
				let user_id = <?php echo $userget->id ?>;
				let comment = $('.comment-box[data-id="' + productId + '"]').val();
				console.log(comment);

				// Highlight the selected stars
				updateStars(productId, rating);

				// AJAX call to server
				$.ajax({
					url: '<?= base_url("rating/r_insert") ?>', // CI3 controller/method
					type: 'POST',
					data: {
						pro_id: productId,
						rating: rating,
						user_id: user_id,
						comment: comment,
					},
					success: function(response) {
						console.log('Rating saved:', response);
						// Optionally show a message or feedback to user
					},
					error: function(xhr, status, error) {
						console.error('AJAX Error:', error);
					}
				});
			});

			function updateStars(productId, rating) {
				$('#rating-' + productId + ' .star').each(function() {
					var starRating = $(this).data('rating');
					if (starRating <= rating) {
						$(this).css('color', 'gold');
					} else {
						$(this).css('color', '');
					}
				});
			}
		});
	</script>


</body>

</html>
