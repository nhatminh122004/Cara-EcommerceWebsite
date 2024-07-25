<?php
// Start output buffering
ob_start();

require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\header.php');

// Lay id goi edit
$id = $_GET['id'];

// Ket noi csdl
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

// Tim trong CSDL brand co id trung
$sql_str = "SELECT * FROM categories WHERE id=$id";
$res = mysqli_query($con, $sql_str);
$cat = mysqli_fetch_assoc($res);

if (isset($_POST['btnUpdate'])) {
    // Neu nut Cap nhat duoc nhan
    // Lay name
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

    // Thuc hien viec cap nhat
    $sql_str2 = "UPDATE categories SET name='$name', slug='$slug' WHERE id=$id";
    mysqli_query($con, $sql_str2);

    // Chuyen qua trang listcats
    header("Location: listcats.php");
    exit(); // Ensure no further code is executed after redirect
}
?>

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Cập nhật danh mục sản phẩm</h1>
                        </div>
                        <form class="user" method="post" action="#">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                       placeholder="Tên danh mục"
                                       value="<?php echo htmlspecialchars($cat['name']); ?>">
                            </div>
                            <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\footer.php');

// Flush the output buffer
ob_end_flush();
?>
