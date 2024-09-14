<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the search query
$searchQuery = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';
$sql = "SELECT * FROM products";
if ($searchQuery) {
    $sql .= " WHERE name LIKE '%$searchQuery%'";
}

$result = $conn->query($sql);

// Initialize cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $found = false;
    // Check if the product is already in the cart
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    // If not found, add new item to cart
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,
            'quantity' => 1,
        ];
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_item'])) {
    $removeIndex = $_POST['remove_index'];
    
    if (isset($_SESSION['cart'][$removeIndex])) {
        unset($_SESSION['cart'][$removeIndex]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GrowSmart</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
<link rel="stylesheet" href="styles.css">
<style>
   
.menu-container {
    position: relative;
    display: inline-block;
}

.menu-icon {
    font-size: 24px;
    cursor: pointer;
    padding: 10px;
}

.dropdown {
    display: none;
    position: absolute;
    background-color: white;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    min-width: 160px;
    right: 0;
    top: 50px;
}

.dropdown a {
    text-decoration: none;
    color: black;
    padding: 12px 16px;
    display: block;
}

.dropdown a:hover {
    background-color: #f1f1f1;
}

.menu-container:hover .dropdown {
    display: block;
}

.menu {
    position: relative;
}

.menu .submenu {
    display: none;
    position: absolute;
    left: 160px; /* Adjust this to control the distance from the parent menu */
    top: 0;
    background-color: white;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.menu:hover .submenu {
    display: block;
}

/* Logout styling */
.logout {
    border-top: 1px solid #ddd;
    padding: 12px 16px;
    text-align: center;
    background-color: #f44336;
    color: white;
    text-decoration: none;
}

.logout:hover {
    background-color: #d32f2f;
}

/* Search bar styling */
.search-bar2 {
    display: inline-block;
    position: relative;
    background-color: #fff;
    border-radius: 4px;
    border: 1px solid #ccc;
    padding: 5px;
    margin-right: 180px;
    width: 100%;
    max-width: 600px;
    box-sizing: border-box;
    margin-top:-30px;
}

.search-bar2 input[type="text"] {
    border: none;
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
    width: calc(100% - 50px);
    box-sizing: border-box;
}

.search-bar2 button {
    border: none;
    background: #000;
    color: white;
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    margin-left: -1px;
}

.search-bar2 button:hover {
    background: green;
}

/* Responsive styles */
@media (max-width: 768px) {
    .search-bar2 {
        width: 90%;
        margin-right: 0;
    }

    .search-bar2 input[type="text"] {
        width: calc(100% - 40px);
    }
}

.categories img{
    
    border-radius:500px;
}
/* Add this to your existing CSS */

.dropdown-container {
    position: relative;
    display: inline-block;
}

.dropdown-toggle {
    cursor: pointer;
    padding: 10px 12px;
    display: block;
    text-decoration: none;
    color: black;
}

.dropdown-content {
    display: none;
    position: absolute;
    left: -100%; /* Position to the left of the text */
    top:30px; /* Align with the top of the text */
    background-color: #f9f9f9;
    min-width: 250px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    padding: 12px 16px;
}

.dropdown-content a {
    text-decoration: none;
    color: black;
    padding: 12px 16px;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown-container:hover .dropdown-content {
    display: block;
}

.nav1 a {
    padding: 12px 16px;
    display: inline-block;
}
.nav1 {
        margin-top: -50px;
    }
/* Container for the iframe */
.map-container {
    margin-top: 20px; /* Space above the map */
    position: relative;
    width: 100%; /* Full width of the container */
    height: 300px; /* Adjust height as needed */
}

/* Styling for the iframe */
.map-container iframe {
    border: 0; /* Remove border */
    width: 100%; /* Full width of the container */
    height: 100%; /* Full height of the container */
}

</style>
</head>
<body>

<header>
    <a class="upload" href="index.php">Upload</a>
</div>
    <div class="left-section">
        <a href="home.php">
            <img src="./2.png" alt="click on image" class="logo">
        </a>
    </div>
    <form action="home.php" method="get" class="search-bar2">
        <input type="text" name="query" placeholder="Search...." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
    <div class="nav1">
    <div class="dropdown-container">
        <a href="home.php">Home</a>
    </div>
    <div class="dropdown-container">
        <a href="about.php">About</a>
    </div>
    <div class="dropdown-container">
        <a href="#" class="dropdown-toggle">Services</a>
        <div class="dropdown-content">
            <a href="delivery.html">Fast Delivery</a>
            <a href="support.html">Customer Support</a>
            <a href="consulting.html">Agricultural Consulting</a>
            <a href="return.html">Easy Returns</a>
        </div>
    </div>
    <div class="dropdown-container">
        <a href="#" class="dropdown-toggle">Contact Us</a>
        <div class="dropdown-content">
            <a href="mailto:smartgrow@.com">Email: smartgrow@.com</a>
            <a href="tel:+919391592561">Phone: +91-9391592561</a>
            <a href="https://maps.google.com?q=Warangal,Hamkonda" target="_blank">Address: Warangal, Hamkonda</a>
            <div class="map-container">
            <iframe 
            src="https://www.google.com/maps/embed/v1/place?q=Vaagdevi+College+of+Engineering,+Bollikunta,+Warangal&key=YOUR_GOOGLE_MAPS_API_KEY" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
        </div>
    </div>
</div>

    <div class="right-section">
        <a href="login1.php" class="login" title="Login"><i class="fas fa-sign-in-alt"></i></a>
        <a href="profile.php" class="login" title="Profile"><i class="fas fa-user"></i></a>
        <span class="cart-icon" onclick="toggleCartPanel()">
            <i class="fas fa-shopping-cart"></i>
            <span class="count"><?php echo count($_SESSION['cart']); ?></span>
        </span>
        <a href="" class="menu" ><i class="fa fa-bars" aria-hidden="true"></i></a>
    </div>
</header>
<div class="categories">
        <div class="category">
            <a href="#product" style="color:black; text-decoration:none;">
            <img src="OIP (5).jpeg" alt="all">
            <div>All</a></div>
        </div>
        <div class="category">
            <img src="th (1).jpeg" alt="Pesticides">
            <div>Pesticides</div>
        </div>
        <div class="category">
            <img src="OIP (2).jpeg" alt="Fertilizers">
            <div>Fertilizers</div>
        </div>
        <div class="category">
            <img src="OIP (3).jpeg" alt="Seeds">
            <div>Seeds</div>
        </div>
        <div class="category">
            <img src="download.jpeg" alt="Equipment">
            <div>Equipment</div>
        </div>
    </div>
    
    <div class="advertisement">
        <video id="advertisementVideo" autoplay muted>
            <source src="aad.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <button class="mute-button" id="muteButton"><i class="fas fa-volume-mute"></i></button>
    </div>

<h1 style="font-size:20px;" id="product">Product List</h1>
<div class="container">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="product">
                <?php if ($row['image']): ?>
                    <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <?php endif; ?>
                <div class="product-details">
                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                    <p class="weight">Net Weight: <?php echo htmlspecialchars($row['weight']); ?></p>
                    <p class="weight">Company: <?php echo htmlspecialchars($row['company']); ?></p>
                    <p class="weight">Uses: <?php echo htmlspecialchars($row['users']); ?></p>
                    <p class="price">₹<?php echo number_format($row['price'], 2); ?></p>
                    <div class="buttons">
                        <a class="buy-button" href="product_details.php?id=<?php echo $row['id']; ?>">Buy</a>
                        <form action="" method="post" style="display:inline;" >
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($row['image']); ?>">
                            <button type="submit" class="cart-button" id="cart">Cart</button>
                        </form>
                       <!-- <a class="details-button" href="product_details.php?id=<?php echo $row['id']; ?>">View Details</a>-->
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
    <?php
    $conn->close();
    ?>
</div>


<div class="cart-panel" id="cartPanel">
    <span class="close-btn" onclick="toggleCartPanel()">&times;</span>
    <h2>Shopping Cart</h2>
    <form id="cartForm" method="post">
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                <div class="cart-item">
                    <input type="checkbox" name="selected_products[]" value="<?php echo $item['id']; ?>" data-price="<?php echo $item['price']; ?>" class="product-checkbox">
                    <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <div class="item-details">
                        <span class="item-name"><?php echo htmlspecialchars($item['name']); ?></span>
                        <span class="item-price">₹<?php echo number_format($item['price'], 2); ?></span>
                        <span class="item-quantity">Quantity: <?php echo $item['quantity']; ?></span>
                        <form method="post" class="remove-form">
                            <input type="hidden" name="remove_index" value="<?php echo $index; ?>">
                            <button type="submit" name="remove_item" class="remove-button">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="total-amount">
                <strong>Total: ₹<span id="totalPrice">0.00</span></strong>
            </div>
            <button type="button" onclick="proceedToCheckout()" class="buy-button">Proceed to Checkout</button>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </form>
</div>


<footer>
<div class="footer-container" >
            <div class="footer-container" >
                <div class="footer-section about">
                    <h2>About Us</h2>
                    <p>We provide a variety of agricultural products with fast delivery, catering to the needs of both customers and dealers.</p>
                </div>
                <div class="footer-section services">
                    <h2>Services</h2>
                    <ul>
                        <li><a href="delivery.html">Fast Delivery</a></li>
                        <li><a href="support.html">Customer Support</a></li>
                        <li><a href="consulting.html">Agricultural Consulting</a></li>
                        <li><a href="return.html">Easy Returns</a></li>
                    </ul>
                </div>
                <div class="footer-section links">
                    <h2>Quick Links</h2>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="#product">Products</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section contact">
                    <h2>Contact Us</h2>
                    <ul>
                        <li>Email: smartgrow@.com</li>
                        <li>Phone: +91-9391592561</li>
                        <li>Address: Warangal,Hamkonda</li>
                    </ul>
                </div>
                <div class="footer-section social">
                    <h2>Follow Us</h2>
                    <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                    <i class="fa-brands fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.linkedin.com" target="_blank" aria-label="LinkedIn">
                    <i class="fa-brands fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                    <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                 </a> 
                 <a href="https://www.youtube.com" target="_blank" aria-label="YouTube">
                 <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                 </a>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Agriculture Store. All rights reserved.</p>
            </div>
    </div>
        </footer>

<script>
function toggleCartPanel() {
    var cartPanel = document.getElementById('cartPanel');
    cartPanel.classList.toggle('visible');
}
        document.addEventListener('DOMContentLoaded', function() {
            const categoryElements = document.querySelectorAll('.category');
            const products = document.querySelectorAll('.product');
            const muteButton = document.getElementById('muteButton');
            const advertisementVideo = document.getElementById('advertisementVideo');

            categoryElements.forEach(category => {
                category.addEventListener('click', function() {
                    const categoryType = this.getAttribute('data-category');
                    
                    products.forEach(product => {
                        if (categoryType === 'all' || product.getAttribute('data-category') === categoryType) {
                            product.style.display = 'block';
                        } else {
                            product.style.display = 'none';
                        }
                    });
                });
            });
let totalPrice = 0;
function updateTotalPrice() {
    const checkedCheckboxes = document.querySelectorAll('.product-checkbox:checked');
    totalPrice = 0;
    checkedCheckboxes.forEach(function(checkbox) {
        totalPrice += parseFloat(checkbox.getAttribute('data-price'));
    });
    document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
}
document.querySelectorAll('.product-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', updateTotalPrice);
});


            muteButton.addEventListener('click', function() {
                if (advertisementVideo.muted) {
                    advertisementVideo.muted = false;
                    muteButton.innerHTML = '<i class="fas fa-volume-up"></i>';
                } else {
                    advertisementVideo.muted = true;
                    muteButton.innerHTML = '<i class="fas fa-volume-mute"></i>';
                }
            });
        });
</script>
</body>
</html>