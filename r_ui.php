<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Wishlist</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
  <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold border-b px-6 py-4">My Wishlist (5)</h2>
    
    <!-- Wishlist Item -->
    <div class="flex items-center justify-between px-6 py-4 border-b">
      <div class="flex items-center space-x-4">
        <img src="https://via.placeholder.com/80" class="w-20 h-20 object-cover rounded" alt="Product">
        <div>
          <h3 class="font-medium">Robbie Jones Men Sandals</h3>
          <div class="flex items-center space-x-2 text-sm">
            <span class="text-lg font-semibold text-gray-900">₹467</span>
            <span class="line-through text-gray-500">₹1,999</span>
            <span class="text-green-600 font-semibold">76% off</span>
          </div>
        </div>
      </div>
      <button class="text-gray-400 hover:text-red-600">
        🗑️
      </button>
    </div>

    <!-- Wishlist Item - Currently Unavailable -->
    <div class="flex items-center justify-between px-6 py-4 border-b">
      <div class="flex items-center space-x-4">
        <img src="https://via.placeholder.com/80" class="w-20 h-20 object-cover rounded" alt="Product">
        <div>
          <h3 class="font-medium">WROGN Unisex Bag with rain cover</h3>
          <div class="flex items-center space-x-2 text-sm">
            <span class="text-lg font-semibold text-gray-900">₹899</span>
            <span class="line-through text-gray-500">₹4,999</span>
            <span class="text-green-600 font-semibold">82% off</span>
          </div>
          <div class="text-pink-600 text-sm mt-1">Currently unavailable</div>
        </div>
      </div>
      <button class="text-gray-400 hover:text-red-600">
        🗑️
      </button>
    </div>

    <!-- Add more items here using the same structure -->

  </div>
</body>
</html>
