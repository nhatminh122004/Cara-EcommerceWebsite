<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Detail</title>
    <link rel="shortcut icon" href="../assets/icon.png" type="image/.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsiveHome.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/shop.css">
</head>
<body>
    <section id="header">
        <a href="../index.php"><img src="../assets/logo.png" alt="logo" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../sub-pages/shop.php">Shop</a></li>
                <li><a class="active" href="../sub-pages/blog.php">Blog</a></li>
                <li><a href="../sub-pages/about.html">About</a></li>
                <li><a href="../sub-pages/contact.html">Contact</a></li>
                <li class="lg-bag"><a href="../sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <!-- <li><a href="account.html"><i class="fas fa-user-alt"></i></a></li> -->
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="./sub-pages/cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>
    <section id="page-header" class="blog-header">
        <h2>#readmore</h2>
        <p>Read all case studies about our products!</p>
    </section> 

    <section id="blog-detail" class="section-p1">
        <div class="container">
            <?php
            require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

            // Lấy ID của bài báo từ URL
            $id = $_GET['id'];

            // Truy vấn thông tin chi tiết của bài báo từ cơ sở dữ liệu
            $sql_str = "SELECT news.id as nid, news.tittle as ntittle, news.avatar as navatar, news.sumary as nsumary, news.description as ndescription, DATE_FORMAT(news.created_at, '%d/%m/%Y') as ndate 
                        FROM news 
                        WHERE news.id = $id";
            $result = mysqli_query($con, $sql_str);

            if ($row = mysqli_fetch_assoc($result)) {
                // Đường dẫn tới ảnh
                $imgPath = "../admin/admin%20dashboard/" . $row['navatar'];
            ?>
                <div class="blog-detail-box">
                    <div class="blog-detail-content">
                        <h1><?= $row['ntittle'] ?></h1>
                        <p>Posted on <?= $row['ndate'] ?></p>
                        <p><strong>Summary: </strong><?= $row['nsumary'] ?></p>
                        <p><?= nl2br($row['ndescription']) ?></p>
                    </div>
                    <div class="blog-detail-img">
                        <img src="<?= $imgPath ?>" alt="<?= $row['ntittle'] ?>">
                    </div>
                </div>
            <?php
            } else {
                echo "<p>Bài báo không tồn tại.</p>";
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
   <script src="../js/responsiveHome.js"></script>
</body>
</html>
