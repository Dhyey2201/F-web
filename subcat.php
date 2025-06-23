<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Category</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">

  <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Category</h2>

    <form action="<?='http://192.168.1.170/api/sc_controller/scin' ?>" method="POST" enctype="multipart/form-data" class="space-y-6 border-black rounded-xl">

     
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">SubCategory Name</label>
        <input type="text" name="sc_name" id="name" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 border border-black rounded-xl focus:border-blue-500" required>
      </div>

     
	  <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Category id</label>
        <input name="co-id" id="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500  border-black rounded-xl focus:border-blue-500" required></>
      </div>

      
      <div>
        <label for="sub-image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
        <input type="file" name="sc_image" id="co-image" accept="image/*" class="w-full text-sm  border-black rounded-xl text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
      </div>

	  


      <div class="flex justify-end">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
          Save SubCategory
        </button>
      </div>

    </form>
  </div>

</body>
</html>
