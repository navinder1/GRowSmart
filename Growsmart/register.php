<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$user', '$pass', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Start session and redirect to profile page
        session_start();
        $_SESSION['username'] = $user;
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowSmart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
      /*  background-image: url('OIP (1).jpeg');
        background-size: cover; /* Ensures the image covers the entire page */
        background-position: center; /* Centers the image */
        background-repeat: no-repeat;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    header {
        position: relative;
        /*background-color: #fafcfc;*/
        color: #000;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #ddd;
    }
    .left-section {
        display: flex;
        align-items: center;
        flex: 1;
    }
    .left-section img{
        max-width: 230px;
        margin-right: 10px;
    }
    .right-section {
        display: flex;
        align-items: center;
        flex: 1;
        justify-content: flex-end;
    }
    .right-section a, .right-section span {
        color: #000;
        text-decoration: none;
        font-size: 20px;
        margin-left: 20px;
        display: flex;
        align-items: center;
        transition: color 0.3s;
    }
    .right-section a:hover{
        color:green;
    }
     .right-section span:hover {
        color: green;
    }
    .search-bar {
        flex: 1;
        display: flex;
        justify-content: center;
        margin: 10px;
        border-radius: 3px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .search-bar input[type="text"] {
        padding: 8px;
        font-size: 16px;
        border: none;
        border-radius: 3px 0 0 3px;
        outline: none;
        width: 100%;
        max-width: 400px; /* Adjust max-width as needed */
    }
    .search-bar button {
        padding: 8px 12px;
        font-size: 16px;
        border: none;
        border-radius: 0 3px 3px 0;
        background: color #000;;
        color: #4CAF50;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .search-bar button:hover {
        background-color: #f1f1f1;
    }
    @media (max-width: 768px) {
        .left-section h1 {
            font-size: 20px;
        }
        .search-bar {
            margin: 10px 0;
        }
        .search-bar input[type="text"] {
            max-width: 250px;
        }
        .right-section {
            margin-top: 10px;
            justify-content: flex-end;
        }
        .right-section a, .right-section span {
            font-size: 18px;
            margin-left: 15px;
        }
    }
    @media (max-width: 480px) {
        header {
            flex-direction: column;
            align-items: flex-start;
        }
        .search-bar {
            width: 100%;
            margin-top: 10px;
        }
        .right-section {
            width: 100%;
            justify-content: flex-end;
            margin-top: 10px;
        }
        .right-section a, .right-section span {
            margin-left: 10px;
            font-size: 16px;
        }
    }
    </style>
    <head>
<body>

<header>
    <div class="left-section">
        <a href="home.php">
            <img src="download (1).png" alt="click on image" class="logo">
        </a>
    </div>
    <!--<form action="" method="get" class="search-bar">
        <input type="text" name="query" placeholder="Search..." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>-->
    <div class="right-section">
        <a href="login.php" class="login" title="Login"><i class="fas fa-sign-in-alt"></i></a>
        <a href="profile.php" class="login" title="Login"><i class="fa fa-user"></i></a>
        <span class="cart" title="Cart"><i class="fas fa-shopping-cart"></i></span>
        <span class="menu" title="Menu"><i class="fas fa-bars"></i></span>
    </div>
</header>
    <h2>Register</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Register">
    </form>
    <p><a href="login.php">Already have an account? Login here.</a></p>
</body>
</html>
