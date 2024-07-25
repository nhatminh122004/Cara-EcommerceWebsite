<?php
// Start output buffering
ob_start();

require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\header.php');

// Lay id goi edit
$id = $_GET['id'];

// Ket noi csdl
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

$sql_str = "select 
products.id as pid,
summary,
description,
stock,
price,
disscounted_price,
products.name as pname,
images,
categories.name as cname,
brands.name as bname,
products.status as pstatus
from products, categories, brands 
where products.category_id=categories.id 
and products.brand_id = brands.id 
and products.id=$id";
// echo $sql_str; exit;   //debug cau lenh

$res = mysqli_query($con, $sql_str);

$product = mysqli_fetch_assoc($res);

function generateUniqueSlug($con, $slug, $id = 0) {
    $original_slug = $slug;
    $counter = 1;

    while (true) {
        $query = "SELECT COUNT(*) as count FROM products WHERE slug='$slug' AND id != $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] == 0) {
            return $slug;
        }

        $slug = $original_slug . '-' . $counter;
        $counter++;
    }
}

if (isset($_POST['btnUpdate'])){
   //lay du lieu tu form
   $name = mysqli_real_escape_string($con, $_POST['name']);
   $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
   $slug = generateUniqueSlug($con, $slug, $id); // Ensure slug is unique
   $summary = mysqli_real_escape_string($con, $_POST['summary']);
   $description = mysqli_real_escape_string($con, $_POST['description']);
   $stock = $_POST['stock'];
   $giagoc = $_POST['giagoc'];
   $giaban = $_POST['giaban'];
   $danhmuc = $_POST['danhmuc'];
   $thuonghieu = $_POST['thuonghieu'];
   $giaban = $_POST['giaban'];

   //xu ly hinh anh
   $countfiles = count($_FILES['anhs']['name']);

   if (!empty($_FILES['anhs']['name'][0])) { //có chọn hình ảnh mới - xóa các ảnh cũ
       //xoa anh cu
       $images_arr = explode(';', $product['images']);
       foreach ($images_arr as $img) {
           if (file_exists($img)) {
               unlink($img);
           }
       }

       //them anh moi 
       $imgs = '';
       for ($i = 0; $i < $countfiles; $i++) {
           $filename = $_FILES['anhs']['name'][$i];

           // Location
           $location = "uploads/" . uniqid() . $filename;
           $extension = pathinfo($location, PATHINFO_EXTENSION);
           $extension = strtolower($extension);

           // File upload allowed extensions
           $valid_extensions = array("jpg", "jpeg", "png");

           // Check file extension
           if (in_array(strtolower($extension), $valid_extensions)) {

               // them vao CSDL - them thanh cong moi upload anh len
               if (move_uploaded_file($_FILES['anhs']['tmp_name'][$i], $location)) {
                   $imgs .= $location . ";";
               }
           }
       }
       $imgs = substr($imgs, 0, -1);

       // cau lenh them vao bang
       $sql_str = "UPDATE products 
           SET name='$name', 
           slug='$slug', 
           description='$description', 
           summary='$summary', 
           stock=$stock, 
           price=$giagoc, 
           disscounted_price=$giaban, 
           images='$imgs', 
           category_id=$danhmuc, 
           brand_id=$thuonghieu 
           WHERE id=$id";
   } else {
       $sql_str = "UPDATE products 
           SET name='$name', 
           slug='$slug', 
           description='$description', 
           summary='$summary', 
           stock=$stock, 
           price=$giagoc, 
           disscounted_price=$giaban, 
           category_id=$danhmuc, 
           brand_id=$thuonghieu
           WHERE id=$id";
   }

   //thuc thi cau lenh
   if (mysqli_query($con, $sql_str)) {
       echo "Product updated successfully";
   } else {
       echo "Error: " . $sql_str . "<br>" . mysqli_error($con);
   }

   //tro ve trang 
   header("location: ./listsanpham.php");
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
                            <h1 class="h4 text-gray-900 mb-4">Cập nhật sản phẩm</h1>
                        </div>
                        <form class="user" method="post" action="#" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="emailHelp" placeholder="Tên sản phẩm" value="<?=$product['pname']?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Các hình ảnh cho sản phẩm</label>
                                <input type="file" class="form-control form-control-user" id="anhs" name="anhs[]" multiple>
                                <br>
                                Các ảnh hiện tại:
                                <?php
                                $arr = explode(';', $product['images']);
                                foreach ($arr as $img) {
                                    echo "<img src='$img' height='100px' />";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tóm tắt sản phẩm:</label>
                                <textarea name="summary" class="form-control" placeholder="Nhập..."><?=$product['summary']?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mô tả sản phẩm:</label>
                                <textarea name="description" class="form-control" placeholder="Nhập..."><?=$product['description']?></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="stock" name="stock" aria-describedby="emailHelp" placeholder="Số lượng nhập:" value="<?=$product['stock']?>">
                                </div>
                                <div class="col-sm-4 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="giagoc" name="giagoc" aria-describedby="emailHelp" placeholder="Giá gốc" value="<?=$product['price']?>">
                                </div>
                                <div class="col-sm-4 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="giaban" name="giaban" aria-describedby="emailHelp" placeholder="Giá bán:" value="<?=$product['disscounted_price']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Danh mục:</label>
                                <select class="form-control" name="danhmuc">
                                    <option>Chọn danh mục</option>
                                    <?php 
                                    $sql_str = "select * from categories order by name";
                                    $result = mysqli_query($con, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <option value="<?php echo $row['id'];?>"
                                        <?php if ($row['name'] == $product['cname']) echo "selected"; ?>
                                    ><?php echo $row['name'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Thương hiệu:</label>
                                <select class="form-control" name="thuonghieu">
                                    <option>Chọn thương hiệu</option>
                                    <?php 
                                    $sql_str = "select * from brands order by name";
                                    $result = mysqli_query($con, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <option value="<?php echo $row['id'];?>"
                                        <?php if ($row['name'] == $product['bname']) echo "selected=true"; ?>
                                    ><?php echo $row['name'];?></option>
                                    <?php } ?>
                                </select>
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

