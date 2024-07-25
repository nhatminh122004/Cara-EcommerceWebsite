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
                            <h1 class="h4 text-gray-900 mb-4">Thêm mới tin tức</h1>
                        </div>
                        <form class="user" method="post" action="addnews.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="emailHelp" placeholder="Tiêu đề tin tức">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Hình đại diện cho tin</label>
                                <input type="file" class="form-control form-control-user" id="anh" name="anh">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tóm tắt tin:</label>
                                <textarea name="sumary" class="form-control" placeholder="Nhập">

                        </textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nội dung tin:</label>
                                <textarea name="description" class="form-control" placeholder="Nhập">

                        </textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Thương hiệu :</label>
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
                                <label class="form-label">Danh mục tin tức:</label>
                                <select class="form-control" name="danhmuc">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    $sql_str = 'SELECT * FROM newcategories ORDER BY name';
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