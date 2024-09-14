<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
} else {
    echo "No user found";
    exit();
}
$order_sql = "SELECT * FROM orders WHERE user_id = $user_id";
$order_result = $conn->query($order_sql);

$conn->close();
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
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f9f9f9;
}

header {
    background-color: #fff;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 2px solid #eee;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.left-section {
    display: flex;
    align-items: center;
}

.left-section img {
    max-width: 150px;
    margin-right: 15px;
}

.right-section {
    display: flex;
    align-items: center;
}

.right-section a, .right-section span {
    color: #333;
    text-decoration: none;
    font-size: 18px;
    margin-left: 20px;
    display: flex;
    align-items: center;
    transition: color 0.3s, transform 0.3s;
}

.right-section a:hover, .right-section span:hover {
    color: #4CAF50;
    transform: scale(1.1);
}

.search-bar {
    flex: 1;
    display: flex;
    justify-content: center;
    margin: 10px 20px;
    border-radius: 5px;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.search-bar input[type="text"] {
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px 0 0 5px;
    outline: none;
    width: 100%;
    max-width: 400px;
}

.search-bar button {
    padding: 10px 15px;
    font-size: 16px;
    border: none;
    border-radius: 0 5px 5px 0;
    background-color: #4CAF50;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

.search-bar button:hover {
    background-color: #45a049;
}

.profile-container {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.profile-container h2 {
    margin-bottom: 15px;
    color: #333;
}

.profile-pic {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
    border: 2px solid #4CAF50;
}

.profile-container p {
    margin: 8px 0;
    font-size: 16px;
    color: #555;
}

.profile-container a {
    color: #4CAF50;
    text-decoration: none;
    transition: color 0.3s;
}

.profile-container a:hover {
    color: #388e3c;
}

.profile1 {
    margin: 20px;
}

.profile1 input[type="file"] {
    padding: 8px;
    margin-top: 10px;
}

.profile1 button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}

.profile1 button:hover {
    background-color: #45a049;
}

@media (max-width: 768px) {
    .left-section img {
        max-width: 120px;
    }

    .right-section a, .right-section span {
        font-size: 16px;
        margin-left: 15px;
    }

    .search-bar {
        margin: 10px 0;
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
        justify-content: space-between;
        margin-top: 10px;
    }

    .right-section a, .right-section span {
        margin-left: 10px;
        font-size: 14px;
    }
}

</style>
</head>
<body>
<header>
    <div class="left-section">
        <a href="home.php">
            <img src="./2.png" alt="click on image" class="logo">
        </a>
    </div>
    <div class="right-section">
        <a href="login.php" class="login" title="Login"><i class="fas fa-sign-in-alt"></i></a>
        <a href="profile.php" class="login" title="Profile"><i class="fa fa-user"></i></a>
        <span class="cart" title="Cart"><i class="fas fa-shopping-cart"></i></span>
        <span class="menu" title="Menu"><i class="fas fa-bars"></i></span>
    </div>
</header>

<div class="profile-container">
    <h2>Profile</h2>
    <?php if (!empty($row['profile_pic'])): ?>
        <img src="<?php echo htmlspecialchars($row['profile_pic']); ?>" alt="Profile Picture" class="profile-pic">
    <?php else: ?>
        <img src="default-profile.png" alt="Picture" class="profile-pic">
    <?php endif; ?>
    <p><?php echo htmlspecialchars($row['username']); ?></p>
    <p><?php echo htmlspecialchars($row['email']); ?></p>
    <p><a href="logout.php">Logout</a></p>

<form action="upload_profile_pic.php" method="post" enctype="multipart/form-data" class="profile1">
    <input type="file" name="profile_pic" accept="image/*">
    <button type="submit">Upload</button>
</form>
</div>
 
</body>
</html>
