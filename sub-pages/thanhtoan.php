<?php
session_start();
require_once('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

// Khởi tạo mảng giỏ hàng nếu nó chưa tồn tại
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$total = 0;

if (isset($_POST['btDathang'])) {
    // Lấy thông tin khách hàng từ form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    // Chuẩn bị dữ liệu cho từng sản phẩm trong giỏ hàng
    foreach ($_SESSION['cart'] as $item) {
        if (isset($item['price']) && isset($item['quantity'])) {
            $product_id = $item['id'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            
            // Tạo dữ liệu cho order
            $sqli = "INSERT INTO orders (user_id, status, firstname, lastname, address, phone, email, product_id, price, created_at, updated_at)
                     VALUES (NULL, 'Processing', '$firstname', '$lastname', '$address', '$phone', '$email', '$product_id', '$price', NOW(), NOW())";

            if (!mysqli_query($con, $sqli)) {
                echo "Error: " . $sqli . "<br>" . mysqli_error($con);
                exit();
            }
        } else {
            echo "Error: Missing price or quantity for item ID $item[id]";
            exit();
        }
    }

    // Xóa cart
    unset($_SESSION["cart"]);
    header("Location: thankyou.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="shortcut icon" href="../assets/icon.png" type="image/.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsiveHome.css">
    <link rel="stylesheet" href="../css/account.css">
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -16px;
        }

        .col-25, .col-50, .col-75 {
            padding: 0 16px;
        }

        .col-25 {
            flex: 25%;
        }

        .col-50 {
            flex: 50%;
        }

        .col-75 {
            flex: 75%;
        }

        .container {
            background-color: #f2f2f2;
            padding: 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        input[type=text] {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        label {
            margin-bottom: 10px;
            display: block;
        }

        .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 24px;
        }

        .btn {
            background-color: #04AA6D;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        span.price {
            float: right;
            color: grey;
        }

        .checkbox-container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 18px;
            user-select: none;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 4px;
        }

        .checkbox-container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }

        .checkout__order {
            background-color: #fff;
            padding: 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        .checkout__order h4 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        .checkout__order__products, .checkout__order__total {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .checkout__order ul {
            list-style: none;
            padding: 0;
        }

        .checkout__order ul li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .checkout__order__shipping, .checkout__order__total {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .site-btn {
            background-color: #04AA6D;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }

        .site-btn:hover {
            background-color: #45a049;
        }

        @media (max-width: 800px) {
            .row {
                flex-direction: column;
            }
            .col-25 {
                margin-bottom: 20px;
            }
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
                <!-- <li><a href="../sub-pages/account.html"><i class="fas fa-user-alt"></i></a></li> -->
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="../sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>

    <section class="checkout-section">
        <div class="row">
            <div class="col-75">
                <div class="container">
                    <form action="thanhtoan.php" method="post">
                        <div class="row">
                            <div class="col-50">
                                <h3>Billing Address</h3>
                                <br>
                                <label for="fname"><i class="fa fa-user"></i> First Name</label>
                                <input type="text" id="fname" name="firstname" placeholder="John" required>
                                <label for="lname"><i class="fa fa-user"></i> Last Name</label>
                                <input type="text" id="lname" name="lastname" placeholder="M. Doe" required>
                                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                <input type="text" id="email" name="email" placeholder="john@example.com" required>
                                <label for="phone"><i class="fa fa-phone"></i> Phone</label>
                                <input type="text" id="phone" name="phone" placeholder="0935423123" required>
                                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
                                <label for="city"><i class="fa fa-institution"></i> City</label>
                                <input type="text" id="city" name="city" placeholder="New York" required>
                                <div class="row">
                                    <div class="col-50">
                                        <label for="state">State</label>
                                        <input type="text" id="state" name="state" placeholder="NY" required>
                                    </div>
                                    <div class="col-50">
                                        <label for="zip">Zip</label>
                                        <input type="text" id="zip" name="zip" placeholder="10001" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-50">
                                <h3>Payment</h3>
                                <br>
                                <label for="fname">Accepted Cards</label>
                                <br>
                                <img src="../assets/pay/pay.png" alt="pay">
                                <br>
                                <br>
                                <label for="cname">Name on Card</label>
                                <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
                                <label for="ccnum">Credit card number</label>
                                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
                                <label for="expmonth">Exp Month</label>
                                <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
                                <div class="row">
                                    <div class="col-50">
                                        <label for="expyear">Exp Year</label>
                                        <input type="text" id="expyear" name="expyear" placeholder="2018" required>
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="352" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="checkbox-container">
                            Shipping address same as billing
                            <input type="checkbox" checked="checked" name="sameadr">
                            <span class="checkmark"></span>
                        </label>
                        <button type="submit" class="site-btn" name="btDathang">Đặt hàng</button>
                    </form>
                </div>
            </div>
            <div class="col-25">
                <div class="checkout__order">
                    <h4>Your Order</h4>
                    <div class="checkout__order__products">Products <span>Total</span></div>
                    <ul>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <?php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                            ?>
                            <li><?= htmlspecialchars($item['name']) ?> <span>$<?= number_format($subtotal, 2) ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="checkout__order__shipping">Shipping <span>Free</span></div>
                    <div class="checkout__order__total">Total <span>$<?= number_format($total, 2) ?></span></div>
                    <div class="checkout__input__checkbox">
                        <label for="payment">
                            Check Payment
                            <input type="checkbox" id="payment">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
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
