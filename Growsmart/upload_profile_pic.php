<?php
session_start();

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

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
    // Get the file details
    $file = $_FILES['profile_pic'];
    $fileName = $_SESSION['username'] . "_" . basename($file['name']);
    $fileTmpPath = $file['tmp_name'];
    $filePath = 'uploads/' . $fileName;

    // Ensure the uploads directory exists
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Validate the file (e.g., type, size)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxSize) {
        // Move the uploaded file to the 'uploads' directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Update the database with the file path
            $user = $_SESSION['username'];
            $sql = "UPDATE users SET profile_pic='$filePath' WHERE username='$user'";
            
            if ($conn->query($sql) === TRUE) {
                // Redirect to profile page after successful upload
                header("Location: profile.php");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        echo "Invalid file type or size too large.";
    }
} else {
    echo "No file uploaded or there was an upload error.";
}

$conn->close();
?>
