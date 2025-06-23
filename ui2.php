<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Add in your <head> -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-gray-100">



<header class="flex justify-between items-center px-8 py-4 shadow-sm">
    <div class="container mx-auto px-6 flex items-center justify-between">
        <span class=" fweb font-bold text-2xl text-black">F-WEB</span>
		<script>
		$(document).on('click', '.fweb', function() {
			const productId = $(this).data('id');
			window.location.href = `<?php echo base_url('pro_get'); ?>`;
		});
	</script>
        <nav class="hidden md:flex space-x-6 text-black">
            <a href="#" data-id="22" class="filter-btn hover:text-yellow-300">WOMEN</a>
            <a href="#" data-id="21" class="filter-btn hover:text-yellow-300">MEN</a>
            <a href="#" data-id="23" class="filter-btn hover:text-yellow-300">TEENAGER</a>
            <a href="#" data-id="24" class="filter-btn hover:text-yellow-300">KIDS</a>
            <a href="#" data-id="25" class="filter-btn hover:text-yellow-300">BABY</a>
        </nav>
        <div class="flex items-center space-x-6">
            <a href="#" class="relative text-gray-700 hover:text-black">
                <i id="cart" class="fas fa-shopping-cart text-black text-2xl"></i>
                <span id="cart-count" class="absolute -top-1 -right-3 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full"><?php echo $cart?></span>
            </a>
        </div>
    </div>
</header>
<!-- Main Product Display -->
<div class="max-w-7xl mx-auto p-6 flex flex-col md:flex-row gap-6 mt-12 ">
    <!-- Left: Image Section -->
	 <?php 		$base_url = base_url('image/multi/');?>
	<div class="w-full md:w-1/2 relative">
    <div class="w-full md:w-[500px] h-[500px] mt-[25px] flex items-center justify-center bg-gray-100 rounded-lg overflow-hidden">
        <img id="mainImage" src="<?php echo $base_url.$p_data['pro_image']; ?>" alt="Product Image"
             class="w-full h-full object-contain rounded-lg transition-all duration-300 shadow-md">
    </div>

    <!-- Navigation Buttons -->
    <button id="prevBtn">
        
    </button>
    <button id="nextBtn" >
        
    </button>

    <!-- Thumbnails -->
	<?php 		$base_url = base_url('image/multi/');?>
    <div id="multi" class="flex space-x-2 mt-4  md:space-x-4">
        <?php foreach( $p_data['multi_img'] as $img): ?> 
            <img src="<?php echo $img; ?>" 
                 class="thumb w-16 h-16  border rounded-lg cursor-pointer bg-white p-1 hover:scale-105 transition"
                 onclick="updateImage('<?php echo $img ?>')">
        <?php endforeach ?>
    </div>

    <p class="mt-10 mr-16 text-sm md:text-base text-gray-700">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis optio magnam reprehenderit et natus quos minima eum quidem rerum cumque nostrum vel repellendus, est perspiciatis amet asperiores vero repellat quas necessitatibus soluta perferendis voluptatum molestiae praesentium. Similique deleniti ut voluptates iure quod sapiente enim totam! Obcaecati cupiditate sit iure repellat consequatur impedit, iusto nulla quibusdam ipsa itaque a fugit voluptatibus cumque ullam eveniet exercitationem rem nemo placeat sequi perspiciatis. Possimus, nostrum molestias! Maiores fuga sint nam harum est eveniet rem, voluptatum corrupti a modi eligendi odio reprehenderit provident nisi labore consequuntur explicabo tenetur, in quo expedita maxime tempore cupiditate? Incidunt.
    </p>
</div>


    <!-- Right: Product Details -->
    <div class="w-full md:w-1/2 space-y-4">
        <input type="hidden" id="user_id" value="<?php echo $userget->id?>" class="text-gray-600">
        
        <h2 id="pro_name" class="text-2xl font-bold text-gray-800"><?php echo $p_data['pro_name']; ?></h2>
        <p id="pro_dis" class="text-gray-600"><?php echo $p_data['pro_discription']; ?></p>
        
        <div class="flex items-center mt-2">
          
            <!-- <span class="text-gray-500 ml-2 text-sm"><?php echo $review?></span> -->
        </div>

			<div id="rating-stars">
				
				<input type="hidden" id="product_id" value="<?php echo $p_data['pro_id']; ?>">
				
				 <!-- <span class="star" data-rating="1">&#9733;</span>
				<span class="star" data-rating="2">&#9733;</span>
				<span class="star" data-rating="3">&#9733;</span>
				<span class="star" data-rating="4">&#9733;</span>
				<span class="star" data-rating="5">&#9733;</span>  -->
			</div>

			<p>Average Rating: <span id="avg-rating">Loading...</span></p>
				
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
		<!-- ratings  -->
	<script>
			$(document).ready(function() {
				let rating = 0;

				// Highlight stars on hover/click
				$('.star').on('click', function() {
					rating = $(this).data('rating');
					$('.star').removeClass('selected');
					$('.star').each(function() {
						if ($(this).data('rating') <= rating) {
							$(this).addClass('selected');
						}
					});
					console.log(rating);
					// AJAX POST rating
					$.ajax({
						url: '<?= base_url("rating/r_insert") ?>',
						type: 'POST',
						data: {
							user_id: $('#user_id').val(),
							pro_id: $('#product_id').val(),
							rating: rating
						},
						dataType: 'json',
						success: function(response) {
							if (response.status === 'success') {
								alert('Thanks for your rating!');
								loadAvgRating();
							} else {
								alert('Failed to submit rating.');
							}
						}
					});
				});
				function loadAvgRating() {
    let product_id = $('#product_id').val();
    let $ratingContainer = $('#avg-rating');

    // Show colorful loading spinner
    $ratingContainer.html(`
        <div class="spinner-border text-primary" role="status" style="width: 1.5rem; height: 1.5rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    `);

    $.getJSON('<?php echo base_url("rating/get_average_rating/") ?>' + product_id)
        .done(function(data) {
            console.log(data);
            let rating = parseFloat(data.rating);
            let colorClass = 'text-success'; // default green

            if (rating >= 4) {
                colorClass = 'text-success'; // Green for great rating
            } else if (rating >= 2.5) {
                colorClass = 'text-warning'; // Orange for average
            } else {
                colorClass = 'text-danger'; // Red for poor
            }

            let ratingHtml = `
                <span class="${colorClass} bg-green-600 text-white text-sm font-semibold px-2 py-1 rounded">
                    ${rating.toFixed(1)} 
                    <i class="bi bi-star-fill"></i>
                </span>
            `;

            // Smooth fade in animation
            $ratingContainer.fadeOut(200, function () {
                $(this).html(ratingHtml).fadeIn(400);
            });
        })
        .fail(function () {
            $ratingContainer.html('<span class="text-danger fw-bold">⚠️ Unable to load rating</span>');
        });
}

loadAvgRating();

			});

	</script>




        <div>
            <span id="pro_price" class="text-xl font-bold text-gray-900">Rs. <?php echo number_format($p_data['pro_price'], 2); ?></span>
            <span class="text-gray-500 line-through ml-2">₹899</span>
            <span class="text-green-600 font-semibold ml-2">(<?php echo $p_data['discount']; ?>%-OFF)</span>
        </div>

        <div class="bg-blue-100 p-3 rounded">
            <p class="text-blue-700 text-sm">Best Price - Grab now!</p>
            <p class="text-gray-600 text-xs">Price highlighted in blue indicates this product is available at its best price & no coupons are applicable.</p>
        </div>

        <!-- Color Buttons -->

        <div id="colorOptions" class="flex space-x-2 mt-2">
            <?php 
		 		$base_url = base_url('image/multi/');
                $colorImages = $p_data['color_img'];
                foreach ($colorImages as $color => $img) {
				
                    echo "<button class='color-btn w-8 h-8 rounded-full border' 
                            data-img='$img' style='background-color: $color;' data-color='$color'></button>";
                }
            ?>
        </div>

        <!-- Size Selection -->
		<div>
			<p class="text-gray-800 font-semibold">Select Size</p>
			<div id="size" class="flex space-x-2 mt-2">
				<?php foreach (explode(',', $p_data['pro_size']) as $size): ?>
				<button 
					class="size-btn border px-4 py-2 rounded-lg text-gray-800 hover:bg-gray-100 transition"
					data-size="<?php echo $size; ?>">
					<?php echo $size; ?>
				</button>
				<?php endforeach ?>
			</div>
		</div>


			<script>
			document.addEventListener("DOMContentLoaded", function () {
				const sizeButtons = document.querySelectorAll('.size-btn');
				sizeButtons.forEach(button => {
				button.addEventListener('click', () => {
					sizeButtons.forEach(btn => btn.classList.remove('bg-black', 'text-white'));
					button.classList.add('bg-black', 'text-white');
				});
				});
			});
			</script>
  
 <!-- #region -->
        <div>
            <button id="buy" class="w-full bg-black text-white py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-yellow-500 transition">ADD TO BAG</button>
            <button id="wishlist"class="w-full mt-2 border border-gray-400 text-gray-800 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-gray-200 transition">SAVE TO WISHLIST</button>
        </div>
		<h2 id="pro_name" class="text-2xl font-bold text-gray-800">Customer Review</h2>
		<!-- Custom CSS class for scrollbar-hide -->
<style>
  .scrollbar-hide::-webkit-scrollbar {
    display: none;
  }
  .scrollbar-hide {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
  }
</style>

<!-- Review List Container -->
<div class="max-h-[350px] overflow-y-scroll pr-2 space-y-4 scrollbar-hide">
    <?php foreach ($rating as $item): ?>
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow transition duration-200">
        <div class="flex items-start gap-4">
            <!-- Avatar Icon -->
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 font-bold text-lg">
                    <?= strtoupper(substr($item['pro_comment'], 0, 1)) ?>
                </div>
            </div>

            <!-- Comment Content -->
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h4 class="text-gray-800 font-semibold text-sm">Customer Review</h4>
                    <div class="text-yellow-400 text-sm">
                        <?php
                        if (isset($item['rating'])) {
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $item['rating'] ? '&#9733;' : '<span class="text-gray-300">&#9733;</span>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- Truncated comment with ellipsis -->
                <p class="text-gray-600 mt-1 text-sm line-clamp-2">
                    <?= htmlspecialchars($item['pro_comment']) ?>
                </p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

    </div>
</div>


<!-- Similar Products Section -->
<div class="max-w-7xl border-black mx-auto mt-12 px-6">
<h2 id="pro_name" class="text-2xl font-bold text-gray-800 mb-4">Similar Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        <?php foreach ($similler as $item): ?>
            <div class="con p-5 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:scale-105 w-full max-w-xs mx-auto cursor-pointer border border-gray-200 bg-gray-100" data-id="<?php echo $item['pro_id']; ?>">
                <div class="relative overflow-hidden rounded-lg">
                    <img src="<?php echo $item['pro_image']; ?>" alt="Product Image" 
                         class="w-full h-64 object-cover rounded-lg transition-transform duration-300 hover:scale-110">
                </div>

                <h3 class="text-lg font-semibold mt-4 text-gray-900 text-center"><?php echo $item['pro_name']; ?></h3>
                <p class="text-gray-600 mt-2 text-sm leading-relaxed text-center"><?php echo $item['pro_discription']; ?></p>

                <div class="mt-3 flex flex-col items-center">
                    <span class="text-gray-500 line-through text-lg font-medium">Rs. 2299 (50% OFF)</span>
                    <span class="text-green-600 font-bold text-xl bg-green-100 px-3 py-1 rounded-lg shadow-sm">
                        <?php echo 'Rs. ' . number_format($item['pro_price'], 2); ?>
                    </span>
                </div>
            </div>
        <?php endforeach ?>
    </div>
	<p style="text-align: center; font-family: Arial, sans-serif; font-size: 14px; color: #555; margin-top: 40px ;" class="mb-10">
  &copy; <?php echo date("d-m-Y"); ?> <strong>F-web</strong>. Developed by <strong>Dhyey</strong>. All rights reserved.<br>
  <span style="font-size: 13px;">
    This website and its content are the intellectual property of Dhyey.<br>
    Any redistribution or reproduction of part or all of the contents in any form is strictly prohibited without written consent.
  </span>
</p>

</div>







<script>
	$(document).ready(function(){
    let prosize = null;
    let procolor = null; // Declare here so it's available globally

    $('.color-btn').on('click', function () {
        procolor = $(this).data('color');
        console.log("Selected color:", procolor);
    });

    $('.size-btn').on('click', function () {
        prosize = $(this).data('size');
        console.log("Selected size:", prosize);
    });

    $("#buy").click(function(){
        if ($('#user_id').val()) {
            var user_id = $('#user_id').val();
            let Pro_name = '<?php echo $p_data['pro_name']; ?>';
            var pro_dis = $('#pro_dis').text();
            let pro_price = '<?php echo $p_data['pro_price']; ?>';
            let Pro_image = '<?php echo $p_data['pro_image']; ?>';
            let Pro_id = '<?php echo $p_data['pro_id']; ?>';

            // These values now come from global scope
            let pro_size = prosize;
            let pro_color = procolor;

            $.ajax({
                url: "<?php echo base_url('cart/cart_web') ?>",
                type: "POST",
                data: {
                    user_id: user_id,
                    pro_name: Pro_name,
                    pro_dis: pro_dis,
                    pro_price: pro_price,
                    pro_image: Pro_image,
                    pro_id: Pro_id,
                    pro_size: pro_size,
                    pro_color: pro_color // <-- include color in the request
                },
                dataType: "json",
                success: function(response) {
                    console.log("Response:", response);
                    if (response.status == "success") {
                        alert("Added to cart successfully!");
                        var currentCount = parseInt($("#cart-count").text());
                        $("#cart-count").text(currentCount + 1);
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    console.log("Response Text:", xhr.responseText);
                    alert("Something went wrong. Check console for details.");
                }
            });
        } else {
            alert('You want to login first');
        }
    });



		$("#wishlist").click(function(){
			var user_id=$('#user_id').val();
			let Pro_name='<?php echo $p_data['pro_name'];?>';
			var pro_dis=$('#pro_dis').text();
			let pro_price='<?php echo $p_data['pro_price'];?>';
			let Pro_image='<?php echo $p_data['pro_image'];?>';
			let Pro_id='<?php echo $p_data['pro_id'];?>';
			let pro_size = prosize;
		
			

			$.ajax({
				url:"<?php echo base_url('wishlist/wish_in')?>",
				type:"POST",
				data:{
					id: user_id,
					pro_name:Pro_name,
					pro_dis:pro_dis,
					pro_price:pro_price,
					pro_image:Pro_image,
					pro_id:Pro_id,
				
				},
				dataType:"json",
				success: function(response) {
                
                if (response.status == "success") {
                    alert("Added to wishlist successfully!");
                    
                    // Update cart count
                    var currentCount = parseInt($("#cart-count").text());
                    $("#cart-count").text(currentCount + 1);
                } else {
                    alert("Error: " + response.message);
                }
				},
				error: function(xhr, status, error) {
					console.error("AJAX Error:", status, error);
					console.log("Response Text:", xhr.responseText);
					alert("Something went wrong. Check console for details.");
				}
			})
		})
	})
</script>
<script>
   $(document).ready(function () {
    // Product click event
    $(document).on("click", ".con", function () {
        var pro_id = $(this).data("id");
        console.log(pro_id);
        window.location.href = "<?php echo base_url('US/'); ?>" + pro_id;
    });
	
});

</script>
<script>
	document.getElementById('cart').addEventListener('click', function () {
    window.location.href = '<?php echo base_url('us2'); ?>';
	})
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const mainImage = document.getElementById("mainImage");
    const thumbs = document.querySelectorAll(".thumb");
    const colorButtons = document.querySelectorAll(".color-btn");

    // Attach click events to multi_img thumbnails
    thumbs.forEach(thumb => {
        thumb.addEventListener("click", function () {
            const imgSrc = this.getAttribute("src");
            mainImage.setAttribute("src", imgSrc);
        });
    });

    // Attach click events to color buttons
    colorButtons.forEach(button => {
        button.addEventListener("click", function () {
            const colorImg = this.getAttribute("data-img");
            mainImage.setAttribute("src", colorImg);
        });
    });
});
</script>

<script>
// Navigate to cart page
document.getElementById('cart').addEventListener('click', function () {
    window.location.href = '<?php echo base_url('us2') ?>';
})
</script> 




</body>
</html>
