<?php
session_start();
$is_homepage = false;
require_once('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="shortcut icon" href="../assets/icon.png" type="image/.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsiveHome.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/shop.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .thank-you-container {
            text-align: center;
            padding: 50px 20px;
            background-color: #f9f9f9;
        }
        .thank-you-container h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }
        .thank-you-container p {
            font-size: 18px;
            color: #555;
        }
        .thank-you-container a {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 30px;
            font-size: 18px;
            color: #fff;
            background-color: #04AA6D;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .thank-you-container a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <section id="header">
        <a href="../index.php"><img src="../assets/logo.png" alt="logo" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../sub-pages/shop.php">Shop</a></li>
                <li><a href="../sub-pages/blog.php">Blog</a></li>
                <li><a href="../sub-pages/about.html">About</a></li>
                <li><a href="../sub-pages/contact.html">Contact</a></li>
                <li class="lg-bag"><a href="../sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <li><a href="../sub-pages/account.html"><i class="fas fa-user-alt"></i></a></li>
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="../sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>

    <section class="thank-you-container">
        <h1>Cảm ơn bạn đã đặt hàng!</h1>
        <p>Chúng tôi đã nhận được đơn hàng của bạn và sẽ sớm liên hệ với bạn để chốt đơn hàng.</p>
        <a href="../index.php">Tiếp tục mua sắm</a>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img src="../assets/logo.png" alt="logo" class="logoS">
            <br><br>
            <p><strong>Address:</strong> 562 Wellington Road, Street 32, San Francisco</p>
            <p><strong>Phone:</strong> +01 2222 3665 / (+91) 01 2345 6763</p>
            <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Sat</p>
            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-linkedin"></i>
                    <i class="fa-brands fa-twitter"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Condition</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My WishList</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>
        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="../assets/pay/app.jpg" alt="app">
                <img src="../assets/pay/play.jpg" alt="play">
            </div>
            <p>Secured Payment Gateways</p>
            <img src="../assets/pay/pay.png" alt="pay">
        </div>
        <div class="copyright">
            <p>2023, ABVM Ecommerce Template</p>
        </div>
    </footer>

    <script src="../js/responsiveHome.js"></script>
</body>
</html>
