<?php
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Default XAMPP MySQL password
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

 //Fetch product details from database
 $sql = "SELECT * FROM products WHERE id = $product_id";
 $result = $conn->query($sql);
 $product = $result->fetch_assoc();

// Fetch ratings from database
//$ratings_sql = "SELECT AVG(rating) as average_rating, COUNT(rating) as rating_count FROM ratings WHERE product_id = $product_id";
//$ratings_result = $conn->query($ratings_sql);
//$ratings = $ratings_result->fetch_assoc();
//$average_rating = $ratings['average_rating'];
//$rating_count = $ratings['rating_count'];

// Handle rating submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rating'])) {
    $rating = intval($_POST['rating']);
    $stmt = $conn->prepare("INSERT INTO ratings (product_id, rating) VALUES (?, ?)");
    $stmt->bind_param("ii", $product_id, $rating);
    $stmt->execute();
    $stmt->close();
    // Refresh the page to show the updated rating
    header("Location: product_details.php?id=$product_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        .product {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        .product img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 20px;
            border-radius: 8px;
            position: relative;
        }
        .tooltip {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.75);
            color: white;
            padding: 10px;
            border-radius: 8px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
            width: 90%;
            max-width: 400px;
            z-index: 10;
            text-align: center;
        }
        .product img:hover + .tooltip,
        .tooltip:hover {
            opacity: 1;
        }
        .product-details {
            text-align: center;
        }
        .product h2 {
            margin: 0 0 10px;
        }
        .product p {
            margin: 0 0 10px;
        }
        .product .price {
            font-weight: bold;
        }
        .ratings {
            margin-top: 20px;
        }
        .rating-form {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .rating-form label {
            font-weight: bold;
        }
        .rating-form select {
            padding: 5px;
        }
        .rating-form button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .rating-form button:hover {
            background-color: #218838;
        }
        .buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .buttons .proceed-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            flex: 1;
            min-width: 100px;
            margin-bottom: 10px;
            text-decoration: none;
            text-align: center;
        }
        .buttons .proceed-button:hover {
            background-color: #218838;
        }
        .stars {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .stars input {
            display: none;
        }
        .stars label {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
        }
        .stars input:checked ~ label,
        .stars label:hover,
        .stars label:hover ~ label {
            color: #ffdd00;
        }

        @media (min-width: 768px) {
            .product {
                flex-direction: row;
                align-items: flex-start;
            }
            .product img {
                max-width: 200px;
                margin-right: 20px;
                margin-bottom: 0;
            }
            .product-details {
                text-align: left;
            }
        }

        @media (min-width: 992px) {
            .buttons .proceed-button {
                flex: 0 0 auto;
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($product): ?>
            <div class="product">
                <?php if ($product['image']): ?>
                    <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="tooltip"><?php echo htmlspecialchars($product['description']); ?></div>
                <?php endif; ?>
                    <div class="rating-form">
                        <form action="product_details.php?id=<?php echo $product_id; ?>" method="post">
                            <div class="stars">
                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5">★</label>
                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4">★</label>
                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3">★</label>
                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2">★</label>
                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1">★</label>
                            </div>
                            <button type="submit">Submit Rating</button>
                        </form>
                    </div>
                    <div class="buttons">
                        <a class="proceed-button" href="#">Proceed</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>Product not found.</p>
        <?php endif; ?>
        <?php
        $conn->close();
        ?>
    </div>
</body>
</html>
