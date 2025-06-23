<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .back-button {
            background-color: #6c757d;
            margin-top: 10px;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
        .payment-methods {
            margin-top: 20px;
        }
		
    </style>
</head>
<body>

    <div class="container">
        <h2>Make a Payment</h2>
        <p>Enter the amount to pay:</p>
        <input type="number" id="amount" placeholder="Amount in INR" required />

        <div class="payment-methods">
            <button id="pay-btn">Pay with Razorpay</button>
            <button id="cod-btn" class="back-button">Cash on Delivery</button>
        </div>

		<a href="http://localhost/api/logout">logout</a>
       
        <p id="payment-status"></p>
        <button class="back-button" onclick="goBack()">Back</button>
    </div>

    <script>
        $(document).ready(function () {
            // Razorpay Payment
            $("#pay-btn").click(function () {
                let amount = $("#amount").val();
				// console.log(amount);
                if (amount <= 0) {
                    alert("Please enter a valid amount.");
                    return;
                }

                $.ajax({
                    url: "<?php echo base_url('pay_o'); ?>",
                    type: "POST",
                    data: { amount: amount,email:'dheay19900@gmail.com',total_price:5000,shipping_address:'4-a akshra socity'},
                    success: function(response) {
						// console.log(JSON.parse(response.data));
						response = JSON.parse(response);
						console.log(response);
                        let options = {
                            "key": "rzp_test_v1TzrAaOfZ8DOD",
                            "amount": response.amount,  // Convert to paise
                            "currency": "INR",
                            "name": "Your Company",
                            "description": "Test Transaction",
                            "order_id": response.id,
                            "handler": function (data) {
								console.log(data);
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
                                "color": "ec7e43"
                            }
                        };
						console.log(options);
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                      //ec7e43
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", error);
						console.log("XHR Response:", xhr.responseText);
						console.log("Status:", status);
                        // alert("Error creating order. Please try again.");
                    }
                });
            });

            // Cash on Delivery
            $("#cod-btn").click(function () {
                var amount = $("#amount").val();
                if (amount <= 0) {
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

</body>
</html>
