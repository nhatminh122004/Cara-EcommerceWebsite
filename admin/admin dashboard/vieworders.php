<?php
// Kết nối cơ sở dữ liệu
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

// Lấy ID của đơn hàng từ URL
$id = intval($_GET['id']);

// Truy vấn để lấy thông tin chi tiết đơn hàng
$sql_str = "SELECT * FROM orders WHERE id = $id";
$res = mysqli_query($con, $sql_str);
$order = mysqli_fetch_assoc($res);

if (isset($_POST['btnUpdate'])) {
    // Lấy dữ liệu từ form
    $status = $_POST['status'];

    // Cập nhật trạng thái đơn hàng
    $sql_str = "UPDATE `orders` SET status = '$status' WHERE `id` = $id";
    mysqli_query($con, $sql_str);

    // Trở về trang danh sách đơn hàng
    header("location: listorders.php");
} else {
    require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\header.php');
    ?>

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Xem và cập nhật trạng thái đơn hàng</h1>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <form class="user" method="post" action="#">
                                        <div class="row">
                                            <div class="col-md-3">Khách hàng:</div>
                                            <div class="col-md-9">
                                                <?= $order['firstname'] . ' ' . $order['lastname'] ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">Địa chỉ:</div>
                                            <div class="col-md-9">
                                                <?= $order['address'] ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">Số điện thoại:</div>
                                            <div class="col-md-9">
                                                <?= $order['phone'] ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">Email:</div>
                                            <div class="col-md-9">
                                                <?= $order['email'] ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">Trạng thái đơn hàng:</div>
                                            <div class="col-md-9">
                                                <select name="status" id="">
                                                    <option <?= $order['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                                                    <option <?= $order['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                                    <option <?= $order['status'] == 'Shipping' ? 'selected' : '' ?>>Shipping</option>
                                                    <option <?= $order['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                                    <option <?= $order['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h3>Chi tiết đơn hàng</h3>
                                    <table class="table">
                                        <tr>
                                            <th>STT</th>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tiền</th>
                                        </tr>
                                        <?php
                                        // Truy vấn để lấy chi tiết sản phẩm trong đơn hàng
                                        $sql = "SELECT orders.*, products.name AS pname FROM orders JOIN products ON orders.product_id = products.id WHERE orders.id = $id";
                                        $res = mysqli_query($con, $sql);
                                        $stt = 0;
                                        $tongtien = 0;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $subtotal = $row['price'] * 1; // Assuming quantity is 1 since it's not stored
                                            $tongtien += $subtotal;
                                            ?>
                                            <tr>
                                                <td><?= ++$stt ?></td>
                                                <td><?= htmlspecialchars($row['pname']) ?></td>
                                                <td><?= number_format($row['price'], 0, '', '.') . " $" ?></td>
                                                <td>1</td>
                                                <td><?= number_format($subtotal, 0, '', '.') . " $" ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                    <div class="tongtien">
                                        <h5>
                                            Tổng tiền: <?= number_format($tongtien, 0, '', '.') . " $" ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\footer.php');
}
?>
