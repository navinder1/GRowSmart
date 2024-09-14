<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GrowSmart - Login/Register</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 400px;
        width: 100%;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .form-container {
        display: none;
    }
    .form-container.active {
        display: block;
    }
    .form-container h2 {
        margin-bottom: 20px;
    }
    .form-container form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .form-container label {
        font-weight: bold;
    }
    .form-container input[type="text"],
    .form-container input[type="password"],
    .form-container input[type="email"] {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .form-container input[type="submit"] {
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .form-container input[type="submit"]:hover {
        background-color: #45a049;
    }
    .form-container p {
        text-align: center;
    }
    .form-container p a {
        color: #4CAF50;
        text-decoration: none;
    }
    .form-container p a:hover {
        text-decoration: underline;
    }
    .error-message {
        color: red;
        text-align: center;
    }
    .toggle-btns {
        text-align: center;
        margin-top: 20px;
    }
</style>
</head>
<body>

<div class="container">
    <!-- Login Form -->
    <div id="login-form" class="form-container active">
        <h2>Login</h2>
        <form method="POST" action="">
            <label for="login-username">Username:</label>
            <input type="text" id="login-username" name="username" required>
            <label for="login-password">Password:</label>
            <input type="password" id="login-password" name="password" required>
            <input type="submit" value="Login">
            
            <?php
            session_start();
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "project";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
                $user = $_POST['username'];
                $pass = $_POST['password'];

                $sql = "SELECT * FROM users WHERE username='$user'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if (password_verify($pass, $row['password'])) {
                        $_SESSION['username'] = $user;
                        header("Location: profile.php");
                        exit();
                    } else {
                        echo '<p class="error-message">Invalid password</p>';
                    }
                } else {
                    echo '<p class="error-message">No user found with that username</p>';
                }
            }

            $conn->close();
            ?>
        </form>
        <div class="toggle-btns">
            <p>Don't have an account? <a href="#" onclick="showRegister()">Register here.</a></p>
            <p><a href="#" onclick="showForgotPassword()">Forgot Password?</a></p>
        </div>
    </div>

    <!-- Registration Form -->
    <div id="register-form" class="form-container">
        <h2>Register</h2>
        <form method="POST" action="">
            <label for="register-username">Username:</label>
            <input type="text" id="register-username" name="username" required>
            <label for="register-password">Password:</label>
            <input type="password" id="register-password" name="password" required>
            <label for="register-email">Email:</label>
            <input type="email" id="register-email" name="email" required>
            <input type="submit" value="Register">
            <?php

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
                $user = $_POST['username'];
                $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $email = $_POST['email'];

                $sql = "INSERT INTO users (username, password, email) VALUES ('$user', '$pass', '$email')";

                if ($conn->query($sql) === TRUE) {
                    $_SESSION['username'] = $user;
                    header("Location: profile.php");
                    exit();
                } else {
                    echo '<p class="error-message">Error: ' . $conn->error . '</p>';
                }
            }

            $conn->close();
            ?>
        </form>
        <div class="toggle-btns">
            <p>Already have an account? <a href="#" onclick="showLogin()">Login here.</a></p>
        </div>
    </div>

    <!-- Forgot Password Form -->
    <div id="forgot-password-form" class="form-container">
        <h2>Forgot Password</h2>
        <form method="POST" action="send_reset_email.php">
            <label for="forgot-email">Enter your email:</label>
            <input type="email" id="forgot-email" name="email" required>
            <input type="submit" value="Send Reset Link">
        </form>
        <div class="toggle-btns">
            <p><a href="#" onclick="showLogin()">Back to Login</a></p>
        </div>
    </div>
</div>

<script>
    function showLogin() {
        document.getElementById('login-form').classList.add('active');
        document.getElementById('register-form').classList.remove('active');
        document.getElementById('forgot-password-form').classList.remove('active');
    }

    function showRegister() {
        document.getElementById('register-form').classList.add('active');
        document.getElementById('login-form').classList.remove('active');
        document.getElementById('forgot-password-form').classList.remove('active');
    }

    function showForgotPassword() {
        document.getElementById('forgot-password-form').classList.add('active');
        document.getElementById('login-form').classList.remove('active');
        document.getElementById('register-form').classList.remove('active');
    }
</script>

    <!-- Registration Form -->
    <div id="register-form" class="form-container">
        <h2>Register</h2>
        <form method="POST" action="">
            <label for="register-username">Username:</label>
            <input type="text" id="register-username" name="username" required>
            <label for="register-password">Password:</label>
            <input type="password" id="register-password" name="password" required>
            <label for="register-email">Email:</label>
            <input type="email" id="register-email" name="email" required>
            <input type="submit" value="Register">
            <?php

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
                $user = $_POST['username'];
                $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $email = $_POST['email'];

                $sql = "INSERT INTO users (username, password, email) VALUES ('$user', '$pass', '$email')";

                if ($conn->query($sql) === TRUE) {
                    $_SESSION['username'] = $user;
                    header("Location: profile.php");
                    exit();
                } else {
                    echo '<p class="error-message">Error: ' . $conn->error . '</p>';
                }
            }

            $conn->close();
            ?>
        </form>
        <div class="toggle-btns">
            <p>Already have an account? <a href="#" onclick="showLogin()">Login here.</a></p>
        </div>
    </div>
</div>

<script>
    function showLogin() {
        document.getElementById('login-form').classList.add('active');
        document.getElementById('register-form').classList.remove('active');
    }

    function showRegister() {
        document.getElementById('register-form').classList.add('active');
        document.getElementById('login-form').classList.remove('active');
    }
</script>

</body>
</html>
