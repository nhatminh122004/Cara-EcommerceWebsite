<?php
session_start();

// Initialize the shopping cart array if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Connect to the database
$con = mysqli_connect("localhost", "root", "", "ecommerceshop");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Handle adding products to the cart
if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    // If not, add it to the cart
    if (!$found) {
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = mysqli_query($con, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            $_SESSION['cart'][] = [
                'id' => $id,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'image' => explode(';', $product['images'])[0]
            ];
        }
    }
    $_SESSION['message'] = "Đã thêm vào giỏ hàng thành công";
    header("Location: cart.php");
    exit();
}

// Handle removing products from the cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

// Handle updating product quantities in the cart
if (isset($_POST['update'])) {
    if (isset($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $id => $quantity) {
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $id) {
                    $item['quantity'] = intval($quantity);
                    break;
                }
            }
        }
    }
}

$message = "";
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="shortcut icon" href="../assets/icon.png" type="image/.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsiveHome.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/about.css">
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="../css/cart.css">
    <style>
        .alert {
            padding: 20px;
            background-color: #4CAF50; /* Green */
            color: white;
            margin-bottom: 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .alert .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .alert .closebtn:hover {
            color: black;
        }
        .alert .icon {
            margin-right: 10px;
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
                <li class="lg-bag"><a class="active" href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <!-- <li><a href="account.html"><i class="fas fa-user-alt"></i></a></li> -->
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>
    <section id="page-header" class="about-header">
        <h2>#let's_talk</h2>
        <p>LEAVE A MESSAGE,We love to hear from you!</p>
    </section>
    <?php if ($message): ?>
        <div class="alert" id="alert">
            <span class="icon"><i class="fa-solid fa-check-circle"></i></span>
            <span><?= $message ?></span>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    <?php endif; ?>
    <section id="cart" class="section-p1">
        <form method="post" action="cart.php">
            <table width="100%">
                <thead>
                    <tr>
                        <td>REMOVE</td>
                        <td>IMAGES</td>
                        <td>PRODUCTS</td>
                        <td>PRICE</td>
                        <td>QUANTITY</td>
                        <td>SUBTOTAL</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item):
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                    ?>
                    <tr>
                        <td><a href="cart.php?action=remove&id=<?= $item['id'] ?>"><i class="fa-regular fa-circle-xmark"></i></a></td>
                        <td><img src="../admin/admin dashboard/<?= htmlspecialchars($item['image']) ?>" alt="P-1"></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td><input type="number" name="quantities[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1"></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                    </tr>
                    <?php
                        endforeach;
                    } else {
                        echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" name="update" class="normal">Update Cart</button>
        </form>
    </section>
    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon Code">
                <button class="normal">Apply</button>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <button class="normal" onclick="window.location.href='../index.php'">Continue Shopping</button>
            </div>
        </div>
        <div id="sub-total">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>$<?= number_format($total, 2) ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$<?= number_format($total, 2) ?></strong></td>
                </tr>
            </table>
            <button class="normal" onclick="window.location.href='../sub-pages/thanhtoan.php'" >Proceed to checkout</button>
        </div>
    </section>
    <?php require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\components\footer copy.php'); ?>
    <script>
        document.getElementById('numberInput').addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });
        // Tự động ẩn thông báo sau 5 giây
        setTimeout(function() {
            var alert = document.getElementById('alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);
    </script>
    <script src="../js/responsiveHome.js"></script>
</body>
</html>
