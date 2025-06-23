<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order Summary</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="p-6" style="background-color:rgb(235, 235, 235)">
<h1 class="text-3xl text-center font-bold mb-4">Shopping Cart</h1>
        
<div class="flex items-center justify-center text-sm text-gray-600 mb-8">
    <a href="#" class="fweb hover:underline">Home</a>
	<script>
		$(document).on('click', '.fweb', function() {
			const productId = $(this).data('id');
			window.location.href = `<?php echo base_url('pro_get'); ?>`;
		});
	</script>
    <span class="mx-2">›</span>
    <span> <?php echo $userget->username?>'s Shopping Cart</span>
</div>
        
<!-- Selected Items -->
<div class="max-w-3xl mx-auto my-8 px-4">

    <div class="bg-white rounded-lg shadow-sm p-6">
        <!-- Header -->
        <div class="grid grid-cols-1 sm:grid-cols-12 pb-4 border-b text-gray-800 font-medium">
            <div class="col-span-6">Product</div>
            <div class="col-span-2 text-center">Price</div>
            <div class="col-span-2 text-center">Quantity</div>
            <div class="col-span-2 text-right">Total</div>
        </div>

        <!-- Loop through cart data and display product items -->
        <?php $final_amount = 0; ?>
        <?php
        $mian = [];
        $sub = []; ?>
		<!-- <?= json_encode($cart_data)?> -->
	
        <?php foreach ($cart_data as $data) { 
			 $base_url = base_url('image/multi/');
            $total_price = $data['price'] * $data['quantity'];
            $final_amount += $total_price;
        ?>
            <div class="grid grid-cols-1 sm:grid-cols-12 py-6 border-b items-center">
                <div class="col-span-6 flex space-x-4 sm:col-span-6">
                    <div class="w-24 h-24 bg-gray-100 rounded flex-shrink-0">
                        <img src="<?= $base_url.$data['image']; ?>" alt="<?= htmlspecialchars($data['pro_name'], ENT_QUOTES); ?>" class="object-contain w-full h-full"/>
                    </div>
                    <div class="flex flex-col justify-between py-1 sm:ml-4">
                        <div>
                            <h3 class="font-medium"><?= htmlspecialchars($data['pro_name'], ENT_QUOTES); ?></h3>
                            <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($data['pro_dis'], ENT_QUOTES); ?></p>
                        </div>
                        <button class="delete-cart-item text-sm text-gray-500 hover:text-gray-700 w-max mt-2 " data-cart-id="<?= $data['cart_id']; ?>">Remove</button>
                    </div>
                </div>
                <div class="col-span-2 text-center"><?= number_format($data['price'], 2); ?></div>
                <div class="col-span-2">
                    <div class="flex justify-center">
                        <div class="flex border border-gray-300 rounded">
                            <button class="px-2 py-1 bg-gray-100 decrease-qty" data-cart-id="<?= $data['cart_id']; ?>">-</button>
                            <input type="number" value="<?= $data['quantity']; ?>" class="w-10 py-1 text-center border-x border-gray-300 quantity" data-cart-id="<?= $data['cart_id']; ?>" />
                            <button class="px-2 py-1 bg-gray-100 increase-qty" data-cart-id="<?= $data['cart_id']; ?>">+</button>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 text-right font-medium"><?= number_format($total_price, 2); ?></div>
            </div>
        <?php $mian[] = $sub; ?>
        <?php } ?>

        <!-- Gift wrapping option -->
        <div class="flex items-center justify-between py-4 border-b">
            <div class="flex items-center">
                <input type="checkbox" id="gift-wrap" class="mr-2 h-4 w-4">
                <label for="gift-wrap" class="text-sm">For ₹50.00 Please Wrap The Product</label>
            </div>
        </div>

        <!-- Subtotal -->
        <div class="flex justify-between py-4">
            <span class="text-xl font-bold">Final Amount:</span>
            <div class="text-right mt-4">
                <p class="text-xl font-bold">₹<span id="final-amount"><?php $mian['total_price'] = $final_amount;
                                                                echo number_format($final_amount, 2); ?></span></p>
            </div>
        </div>

        <!-- Final Amount -->

        <!-- Buttons -->
        <div class="mt-6 space-y-3">
            <button id="place-order" class="w-full bg-black text-white py-3 rounded font-medium hover:bg-gray-800">Place Order</button>
            <button class="w-full text-center py-2 hover:underline">View Cart</button>
        </div>
    </div>
</div>



	<script>
		$(document).ready(function() {

			$("#place-order").click(function() {

				let data = <?php echo json_encode($mian); ?>;
				console.log(data);
				$.ajax({
					url: '<?php echo base_url("order/try"); ?>',
					type: 'POST',
					data: {
						data: data
					},
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							alert("Order placed successfully!");
							window.location.href = '<?php echo base_url('order/US3'); ?>';

						} else {
							alert("Error: " + response.message);
						}
					},
					error: function() {
						alert("Something went wrong. Please try again.");
					}
				});
			})
		})
	</script>
	<script>
		$(document).ready(function() {
			// 🔴 INDIVIDUAL DELETE
			$(".delete-cart-item").click(function() {
				const cartId = $(this).data("cart-id");

				if (!confirm("Are you sure you want to delete this item?")) return;

				$.ajax({
					url: '<?= base_url("cart/delete_cart"); ?>',
					type: 'POST',
					data: {
						cart_id: [cartId]
					},
					dataType: 'json',
					success: function(response) {
						if (response.status === "success") {
							$(`button[data-cart-id="${cartId}"]`).closest(".flex").remove();
							alert(response.message);
							location.reload(); // Uncomment if needed
						} else {
							alert(response.message);
						}
					},
					error: function() {
						alert("Error deleting item.");
					}
				});
			});

		});
	</script>


	<script>
		$(document).ready(function() {
			function updateQuantity(cart_id, quantity, priceElement) {
				console.log(priceElement);
				$.ajax({
					url: '<?php echo base_url('cart/update_quantity'); ?>',
					type: 'POST',
					data: {
						quantity1: quantity,
						cart_id: cart_id
					},
					dataType: 'json',
					success: function(response) {

						if (response.status === 'success') {
							console.log(response);
							location.reload();

						} else {
							alert(response.message);
						}
					},
					error: function() {
						alert('Failed to update quantity.');
					}
				});
			}

			$(".increase-qty").click(function() {
				var qtyInput = $(this).siblings(".quantity");
				var cart_id = $(this).data("cart-id");
				console.log(cart_id);
				var priceElement = $(".total-price");

				var newQty = parseInt(qtyInput.val()) + 1;

				qtyInput.val(newQty);
				updateQuantity(cart_id, newQty, priceElement);
			});

			$(".decrease-qty").click(function() {
				var qtyInput = $(this).siblings(".quantity");
				var cart_id = $(this).data("cart-id");
				var priceElement = $(this).closest(".text-right").find(".total-price");
				var newQty = parseInt(qtyInput.val()) - 1;

				if (newQty < 1) return;
				qtyInput.val(newQty);
				updateQuantity(cart_id, newQty, priceElement);
			});

			$(".quantity").on("blur", function() {
				var cart_id = $(this).data("cart-id");
				var priceElement = $(this).closest(".text-right").find(".total-price");
				var newQty = parseInt($(this).val());

				if (isNaN(newQty) || newQty < 1) {
					$(this).val(1);
					newQty = 1;
				}

				updateQuantity(cart_id, newQty, priceElement);
			});
		});
	</script>


</body>

</html>
