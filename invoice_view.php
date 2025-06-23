<!DOCTYPE html>
<html>
<head>
    <title>Invoice #<?= $invoice['id'] ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <!-- ✅ Action Buttons -->
    <div class="row no-print mb-3">
        <div class="col-12 d-flex flex-column flex-md-row justify-content-end gap-2">
            <button onclick="window.print()" class="btn btn-secondary mb-2 mb-md-0 mr-md-2">
                🖨️ Print Invoice
            </button>
            <a href="<?= base_url('invoice/download/' . $user_data->id) ?>" class="btn btn-primary mb-2 mb-md-0 mr-md-2" target="_blank">
                📥 Download Invoice
            </a>
            <a href="<?= base_url('whatsapp/send/' . $user_data->id) ?>" class="btn btn-success" target="_blank">
                <i class="fab fa-whatsapp"></i> Whatsapp
            </a>
        </div>
    </div>

    <!-- ✅ Invoice Header -->
    <div class="card p-3 mb-4">
        <div class="row">
            <div class="col-12 col-md-4 mb-2">
                <h5>Customer:</h5>
                <p class="mb-0"><strong><?= $user_data->username ?></strong></p>
            </div>

            <div class="col-12 col-md-4 mb-2">
                <h5>Delivery Address:</h5>
                <?php foreach ($order_data as $order): ?>
                    <p class="mb-0"><strong><?= $order["shipping_address"] ?></strong></p>
                    <?php break; ?>
                <?php endforeach; ?>
            </div>

            <div class="col-12 col-md-4 text-md-right mb-2">
                <h5>Date:</h5>
                <p class="mb-0"><?= date("Y-m-d H:i:s") ?></p>
            </div>
        </div>
    </div>

    <!-- ✅ Responsive Invoice Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Item</th>
                    <th>Price (₹)</th>
                    <th>Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grand_total = 0;
                $count = count($pro_data);
                for ($i = 0; $i < $count; $i++):
                    $products = $pro_data[$i];
                    foreach ($products as $pro):
                        $price = (float) $pro['pro_price'];
                        $total = $price; // Adjust if quantity available
                        $grand_total += $total;
                ?>
                <tr>
                    <td><?= $pro['pro_name'] ?></td>
                    <td><?= number_format($price, 2) ?></td>
                    <td><?= number_format($total, 2) ?></td>
                </tr>
                <?php endforeach; endfor; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">Grand Total</th>
                    <th><?= number_format($grand_total, 2) ?></th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

</body>
</html>
