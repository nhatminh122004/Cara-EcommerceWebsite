<?php
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

// Lấy dữ liệu từ form 
$name = isset($_POST['name']) ? mysqli_real_escape_string($con, $_POST['name']) : '';
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
$sumary = isset($_POST['sumary']) ? mysqli_real_escape_string($con, $_POST['sumary']) : '';
$description = isset($_POST['description']) ? mysqli_real_escape_string($con, $_POST['description']) : '';
$stock = isset($_POST['stock']) ? (int)$_POST['stock'] : 0;
$giagio = isset($_POST['giagio']) ? (float)$_POST['giagio'] : 0;
$giaban = isset($_POST['giaban']) ? (float)$_POST['giaban'] : 0;
$thuonghieu = isset($_POST['thuonghieu']) ? (int)$_POST['thuonghieu'] : 0;
$danhmuc = isset($_POST['danhmuc']) ? (int)$_POST['danhmuc'] : 0;

// Generate unique slug
function generateUniqueSlug($con, $slug) {
    $original_slug = $slug;
    $counter = 1;

    while (true) {
        $result = mysqli_query($con, "SELECT COUNT(*) as count FROM products WHERE slug='$slug'");
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] == 0) {
            return $slug;
        }

        $slug = $original_slug . '-' . $counter;
        $counter++;
    }
}

$slug = generateUniqueSlug($con, $slug);

// Xử lý hình ảnh 
$countfiles = count($_FILES['anhs']['name']);
$uploads_dir = 'uploads/';
$imgs = '';

for ($i = 0; $i < $countfiles; $i++) {
    $filename = $_FILES['anhs']['name'][$i];
    $file_tmp = $_FILES['anhs']['tmp_name'][$i];
    $unique_name = uniqid() . '_' . $filename;
    $location = $uploads_dir . $unique_name;
    $extension = strtolower(pathinfo($location, PATHINFO_EXTENSION));

    // File upload allowed extensions
    $valid_extensions = array("jpg", "jpeg", "png");

    if (in_array($extension, $valid_extensions)) {
        if (move_uploaded_file($file_tmp, $location)) {
            $imgs .= $location . ";";
        }
    }
}
$imgs = rtrim($imgs, ';');

// Câu lệnh thêm vào bảng 
$sql_str = "INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) 
VALUES (NULL, '$name', '$slug', '$description', '$sumary', $stock, $giaban, $giagio, '$imgs', $danhmuc, $thuonghieu, 'Active', NULL, NULL);";

// Thực thi câu lệnh 
if (mysqli_query($con, $sql_str)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql_str . "<br>" . mysqli_error($con);
}

// Trở về trang 
header("Location: listsanpham.php");
exit();
?>
