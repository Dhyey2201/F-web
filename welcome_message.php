<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Form</title>
    <style>
        /* Hide the form by default */
        #status {
            display: none;
            border: 1px solid #ccc;
            padding: 15px;
            width: 300px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Button to toggle form visibility -->
    <button onclick="toggleForm()">Show/Hide Form</button>

    <!-- Order Status Form -->
    <form id="status" action="<?php echo base_url('order/update') ?>" method="POST">
        <input type="hidden" name="order_id" id="order_id" value="123"> <!-- Example Order ID -->
        
        <label>
            <input type="checkbox" name="order_status[]" value="placed"> Order Placed
        </label><br>
        <label>
            <input type="checkbox" name="order_status[]" value="shipped"> Shipped
        </label><br>
        <label>
            <input type="checkbox" name="order_status[]" value="out_for_delivery"> Out for Delivery
        </label><br>
        <label>
            <input type="checkbox" name="order_status[]" value="on_way"> On Way
        </label><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        function toggleForm() {
            var form = document.getElementById("status");
            form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
        }

        // Hide form after submission
        document.getElementById("status").onsubmit = function(event) {
            event.preventDefault(); // Prevent default form submission for testing
            alert("Form submitted! Hiding form...");
            document.getElementById("status").style.display = "none";
            
            // Uncomment below if actually submitting via AJAX
            // this.submit(); 
        };
    </script>

</body>
</html>
