<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowSmart - About Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            /*background: linear-gradient(135deg, #a8d5ba, #79c267, #4caf50);*/
            background-color: #F5F5DC;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f7f7f7;
            color: #333;
        }
        header {
            /* Header styles unchanged */
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
        .left-section img {
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
        .right-section a:hover {
            color: green;
        }
        .right-section span:hover {
            color: green;
        }

        main {
            flex: 1;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: rgba(255,255,244,0.4);
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        main h1 {
            color: #4CAF50;
            font-size: 32px;
            margin-bottom: 20px;
            text-align: center;
        }
        main p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        main h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
            margin-top: 30px;
            border-left: 4px solid #4CAF50;
            padding-left: 10px;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
            margin-bottom: 20px;
        }
        ul li {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.6;
        }
        ul li span {
            font-weight: bold;
            color: #333;
        }
        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        button:hover {
            background-color: #ffffff;
           }
        button a {
            color: #fff;
            text-decoration: none;
        }
        button a:hover{
            color:green
        }
        @media (max-width: 768px) {
            main {
                padding: 20px;
            }
            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="left-section">
            <a href="home.php">
                <img src="./2.png" alt="GrowSmart Logo">
            </a>
        </div>
        <div class="right-section">
            <a href="login.php" class="login" title="Login"><i class="fas fa-sign-in-alt"></i></a>
            <a href="profile.php" class="profile" title="Profile"><i class="fa fa-user"></i></a>
            <span class="cart" title="Cart"><i class="fas fa-shopping-cart"></i></span>
            <span class="menu" title="Menu"><i class="fas fa-bars"></i></span>
        </div>
    </header>
    <main>
        <h1>About Us</h1>
        <p>Welcome to GrowSmart, your one-stop e-commerce platform dedicated to serving the farming community. Our mission is to empower farmers with easy access to high-quality agricultural products, ensuring they have the tools and resources they need to succeed.</p>

        <h2>Who We Are</h2>
        <p>At GrowSmart, we understand the challenges faced by farmers and are committed to making their lives easier. Whether you are a small-scale farmer or a large agricultural dealer, our platform is designed to cater to your specific needs. Our team is passionate about agriculture and dedicated to providing top-notch products and services to our valued customers.</p>

        <h2>What We Offer</h2>
        <p>GrowSmart offers a comprehensive range of agricultural products, including:</p>
        <ul>
            <li><span>Fertilizers:</span> Enhance your crop yield with our selection of top-grade fertilizers.</li>
            <li><span>Seeds:</span> Choose from a variety of high-quality seeds tailored to different crops and climates.</li>
            <li><span>Pesticides:</span> Protect your crops from pests and diseases with our effective pesticide solutions.</li>
            <li><span>Tools and Equipment:</span> Equip your farm with the latest tools and machinery for efficient farming.</li>
            <li><span>Urea and Other Inputs:</span> Access essential inputs like urea and other agricultural chemicals to boost productivity.</li>
        </ul>

        <h2>Why Choose Us</h2>
        <ul style="list-style-type: square;">
            <li><span>Quality Products:</span> We partner with trusted suppliers to ensure you receive the best products available.</li>
            <li><span>Fast Delivery:</span> Our delivery network operates with the efficiency of services like Swiggy or Zomato, ensuring your orders reach you promptly.</li>
            <li><span>Customer-Centric Service:</span> We are here to support you with excellent customer service and after-sales assistance.</li>
            <li><span>Wide Range:</span> Our extensive catalog caters to the diverse needs of farmers and dealers alike.</li>
            <li><span>Secure Payments:</span> We offer multiple secure payment options, including PhonePe, Google Pay, Paytm, Amazon Pay, Net Banking, Debit Card, and Credit Card.</li>
        </ul>

        <h2>Our Vision</h2>
        <p>We envision a world where farmers have seamless access to everything they need to thrive. By leveraging technology and innovation, we aim to revolutionize the agricultural sector, making farming more productive and sustainable.</p>

        <h2>Join Us</h2>
        <p>Become a part of the GrowSmart community and experience the convenience and reliability of our e-commerce platform. Whether you are looking to purchase agricultural inputs or sell your products, GrowSmart is here to support your journey towards success.</p>

        <p>Thank you for choosing GrowSmart. Together, we can grow a brighter future for agriculture.</p>

        <button><a href="home.php">Back to Home Page</a></button>
    </main>
</body>
</html>
