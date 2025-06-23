<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Category</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">

  <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Update product</h2>
	

    <form action="<?='http://192.168.1.170/api/product/uppro' ?>" method="POST" enctype="multipart/form-data" class="space-y-6">

		<div>
       
        <input type="hidden" name="id" value="<?= $prodata['pro_id']?>" id="name" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" required>
      </div>
			<div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Products brand Name</label>
        <input type="text" name="pro_brand" id="name" value="<?= $prodata['pro_brand']?>" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" required>
      </div>
     
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Products Name</label>
        <input type="text" name="pro_name" id="name" value="<?= $prodata['pro_name']?>" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" required>
      </div>
			<div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Products discription</label>
        <input type="text" name="pro_discription" id="name" value="<?= $prodata['pro_discription']?>" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" required>
      </div>
     
	  	<div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Category id</label>
        <input name="co-id" id="description" value="<?= $prodata['co-id']?>" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" required></>
      </div>
			<div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">SubCategory id</label>
        <input name="sc_id" id="description" value="<?= $prodata['sc_id']?>" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" required></>
      </div>
			<div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">product price</label>
        <input name="pro_price" id="description" value="<?= $prodata['pro_price']?>"  rows="4" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" required></>
      </div>
			<div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">product Size</label>
        <input name="pro_size" id="size" value="<?= $prodata['pro_size']?>" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" required></>
      </div>

			
			<div class="mb-4">
      <label for="colorInput" class="block mb-2 text-sm font-medium text-gray-700">Pick a color:</label>
      <input type="color" id="colorInput" class="w-16 h-10 p-0 border rounded" />
      <button type="button" onclick="addColor()" class="ml-2 px-3 py-1 bg-blue-600 text-white rounded">Add</button>
    </div>



    <!-- Hidden field to store all selected colors -->
    <input type="hidden" name="color_names" id="color_names">

    <!-- Display selected colors -->
    <div id="selectedColors" class="flex flex-wrap gap-2 mb-4"></div>

    <!-- Preview string field -->
    <label for="colorPreview" class="block mb-2 text-sm font-medium text-gray-700">Selected Colors:</label>
    <input type="text" id="colorPreview" name='color' readonly class="w-full p-2 border rounded bg-white text-gray-700">

    
       
      <div >
		<img src="<?= $prodata['pro_image']?>" alt="" class="w-24  h-24 ">
        <label for="sub-image" class="block text-sm font-medium text-gray-700 mb-1">product Image</label>
        <input type="file" name="pro_image" id="proimage" accept="image/*" class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
      </div>

			<div class="flex">
			<?php 
				$images = explode(',', $prodata['multi_img']); 
				foreach($images as $img): ?>
				
					<img src="<?= $img ?>" alt="" class="flex space-x-2 mt-2 w-24 h-24 ">
			<?php endforeach ?>
			</div>

         <div class="mt-4">
        <label for="sub-image" class="block text-sm font-medium text-gray-700 mb-1">Multi image</label>
        <input type="file" name="multi_img[]" id="mulimage" accept="image/*" multiple class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
      </div>

	  <div id="colorOptions" class="flex space-x-2 mt-2">
    <?php 
        $colorImages = json_decode($prodata['color_img'], true);
        foreach ($colorImages as $color => $img) {
            echo "<div class='text-center'>";
            echo "<img src='$img' alt='' class='w-24 h-24 mb-1'>";
            echo "<button class='color-btn w-8 h-8 rounded-full border' 
                    data-img='$img' style='background-color: $color;'></button>";
            echo "</div>";
        }
    ?>
</div>


			<div>
        <label for="sub-image" class="block text-sm font-medium text-gray-700 mb-1">Color image</label>
        <input type="file" name="color_img[]" id="mulimage" accept="image/*" multiple class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
      </div>

			

			<div id="image-preview" class="mt-4 flex flex-wrap gap-4"></div>
			<script>
			document.getElementById('mulimage').addEventListener('change', function (event) {
				const files = event.target.files;
				const preview = document.getElementById('image-preview');
				preview.innerHTML = ''; // Clear previous previews

				Array.from(files).forEach(file => {
					const reader = new FileReader();
					reader.onload = function (e) {
						const img = document.createElement('img');
						img.src = e.target.result;
						img.classList.add('w-24', 'h-24', 'object-cover', 'rounded', 'border');
						preview.appendChild(img);
					};
					reader.readAsDataURL(file);
				});
			});
		</script>


<script>
    const selected = [];

    function addColor() {
      const color = document.getElementById('colorInput').value;
      if (!selected.includes(color)) {
        selected.push(color);
        updateDisplay();
      }
    }

    function removeColor(hex) {
      const index = selected.indexOf(hex);
      if (index !== -1) {
        selected.splice(index, 1);
        updateDisplay();
      }
    }

    function updateDisplay() {
      const display = document.getElementById('selectedColors');
      const preview = document.getElementById('colorPreview');
      const hidden = document.getElementById('color_names');

      display.innerHTML = '';
      selected.forEach(color => {
        const span = document.createElement('span');
        span.className = 'flex items-center gap-1 px-2 py-1 text-sm rounded text-white';
        span.style.backgroundColor = color;
        span.innerHTML = `${color} <button onclick="removeColor('${color}')" class="ml-1 text-xs">✕</button>`;
        display.appendChild(span);
      });

      // Display like: '#eb4034', '#000000'
      preview.value = selected.map(c => `'${c}'`).join(', ');
      hidden.value = selected.join(','); // for submission
    }
  </script>

	  


      <div class="flex justify-end">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
          Save Product
        </button>
      </div>

    </form>
  </div>

</body>
</html>
