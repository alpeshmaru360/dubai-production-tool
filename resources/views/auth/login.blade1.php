<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dubai Production Tool</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Style */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            overflow: hidden;
            position: relative;
        }

        /* Decorative Background Elements */
        .background-decor {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .background-decor div {
            position: absolute;
            background: rgba(10, 161, 180, 0.2);
            border-radius: 50%;
            filter: blur(50px);
            animation: float 10s ease-in-out infinite;
        }

        .background-decor .circle1 {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 15%;
        }

        .background-decor .circle2 {
            width: 150px;
            height: 150px;
            bottom: 20%;
            right: 10%;
        }

        /* Floating Animation */
        @keyframes float {
            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Container */
        .container {
            display: flex;
            flex-direction: column; /* Column direction for title and card */
            align-items: center; /* Center align items */
            height: auto; /* Changed to auto for better responsiveness */
            width: 100%;
            position: relative;
            z-index: 1;
            padding: 20px; /* Added padding for small screens */
        }

        /* Login Box */
        .login-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px; /* Set max width for large screens */
            backdrop-filter: blur(8px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            position: relative;
            margin-top: 20px; /* Added margin for spacing between title and card */
        }

        /* Title Style */
        .title {
            font-size: 38px;
            font-weight: 600;
            color: #0aa1b4;
            text-align: center; /* Centered text */
            z-index: 1;
        }

        .login-box h2 {
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
            color: #0aa1b4;
        }

        /* Input Group */
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #ddd;
            border-radius: 25px;
            background: #fff;
            outline: none;
            font-size: 16px;
            transition: all 0.3s ease;
            color: #333;
            font-weight: 500;
            position: relative;
        }

        .input-group input:focus {
            border-color: #0aa1b4;
            background: #f0f8fa;
            box-shadow: 0 0 8px rgba(10, 161, 180, 0.5);
        }

        .input-group label {
            position: absolute;
            left: 20px;
            top: 15px;
            color: #aaa;
            pointer-events: none;
            transition: all 0.3s;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: -10px;
            left: 15px;
            color: #0aa1b4;
            font-size: 12px;
        }

        /* Button Styling */
        .login-btn {
            width: 100%;
            padding: 15px;
            border: none;
            background: linear-gradient(135deg, #0aa1b4, #43c6ac);
            color: #fff;
            font-size: 16px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .login-btn::after {
            content: '';
            position: absolute;
            width: 300%;
            height: 300%;
            top: 50%;
            left: 50%;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: width 0.5s, height 0.5s, top 0.5s, left 0.5s;
            z-index: 0;
            transform: translate(-50%, -50%) scale(0);
        }

        .login-btn:hover::after {
            width: 400%;
            height: 400%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1);
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #43c6ac, #0aa1b4);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Forgot Password and Checkbox */
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .login-options a {
            color: #0aa1b4;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .login-options a:hover {
            color: #43c6ac;
        }

        .login-options label {
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .login-options input[type="checkbox"] {
            margin-right: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-box {
                width: 90%;
                padding: 20px;
            }

            .title {
                font-size: 28px;
            }

            .login-box h2 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 15px;
            }

            .title {
                font-size: 24px;
            }

            .login-box h2 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Decorative Background Elements -->
    <div class="background-decor">
        <div class="circle1"></div>
        <div class="circle2"></div>
    </div>

    <div class="container">
        <div class="title">Dubai Production Tool</div> <!-- Title is now above the login box -->
        <div class="login-box">
            <h2>Login</h2>
            <form method="POST" action="{{ route('AuthLogin') }}">
                {{ csrf_field() }}
                <div class="input-group">
                    <input name="email" type="text" placeholder=" " required>
                    <label>Email Address</label>
                </div>

                <div class="input-group">
                    <input name="password" type="password" placeholder=" " required>
                    <label>Password</label>
                </div>

                <button type="submit" class="login-btn">Login</button>

                <div class="login-options">
                    <label>
                        <input type="checkbox" name="remember"> Keep me logged in
                    </label>
                    <a href="#">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
