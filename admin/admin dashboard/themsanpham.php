<?php
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
                            <h1 class="h4 text-gray-900 mb-4">Thêm sản phẩm mới</h1>
                        </div>
                        <form class="user" method="post" action="addproduct.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="emailHelp" placeholder="Tên sản phẩm">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label"> Hình ảnh sản phẩm </label>
                                <input type="file" class="form-control form-control-user" id="anhs" name="anhs[]" multiple >
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mã sản phẩm</label>
                                <textarea name="sumary" class="form-control" placeholder="Nhập"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mô tả sản phẩm</label>
                                <textarea name="description" class="form-control" placeholder="Nhập"></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="stock" name="stock" aria-describedby="emailHelp" placeholder="Số lượng nhập:"> 
                                </div>
                                <div class="col-sm-4 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="giagio" name="giagio" aria-describedby="emailHelp" placeholder="Giá nhập sản phẩm"> 
                                </div>
                                <div class="col-sm-4 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="giaban" name="giaban" aria-describedby="emailHelp" placeholder="Giá sản phẩm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Thương hiệu:</label>
                                <select class="form-control" name="thuonghieu">
                                    <option value="">Chọn thương hiệu</option>
                                    <?php
                                    require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');
                                    $sql_str = 'SELECT * FROM brands ORDER BY name';
                                    $result = mysqli_query($con, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Danh mục sản phẩm:</label>
                                <select class="form-control" name="danhmuc"> 
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    $sql_str = 'SELECT * FROM categories ORDER BY name';
                                    $result = mysqli_query($con, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Tạo mới</button>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\footer.php');
?>
