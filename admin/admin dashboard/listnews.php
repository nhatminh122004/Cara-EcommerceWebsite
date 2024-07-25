<?php
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\header.php');

function anhdaidien($img, $height)
{
    return "<img src='$img' height='$height' />";
}
?>

<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tin tức</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Ảnh đại diện</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Ảnh đại diện</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\db\conn.php');
                        $sql_str = "SELECT *,
                                    news.id as nid,
                                    news.tittle as ntittle,
                                    news.avatar as navatar,
                                    news.slug as nslug,
                                    news.sumary as nsumary,
                                    news.description as ndescription,
                                    newcategories.name as ncname,
                                    brands.name as bname,
                                    news.created_at as ncreated,
                                    news.updated_at as nupdated
                                    FROM news
                                    LEFT JOIN newcategories ON news.newcategories_id = newcategories.id
                                    LEFT JOIN brands ON news.brand_id = brands.id
                                    ORDER BY news.tittle";
                        $result = mysqli_query($con, $sql_str);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $row['nid'] ?></td>
                                <td><?= $row['ntittle'] ?></td>
                                <td><?= anhdaidien($row['navatar'], "100px") ?></td>
                                <td><?= $row['ncname'] ?></td>
                                <td><?= $row['bname'] ?></td>
                                <td>
                                    <a class="btn btn-warning" href="editnews.php?id=<?= $row['nid'] ?>">Edit</a>
                                    <a class="btn btn-danger" href="deletenews.php?id=<?= $row['nid'] ?>" onclick="return confirm('Bạn chắc chắn xóa tin tức này?');">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require('C:\xampp\htdocs\Cara-EcommerceWebsite - Sao chép\Cara-EcommerceWebsite-main\admin\admin dashboard\includes\footer.php');
?>