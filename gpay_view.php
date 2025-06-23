<!DOCTYPE html>
<html>
<head>
  <title>Google Pay Integration</title>
</head>
<body>

<div id="container"></div>

<!-- ✅ Your JS code comes FIRST -->
<button id="rzp-button1">Pay with UPI</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "YOUR_KEY_ID", // from Razorpay dashboard
        "amount": "10000", // = ₹100 (amount in paise)
        "currency": "INR",
        "name": "Your Company",
        "description": "Test Transaction",
        "image": "https://your-logo.png",
        "handler": function (response){
            // Send response.razorpay_payment_id to backend for verification
            alert("Payment ID: " + response.razorpay_payment_id);
        },
        "prefill": {
            "name": "Darling",
            "email": "test@example.com"
        },
        "theme": {
            "color": "#3399cc"
        },
        "method": {
            "upi": true,
            "card": false,
            "netbanking": false
        }
    };

    var rzp1 = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
</script>

</body>
</html>
