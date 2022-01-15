<?php
    $p = new data();
    if(isset($_GET['slug'])) {
        $slug_cateblog = $_GET['slug'];
        
        $link = $p->connect();
        $query_cate = mysqli_query($link, "SELECT * FROM category_blog WHERE slug_danhmuc='$slug_cateblog'");
        $row = mysqli_fetch_assoc($query_cate);
        $id_cate = $row['id_cate'];
    }
?>
<div class="container">
    <ul class="breadcrumb">
        <li><a href="../index.php">Trang chủ</a></li>
        <li>Blog</li>
        <li><?php echo $row['ten_danhmuc']; ?></li>
    </ul>
</div>

<!-- Content -->
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="section-heading">
                <h3><?php echo $row['ten_danhmuc']; ?></h3>
            </div>
            <?php
                //Phân trang
                if (isset($_GET['trang'])) {
                    $trang = $_GET['trang'];
                } else {
                    $trang = 1;
                }

                $rowsPerPage = 3;
                $perRow = $trang * $rowsPerPage - $rowsPerPage;
                
                $query_blog = mysqli_query($link, "SELECT * FROM blog WHERE id_danhmuc='$id_cate' ORDER "
                            . "BY id_blog DESC LIMIT $perRow, $rowsPerPage");
                
                //Tính tổng số trang
                $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM blog WHERE id_blog='$id_cate'"));
                $totalPage = ceil($totalRow / $rowsPerPage);

                $listPage = '';
                for ($i = 1; $i <= $totalPage; $i++) {
                    if ($trang == $i) {
                        $listPage .= '<li class="page-item active"><a class="page-link" '
                                . 'href="index.php?page=blog&slug='.$row['slug_danhmuc'].'&trang='.$i.'">'.$i.'</a></li>';
                    } else {
                        $listPage .= '<li class="page-item"><a class="page-link" '
                                . 'href="index.php?page=blog&slug='.$row['slug_danhmuc'].'&trang='.$i.'">'.$i.'</a></li>';
                    }
                }

                while ($row_blog = mysqli_fetch_array($query_blog)) {
            ?>
            <div class="row">
                <div class="col-md-3">
                    <img src="./img/blog/<?php echo $row_blog['image']; ?>" alt="" class="img-thumbnail">
                </div>
                <div class="col-md-9">
                    <div class="blogs_detail">
                        <h4 class="blogs_detail-title"><?php echo $row_blog['tieu_de']; ?></h4>
                        <p>
                            Thời gian: <span><?php echo $row_blog['ngay_tao']; ?></span>
                            &nbsp; &nbsp;Lượt xem: <span style="font-weight: 600"><?php echo $row_blog['luot_xem']; ?></span>
                        </p>
                        <p>
                            <?php echo mb_substr($row_blog['tom_tat'], 0, 280).'...'; ?>
                        </p>
                    </div>
                    <a href="?page=chi-tiet-blog&slug_blog=<?php echo $row_blog['slug_blog']; ?>" class="product_detail-add-like">Chi tiết <i class="fas fa-angle-double-right"></i></a>
                </div>
            </div> <br>
            <?php
                }
            ?>
            
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

        <div class="col-md-3">
            <div class="section-heading">
                <h3>Bài viết mới</h3>
                <?php
                    $query_newblog = mysqli_query($link, "SELECT * FROM blog ORDER BY id_blog DESC LIMIT 3");
                    while ($row_newblog = mysqli_fetch_array($query_newblog)) {
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <img src="./img/blog/<?php echo $row_newblog['image']; ?>" alt="" class="img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <a href="?page=chi-tiet-blog&slug_blog=<?php echo $row_newblog['slug_blog']; ?>"><?php echo $row_newblog['tieu_de']; ?></a>
                    </div>
                </div> <br>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

