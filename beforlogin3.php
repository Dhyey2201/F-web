<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Fashion Shop</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-white font-['Roboto'] text-gray-800">
	<!-- Header -->
	<header class="border-b border-gray-200 px-8 py-6">
		<div class="max-w-7xl mx-auto flex justify-between items-center">
			<span class="fweb font-bold text-2xl text-black ">F-WEB</span>

		</div>
	</header>
	<script>
		$(document).on('click', '.fweb', function() {
			const productId = $(this).data('id');
			window.location.href = `<?php echo base_url('pro_get'); ?>`;
		});
	</script>

	<!-- Breadcrumb and Title -->
	<section class=" text-center justify-between py-6">
		<div class="max-w-7xl mx-auto px-8">
			<h2 class="text-3xl font-semibold mt-1">Fashion</h2>
			<p class="text-sm text-gray-500">Home / Fashion</p>
		</div>
	</section>

	<main class="py-8">
		<div class="max-w-7xl mx-auto flex gap-8 px-8">
			<!-- Filters Sidebar -->
			<aside class="w-64 space-y-6">
				<div>
					<h3 class="text-xl font-semibold mb-3">Filters</h3>
					<p class="font-medium mb-2">Size</p>
					<div id="size-buttons" class="flex gap-2 flex-wrap">
						<button data-id="S" class="size-filter border px-3 py-1 hover:shadow-lg  hover:bg-red-300 rounded">S</button>
						<button data-id="M" class="size-filter border px-3 py-1 hover:shadow-lg hover:bg-yellow-300 rounded">M</button>
						<button data-id="L" class="size-filter border px-3 py-1 hover:shadow-lg  hover:bg-green-300 rounded">L</button>
						<button data-id="XL" class="size-filter border px-3 py-1 hover:shadow-lg hover:bg-blue-300 rounded">XL</button>
						<button data-id="XXL" class="size-filter border px-3 py-1 hover:shadow-lg hover:bg-orange-300 rounded">XXL</button>
					</div>
				</div>

				<!-- Product list will be loaded here -->




				<!-- jQuery AJAX Script -->
				<script>
					$(document).ready(function() {
						const base_url = "<?php echo base_url('image/multi/'); ?>";
						$(document).on('click', '.size-filter', function() {
							$('#grid').hide();
							var size = $(this).data('id');
							console.log(size);

							$.ajax({
								url: "<?php echo base_url('product/size'); ?>",
								type: 'POST',
								data: {
									size: size
								},
								success: function(data) {
									products = JSON.parse(data);
									console.log(data);
									let html = `
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
`;

products.forEach(product => {
  html += `
    <div class="border rounded-xl p-3 md:p-4 relative hover:shadow-lg transition product-card" data-id="${product.pro_id}">
      <img src="${base_url}${product.pro_image}" alt="${product.pro_name}" class="w-full h-40 sm:h-48 object-cover rounded-lg">
      <div class="mt-3">
        <h5 class="text-base md:text-lg font-semibold mb-1 line-clamp-2">${product.pro_brand} - ${product.pro_name}</h5>
        <p class="text-gray-800 font-medium text-sm md:text-base">
          <strong>Price:</strong> ₹${product.pro_price}
          <del class="text-xs text-gray-500 ml-2">₹${(product.pro_price / (1 - product.discount / 100)).toFixed(2)}</del>
        </p>
        <p class="text-red-500 text-xs md:text-sm font-semibold mt-1"><strong>Discount:</strong> ${product.discount}% off</p>
        <p class="text-gray-700 text-xs md:text-sm mt-1"><strong>Sizes:</strong> ${product.pro_size}</p>
      </div>
    </div>
  `;
});

html += `</div>`;
 // Close grid wrapper

									$('#product-list').html(html);
								},
								error: function(xhr, status, error) {
									console.error("Error fetching products:", error);
									$('#product-list').html('<p class="text-red-500">Something went wrong. Please try again later.</p>');
								}
							});
						});
					});

					$(document).on('click', '.product-card', function() {
						const productId = $(this).data('id');
						window.location.href = `<?php echo base_url('US/'); ?>${productId}`;
					});
				</script>


				<div>
					<p class="font-medium mb-2">Colors</p>
					<div class="grid grid-cols-6 gap-2 " id="color-options">
						<span class="w-5 h-5 rounded-full bg-red-500 border hover:shadow-lg cursor-pointer" data-color="red"></span>
						<span class="w-5 h-5 rounded-full bg-orange-400 border cursor-pointer" data-color="orange"></span>
						<span class="w-5 h-5 rounded-full bg-yellow-400 border cursor-pointer" data-color="yellow"></span>
						<span class="w-5 h-5 rounded-full bg-green-500 border cursor-pointer" data-color="green"></span>
						<span class="w-5 h-5 rounded-full bg-cyan-400 border cursor-pointer" data-color="cyan"></span>
						<span class="w-5 h-5 rounded-full bg-blue-500 border cursor-pointer" data-color="blue"></span>
						<span class="w-5 h-5 rounded-full bg-indigo-500 border cursor-pointer" data-color="indigo"></span>
						<span class="w-5 h-5 rounded-full bg-purple-500 border cursor-pointer" data-color="purple"></span>
						<span class="w-5 h-5 rounded-full bg-pink-500 border cursor-pointer" data-color="pink"></span>
					</div>
				</div>
				<script>
					$(document).ready(function() {
						const base_url = "<?php echo base_url('image/multi/'); ?>";
						$('#color-options').on('click', 'span', function() {
							$('#grid').hide();
							let selectedColor = $(this).data('color');
							

							$.ajax({
								url: "<?php echo base_url('product/filter_by_color'); ?>", // CI3 controller/method
								type: 'POST',
								data: {
									color: selectedColor
								},
								success: function(data) {

									products = JSON.parse(data);
									console.log(data);

									let html = `
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
          `;

									products.forEach(product => {
										html += `
              <div class="border rounded-xl p-4 relative hover:shadow-lg transition product-card " data-id="${product.pro_id}">
                <img src="${base_url}${product.pro_image}" alt="${product.pro_name}" class="w-full h-48 object-cover">
                <div class="p-4">
                  <h5 class="text-lg font-bold mb-1">${product.pro_brand} - ${product.pro_name}</h5>
                
                  <p class="text-gray-800 font-medium">
                    <strong>Price:</strong> ₹${product.pro_price}
                    <del class="text-sm text-gray-500 ml-2">₹${(product.pro_price / (1 - product.discount / 100)).toFixed(2)}</del>
                  </p>
                  <p class="text-red-500 text-sm font-semibold"><strong>Discount:</strong> ${product.discount}% off</p>
                  <p class="text-sm text-gray-700"><strong>Sizes:</strong> ${product.pro_size}</p>
                </div>
              </div>
            `;
									});

									html += `</div>`; // Close grid wrapper

									$('#product-list').html(html);

								},
								error: function(xhr, status, error) {
									console.error("Error sending color:", error);
								}
							});
						});
					});

					$(document).on('click', '.product-card', function() {
						const productId = $(this).data('id');
						window.location.href = `<?php echo base_url('US/'); ?>${productId}`;
					});
				</script>


				<div>
					<p class="text-lg font-bold text-black mb-2">Prices</p>

					<ul class="text-sm space-y-1">
						<li class="price-filter cursor-pointer hover:text-red-500" data-range="100-150">100–150</li>
						<li class="price-filter cursor-pointer hover:text-red-500" data-range="150-200">150–200</li>
						<li class="price-filter cursor-pointer hover:text-red-500" data-range="300-400">300–400</li>
						<li class="price-filter cursor-pointer hover:text-red-500" data-range="300-400">400–1000</li>

					</ul>

				</div>

				<script>
					$(document).on('click', '.price-filter', function() {
						const base_url = "<?php echo base_url('image/multi/'); ?>";

						$('#grid').hide();
						const range = $(this).data('range');
						const [min, max] = range.split('-');

						$.ajax({
							url: "<?php echo base_url('product/filter_by_price'); ?>",
							type: "POST",
							data: {
								min: min,
								max: max
							},
							success: function(response) {
								const products = JSON.parse(response);
								console.log(products);

								let html = `
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
          `;

								products.forEach(product => {
									html += `
              <div class="border rounded-xl p-4 relative hover:shadow-lg transition product-card " data-id="${product.pro_id}">
                <img src="${base_url}${product.pro_image}" alt="${product.pro_name}" class="w-full h-48 object-cover">
                <div class="p-4">
                  <h5 class="text-lg font-bold mb-1">${product.pro_brand} - ${product.pro_name}</h5>
                
                  <p class="text-gray-800 font-medium">
                    <strong>Price:</strong> ₹${product.pro_price}
                    <del class="text-sm text-gray-500 ml-2">₹${(product.pro_price / (1 - product.discount / 100)).toFixed(2)}</del>
                  </p>
                  <p class="text-red-500 text-sm font-semibold"><strong>Discount:</strong> ${product.discount}% off</p>
                  <p class="text-sm text-gray-700"><strong>Sizes:</strong> ${product.pro_size}</p>
                </div>
              </div>
            `;
								});

								html += `</div>`; // Close grid wrapper

								$('#product-list').html(html);

								// render products here
							}
						});
					});
					$(document).on('click', '.product-card', function() {
						const productId = $(this).data('id');
						window.location.href = `<?php echo base_url('US/'); ?>${productId}`;
					});
				</script>

				<div>
					<p class="text-lg font-bold text-black mb-2">Brands</p>
					<ul class="text-sm space-y-1">
						<li class="brand-filter cursor-pointer hover:text-orange-300" data-brand="H&m">H&m</li>
						<li class="brand-filter cursor-pointer hover:text-orange-300" data-brand="Adidas">Adidas</li>
						<li class="brand-filter cursor-pointer hover:text-orange-500" data-brand="Louis Philippe">Louis Philippe</li>
						<li class="brand-filter cursor-pointer hover:text-orange-500" data-brand="Zara">Zara</li>
						<li class="brand-filter cursor-pointer hover:text-orange-500" data-brand="Elegant Edge">Elegant Edge</li>
						<li class="brand-filter cursor-pointer hover:text-orange-500" data-brand="Levi's">Levi's</li>
						<li class="brand-filter cursor-pointer hover:text-orange-500" data-brand="Allen Solly">Allen Solly</li>
					</ul>
				</div>
				<script>
					$(document).on('click', '.brand-filter', function() {

						const base_url = "<?php echo base_url('image/multi/'); ?>";
						$('#grid').hide();
						let brand = $(this).data('brand');
						console.log(brand);


						$.ajax({
							url: "<?php echo base_url('product/filter_by_brand'); ?>",
							type: "POST",
							data: {
								brand: brand
							},
							success: function(response) {
								const products = JSON.parse(response);
								console.log(products);
								let html = `
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
          `;

								products.forEach(product => {
									html += `
              <div class="border rounded-xl p-4 relative hover:shadow-lg transition product-card " data-id="${product.pro_id}">
                <img src="${base_url}${product.pro_image}" alt="${product.pro_name}" class="w-full h-48 object-cover">
                <div class="p-4">
                  <h5 class="text-lg font-bold mb-1">${product.pro_brand} - ${product.pro_name}</h5>
                
                  <p class="text-gray-800 font-medium">
                    <strong>Price:</strong> ₹${product.pro_price}
                    <del class="text-sm text-gray-500 ml-2">₹${(product.pro_price / (1 - product.discount / 100)).toFixed(2)}</del>
                  </p>
                  <p class="text-red-500 text-sm font-semibold"><strong>Discount:</strong> ${product.discount}% off</p>
                  <p class="text-sm text-gray-700"><strong>Sizes:</strong> ${product.pro_size}</p>
                </div>
              </div>
            `;
								});

								html += `</div>`; // Close grid wrapper

								$('#product-list').html(html);


							}
						});
					});
					// 🔥 Product redirect handler — placed outside AJAX to avoid nesting errors
					$(document).on('click', '.product-card', function() {
						const productId = $(this).data('id');
						window.location.href = `<?php echo base_url('US/'); ?>${productId}`;
					});
				</script>

				<div>
					<p class="text-lg font-bold text-black mb-2">Collections</p>
					<ul class="text-sm space-y-1">
						<li>All products</li>
						<li>Best sellers</li>
						<li>New arrivals</li>
						<li>Accessories</li>
					</ul>
				</div>

				<div>
					<p class="text-lg font-bold text-black mb-2">Categories</p>
					<div class="flex flex-wrap gap-2 text-sm">
						<?php foreach ($scat as $item): ?>
							<span
								class="bg-gray-200 px-2 py-1 rounded-full  cursor-pointer hover:bg-purple-200 subcategory-filter"
								data-subcategory="<?php echo $item['sc_id']; ?>">
								<?php echo $item["sc_name"]; ?>
							</span>
						<?php endforeach ?>
					</div>
				</div>

			</aside>

			<script>
				$(document).on('click', '.subcategory-filter', function() {
					const base_url = "<?php echo base_url('image/multi/'); ?>";
					$('#grid').hide();
					var subcategory = $(this).data('subcategory');

					$.ajax({
						url: "<?php echo base_url('product/filter_by_subcategory'); ?>",
						type: 'POST',
						data: {
							subcategory: subcategory
						},
						success: function(response) {
							const products = JSON.parse(response);
							console.log(products);

							let html = `
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        `;

							products.forEach(product => {
								html += `
            <div class="border rounded-xl p-4 relative hover:shadow-lg transition product-card cursor-pointer" data-id="${product.pro_id}">
              <img src="${base_url}${product.pro_image}" alt="${product.pro_name}" class="w-full h-48 object-cover">
              <div class="p-4">
                <h5 class="text-lg font-bold mb-1">${product.pro_brand} - ${product.pro_name}</h5>
                <p class="text-gray-800 font-medium">
                  <strong>Price:</strong> ₹${product.pro_price}
                  <del class="text-sm text-gray-500 ml-2">₹${(product.pro_price / (1 - product.discount / 100)).toFixed(2)}</del>
                </p>
                <p class="text-red-500 text-sm font-semibold"><strong>Discount:</strong> ${product.discount}% off</p>
                <p class="text-sm text-gray-700"><strong>Sizes:</strong> ${product.pro_size}</p>
              </div>
            </div>
          `;
							});

							html += `</div>`; // Close grid

							$('#product-list').html(html);
						},
						error: function(xhr, status, error) {
							console.error("Subcategory filter error:", error);
						}
					});
				});

				// 🔥 Product redirect handler — placed outside AJAX to avoid nesting errors
				$(document).on('click', '.product-card', function() {
					const productId = $(this).data('id');
					window.location.href = `<?php echo base_url('US/'); ?>${productId}`;
				});
			</script>





			<!-- Product Grid -->
			<section class="lg:flex-1">
			
				<div class="container mt-5 ">
					<div class="sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 lg:gap-6" id="product-list"></div>
				</div>


				<div id="grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
					<?php
					$base_url = base_url('image/multi/');
					 foreach ($catpro as $item): ?>
						<div class="product-card1 border rounded-xl p-4 relative hover:shadow-lg transition"
							data-id="<?php echo $item['pro_id']; ?>">

							<div class="relative overflow-hidden rounded-lg">
								<img src="<?php echo $base_url.$item['pro_image']; ?>" alt="Product Image"
									class="w-full h-64 object-cover rounded-lg transition-transform duration-300 hover:scale-110">
							</div>

							<h3 class="text-lg font-semibold mt-4 text-gray-900 text-center"><?php echo $item['pro_name']; ?></h3>
							<p class="text-sm text-center text-gray-600 w-full truncate">
								<?= html_escape($item['pro_discription']) ?>
							</p>



							<div class="mt-3 flex flex-col items-center">

								<span class="text-green-600 font-bold text-xl bg-green-100 px-3 py-1 rounded-lg shadow-sm">
									<?php echo 'Rs. ' . number_format($item['pro_price'], 2); ?>
								</span>
							</div>

						</div>
					<?php endforeach ?>

				</div>
			</section>

			<script>
				$(document).on('click', '.product-card1', function() {
					const productId = $(this).data('id');
					window.location.href = `<?php echo base_url('US/'); ?>` + productId;
				});
			</script>
		</div>
	</main>
</body>

</html>
