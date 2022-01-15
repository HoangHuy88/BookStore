<?php
    $p = new data();
    $link = $p->connect();
    
    if(isset($_GET['slug'])) {
        $slug_cate = $_GET['slug'];
        $query = mysqli_query($link, "SELECT * FROM category_sp WHERE slug_danhmuc='$slug_cate'");
        $row = mysqli_fetch_assoc($query);
        $id_categrory = $row['id_category'];
?>
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php">Trang chủ</a></li>
        <li>Sản phẩm</li>
        <li><?php echo $row['ten_danhmuc']; ?></li>
    </ul>
</div>
<!-- Content -->
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-3">
            <div class="section-heading">
                <h3>Danh mục sản phẩm</h3>
                <div class="list-group">
                    <?php
                        $query = mysqli_query($link, "SELECT * FROM category_sp ORDER BY id_category ASC");
                        while ($row_cate = mysqli_fetch_array($query)) {
                            $slug_cate_dm = $row_cate['slug_danhmuc'];
                    ?>
                    <a href="?page=san-pham&slug=<?php echo $slug_cate_dm; ?>" class="list-group-item list-group-item-action">
                        <?php echo $row_cate['ten_danhmuc']; ?>
                    </a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-sm-8 col-md-9">
            <div class="section-heading">
                <h3><?php echo $row['ten_danhmuc']; ?></h3>
            </div>
            <div class="row">
                <?php
                    //Phân trang
                    if(isset($_GET['trang'])) {
                        $trang = $_GET['trang'];
                    } else {
                        $trang = 1;
                    }
                    
                    $rowsPerPage = 6;
                    $perRow = $trang*$rowsPerPage-$rowsPerPage;
                    
                    $p->read_sp_4("SELECT * FROM san_pham WHERE id_danhmuc='$id_categrory' ORDER BY id_sp DESC LIMIT $perRow, $rowsPerPage");
                    
                    //Tính tổng số trang
                    $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM san_pham WHERE id_danhmuc='$id_categrory'"));
                    $totalPage = ceil($totalRow/$rowsPerPage);
                    
                    $listPage = '';
                    for($i = 1; $i <= $totalPage; $i++) {
                        if($trang == $i) {
                            $listPage .= '<li class="page-item active"><a class="page-link" '
                                    . 'href="index.php?page=san-pham&slug='.$slug_cate.'&trang='.$i.'">'.$i.'</a></li>';
                        } else {
                            $listPage .= '<li class="page-item"><a class="page-link" '
                                    . 'href="index.php?page=san-pham&slug='.$slug_cate.'&trang='.$i.'">'.$i.'</a></li>';
                        }
                    }                   
                ?>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php
                        echo $listPage;
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php
    } else {
        echo '<p class="text-danger">Lỗi trang!</p>';
    }
?>