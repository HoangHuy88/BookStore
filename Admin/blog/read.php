<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Blog</h1>
    <a href="?page_layout=add-blog" class="btn btn-dark">Thêm blog</a>
</div>

<?php
    $p = new database();
    $link = $p->connect();
    
    //Phân trang
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    $rowPerPage = 3;
    $perRow = $page*$rowPerPage - $rowPerPage;
    
    $query = mysqli_query($link, "SELECT * FROM blog INNER JOIN category_blog WHERE "
            . "blog.id_danhmuc=category_blog.id_cate ORDER BY id_blog DESC LIMIT $perRow, $rowPerPage");
    
    //Tính tổng số trang
    $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM blog"));
    $totalPage = ceil($totalRow/$rowPerPage);
    
    $listPage = '';
    for($i = 1; $i <= $totalPage; $i++) {
        if($page == $i) {
            $listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=blog&page='.$i.'">'.$i.'</a></li>';
        } else {
            $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=blog&page='.$i.'">'.$i.'</a></li>';
        }
    }
?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tiêu đề</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Slug blog</th>
            <th scope="col">Thuộc</th>
            <th scope="col">Tóm tắt</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Quản lý</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $stt = 1;
            while($row = mysqli_fetch_array($query)) {
                $id_blog = $row['id_blog'];
        ?>
        <tr>
            <th scope="row"><?php echo $stt++; ?></th>
            <td><?php echo $row['tieu_de']; ?></td>
            <td width="20%">
                <img src="../img/blog/<?php echo $row['image']; ?>" alt="" width="80%" height="80" />
            </td>
            <td><?php echo $row['slug_blog']; ?></td>
            <td><?php echo $row['ten_danhmuc']; ?></td>
            <td><?php echo mb_substr($row['tom_tat'], 0, 120).'...'; ?></td>
            <td><?php echo $row['ngay_tao']; ?></td>
            <td class="text-center">
                <a href="?page_layout=update-blog&id=<?php echo $id_blog; ?>" class="btn btn-primary">Cập nhật</a>
                <a data-confirm="Bạn có chắc chắn muốn xóa blog này không?" href="?page_layout=delete-blog&id=<?php echo $id_blog; ?>" class="btn btn-danger delete">Xóa</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php
            echo $listPage;
        ?>
    </ul>
</nav>