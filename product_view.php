<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Products</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="p-6">
  <h1 class="text-2xl font-bold mb-6">User Orders</h1>
  <div class="space-y-8">

    <?php $base_url = base_url('image/multi/'); ?>
    <?php foreach ($order_products as $user_id => $products): ?>
      <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">User ID: <?= $user_id; ?></h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

          <?php foreach ($products as $pro): ?>
            <div class="bg-white rounded-lg shadow border p-4">
              <img src="<?= htmlspecialchars($pro['pro_image']); ?>" class="w-full h-40 object-contain rounded" alt="<?= htmlspecialchars($pro['pro_name']); ?>">
              <h3 class="font-bold text-lg mt-2"><?= htmlspecialchars($pro['pro_name']); ?></h3>
              <p class="text-gray-600 text-sm mt-1"><?= htmlspecialchars($pro['pro_discription']); ?></p>
              <p class="mt-2 text-black font-semibold">₹<?= $pro['pro_price']; ?>
                <?php if (!empty($pro['discount'])): ?>
                  <span class="line-through text-red-500 text-sm ml-2">₹<?= number_format($pro['pro_price'] / (1 - $pro['discount'] / 100), 0); ?></span>
                  <span class="text-green-600 text-sm ml-1">-<?= $pro['discount']; ?>%</span>
                <?php endif; ?>
              </p>

              <div class="mt-2 flex flex-wrap gap-2">
                <strong class="text-sm text-gray-700">Sizes:</strong>
                <?php foreach (explode(',', $pro['pro_size']) as $size): ?>
                  <span class="bg-gray-200 text-sm px-2 py-1 rounded"><?= trim($size); ?></span>
                <?php endforeach; ?>
              </div>

              <?php if (!empty($pro['color_img'])): 
                $colors = json_decode($pro['color_img'], true);
              ?>
                <div class="mt-3 flex items-center gap-2">
                  <strong class="text-sm">Colors:</strong>
                  <?php foreach ($colors as $color => $img): ?>
                    <div class="w-5 h-5 rounded-full border" style="background-color: <?= $color ?>;"></div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>

</body>
</html>
