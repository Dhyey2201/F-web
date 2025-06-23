<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhonePe Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">PhonePe Payment Gateway</h2>

   
    <div class="card p-4 mt-4">
        <form action="<?php echo base_url('Phonepe/phonepay'); ?>" method="post">
            <div class="mb-3">
                <label for="amount" class="form-label">Enter Amount (INR):</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Pay with PhonePe</button>
        </form>
    </div>


    <div class="mt-4">
    <?php if (isset($payment_status)) { ?>
        <div class="alert <?= ($payment_status == 'PAYMENT_SUCCESS') ? 'alert-success' : 'alert-danger'; ?>">
            <?= "Payment Status: " . htmlspecialchars($payment_status); ?> 
        </div>
    <?php } else { ?>
        <div class="alert alert-warning">Waiting for payment response...</div>
    <?php } ?>
</div>


</div>

</body>
</html>
