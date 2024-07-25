<?php

// Lấy ID gọi đến 
$delid = $_GET['id'];

// Kết nối cơ sở dữ liệu
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

//Tìm các hình ảnh và xóa 
$sql1 = "select avatar from news where id=$delid";
$rs = mysqli_query($con, $sql1);
$row = mysqli_fetch_assoc($rs);

//Danh sách các ảnh
$images_arr = explode(';', $row['images']);
// print_r($images_arr); exit;
//Xóa ảnh trong thư mục lưu 
foreach($images_arr as $img){
    unlink($img);
}

// Xóa dữ liệu sản phẩm trong CSDL
$sql_str = "DELETE FROM news WHERE id=$delid";
mysqli_query($con, $sql_str);

// Trở về trang liệt kê brands
header("Location: listnews.php");
exit;
?>