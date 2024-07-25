<?php
// Start output buffering
ob_start();

require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\header.php');

// Lay id goi edit
$id = $_GET['id'];

// Ket noi csdl
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');

$sql_str = "SELECT 
            news.id as nid,
            news.tittle as ntittle,
            news.avatar as navatar,
            news.slug as nslug,
            news.sumary as nsumary,
            news.description as ndescription,
            newcategories.name as ncname,
            brands.name as bname
            FROM news
            LEFT JOIN newcategories ON news.newcategories_id = newcategories.id
            LEFT JOIN brands ON news.brand_id = brands.id
            WHERE news.id=$id";

$res = mysqli_query($con, $sql_str);

$news = mysqli_fetch_assoc($res);

function generateUniqueSlug($con, $slug, $id = 0) {
    $original_slug = $slug;
    $counter = 1;

    while (true) {
        $query = "SELECT COUNT(*) as count FROM news WHERE slug='$slug' AND id != $id";
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
   $tittle = mysqli_real_escape_string($con, $_POST['tittle']);
   $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $tittle)));
   $slug = generateUniqueSlug($con, $slug, $id); // Ensure slug is unique
   $sumary = mysqli_real_escape_string($con, $_POST['sumary']);
   $description = mysqli_real_escape_string($con, $_POST['description']);
   $danhmuc = $_POST['danhmuc'];
   $thuonghieu = $_POST['thuonghieu'];

   //xu ly hinh anh
   if (!empty($_FILES['avatar']['name'])) { //có chọn hình ảnh mới - xóa các ảnh cũ
       //xoa anh cu
       if (file_exists($news['navatar'])) {
           unlink($news['navatar']);
       }

       //them anh moi 
       $filename = $_FILES['avatar']['name'];

       // Location
       $location = "uploads/news/" . uniqid() . $filename;
       $extension = pathinfo($location, PATHINFO_EXTENSION);
       $extension = strtolower($extension);

       // File upload allowed extensions
       $valid_extensions = array("jpg", "jpeg", "png");

       // Check file extension
       if (in_array(strtolower($extension), $valid_extensions)) {

           // them vao CSDL - them thanh cong moi upload anh len
           if (move_uploaded_file($_FILES['avatar']['tmp_name'], $location)) {
               $avatar = $location;
           }
       }

       // cau lenh them vao bang
       $sql_str = "UPDATE news 
           SET tittle='$tittle', 
           slug='$slug', 
           description='$description', 
           sumary='$sumary', 
           avatar='$avatar', 
           newcategories_id=$danhmuc, 
           brand_id=$thuonghieu 
           WHERE id=$id";
   } else {
       $sql_str = "UPDATE news 
           SET tittle='$tittle', 
           slug='$slug', 
           description='$description', 
           sumary='$sumary', 
           newcategories_id=$danhmuc, 
           brand_id=$thuonghieu
           WHERE id=$id";
   }

   //thuc thi cau lenh
   if (mysqli_query($con, $sql_str)) {
       echo "News updated successfully";
   } else {
       echo "Error: " . $sql_str . "<br>" . mysqli_error($con);
   }

   //tro ve trang 
   header("location: ./listnews.php");
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
                            <h1 class="h4 text-gray-900 mb-4">Cập nhật tin tức</h1>
                        </div>
                        <form class="user" method="post" action="#" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="tittle" name="tittle" aria-describedby="emailHelp" placeholder="Tiêu đề" value="<?=$news['ntittle']?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ảnh đại diện:</label>
                                <input type="file" class="form-control form-control-user" id="avatar" name="avatar">
                                <br>
                                Ảnh hiện tại:
                                <?php
                                echo "<img src='{$news['navatar']}' height='100px' />";
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tóm tắt:</label>
                                <textarea name="sumary" class="form-control" placeholder="Nhập..."><?=$news['nsumary']?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mô tả:</label>
                                <textarea name="description" class="form-control" placeholder="Nhập..."><?=$news['ndescription']?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Danh mục:</label>
                                <select class="form-control" name="danhmuc">
                                    <option>Chọn danh mục</option>
                                    <?php 
                                    $sql_str = "select * from newcategories order by name";
                                    $result = mysqli_query($con, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <option value="<?php echo $row['id'];?>"
                                        <?php if ($row['name'] == $news['ncname']) echo "selected"; ?>
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
                                        <?php if ($row['name'] == $news['bname']) echo "selected"; ?>
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
