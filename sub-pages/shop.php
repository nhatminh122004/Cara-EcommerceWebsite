<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="shortcut icon" href="../assets/icon.png" type="image/.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsiveHome.css">
    <link rel="stylesheet" href="../css/shop.css">
</head>
<body>
    <section id="header">
        <a href="http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/index.php"><img src="../assets/logo.png" alt="logo" class="logo"></a>
        <div>
            <ul id="navbar">
            <li><a  href="http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/index.php">Home</a></li>
            <li><a class="active" href="http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/sub-pages/shop.php">Shop</a></li>
                <li><a href="http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/sub-pages/blog.php">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li class="lg-bag"><a href="../sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <!-- <li><a href="account.html"><i class="fas fa-user-alt"></i></a></li> -->
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="../sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>
    <section id="page-header">
        <h2>#stayhome</h2>
        <p>Save more with coupons & up to 70% off!</p>
    </section> 
    
    <section id="product1" class="section-p1">
        <div class="pro-container">
            <?php
            // Kết nối database
            $con = mysqli_connect("localhost", "root", "", "ecommerceshop");
            // Kiểm tra kết nối
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            // Fetch data from products table
            $sql_str = "SELECT products.id, products.name, products.price, products.images, brands.name as brand_name 
                        FROM products 
                        JOIN brands ON products.brand_id = brands.id 
                        WHERE products.status = 'Active'";
            $result = mysqli_query($con, $sql_str);

            // Check if query was successful
            if (!$result) {
                echo "Error: " . mysqli_error($con);
            } else {
                // Display products
                while ($row = mysqli_fetch_assoc($result)) {
                    // Assume the images are stored as a semicolon-separated string
                    $images = explode(';', $row['images']);
                    $image = !empty($images) ? $images[0] : 'default.jpg'; // Use the first image or a default one

                    // Construct the URL to the image
                    $image_url = "../admin/admin dashboard/" . $image;
                    ?>
                    <div class="pro" onclick="window.location.href='sproduct.php?id=<?= htmlspecialchars($row['id']) ?>'">
                        <img src="<?= htmlspecialchars($image_url) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                        <div class="des">
                            <span><?= htmlspecialchars($row['brand_name']) ?></span>
                            <h5><?= htmlspecialchars($row['name']) ?></h5>
                            <div class="star">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <h4><?= number_format($row['price'], 0, '', '.') . "$" ?></h4>
                        </div>
                        <a href="cart.php?action=add&id=<?= htmlspecialchars($row['id']) ?>" class="cart"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                    <?php
                }
            }

            // Đóng kết nối
            mysqli_close($con);
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
   <script src="../js/responsiveHome.js"></script>
</body>
</html>
