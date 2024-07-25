<?php
session_start();
$errorMsg = "";

if (isset($_POST["btSubmit"])) {
    // Lấy dữ liệu từ form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Kết nối cơ sở dữ liệu
    require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

    // Câu lệnh truy vấn
    $sql = "SELECT * FROM admins WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    // Kiểm tra số lượng record trả về: > 0: đăng nhập thành công
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Kiểm tra mật khẩu
        if ($row['password'] === $password) { // Nếu mật khẩu không được mã hóa
            // Lưu trữ thông tin đăng nhập
            $_SESSION['user'] = $row;

            // Chuyển qua trang quản trị
            header("Location: index.php");
            exit;
        } else {
            $errorMsg = "Mật khẩu không đúng";
        }
    } else {
        $errorMsg = "Không tìm thấy thông tin tài khoản trong hệ thống";
    }
}
require_once('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\loginform.php');
?>
