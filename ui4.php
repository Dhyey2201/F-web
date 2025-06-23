<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Address Selection</title>
    <script src="https://cdn.tailwindcss.com"></script>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="min-h-screen flex items-center justify-center" >
    <div class="max-w-6xl mx-auto py-10 px-4 ">
	<h1 class=" fweb text-2xl font-bold text-center mb-10">F-WEB Order Info</h1>
	<script>
		$(document).on('click', '.fweb', function() {
			const productId = $(this).data('id');
			window.location.href = `<?php echo base_url('pro_get'); ?>`;
		});
	</script>
		<div class="grid md:grid-cols-3 gap-8 bg-white p-6 rounded-lg  border border-black">

		  <!-- Left Section -->
		  <div class="md:col-span-2 space-y-8">
                <!-- Contact -->
                <div>
                    <h2 class="text-xl font-semibold mb-2">Contect number : <?php echo $user->contect_number ?></h2>
                    <div class="flex justify-between items-center mb-4">
                    </div>
                    <input id="email" type="email" placeholder="Email Address" value="<?php echo $stored['email']?>" class="w-full p-3 border border-gray-300 rounded-lg mb-2">
                </div>

                <!-- Delivery -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">Delivery</h2>
                   
                    <textarea type="text" placeholder="Address" value="<?php echo $user->address; ?>" class="w-full p-3 border border-gray-300 rounded-lg "  id="address" name="address"><?php echo $user->address; ?></textarea>  
                </div>

				<div class="mt-6 border-t pt-4">
            <h3 class="text-lg font-semibold text-gray-800">Delivery Estimates</h3>
            <ul class="mt-2 text-sm text-gray-700">
                <li>Ordered date  <span class="font-semibold"><?php echo $order["current_time"]?></span></li>
                <li>Estimated delivery by <span class="font-semibold"><?php echo $order["delivery_time"]?></span></li>
            </ul>
        </div>

                <!-- Payment -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">Payment</h2>
                    
	  <div class="flex items-center mt-6">
        <input id="cod" name="payment_method" type="checkbox" value="cod" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
        <label for="cod" class="ml-2 block text-sm text-gray-900 font-medium">
            Cash on Delivery
        </label>
    	</div>
                </div>
            </div>

			<div class="bg-gray-300 p-6 rounded-lg space-y-6">
			<?php foreach ($pro_data as $p): ?>
                <div class="flex items-center gap-4">
                    <img src="<?php echo $p['pro_image']?>" class="w-20 h-20 object-cover rounded-lg" alt="Product">
                    <div>
                        <h3 class="font-semibold"><?php echo $p['pro_name']?></h3>
                       
                        <p class="font mt-1">₹<?php echo $p['pro_price']?></p>
                    </div>
                </div>
				<?php endforeach; ?>

                <!-- <div>
                    <input type="text" placeholder="Discount code" class="w-full p-3 border border-gray-300 rounded-lg mb-2">
                    <button class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition">Apply</button>
                </div> -->

                <div class="border-t border-black pt-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>₹<?php echo $stored['total_price'] ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Shipping</span>
                        <span>₹40.00</span>
                    </div>
					<div class="flex justify-between">
                        <span>free Shipping</span>
                        <span class="text-red-500">- ₹40.00</span>
                    </div>

                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span id="amount"><?php echo $stored['total_price'] ?></span>
                    </div>
                </div>
            </div>
        
    </div>
	<div class="mt-10 text-center">
            <button id="pay-btn"  class="bg-black text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition">Pay Now</button>
			<button id="cod1" class="bg-black text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition" >Cash On Delivery</button>
            <p class="text-sm text-gray-500 mt-4">Copyright © 2022 FASCO. All Rights Reserved.</p>
        </div>

	</div>
	

    <script>
        $(document).on('blur', '#address', function() { 
            let cell = $(this).val().trim(); 
            let email = $("#email").text().trim(); 

            if (cell === "") {
                alert("Address cannot be empty!");
                return;
            }

            $.ajax({
                url: '<?php echo base_url('order/updateadd'); ?>', 
                type: 'POST',
                data: { address: cell, email: email},
                success: function(response) {
                    alert('Address updated successfully!');
                },
                error: function(xhr, status, error) {
                    alert('Failed to update address.');
                }
            });
        });
    </script>
	<script>
        $(document).ready(function () {
			$('#cod1').hide();
    	$("#pay-btn").click(function () {
			
        let amount = $("#amount").text();
	
		console.log(amount);  // Ensure it's a number
		if (amount <= 0) {
                    alert("Please enter a valid amount.");
                    return;
                }
        $.ajax({
            url: "<?php echo base_url('pay_o'); ?>",
            type: "POST",
            data: { 
                amount:amount, 
                email: '<?php echo $stored['email']; ?>',   
                shipping_address: '<?php echo $user->address?>' ,
            },
            success: function(response) {
				console.log("Raw Response:", response);
                if (typeof response === "string") {
                    response = JSON.parse(response);
                }
                console.log(response);

                let options = {
                    "key":"rzp_test_rWifXA4lUO2oXa",  // Use key from server
                    "amount": response.amount,  
                    "currency": response.currency,
                    "name": "F-web",
                    "description": "UPI Test Payment",
                    "order_id": response.id,
                    "handler": function (data) {
                        $.ajax({
                            url: "<?= base_url('payment/payment_success') ?>",
                            type: "POST",
                            data: {
                                razorpay_payment_id: data.razorpay_payment_id,
                                razorpay_order_id: data.razorpay_order_id,
                                razorpay_signature: data.razorpay_signature
                            },
                            success: function (result) {
                                $("#payment-status").html(result).addClass("success");
                            },
                            error: function () {
                                $("#payment-status").html("Payment verification failed!").addClass("error");
                            }
                        });
                    },
                    "prefill": {
                        "name": "John Doe",
                        "email": "johndoe@example.com",
                        "contact": "9999999999"
                    },
                    "theme": {
                        "color":"#4A6676"
                    },
					"method": {
						upi: true,
						card: true,
						netbanking: true,
						wallet: true
					}

                };
				

                var rzp1 = new Razorpay(options);
                rzp1.open();
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("XHR Response:", xhr.responseText);
                console.log("Status:", status);
            }
        });
    });

    // Cash on Delivery
    $("#cod-btn").click(function () {
        var amount = parseFloat($("#amount").val());
        if (isNaN(amount) || amount <= 0) {
            alert("Please enter a valid amount.");
            return;
        }
        $("#payment-status").html("You selected Cash on Delivery.").addClass("success");
    });
});


// Back button functionality
function goBack() {
    window.history.back();
}

    </script>


<script>
$(document).ready(function() {
	$('#cod').on('click',function(){
		$("#pay-btn").hide();
		$('#cod1').show();
	})
		
	
    let s_address = <?= json_encode($user->address); ?>;
    let c_time = <?= json_encode($order["current_time"]); ?>;
    let d_time = <?= json_encode($order["delivery_time"]); ?>;
    let email = <?= json_encode($stored['email']); ?>;

    $('#cod1').on('click', function() {
	
		
		
        if ($('#cod1').on('click')) {
            $.ajax({
                url: "<?= base_url("order/cash") ?>",
                type: "POST",
                data: {
                    s_address: s_address,
                    c_time: c_time,
                    d_time: d_time,
                    email: email
                },
                success: function(data) {
                    alert("Cash on Delivery Order Placed!");
                    // You can redirect after success if you want
                    window.location.href = "<?= base_url('pro_get') ?>";
                },
                error: function() {
                    alert("Something went wrong!");
                }
            });
        } else {
            alert("Please select Cash on Delivery option!");
        }
    });
});
</script>

</body>
</html>
