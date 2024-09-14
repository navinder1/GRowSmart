<?php
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Default XAMPP MySQL password
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $weight = $conn->real_escape_string($_POST['weight']);
    $company = $conn->real_escape_string($_POST['company']);
    $users = $conn->real_escape_string($_POST['users']);

    // Image upload handling
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check if the image is valid
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) { // 500KB
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // Redirect to home page without uploading
        echo "<script>
                alert('Failed to upload image. Please try again.');
                window.location.href='home.php';
              </script>";
        exit(); // Ensure the script stops executing after the redirect
    } else {
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert product details into the database
            $sql = "INSERT INTO products (name, description, price, image, weight, company, users) 
                    VALUES ('$name', '$description', '$price', '$image', '$weight', '$company', '$users')";

            if ($conn->query($sql) === TRUE) {
                // Redirect to home page with a success message
                echo "<script>
                        alert('Product uploaded successfully!');
                        window.location.href='home.php';
                      </script>";
                exit(); // Ensure the script stops executing after the redirect
            } else {
                // Redirect to home page without uploading
                echo "<script>
                        alert('Failed to insert product details. Please try again.');
                        window.location.href='home.php';
                      </script>";
                exit(); // Ensure the script stops executing after the redirect
            }
        } else {
            // Redirect to home page without uploading
            echo "<script>
                    alert('Failed to upload file. Please try again.');
                    window.location.href='home.php';
                  </script>";
            exit(); // Ensure the script stops executing after the redirect
        }
    }
}

$conn->close();
?>
