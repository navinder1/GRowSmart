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

// Fetch product details from database
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Page with Header, Logo, and Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
       /* background-image: url('OIP (1).jpeg');
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
            background-color: #;
            color: #000;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            flex-wrap: wrap;
        }
        h1{
            color:green;
        }
        .left-section {
            display: flex;
            align-items: center;
            flex: 1;
        }
        .left-section img{
            max-width: 200px;
            margin-right: 10px;
        }
        .left-section h1 {
            margin: 0;
            font-size: 24px;
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
        footer {
            background-color: #f1f1f1;
            color: #333;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
        .content {
            flex: 1;
            padding: 20px;
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
        .container {
            display: flex;
            flex-wrap: wrap;
        }
        .left-side {
            flex: 2;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.1);
        }
        .right-side {
            flex: 1;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.4);
            /*background-color: #f9f9f9;*/
            color:block;
        }
        .product {
            background-color: rgba(255, 255, 255, 0.4);
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
    top: 100%; /* Position it below the element */
    left: 50%; /* Center it horizontally relative to the element */
    transform: translateX(-50%); /* Center the tooltip horizontally */
    background-color: lightyellow;
    color: #000;
    padding: 10px;
    border-radius: 8px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
    width: 90%;
    max-width: 400px;
    z-index: 10;
    text-align: left;
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
        .right-side {
    flex: 1;
    padding: 20px;
   /* background-color: #fafcfc;*/
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.quantity-container,
.address-container,
.location-detector,
.delivery-timing,
.overview-container {
    margin-bottom: 20px;
}

.quantity-container label,
.address-container label,
.delivery-timing label,
.overview-container label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.quantity-container input[type="number"],
.address-container input[type="text"],
.overview-container textarea {
    width: 100%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.location-detector button,
.confirm-address {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    background-color: green;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}

.location-detector button:hover,
.confirm-address:hover {
    background-color: #0056b3;
}


    </style>
</head>
<body>
<header>
    <div class="left-section">
        <a href="home.php">
            <img src="download (1).png" alt="click on image" class="logo">
        </a>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button type="submit"><i class="fas fa-search"></i></button>
    </div>
    <div class="right-section">
        <a href="#" class="login" title="Login"><i class="fas fa-sign-in-alt"></i></a>
        <a href="profile.php" class="login" title="Login"><i class="fa fa-user"></i></a>

        <span class="cart" title="Cart"><i class="fas fa-shopping-cart"></i></span>
        <span class="menu" title="Menu"><i class="fas fa-bars"></i></span>
    </div>
</header>

<div class="container">
    <div class="left-side">
        <?php if ($product): ?>
            <div class="product">
                <?php if ($product['image']): ?>
                    <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="tooltip"><h5>DESCRIPTION:<h5><?php echo htmlspecialchars($product['description']); ?></div>
                <?php endif; ?>
                <div class="product-details">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p class="weight">Net Weight:<?php echo htmlspecialchars($product['weight']); ?></p>
                    <p class="company">Company:<?php echo htmlspecialchars($product['company']); ?></p>
                    <p class="users">Uses:<?php echo htmlspecialchars($product['users']); ?></p>
                    <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>
                    <div class="buttons">
                        <a class="proceed-button" href="payment.php">Proceed</a>
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
    <div class="right-side">
    <div class="quantity-container">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" max="100" value="1">
    </div>
    
    <div class="address-container">
        <label for="address1">Home:</label>
        <input type="text" id="address1" name="address1" placeholder="Enter Address 1">
        <label for="address2">Office:</label>
        <input type="text" id="address2" name="address2" placeholder="Enter Address 2">
        <label for="address3">Other:</label>
        <input type="text" id="address3" name="address3" placeholder="Enter Address 3">
        <button class="confirm-address" onclick="confirmAddress()">Confirm Address</button>
    </div>
    <div class="location-detector">
        <button onclick="detectLocation()">Detect Location</button>
    </div>
    <div class="delivery-timing">
        <label for="delivery-time">Delivery Timing:</label>
        <p id="delivery-time">Calculating...</p>
    </div>
    <div class="overview-container">
        <label for="overview">Overview:</label>
        <textarea id="overview" name="overview" rows="5" placeholder="Enter product overview"></textarea>
    </div>
</div>

</div>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
<script>
function detectLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;
    
    const geocoder = new google.maps.Geocoder();
    const latlng = { lat: latitude, lng: longitude };

    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === 'OK') {
            if (results[0]) {
                const userAddress = results[0].formatted_address;
                const addressComponents = results[0].address_components;

                // Fill the address fields automatically
                document.getElementById('address1').value = addressComponents[0].long_name + ' ' + addressComponents[1].long_name; // Street number and route
                document.getElementById('address2').value = addressComponents[2].long_name; // Neighborhood
                document.getElementById('address3').value = addressComponents[3].long_name + ', ' + addressComponents[4].short_name + ' ' + addressComponents[5].short_name; // City, state, postal code
            } else {
                alert("No results found");
            }
        } else {
            alert("Geocoder failed due to: " + status);
        }
    });
}

function confirmAddress() {
    const address1 = document.getElementById('address1').value;
    const address2 = document.getElementById('address2').value;
    const address3 = document.getElementById('address3').value;

    const fullAddress = `${address1}, ${address2}, ${address3}`;

    if (confirm("Is this your address? " + fullAddress)) {
        calculateDeliveryTiming(fullAddress);
    } else {
        alert("Please enter your address manually.");
    }
}

function calculateDeliveryTiming(userAddress) {
    const service = new google.maps.DistanceMatrixService();
    const warehouseAddress = "WAREHOUSE_ADDRESS"; // Replace with your warehouse address

    service.getDistanceMatrix(
        {
            origins: [warehouseAddress],
            destinations: [userAddress],
            travelMode: 'DRIVING',
        },
        (response, status) => {
            if (status === 'OK') {
                const distanceInMeters = response.rows[0].elements[0].distance.value;
                const distanceInKm = distanceInMeters / 1000;
                
                let deliveryTime;
                if (distanceInKm < 10) {
                    deliveryTime = "1-2 hours";
                } else if (distanceInKm < 20) {
                    deliveryTime = "2-4 hours";
                } else {
                    deliveryTime = "4-6 hours";
                }

                document.getElementById('delivery-time').textContent = deliveryTime;
            } else {
                alert("Distance Matrix request failed due to: " + status);
            }
        }
    );
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}
</script>



<footer>
    Footer content here
</footer>
</body>
</html>
