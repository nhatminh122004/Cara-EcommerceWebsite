<?php

// Get the ID from the request
$delid = $_GET['id'];

// Connect to the database
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

// Now delete the category
$sql_str_category = "DELETE FROM newcategories WHERE id=$delid";
mysqli_query($con, $sql_str_category);

// Redirect back to the list page
header("Location: listnewcats.php");
exit;
?>
