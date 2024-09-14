<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowSmart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
       /* background: linear-gradient(135deg, #a8d5ba, #79c267, #4caf50);*/
        background-color: #F5F5DC;
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
        .container {
            max-width: 800px;
            margin-left:30px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color:rgba(244,244,244,0.3)
        }
        h1 {
            margin-top: 0;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .btn{
            color:white;
            background:green;
        }
        .btn:hover{
            color:block;
            background:white;
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
    <!--<form action="" method="get" class="search-bar">
       <input type="text" name="query" placeholder="Search..." value="">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>-->
    <div class="right-section">
        <a href="login.php" class="login" title="Login"><i class="fas fa-sign-in-alt"></i></a>
        <a href="profile.php" class="login" title="Login"><i class="fa fa-user"></i></a>
        <span class="cart" title="Cart"><i class="fas fa-shopping-cart"></i></span>
        <span class="menu" title="Menu"><i class="fas fa-bars"></i></span>
    </div>
</header>
<body>
    <div class="container">
        <h1>Upload Product Details</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4"></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
             
            <label for="name">Net Weight:</label>
            <input type="text" id="weight" name="weight" required>
             
            <label for="name">Company:</label>
            <input type="text" id="company" name="company" required>
            
            <label for="name">Uses:</label>
            <input type="text" id="users" name="users" required>

            <input type="submit" class="btn" value="Upload Product">
        </form>
    </div>
</body>
</html>
