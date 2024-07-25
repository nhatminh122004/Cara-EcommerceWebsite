<?php
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

// Lấy dữ liệu từ form
$name = mysqli_real_escape_string($con, $_POST['name']);
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
$sumary = mysqli_real_escape_string($con, $_POST['sumary']);
$description = mysqli_real_escape_string($con, $_POST['description']);
$danhmuc = (int)$_POST['danhmuc'];
$thuonghieu = isset($_POST['thuonghieu']) ? (int)$_POST['thuonghieu'] : 0;

// Xử lý hình ảnh
$filename = $_FILES['anh']['name'];
$location = "uploads/news/" . uniqid() . $filename;
$extension = pathinfo($location, PATHINFO_EXTENSION);
$extension = strtolower($extension);
$valid_extensions = array("jpg", "jpeg", "png");
$response = 0;

if (in_array(strtolower($extension), $valid_extensions)) {
    if (move_uploaded_file($_FILES['anh']['tmp_name'], $location)) {
        // Hình ảnh đã được upload thành công
    }
}

// Câu lệnh thêm vào bảng
$sql_str = "INSERT INTO `news` (`tittle`, `avatar`, `slug`, `sumary`, `description`, `newcategories_id`, `brand_id`, `created_at`, `updated_at`) VALUES 
    ('$name', 
    '$location',
    '$slug', 
    '$sumary',
    '$description',  
    $danhmuc,
    $thuonghieu,  
    NOW(), 
    NOW());";

// Thực thi câu lệnh
if (mysqli_query($con, $sql_str)) {
    // Trở về trang
    header("Location: listnews.php");
    exit();
} else {
    echo "Error: " . $sql_str . "<br>" . mysqli_error($con);
}

// Đóng kết nối
mysqli_close($con);
?>

