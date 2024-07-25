<?php

// Lấy ID gọi đến 
$delid = $_GET['id'];

// Kết nối cơ sở dữ liệu
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

$sql_str = "DELETE FROM brands WHERE id=$delid";
mysqli_query($con, $sql_str);

// Trở về trang liệt kê brands
header("Location: listbrands.php");
exit;
?>