<?php

// Get the ID from the URL parameter
$delid = $_GET['id'];

// Validate the ID
if (!isset($delid) || !is_numeric($delid)) {
    die("Invalid ID");
}

// Connect to the database
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

// Prepare the SQL statement
$sql_str = "DELETE FROM categories WHERE id=$delid";

// Execute the SQL statement
if (mysqli_query($con, $sql_str)) {
    // Redirect to the categories list page after deletion
    header("Location: listcats.php");
    exit;
} else {
    // Display error message if something goes wrong
    echo "Error deleting record: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
