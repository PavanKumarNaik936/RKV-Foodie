<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up/Login</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image:url("loginbg.jpg");
            background-repeat: no-repeat;
            background-size: 1350px 100%;
            height:485px;
            width:1350px;
        }

        .container {
            
            display: grid;
            grid-template-columns: 1fr 2fr;
            background: linear-gradient(to bottom, rgb(6, 108, 100), rgb(14, 48, 122));
            width: 800px;
            height: 400px;
            margin: 10% auto;
            border-radius: 5px;
        }

        .content-holder {
            
            text-align: center;
            color: white;
            font-size: 14px;
            font-weight: lighter;
            letter-spacing: 2px;
            margin-top: 15%;
            padding: 50px;
        }

        .content-holder h2 {
            font-size: 34px;
            margin: 20px auto;
        }

        .content-holder p {
            margin: 30px auto;
        }

        .content-holder button {
            border: none;
            font-size: 15px;
            padding: 10px;
            border-radius: 6px;
            background-color: white;
            width: 150px;
            margin: 20px auto;
        }

        .box-2 {
            background-color: white;
            margin: 5px;
        }

        .login-form-container, .signup-form-container {
            text-align: center;
            margin-top: 10%;
        }

        .login-form-container h1, .signup-form-container h1 {
            color: black;
            font-size: 24px;
            padding: 20px;
        }

        .input-field {
            box-sizing: border-box;
            font-size: 14px;
            padding: 10px;
            border-radius: 7px;
            border: 1px solid rgb(168, 168, 168);
            width: 250px;
            outline: none;
        }

        .login-button, .signup-button {
            box-sizing: border-box;
            color: white;
            font-size: 14px;
            padding: 13px;
            border-radius: 7px;
            border: none;
            width: 250px;
            outline: none;
        }

        .login-button {
            background-color: rgb(56, 102, 189);
        }

        .signup-button {
            background-color: rgb(56, 189, 149);
        }

        .button-2 {
            display: none;
        }

        .signup-form-container {
            position: relative;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -60%);
            text-align: center;
            display: none;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Data or Content -->
        <div class="box-1">
            <div class="content-holder">
                <h2>Hello!</h2>
                <button class="button-1" onclick="signup()">Sign up</button>
                <button class="button-2" onclick="login()">Login</button>
            </div>
        </div>

        <!-- Forms -->
        <div class="box-2">
            <div class="login-form-container">
                <h1>Login Form</h1>
                <form action="login_process.php" method="post">
                    <input type="text" name="username" placeholder="Username" class="input-field" required>
                    <br><br>
                    <input type="password" name="password" placeholder="Password" class="input-field" required>
                    <br><br>
                    <button class="login-button" type="submit">Login</button>
                    <?php
                    if (isset($_GET['error'])) {
                        echo '<div class="error-message">' . htmlspecialchars($_GET['error']) . '</div>';
                    }
                    ?>
                </form>
            </div>

            <!-- Create Container for Signup form -->
            <div class="signup-form-container">
                <h1>Sign Up Form</h1>
                <form action="signup_process.php" method="post">
                    <input type="text" name="username" placeholder="Username" class="input-field" required>
                    <br><br>
                    <input type="email" name="email" placeholder="Email" class="input-field" required>
                    <br><br>
                    <input type="password" name="password" placeholder="Password" class="input-field" required>
                    <br><br>
                    <input type="tel" name="phone" placeholder="mobile" class="input-field" pattern="[0-9]{10}" required>
                    <br><br>
                    <textarea name="address" placeholder="Address" class="input-field" required></textarea>
                    <br><br>
                    <button class="signup-button" type="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function signup() {
            document.querySelector(".login-form-container").style.display = "none";
            document.querySelector(".signup-form-container").style.display = "block";
            document.querySelector(".container").style.background = "linear-gradient(to bottom, rgb(56, 189, 149), rgb(28, 139, 106))";
            document.querySelector(".button-1").style.display = "none";
            document.querySelector(".button-2").style.display = "block";
        }

        function login() {
            document.querySelector(".signup-form-container").style.display = "none";
            document.querySelector(".login-form-container").style.display = "block";
            document.querySelector(".container").style.background = "linear-gradient(to bottom, rgb(6, 108, 224), rgb(14, 48, 122))";
            document.querySelector(".button-2").style.display = "none";
            document.querySelector(".button-1").style.display = "block";
        }
    </script>
</body>
</html>
