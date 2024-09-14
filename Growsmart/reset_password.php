<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM users WHERE reset_token='$token' AND reset_token_expiry > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Token is valid, allow the user to reset their password
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password'])) {
            $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "UPDATE users SET password='$newPassword', reset_token=NULL, reset_token_expiry=NULL WHERE reset_token='$token'";
            
            if ($conn->query($sql) === TRUE) {
                echo "Password has been reset successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Invalid or expired token.";
    }
}

$conn->close();
?>

<!-- HTML Form for resetting password -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="POST" action="">
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="password" required>
            <input type="submit" value="Reset Password">
        </form>
    </div>
</body>
</html>
