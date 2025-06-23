<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wishlist</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Optional Cart Icon -->
<div class="p-4 flex justify-end">
  <div class="relative">
    <i class="fas fa-shopping-cart text-2xl"></i>
    <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">0</span>
  </div>
</div>

<!-- Wishlist Items -->
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg">
  <h2 class="text-xl font-semibold border-b px-6 py-4">My Wishlist (<?= count($cart_data); ?>)</h2>

  <?php 
    $base_url = base_url('image/multi/');
    foreach ($cart_data as $cart): 
  ?>
    <div class="flex items-start justify-between px-6 py-4 border-b">
      <div class="flex items-start space-x-4 w-full">
        <!-- Product Image -->
        <img src="<?= $base_url . $cart['pro_image']; ?>" alt="Product" class="w-24 h-24 object-cover rounded">

        <!-- Product Details -->
        <div class="flex-1">
          <h3 class="text-lg font-semibold"><?= $cart['pro_name']; ?></h3>
          <p class="text-sm text-gray-600"><?= $cart['pro_discription']; ?></p>
          <p class="mt-2 text-lg font-bold text-gray-900">₹<?= $cart['pro_price']; ?></p>
          
          <!-- Buttons -->
          <div class="flex space-x-4 mt-4">
            <button 
              class="add-to-cart bg-black text-white px-4 py-2 rounded hover:bg-yellow-500 transition"
              data-user-id="<?= $userget->id; ?>"
              data-pro-id="<?= $cart['pro_id']; ?>"
              data-pro-name="<?= htmlspecialchars($cart['pro_name'], ENT_QUOTES); ?>"
              data-pro-dis="<?= htmlspecialchars($cart['pro_discription'], ENT_QUOTES); ?>"
              data-pro-price="<?= $cart['pro_price']; ?>"
              data-pro-image="<?= $cart['pro_image']; ?>"
            >ADD TO CART</button>

            <button 
              class="delete-cart-item text-gray-500 hover:text-red-600 text-sm"
              data-cart-id="<?= $cart['w_id']; ?>"
            >🗑 Remove</button>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>






<script>
$(document).ready(function(){
  let prosize = null; // Size feature reserved

  // Add to Cart Handler
  $(document).on("click", ".add-to-cart", function(){
    const btn = $(this);
    const user_id = btn.data("user-id");

    if (!user_id) {
      alert("You need to login first.");
      return;
    }

    btn.prop("disabled", true).text("Adding...");

    $.ajax({
      url: "<?= base_url('cart/cart_web'); ?>",
      type: "POST",
      data: {
        user_id: user_id,
        pro_id: btn.data("pro-id"),
        pro_name: btn.data("pro-name"),
        pro_dis: btn.data("pro-dis"),
        pro_price: btn.data("pro-price"),
        pro_image: btn.data("pro-image"),
        pro_size: prosize
      },
      dataType: "json",
      success: function(response) {
        if (response.status === "success") {
          alert("Added to cart successfully!");
          const countEl = $("#cart-count");
          const currentCount = parseInt(countEl.text());
          countEl.text(currentCount + 1);
        } else {
          alert("Error: " + response.message);
        }
        btn.prop("disabled", false).text("ADD TO Cart");
      },
      error: function(xhr, status, error) {
        console.error("AJAX Error:", status, error);
        alert("Something went wrong.");
        btn.prop("disabled", false).text("ADD TO Cart");
      }
    });
  });

  // Delete Wishlist Item Handler
  $(".delete-cart-item").click(function(){
    const cartId = $(this).data("cart-id");

    if (!confirm("Are you sure you want to remove this item from wishlist?")) return;

    $.ajax({
      url: "<?= base_url('wishlist/delete_wishlist'); ?>",
      type: "POST",
      data: {wish_id: [cartId] },
      dataType: "json",
      success: function(response) {
        if (response.status === "success") {
          alert(response.message);
          location.reload(); // Optional: reload page or remove item from DOM
        } else {
          alert("Error: " + response.message);
        }
      },
      error: function() {
        alert("Error deleting item.");
      }
    });
  });
});
</script>

</body>
</html>
