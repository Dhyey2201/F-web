<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FASCO Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white rounded-lg shadow-md w-full max-w-6xl flex overflow-hidden">
    
    <!-- Left: Image -->
	<div class="w-1/2 hidden md:block">
  <img src="../image/banner/54_8558553c-a9dd-4474-bc2b-6707343dacbe.jpg@2x (1).png" alt="Hero" class="w-full h-[650px] object-cover" />
</div>

    <!-- Right: Register Form -->
    <div class="w-full md:w-1/2 p-10">
      <h2 class="text-3xl font-semibold text-center text-gray-800 mb-2">F-Web</h2>
      <p class="text-gray-600 mb-6 text-center">Create Account</p>

      <!-- Social Login -->
      

      <div class="flex items-center justify-center mb-6">
      
      </div>

      <!-- Registration Form -->
      <form action="http://192.168.1.170/api/user_post1" class="mt-6" method="post">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <input type="text" name="username" placeholder="First Name" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" />
         
          <input type="email" name="email" placeholder="Email Address" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" />
          <input type="text" name="contect_number" placeholder="Phone Number" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" />
          <input type="password"  name="password" placeholder="Password" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" />
          <input type="password" name="confirm_password" placeholder="Confirm Password" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring focus:border-blue-300" />
					<input name="address" type="text" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="123 Street, City">
        </div>
        <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800 mt-6 mb-3">Create Account</button>
      
      </form>

      <p class="text-xs text-gray-400 text-center mt-6">F-Web Terms & Conditions</p>
    </div>
  </div>
</body>
</html>
