<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* Import Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Center the login form */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg #900c3f, #764ba2); /* Gradient background */
        }

        /* Login Container */
        .login-container {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        /* Form Title */
        .login-form h2 {
            margin-bottom: 15px;
            font-size: 22px;
            color: #333;
        }

        /* Input Fields */
        .input-group {
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            transition: border 0.3s ease-in-out;
        }

        .input-group input:focus {
            border: 2px solid #667eea;
        }

        /* Login Button */
        button {
            background:#900c3f;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease-in-out;
        }

        button:hover {
            background: rgb(255, 180, 180);;
        }

        /* Forgot Password */
        .forgot-password {
            margin-top: 10px;
        }

        .forgot-password a {
            text-decoration: none;
            color: #900c3f	;
            font-size: 14px;
        }

        .forgot-password a:hover {
            color: rgb(119, 182, 224);;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <form action="<?php echo base_url('api/user_login'); ?>" method="POST" class="login-form">
            <h2>Admin Login</h2>
            <div class="input-group">
                <input type="text" id="email" placeholder="email" name="email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
            <p class="forgot-password"><a href="#">Forgot Password?</a></p>
        </form>
    </div>

</body>
</html>
