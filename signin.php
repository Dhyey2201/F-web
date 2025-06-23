<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FASCO Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white rounded-lg shadow-md w-full max-w-5xl flex overflow-hidden">
    
    <!-- Left: Image -->
    <div class="w-1/2 hidden md:block">
		<img src="<?php echo base_url('image/banner/image (10).png'); ?>" alt="Hero" class="w-full h-full object-cover" />

    </div>

    <!-- Right: Login Form -->
    <div class="w-full md:w-1/2  p-10">
      <h2 class="text-3xl font-semibold text-center text-gray-800 mb-2">F-Web</h2>
      <p class="text-gray-600 text-center  mb-6">Sign In To F-Web</p>

      <!-- Social Login -->
      <div class="flex gap-4 mb-6 justify-center">
			<a href="<?php echo base_url('googlesignin/login'); ?>" 
                class="flex items-center justify-center gap-2 p-2 bg-white border border-gray-300 rounded-lg shadow hover:bg-gray-100 transition">
                <img src="https://developers.google.com/identity/images/g-logo.png" class="w-6 h-6">
                <span class="text-gray-700 font-medium">Sign in with Google</span>
            </a>

      </div>

      <div class="flex items-center justify-center mb-6">
        <div class="border-b w-1/5"></div>
        <span class="mx-3 text-gray-500">OR</span>
        <div class="border-b w-1/5"></div>
      </div>

      <!-- Login Form -->
      <form action="<?php echo base_url('api/loginweb')?>" method="POST">
        <div class="mb-4">
          <label class="block text-sm text-gray-700 mb-1">Email</label>
          <input type="email" id="email" name="email" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" placeholder="Enter your email" />
        </div>
        <div class="mb-4">
          <label class="block text-sm text-gray-700 mb-1">Password</label>
          <input type="password" id="password" name="password" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" placeholder="Enter your password" />
        </div>
        <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800 mb-3">Sign in</button>
        <div class="flex justify-between text-sm">
        
     
        </div>
      </form>
	  <a href="<?= base_url('api/main') ?>" class="text-blue-600 hover:underline">Register Now</a>


			

      <p class="text-xs text-gray-400 text-center mt-6">F-Web Terms & Conditions</p>
    </div>
  </div>
</body>
</html>
