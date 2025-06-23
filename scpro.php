<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wishlist</title>
  <script src="https://cdn.tailwindcss.com"></script>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

  <div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-8 text-center">Products</h1>

		
   
		<div class="max-w-6xl mx-auto px-4 py-10">


  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <?php  
      $base_url = base_url('image/multi/');
      foreach($sc as $cart): 
    ?>
      <div class="bg-white shadow-md rounded-xl overflow-hidden p-4 flex flex-col items-center">
        <img src="<?= $base_url . $cart['pro_image']; ?>" alt="Product" class="w-32 h-32 object-contain mb-4" />
        <h2 class="text-lg font-semibold text-center mb-1"><?= $cart['pro_name']; ?></h2>
        <p class="text-gray-600 mb-3">₹<?= $cart['pro_price']; ?></p>
        <p class="text-gray-600 mb-3 overflow-hidden text-ellipsis whitespace-nowrap"><?= $cart['pro_discription']; ?></p>
        <div class="flex gap-2">
          <button 
            class="show-product-btn px-4 py-2 bg-black text-white text-sm rounded hover:bg-green-700"
            data-id="<?= $cart['pro_id']; ?>"
          >
            Show Product
          </button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
  $(document).on('click', '.show-product-btn', function () {
    const pid = $(this).data('id');
    window.location.href = '<?= base_url('product/Usershow/'); ?>' + pid;
  });
</script>

</body>
</html>
