<?php require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\components\header.php'); ?>

<body>
    <section id="header">
        <a href="./index.php"><img src="./assets/logo.png" alt="logo" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/index.php">Home</a></li>
                <li><a href="http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/sub-pages/shop.php">Shop</a></li>
                <li><a href="http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/sub-pages/blog.php">Blog</a></li>
                <li><a href="./sub-pages/about.html">About</a></li>
                <li><a href="./sub-pages/contact.html">Contact</a></li>
                <li class="lg-bag"><a href="./sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="./sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>
    <section id="hero">
        <h4>Trade-In-Offer</h4>
        <h2>Super Value Deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 70% off!</p>
        <button onclick="window.location.href='http://localhost/Cara-EcommerceWebsite%20-%20Sao%20ch%C3%A9p/Cara-EcommerceWebsite-main/sub-pages/shop.php'">Shop Now</button>

    </section>

   <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="./assets/features/f1.png" alt="F-1">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="./assets/features/f2.png" alt="F-1">
            <h6>Online Order</h6>
        </div>
        <div class="fe-box">
            <img src="./assets/features/f3.png" alt="F-1">
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="./assets/features/f4.png" alt="F-1">
            <h6>Promotion</h6>
        </div>
        <div class="fe-box">
            <img src="./assets/features/f5.png" alt="F-1">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="./assets/features/f6.png" alt="F-1">
            <h6>24/7 Support</h6>
        </div>
    </section>

    <section id="categories" class="section-p1">
        <div class="section-title">
            <h2>Product Categories</h2>
            <p>Explore our diverse range of product categories to find exactly what you need.</p>
        </div>
        <?php
        // Database connection
        $con = mysqli_connect("localhost", "root", "", "ecommerceshop");
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        // Fetch data from categories table
        $sql_str = "SELECT * FROM categories ORDER BY name";
        $result = mysqli_query($con, $sql_str);

        // Array to map category names to images
        $category_images = [
            'Mens shirt' => './assets/products/f1.jpg',
            'Women Shirt' => './assets/products/f8.jpg',
            'Male pants' => './assets/products/n6.jpg',
            'Female trousser' => './assets/products/f7.jpg'
        ];

        // Check if query was successful
        if (!$result) {
            echo "Error: " . mysqli_error($con);
        } else {
            // Display categories in similar boxes
            while ($row = mysqli_fetch_assoc($result)) {
                $category_name = $row['name'];
                $category_image = isset($category_images[$category_name]) ? $category_images[$category_name] : './assets/products/default.jpg';
                ?>
                <div class="fe-box">
                    <img src="<?= $category_image ?>" alt="<?= $category_name ?>">
                    <h6><?= $category_name ?></h6>
                </div>
                <?php
            }
        }
        ?>
    </section>



    <!--  -->
    <section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
        // Kết nối database
        $con = mysqli_connect("localhost", "root", "", "ecommerceshop");
        // Kiểm tra kết nối
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        // List of specific product names
        $product_names = [
            'Floral Pattern Shirt',
            'Tropical Leaf Shirt',
            'Red Blossom Shirt Men',
            'Red Blossom Shirt Women',
            'Floral Summer Shirt',
            'Casual Colorblock Shirt',
            'Linen Floral Pants',
            'Abstract Pattern Blouse'
        ];

        // Prepare the SQL query
        $placeholders = implode(',', array_fill(0, count($product_names), '?'));
        $sql_str = "SELECT products.id, products.name, products.price, products.disscounted_price, products.images, brands.name as brand_name 
                    FROM products 
                    JOIN brands ON products.brand_id = brands.id 
                    WHERE products.status = 'Active' AND products.name IN ($placeholders)";
        
        // Prepare the statement
        if ($stmt = mysqli_prepare($con, $sql_str)) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($product_names)), ...$product_names);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

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
                    $image_url = "admin/admin dashboard/" . $image;
                    ?>
                    <div class="pro">
                        <a href="./sub-pages/sproduct.php?id=<?= htmlspecialchars($row['id']) ?>">
                            <img src="<?= htmlspecialchars($image_url) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                        </a>
                        <div class="des">
                            <span><?= htmlspecialchars($row['brand_name']) ?></span>
                            <h5><a href="./sub-pages/sproduct.php?id=<?= htmlspecialchars($row['id']) ?>"><?= htmlspecialchars($row['name']) ?></a></h5>
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

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($con);
        }

        // Close the connection
        mysqli_close($con);
        ?>
    </div>
</section>

<!-- Banner -->
<section id="banner" class="section-m1">
    <h4>Repair Services</h4>
    <h2>Up to <span>70% Off</span> All t-shirt & Accessories</h2>
</section>

<!--  -->

<section id="product1" class="section-p1">
    <h2>New Arrivals</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
        // Kết nối database
        $con = mysqli_connect("localhost", "root", "", "ecommerceshop");
        // Kiểm tra kết nối
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        // List of specific product names
        $product_names = [
            'Classic Light Blue Shirt',
            'Modern Striped Shirt',
            'Elegant White Shirt',
            'Casual Printed Shirt',
            'Denim Classic Shirt',
            'Striped Summer Shorts',
            'Khaki Utility Shirt',
            'Short Sleeve Collar Shirt'
        ];

        // Prepare the SQL query
        $placeholders = implode(',', array_fill(0, count($product_names), '?'));
        $sql_str = "SELECT products.id, products.name, products.price, products.disscounted_price, products.images, brands.name as brand_name 
                    FROM products 
                    JOIN brands ON products.brand_id = brands.id 
                    WHERE products.status = 'Active' AND products.name IN ($placeholders)";
        
        // Prepare the statement
        if ($stmt = mysqli_prepare($con, $sql_str)) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($product_names)), ...$product_names);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

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
                    $image_url = "admin/admin dashboard/" . $image;
                    ?>
                    <div class="pro">
                        <a href="./sub-pages/sproduct.php?id=<?= htmlspecialchars($row['id']) ?>">
                            <img src="<?= htmlspecialchars($image_url) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                        </a>
                        <div class="des">
                            <span><?= htmlspecialchars($row['brand_name']) ?></span>
                            <h5><a href="./sub-pages/sproduct.php?id=<?= htmlspecialchars($row['id']) ?>"><?= htmlspecialchars($row['name']) ?></a></h5>
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

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($con);
        }

        // Close the connection
        mysqli_close($con);
        ?>
    </div>
</section>

    <!-- Banner -->
    <section id="sm-banner" class="section-p1">
        <div class="bannner-box">
            <h4>crazy deals</h4>
            <h2>buy 1 get 1 free</h2>
            <span>The Best classic dress is on sale at cara</span>
        </div>
        <div class="bannner-box">
            <h4>spring/summer</h4>
            <h2>upcoming season</h2>
            <span>The Best classic dress is on sale at cara</span>
        </div>
    </section>
    <section id="banner3">
        <div class="banner-box">
            <h4>SEASON SALE</h4>
            <h3>winter Collection -50% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h4>NEW FOOTWEAR COLLECTION</h4>
            <h3>spring / summer 2023</h3>
        </div>
        <div class="banner-box banner-box3">
            <h4>T-SHIRT</h4>
            <h3>New Trendy Prints</h3>
        </div>
    </section>
    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>sign up for newsletters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <?php require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\components\footer.php'); ?>
    
    <script src="./js/responsiveHome.js"></script>
</body>

</html>
