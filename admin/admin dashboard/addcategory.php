<?php

// Connect to the database
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

// Get data from form
$name = $_POST['name'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

// Check if the slug already exists
$check_slug_query = "SELECT COUNT(*) AS count FROM `categories` WHERE `slug`='$slug'";
$result = mysqli_query($con, $check_slug_query);
$row = mysqli_fetch_assoc($result);

if ($row['count'] > 0) {
    // If the slug already exists, handle the error (e.g., show an error message or redirect back with an error)
    echo "Error: The category slug '$slug' already exists. Please choose a different name.";
    // Alternatively, you can redirect back to the form with an error message
    // header("location: addcategory.php?error=slug_exists");
} else {
    // If the slug is unique, insert the new category
    $sql_str = "INSERT INTO `categories` (`name`, `slug`, `status`) VALUES ('$name', '$slug', 'Active')";
    
    if (mysqli_query($con, $sql_str)) {
        // Redirect to the list page if the insertion is successful
        header("location: listcats.php");
    } else {
        // Handle the error if the insertion fails
        echo "Error: " . $sql_str . "<br>" . mysqli_error($con);
    }
}
?>
