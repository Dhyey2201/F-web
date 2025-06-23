<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Flipkart Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">



    
    <!-- Navbar -->

	<header class="flex justify-between items-center px-8 py-4 shadow-sm">
		<div class="container mx-auto px-6 flex items-center justify-between">

			<span class=" fweb font-bold text-2xl text-black ">F-WEB</span>
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
				<span href="#" class="text-black font-medium">Hello, <?php echo $user->username ?></span>
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
    <!-- Main Container -->
    
        
        <!-- Orders List -->
       

		
			
		<div class="flex flex-wrap justify-center gap-6 mt-4 mb-4 ">
		<?php 
	
$base_url = base_url('image/multi/'); // Image base URL
$count = min(count($pro_data), count($or)); // Ensure matching indexes
?>

<?php for ($i = 0; $i < $count; $i++): ?>
  <?php $productGroup = $pro_data[$i]; ?>
  <?php foreach ($productGroup as $pro): ?>
    <?php 
      // Get image URL and order item ID
      $imageUrl = htmlspecialchars($base_url . $pro['pro_image']);
      $orderItemId = htmlspecialchars($or[$i]['order_itme_id']);
      $productName = htmlspecialchars($pro['pro_name']);
      $productPrice = htmlspecialchars($pro['pro_price']);
    ?>
    
    <div class="con w-full sm:w-1/2 md:w-5/12 lg:w-1/3 bg-white p-4 rounded-lg border border-gray-300 shadow-sm flex items-center gap-4 mt-2" data-id="<?= $orderItemId; ?>">
      <img src="<?= $imageUrl; ?>" alt="<?= $productName; ?>" class="rounded w-20 h-20 object-cover">
      
      <div class="flex-1">
        <h3 class="font-bold text-black text-lg"><?= $productName; ?></h3>
        <p class="text-gray-600 mt-1">₹<?= $productPrice; ?></p>
        <p class="text-gray-500 mt-1">✔ Delivered on</p>
        <button class="mt-2 text-blue-600 font-semibold hover:underline">Rate & Review Product</button>
      </div>
    </div>

    <?php break; // Only show the first product per group ?>
  <?php endforeach; ?>
<?php endfor; ?>

</div>





			<script>
			$(document).ready(function () {
				// Product click event
				// $(document).on("click", ".con", function () {
				// 	var pro_id = $(this).data("id");
				// 	console.log(pro_id);
				// 	window.location.href = "<?php echo base_url('US/'); ?>" + pro_id;
				// });

				$(document).on("click", ".con", function () {
					var pro_id = $(this).data("id");
					console.log(pro_id);
					window.location.href = "<?php echo base_url('order/order_details/'); ?>"+ pro_id;
				});
				
			});

			</script>


			

</body>
</html>
