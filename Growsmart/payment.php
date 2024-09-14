<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowSmart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
       /* background-image: url('OIP (1).jpeg');*/
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
        .payment-methods {
            margin: 20px;
        }
        .payment-method {
            margin-bottom: 10px;
        }
        .payment-method label {
            margin-left: 10px;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.4);
    max-width: 500px; /* Increase the width as needed */
    
    margin-top:20px;
    margin-left:10px;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
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
<div class="container">
<div class="payment-methods">
    <h3>Select Payment Method</h3>
    <form id="paymentForm">
        <div class="payment-method">
            <input type="radio" id="phonepe" name="payment_method" value="phonepe">
            <label for="phonepe">PhonePe</label>
        </div>
        <div class="payment-method">
            <input type="radio" id="gpay" name="payment_method" value="gpay">
            <label for="gpay">Google Pay</label>
        </div>
        <div class="payment-method">
            <input type="radio" id="paytm" name="payment_method" value="paytm">
            <label for="paytm">Paytm</label>
        </div>
        <div class="payment-method">
            <input type="radio" id="amazonpay" name="payment_method" value="amazonpay">
            <label for="amazonpay">Amazon Pay</label>
        </div>
        <div class="payment-method">
            <input type="radio" id="cod" name="payment_method" value="cod">
            <label for="cod">Cash on Delivery</label>
        </div>
    </form>
</div>
    </div>

<script>
    document.getElementById('paymentForm').addEventListener('change', function(event) {
        if (event.target.name === 'payment_method') {
            let paymentMethod = event.target.value;
            let url = '';
            switch (paymentMethod) {
                case 'phonepe':
                    url = 'https://www.phonepe.com/';
                    break;
                case 'gpay':
                    url = 'https://pay.google.com/';
                    break;
                case 'paytm':
                    url = 'https://paytm.com/';
                    break;
                case 'amazonpay':
                    url = 'https://pay.amazon.com/';
                    break;
                case 'cod':
                    url = 'https://yourwebsite.com/cash-on-delivery';
                    break;
                default:
                    url = '#';
            }
            window.location.href = url;
        }
    });
</script>

</body>
</html>
