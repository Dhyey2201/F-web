<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product Grid with Footer</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

		
	
<header class="flex justify-between items-center px-8 py-4 shadow-sm">
	<div class="container mx-auto px-6 flex items-center justify-between">
		<!-- Logo -->
		<a href="#" class="fweb font-bold text-2xl text-black">F-WEB</a>

		<script>
			$(document).on('click', '.fweb', function () {
				window.location.href = `<?php echo base_url('pro_get'); ?>`;
			});
		</script>

		<!-- Navigation Links -->
		<nav class="hidden md:flex space-x-6 text-black">
			<a href="#" data-id="22" class="filter-btn hover:text-yellow-300 transition duration-300">WOMEN</a>
			<a href="#" data-id="21" class="filter-btn hover:text-yellow-300 transition duration-300">MEN</a>
			<a href="#" data-id="23" class="filter-btn hover:text-yellow-300 transition duration-300">TEENAGER</a>
			<a href="#" data-id="24" class="filter-btn hover:text-yellow-300 transition duration-300">KIDS</a>
			<a href="#" data-id="25" class="filter-btn hover:text-yellow-300 transition duration-300">BABY</a>
		</nav>

		<script>
			$(document).ready(function () {
				$(document).on('click', '.filter-btn', function () {
					var co_id = $(this).data('id');
					$.ajax({
						url: "<?php echo base_url('product/post_data1'); ?>",
						type: 'POST',
						data: { co_id: co_id },
						success: function (data) {
							console.log(data);
							window.location.href = '<?php echo base_url('product/catproducts1'); ?>';
						}
					});
				});
			});
		</script>

		<!-- Right side (Search + Login) -->
		<div class="flex items-center space-x-6">
			<!-- Search Bar -->
			<div class="relative hidden md:block">
				<input
					id="search"
					type="text"
					placeholder="Search..."
					class="w-[400px] mt-[10px] p-2 pr-12 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300 bg-white text-black" />
				<i class="fas fa-search absolute right-3 top-[29px] -translate-y-1/2 text-black pointer-events-none"></i>
				<div id="suggestions" class="absolute w-full bg-white border rounded-lg mt-1 shadow-lg z-10 hidden"></div>
				<p id="selectedProduct" class="mt-2 text-gray-600"></p>
			</div>

			<!-- Login Button -->
			
		</div>
		<a href="signin" class="text-white px-4 py-2 rounded-2xl bg-black text-lg font-semibold hover:text-yellow-300 transition duration-300">
				Login
			</a>

		<!-- Mobile Menu Icon -->
		<div class="md:hidden cursor-pointer text-black text-2xl" id="mobile-menu-btn">
			<i class="fas fa-bars"></i>
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
				window.location.href = `<?php echo base_url("product/beforUsershow/") ?>${productId}`;
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

	<!-- Main Content -->
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-6 py-6">
		<!-- Sorting Section -->
		<div class="flex justify-end mb-6">
			<label class="mr-2 mt-2 font-semibold text-gray-700">Sort by:</label>
			<select id="sortopation" class="border rounded px-2 py-2 mr-2 bg-white text-gray-700">
				<option value="recommended">Recommended</option>
				<option value="low_to_high">Price: Low to High</option>
				<option value="high_to_low">Price: High to Low</option>
				<option value="customer_ratings">Customer Ratings</option>
			</select>
		</div>

		<script>
			$('#sortopation').on('change', function() {
				var sort = $(this).val();
				$.ajax({
					url: '<?php echo base_url('product/sort_data'); ?>',
					type: "POST",
					data: {
						sort: sort
					},
					success: function(response) {
						$(".grid").html(response);
					}
				});
				$('.grid').on('click', '.con', function() {
					let pid = $(this).data('id');
					console.log(pid);
					window.location.href = '<?php echo base_url('product/beforUsershow/'); ?>' + pid;
				});

			});
		</script>


<div class="w-full mt-10 shadow-lg rounded-2xl overflow-hidden  hover:scale-105">
    <img
        src="./image/banner/image (7).png"
        alt="Hero Woman"
        class="w-full h-full object-cover transition-transform duration-300 rounded-2xl  hover:scale-105" />
</div>
<div class="w-full py-12 ">

    <!-- Grid Layout -->
    <div class="">

        <!-- Hero Card (Big Left Section) -->
        <div class="lg:col-span-2 bg-[#e5effc] rounded-2xl pl-6 text-white flex flex-col lg:flex-row shadow-lg justify-between hover:scale-[1.02] transition duration-300">
            <!-- Text Section -->
            <div class="w-full md:w-1/2 max-w-xl py-8 mt-20">
                <h2 class="text-sm uppercase tracking-wide mt-[20px] text-gray-700">
                    Up to <span class="text-purple-600 font-bold">70% Off</span>
                </h2>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mt-2 leading-tight">
                    Fashion Collection <br /> Summer Sale
                </h1>
                <button class="mt-6 bg-black hover:bg-[#4A6676] text-white px-6 py-3 rounded-lg font-semibold transition">
                    Shop Now
                </button>
            </div>
            <!-- Image Section -->
            <div class="w-full md:w-[500px] h-full ">
                <img
                    src="./image/banner/image-(4).png"
                    alt="Hero Woman"
                    class="w-full h-full object-cover rounded-r-2xl" />
            </div>
			
        </div>
		

        <!-- Cart Button -->
        <div id="cartdata" class="fixed bottom-6 right-6 z-50">
            <button class="relative bg-black text-white p-3 rounded-full shadow-lg hover:scale-110 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 5.6A1 1 0 007 20h10a1 1 0 001-.8l1-4.2M7 13l1.5-6m0 0L8 5h8l-1.5 2H9.5z" />
                </svg>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full"></span>
            </button>
        </div>

        <!-- <script>
            // Navigate to cart page
            document.getElementById('cartdata').addEventListener('click', function() {
                window.location.href = '<?php echo base_url('us2') ?>';
            })
        </script> -->
		

        <!-- Content Section with Wishlist & Cart Items -->
        <!-- <div class="flex flex-col gap-6">
           
            <div id="wishlist-content" class="flex overflow-x-auto space-x-4 ml-2 justify-center text-lg scrollbar-thin scrollbar-thumb-white scrollbar-track-transparent">
                
                <div class="min-w-[200px] sm:min-w-[150px] md:min-w-[200px] bg-white text-gray-800 rounded-xl flex-shrink-0 hover:scale-105 transition">
                    <img src="https://via.placeholder.com/200x150" alt="Wishlist Item" class="rounded-md w-full h-36 object-cover mb-2">
                    <h3 class="font-semibold text-base mb-1">Product Name</h3>
                    <p class="text-sm">Short Description</p>
                </div>
            </div>

        
            <div id="wishlist-content1" class="flex overflow-x-auto space-x-4 ml-2 justify-center text-lg scrollbar-thin scrollbar-thumb-white scrollbar-track-transparent">
              
                <div class="min-w-[300px] sm:min-w-[200px] md:min-w-[300px] bg-white text-gray-800 rounded-xl flex-shrink-0 hover:scale-105 transition">
                    <img src="https://via.placeholder.com/200x150" alt="Cart Item" class="rounded-md w-full h-36 object-cover mb-2">
                    <h3 class="font-semibold text-base mb-1">Product Name</h3>
                    <p class="text-sm">Short Description</p>
                </div>
            </div>
        </div> -->

    </div>
</div>



		<!-- <script>
			$(document).ready(function() {
				$("#mobile-menu-btn").on("click", function() {
					$("#mobile-menu").toggleClass("hidden");
				});


				let wishlistData = <?php echo json_encode($prodata); ?>;
				let currentIndex = 0;

				function showWishlistItem() {
					if (wishlistData.length > 0) {
						let item = wishlistData[currentIndex];
						let wishlistHtml = `
						<div class="relative w-[350px] h-[270px] rounded-lg overflow-hidden shadow-md flex items-end justify-center bg-cover bg-center" style="background-image: url('${item.pro_image || item.image}')">
							<div class="bg-black bg-opacity-60 w-full text-center py-2">
							<span class="text-white font-semibold text-sm">${item.pro_name}</span>
							<div class="mt-1">
								<span class="text-gray-300 line-through text-xs">Rs.2999</span>
								<span class="text-white font-bold text-sm ml-2">Rs. ${item.pro_price || item.price}</span>
							</div>
							</div>
						</div>
						`;

						$("#wishlist-content").html(wishlistHtml);


						$("#wishlist-slider").on("click", function() {
							window.location.href = `<?php echo base_url('US/'); ?>${item.pro_id}`;
						});


						currentIndex = (currentIndex + 1) % wishlistData.length;
					}
				}

				showWishlistItem();
				setInterval(showWishlistItem, 5000);
			});
		</script> -->
		<!-- <script>
			$(document).ready(function() {
				$("#mobile-menu-btn").on("click", function() {
					$("#mobile-menu").toggleClass("hidden");
				});


				let wishlistData = <?php echo json_encode($cart); ?>;
				let currentIndex = 0;

				function showWishlistItem() {
					if (wishlistData.length > 0) {
						let item = wishlistData[currentIndex];
						let wishlistHtml = `
  <div class="relative w-[350px] h-[270px] rounded-lg overflow-hidden shadow-md flex items-end justify-center bg-cover bg-center" style="background-image: url('${item.pro_image || item.image}')">
    <div class="bg-black bg-opacity-60 w-full text-center py-2">
	<span class="text-white font-semibold text-sm"><?php echo 'cart'; ?></span>
      <span class="text-white font-semibold text-sm">${item.pro_name}</span>
      <div class="mt-1">
        <span class="text-gray-300 line-through text-xs">Rs.2999</span>
        <span class="text-white font-bold text-sm ml-2">Rs. ${item.pro_price || item.price}</span>
      </div>
    </div>
  </div>
`;
						$("#wishlist-content1").html(wishlistHtml);


						$("#wishlist-slider").on("click", function() {
							window.location.href = `<?php echo base_url('US/'); ?>${item.pro_id}`;
						});


						currentIndex = (currentIndex + 1) % wishlistData.length;
					}
				}

				showWishlistItem();
				setInterval(showWishlistItem, 5000);
			});


			$("#wishlist-content1").on("click", function() {
				window.location.href = `<?php echo base_url('product/wishlist'); ?>`;
			});
		</script> -->

		<div class="flex items-center justify-between mb-4">
			<h2 class="text-3xl font-bold">Popular Categories</h2>
			<a href="#" class="text-green-500 font-medium hover:underline">View All →</a>
		</div>


		<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
			<?php foreach ($sc as $item): ?>
				<div class="scategory flex flex-col items-center  p-4 border rounded-lg hover:shadow-md transition" data-id="<?= $item['sc_id']; ?>">

					<img src="<?= $item['sc_image']; ?>" alt="<?= $item['sc_name']; ?>" class="object-contain w-20 h-20" />

					<p class="mt-2 text-sm font-medium text-gray-800 text-center">
						<?= htmlspecialchars($item['sc_name']); ?>
					</p>
				</div>
			<?php endforeach; ?>
		</div>

		<script>
			$(document).ready(function() {
				$('.scategory').click(function() {
					let sc_id = $(this).data('id');
					window.location.href = "<?php echo base_url('sc_controller/scget/'); ?>" + sc_id;

				});
			});
		</script>


<div class="w-full md:w-[100%] rounded-xl shadow mx-auto p-4 mt-10">
    <h2 class="text-xl font-bold mb-4">70% Off Products</h2>
    <div
        id="70"
        class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4"
        data-id="70">
        <?php foreach ($dis as $product): ?>
            <div class=" product-card1 flex flex-col items-center p-4 border rounded-lg hover:shadow-md transition " data-id="<?= $product['pro_id']?>">
                <img
                    src="<?= html_escape($product['pro_image']) ?>"
                    alt="<?= html_escape($product['pro_name']) ?>"
                    class="w-full h-64 object-contain rounded-lg transition-transform duration-300 hover:scale-110">
                <h3 class="font-semibold mt-2"><?= html_escape($product['pro_name']) ?></h3>
                <p class="text-sm text-center text-gray-600 w-full truncate">
                    <?= html_escape($product['pro_discription']) ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>



		<script>
			$(document).ready(function() {
				$('#70').on('click', function() {
					let dis = $(this).data('id');
					$.ajax({
						url: "<?php echo base_url("product/discount") ?>",
						type: "POST",
						data: {
							dis: dis
						},
						success: function(response) {
							console.log(response);
						}
					})
				})
			})

			$(document).on('click', '.product-card1', function() {
				const productId = $(this).data('id');
				window.location.href = `<?php echo base_url('beUS/'); ?>` + productId;
			});
		</script>



<div class="w-full mt-10 shadow-md overflow-hidden">
    <img
        src="./image/banner/top_pcl_1500x460._CB542287683_.png"
        alt="Hero Woman"
        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
</div>


			
		<?php
		$displayProducts = array_slice($dis1, 0, 4); // Get only the first 4 products
		?>

<div class="w-full rounded-xl shadow-md mx-auto p-4 mt-10">
    <h2 class="text-xl font-bold mb-4">50% Off Products</h2>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <?php foreach ($displayProducts as $product): ?>
            <div class=" product-card2 flex flex-col items-center p-4 border rounded-lg hover:shadow-md transition " data-id="<?= $product['pro_id']?>">
                <img
                    src="<?= html_escape($product['pro_image']) ?>"
                    alt="<?= html_escape($product['pro_name']) ?>"
                    class="w-full h-64 object-contain rounded-lg transition-transform duration-300 hover:scale-110">
                <h3 class="font-semibold mt-2"><?= html_escape($product['pro_name']) ?></h3>
                <p class="text-sm text-center text-gray-600 w-full truncate">
                    <?= html_escape($product['pro_discription']) ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
	$(document).on('click', '.product-card2', function() {
				const productId = $(this).data('id');
				window.location.href = `<?php echo base_url('beUS/'); ?>` + productId;
			});
</script>






<h2 class="mt-9 mb-9 text-3xl font-bold">Popular Products</h2>
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 text-center gap-6">

    <?php foreach ($prodata as $item): ?>

        <div class="con border rounded-xl p-4 relative hover:shadow-lg transition"
            data-id="<?php echo $item['pro_id']; ?>">

            <div class="relative overflow-hidden rounded-lg">
                <img src="<?php echo $item['pro_image']; ?>" alt="Product Image"
                    class="w-full h-64 object-contain rounded-lg transition-transform duration-300 hover:scale-110">
            </div>

            <h3 class="text-lg font-semibold mt-4 text-gray-900 text-center"><?php echo $item['pro_name']; ?></h3>
            <p class="text-sm text-center text-gray-600 w-full truncate">
                <?= html_escape($item['pro_discription']) ?>
            </p>

            <span class="text-red-500 bg-red-100 rounded-lg text-center text-lg font-medium">
                <?php echo $item['discount']; ?>%
            </span>

            <div class="mt-3 flex flex-col items-center">
                <span class="text-green-600 font-bold text-xl bg-green-100 px-3 py-1 rounded-lg shadow-sm">
                    <?php echo 'Rs. ' . number_format($item['pro_price'], 2); ?>
                </span>
            </div>

        </div>

    <?php endforeach ?>
</div>



		<script>
			$(document).ready(function() {
				// Product click event
				$(document).on("click", ".con", function() {
					var pro_id = $(this).data("id");
					console.log(pro_id);
					window.location.href = "<?php echo base_url('beUS/'); ?>" + pro_id;
				});

			});
		</script>

		<div class="w-full mb-10 hover:shadow-lg mt-6 ">
			<img
				src="./image/banner/Capture1.PNG"
				alt="Banner Image"
				class="w-full h-full object-cover rounded-2xl lg:rounded-l-none" />
		</div>
		</div>
<!-- Footer -->
<footer class="bg-gray-800 text-white py-12 w-full">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Top Sections -->
        <div class="flex  gap-8 justify-between">
            <!-- About -->
            <div class="w-full sm:w-1/2 md:w-1/4">
                <h3 class="text-lg font-semibold mb-4">ABOUT</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Contact Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">About Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Careers</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Fisher Stories</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Press</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Corporate Info</a></li>
                </ul>
            </div>

            <!-- Group Companies -->
            <div class="w-full sm:w-1/2 md:w-1/4">
                <h3 class="text-lg font-semibold mb-4">GROUP COMPANIES</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Myrrhs</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Pygmints</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Colors</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Society</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Fisher Internet Pvt Ltd</a></li>
                </ul>
            </div>

            <!-- Help -->
            <div class="w-full sm:w-1/2 md:w-1/4">
                <h3 class="text-lg font-semibold mb-4">HELP</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Payments</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Shipping</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Cancellation & Returns</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Report Infringement</a></li>
                </ul>
            </div>

            <!-- Consumer Policy -->
            <div class="w-full sm:w-1/2 md:w-1/4">
                <h3 class="text-lg font-semibold mb-4">CONSUMER POLICY</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Cancellation & Returns</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Terms Of Use</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Security</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Privacy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-yellow-300">Grievance Redressal</a></li>
                  
                </ul>
            </div>
        </div>

        <!-- Middle Contact Info -->
        <div class="flex flex-col md:flex-row justify-between mt-12 gap-6 text-sm">
            <!-- Mail Us -->
            <div class="md:w-1/3">
                <h3 class="text-lg font-semibold mb-2">Mail Us:</h3>
                <p class="text-gray-400 leading-relaxed">
                    Fisher Internet Private Limited,<br>
                    Buildings Myrrhs, Beyond & Cover Embassy Tech Village,<br>
                    Outer Ring Road, Devarabeesanahalli Village,<br>
                    Bengaluru, 560103, Karnataka, India
                </p>
            </div>

            <!-- Registered Office -->
            <div class="md:w-1/3">
                <h3 class="text-lg font-semibold mb-2">Registered Office Address:</h3>
                <p class="text-gray-400 leading-relaxed">
                    Fisher Internet Private Limited,<br>
                    Buildings Myrrhs, Beyond & Cover Embassy Tech Village,<br>
                    Outer Ring Road, Devarabeesanahalli Village,<br>
                    Bengaluru, 560103, Karnataka, India<br>
                    CIN: U74140KA2012PTC066107
                </p>
            </div>

            <!-- Contact Us -->
            <div class="md:w-1/3">
                <h3 class="text-lg font-semibold mb-2">Contact Us</h3>
                <p class="text-gray-400 leading-relaxed">
                    Telephone: 044-45614790 / 044-67418900<br>
                    Email: support@fisher.com
                </p>
            </div>
        </div>

        <!-- Bottom Social and Copyright -->
        <div class="mt-12 border-t border-gray-700 pt-6 flex flex-col md:flex-row items-center justify-between text-sm">
            <div class="flex space-x-4 mb-4 md:mb-0">
                <a href="#" class="text-gray-400 hover:text-white">Facebook</a>
                <a href="#" class="text-gray-400 hover:text-white">Twitter</a>
                <a href="#" class="text-gray-400 hover:text-white">Instagram</a>
            </div>
            <p class="text-gray-400">&copy; 2007–2023 Fisher.com</p>
        </div>
    </div>
</footer>

		

</body>

</html>
