<?php
session_start();

// Kết nối cơ sở dữ liệu
$con = mysqli_connect("localhost", "root", "", "ecommerceshop");

// Kiểm tra kết nối
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (!isset($_GET['id'])) {
    die('Không tìm thấy sản phẩm');
}

$idsp = $_GET['id'];
$sql_str = "SELECT products.*, brands.name as brand_name FROM products JOIN brands ON products.brand_id = brands.id WHERE products.id = $idsp";
$result = mysqli_query($con, $sql_str);
if (!$result || mysqli_num_rows($result) == 0) {
    die('Sản phẩm không tồn tại');
}
$row = mysqli_fetch_assoc($result);
$anh_arr = explode(';', $row['images']);
$image_url = "../admin/admin dashboard/";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/icon.png" type="image/png">
    <title><?= htmlspecialchars($row['name']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsiveHome.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/sproduct.css">
</head>

<body>
    <section id="header">
        <a href="../index.php"><img src="../assets/logo.png" alt="logo" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/index.php">Home</a></li>
                <li><a class="active" href="http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/sub-pages/shop.php">Shop</a></li>
                <li><a href="../sub-pages/blog.php">Blog</a></li>
                <li><a href="../sub-pages/about.html">About</a></li>
                <li><a href="../sub-pages/contact.html">Contact</a></li>
                <li class="lg-bag"><a href="../sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="../sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>

    <section id="prodetails" class="section-p1">
        <div class="single-pro-img">
            <img src="<?= $image_url . htmlspecialchars($anh_arr[0]) ?>" alt="<?= htmlspecialchars($row['name']) ?>" width="100%" id="mainImg">
            <div class="small-img-group">
                <?php foreach ($anh_arr as $img) : ?>
                    <div class="small-img-col">
                        <img src="<?= $image_url . htmlspecialchars($img) ?>" width="100%" alt="<?= htmlspecialchars($row['name']) ?>" class="small-img">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="single-pro-details">
            <h5>Home / <?= htmlspecialchars($row['brand_name']) ?></h5>
            <h4><?= htmlspecialchars($row['name']) ?></h4>
            <h2>$<?= htmlspecialchars($row['price']) ?></h2>
            <select>
                <option>Select Size</option>
                <option>XL</option>
                <option>XXL</option>
                <option>Small</option>
                <option>Large</option>
            </select>
            <form method="post" action="cart.php?action=add&id=<?= htmlspecialchars($row['id']) ?>">
                <input type="number" name="quantity" id="numberInput" value="1" min="1">
                <button type="submit" class="normal">Add to cart</button>
            </form>
            <h4>Product Details</h4>
            <span><?= htmlspecialchars($row['description']) ?></span>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            <?php
            // Kiểm tra biến $idsp đã được định nghĩa chưa
            if (isset($idsp)) {
                // Truy vấn các sản phẩm liên quan dựa trên thương hiệu (brand_id)
                $related_sql = "SELECT products.*, brands.name as brand_name 
                            FROM products 
                            JOIN brands ON products.brand_id = brands.id 
                            WHERE products.brand_id = (SELECT brand_id FROM products WHERE id = $idsp) 
                            AND products.id <> $idsp 
                            LIMIT 4";
                $related_result = mysqli_query($con, $related_sql);

                // Kiểm tra truy vấn có thành công không
                if ($related_result) {
                    while ($related_row = mysqli_fetch_assoc($related_result)) {
                        $related_images = explode(';', $related_row['images']);
            ?>
                        <div class="pro" onclick="window.location.href='sproduct.php?id=<?= htmlspecialchars($related_row['id']) ?>'">
                            <img src="../admin/admin dashboard/<?= htmlspecialchars($related_images[0]) ?>" alt="<?= htmlspecialchars($related_row['name']) ?>">
                            <div class="des">
                                <span><?= htmlspecialchars($related_row['brand_name'] ?? 'Unknown Brand') ?></span>
                                <h5><?= htmlspecialchars($related_row['name']) ?></h5>
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <h4>$<?= htmlspecialchars($related_row['price']) ?></h4>
                            </div>
                            <a class="cart"><i class="fa-solid fa-cart-shopping"></i></a>
                        </div>
            <?php
                    }
                } else {
                    echo "<p>Không tìm thấy sản phẩm liên quan.</p>";
                }
            } else {
                echo "<p>ID sản phẩm không được xác định.</p>";
            }
            ?>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign up for newsletters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <?php require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\components\footer copy.php'); ?>
    <script>
        document.getElementById('numberInput').addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });
    </script>
    <script src="../js/slider.js"></script>
    <script src="../js/responsiveHome.js"></script>
</body>

</html>
