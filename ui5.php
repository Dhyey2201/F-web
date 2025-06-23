<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile Settings</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</head>

<body class="bg-gray-100">
	<div class="container  lg:mx-auto p-4 lg:flex">
		<div class="w-full md:w-1/4 mt-6 md:pr-4">

			<div class="bg-white rounded-lg shadow-md p-4 md:p-6 mb-4">
				<div class="flex flex-col items-center">
					<!-- Yellow Circle with the First Letter -->
					<div class="bg-black rounded-full w-16 h-16 flex items-center justify-center mb-2">
						<span id="initial" class="text-white text-3xl font-semibold"></span>
					</div>

					<div class="text-center">
						<p class="text-gray-600 text-sm">Hello,</p>
						<div class="flex items-center justify-center">
							<h2 class="text-gray-800 font-semibold text-lg" id="full-name"><?php echo $udata->username ?></h2>
						</div>
					</div>
				</div>
			</div>

			<!-- Sidebar -->
			<div class="bg-white rounded-lg shadow-md">
				<div class="border-b border-gray-200">
					<div class="flex items-center p-4 hover:bg-gray-50 cursor-pointer">
						<div class="bg-blue-100 p-2 rounded mr-3">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
								<path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
								<path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
							</svg>
						</div>
						<a href="<?php echo base_url('order/history') ?>" class="font-medium text-gray-700">
							My Orders
						</a>
					</div>
				</div>

				<div class="border-b border-gray-200">
					<div class="flex items-center p-4 hover:bg-gray-50 cursor-pointer">
						<div class="bg-blue-100 p-2 rounded mr-3">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
								<path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
							</svg>
						</div>
						<span class="font-medium text-gray-700">ACCOUNT SETTINGS</span>
						<span class="ml-auto text-gray-400">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
								<path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
							</svg>
						</span>
					</div>
				</div>

				<div class="flex items-center p-4 hover:bg-gray-50 cursor-pointer">
					<div class="bg-blue-100 p-2 rounded mr-3">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
							<path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7z" />
							<path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 5a1 1 0 00-1 1v2a1 1 0 002 0v-2a1 1 0 00-1-1zm3 0a1 1 0 00-1 1v2a1 1 0 002 0v-2a1 1 0 00-1-1zm3 0a1 1 0 00-1 1v2a1 1 0 002 0v-2a1 1 0 00-1-1z" clip-rule="evenodd" />
						</svg>
					</div>
					<a href="signin" class="font-medium text-gray-700">Logout</a>
				</div>
			</div>

			<div class="p-4 md:p-6 mb-4 mt-4">
				<img src="<?php echo base_url('image/banner/image 2 28.png'); ?>" class="w-full h-auto object-cover rounded-lg">
			</div>
		</div>



		<script>
			const fullName = document.getElementById('full-name').textContent;
			const firstLetter = fullName.charAt(0).toUpperCase();
			document.getElementById('initial').textContent = firstLetter;
		</script>


		<!-- Main Content -->
		<main class="w-full md:flex-1 p-4 sm:p-5 md:p-6">
  <form id="updateProfileForm" method="post" >
    <div class="bg-white p-4 sm:p-5 md:p-6 rounded-lg shadow-md space-y-6">

      <!-- Personal Info -->
      <div class="bg-white rounded-lg shadow-md border border-gray-300 p-4 sm:p-5 md:p-6">
        <h2 class="text-lg sm:text-xl font-semibold mb-4">Personal Information</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <input type="hidden" name="id" value="<?php echo $udata->id ?>" class="border p-2 w-full rounded">
          <input type="text" name="username" value="<?php echo $udata->username ?>" class="border p-2 w-full rounded" placeholder="Username">
        </div>

        <div class="mb-4">
          <span class="block mb-2 font-medium text-gray-700">Your Gender</span>
          <div class="flex items-center gap-6">
            <label class="flex items-center">
              <input type="radio" name="gender" value="Male" class="mr-2" checked> Male
            </label>
            <label class="flex items-center">
              <input type="radio" name="gender" value="Female" class="mr-2"> Female
            </label>
          </div>
        </div>
      </div>

      <!-- Email -->
      <div class="bg-white rounded-lg border shadow-md border-gray-300 p-4 sm:p-5 md:p-6">
        <div class="mb-4">
          <h3 class="font-semibold text-base sm:text-lg">Email Address</h3>
          <input type="email" name="email" value="<?php echo $udata->email ?>" class="border p-2 w-full rounded mt-2" placeholder="Email">
        </div>
      </div>

      <!-- Mobile -->
      <div class="bg-white rounded-lg border shadow-md border-gray-300 p-4 sm:p-5 md:p-6">
        <div class="mb-4">
          <h3 class="font-semibold text-base sm:text-lg">Mobile Number</h3>
          <input type="text" name="contect_number" value="<?php echo $udata->contect_number ?>" class="border p-2 w-full rounded mt-2" placeholder="Mobile Number">
        </div>
      </div>

      <!-- Address -->
      <div class="bg-white border border-gray-300 shadow-md rounded-lg p-4 sm:p-5 md:p-6">
        <div class="mb-4">
          <h3 class="font-semibold text-base sm:text-lg mb-2">Address</h3>
          <input type="text" name="address" value="<?php echo $udata->address ?>" class="border p-2 pr-10 w-full rounded mt-2" placeholder="Enter your address">
        </div>

        <button onclick="window.location.href='<?php echo base_url('LeafletMap/index') ?>'" type="button"
          class="mt-4 bg-black text-white px-4 py-2 w-full sm:w-auto rounded hover:bg-blue-700 transition">
          <i class="fas fa-map-marker-alt text-white text-xl mr-2"></i>Select Location
        </button>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-center sm:justify-end">
        <button type="submit" class="bg-black text-white w-full sm:w-[220px] px-4 py-2 rounded hover:bg-gray-800 transition">
          Update
        </button>
      </div>

    </div>
  </form>
</main>

		<!-- FontAwesome -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

		<!-- Set address from localStorage -->
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				var locationData = JSON.parse(localStorage.getItem("locationData"));
				if (locationData && locationData.address) {
					document.querySelector("input[name='address']").value = locationData.address;
				}
			});
		</script>


		<!-- FontAwesome -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

		<!-- Set address from localStorage -->
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				var locationData = JSON.parse(localStorage.getItem("locationData"));
				if (locationData && locationData.address) {
					document.querySelector("input[name='address']").value = locationData.address;
				}
			});
		</script>

	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#updateProfileForm").submit(function(e) {
				e.preventDefault();

				$.ajax({
					url: "<?php echo base_url('api/update_user'); ?>",
					type: "POST",
					data: $(this).serialize(),
					dataType: "json",
					success: function(response) {
						console.log(response);

						if (response.success) {
							alert(response.message || "Profile updated successfully!");
							window.location.reload(true);
						} else {
							alert(response.message || "Profile update failed.");
						}
					},
					error: function() {
						alert(response.message || "Profile update failed.");
					}
				});
			});
		});
	</script>








</body>

</html>
