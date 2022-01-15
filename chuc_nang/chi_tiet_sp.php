<?php
    $p = new data();
    $link = $p->connect();
    if(isset($_GET['slug-san-pham'])) {
        $slug_sp = $_GET['slug-san-pham'];
        $query = mysqli_query($link, "SELECT * FROM san_pham WHERE slug_sp='$slug_sp'");
        $row = mysqli_fetch_assoc($query);
        $id_product = $row['id_sp'];
        $id_cateproduct = $row['id_danhmuc'];
    }
?>

<!-- Breadcrumb -->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="../index.php">Trang chủ</a></li>
        <li>Chi tiết sản phẩm</li>
        <li><?php echo $row['ten_sp']; ?></li>
    </ul>
</div>

<!-- Content -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="./img/product/<?php echo $row['image']; ?>" alt="">
            <img style="position: absolute; width: 140px; margin-top: 220px; margin-left: -152px;" 
                 src="./img/qr_code/<?php echo $row['ma_qr']; ?>" alt="">
        </div>

        <div class="col-md-5">
            <ul class="product_detail">
                <li class="product_detail-title"><h3><?php echo $row['ten_sp']; ?></h3></li>
                <div class="pro-rating">
                    <a href=""><i class="fa fa-star"></i></a>
                    <a href=""><i class="fa fa-star"></i></a>
                    <a href=""><i class="fa fa-star"></i></a>
                    <a href=""><i class="fa fa-star"></i></a>
                </div>
                <li class="product_detail-list">Tác giả: <span><?php echo $row['tac_gia']; ?></span></li>
                <li class="product_detail-list">Nhà xuất bản: 
                    <span><?php echo $row['nha_xb']; ?></span>
                </li>
                <li class="product_detail-list">Giá: 
                    <?php
                        if($row['gia_km'] == NULL) {
                    ?>
                        <span class="product_detail-list-price"><?php echo number_format($row['gia_sp']); ?> VNĐ</span>
                    <?php
                        } else {
                    ?>
                        <del><?php echo number_format($row['gia_sp']); ?> VNĐ</del>
                        <span class="product_detail-list-price"><?php echo number_format($row['gia_km']); ?> VNĐ</span>
                    <?php
                        }
                    ?>
                </li>
                <li class="product_detail-list">
                    <?php echo mb_substr($row['tom_tat'], 0, 320).'...'; ?>
                </li>					
            </ul>
            <div class="product_detail-add">
                <?php
                    $gia_sp_cart = $row['gia_km'] ? $row['gia_km'] : $row['gia_sp'];
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="id_sp" value="<?php echo $row['id_sp']; ?>">
                    <input type="hidden" name="ten_sp" value="<?php echo $row['ten_sp']; ?>">
                    <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                    <input type="hidden" name="gia_sp" value="<?php echo $gia_sp_cart; ?>">
                    <button type="submit" name="them_cart" onclick="add_cart_succes();"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>
        <?php
            $query_sale = mysqli_query($link, "SELECT * FROM san_pham WHERE gia_km!='' ORDER BY id_sp DESC LIMIT 3");
            $sl_sale = mysqli_num_rows($query_sale);
        ?>
        <div class="col-md-3">
            <h3>Sản phẩm giảm giá</h3>
            <hr>
            <?php
                if($sl_sale > 0) {
                    while ($row_sale = mysqli_fetch_array($query_sale)) {
            ?>
            <div class="row" style="margin-top: 16px;">
                <div class="col-md-5">
                    <img src="./img/product/<?php echo $row_sale['image']; ?>" alt="" class="img-thumbnail">
                </div>
                <div class="col-md-7">
                    <ul>
                        <li class="product_detail-list"><?php echo $row_sale['ten_sp']; ?></li>
                        <li class="product_detail-list">
                            <del><?php echo number_format($row_sale['gia_sp']); ?> VNĐ</del> <br>
                            <span class="product_detail-list-price"><?php echo number_format($row_sale['gia_km']); ?> VNĐ</span>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <?php
        //Phân trang
        if (isset($_GET['trang'])) {
            $trang = $_GET['trang'];
        } else {
            $trang = 1;
        }

        $rowsPerPage = 2;
        $perRow = $trang * $rowsPerPage - $rowsPerPage;

        $sql = "SELECT * FROM phan_hoi INNER JOIN khach_hang ON phan_hoi.id_kh=khach_hang.id_kh "
                    . "WHERE id_sp='$id_product' ORDER BY id_phanhoi DESC LIMIT $perRow, $rowsPerPage";
        $query_cmt = mysqli_query($link, $sql);
        $sl_cmt = mysqli_num_rows($query_cmt);
            
        //Tính tổng số trang
        $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM phan_hoi WHERE id_sp='$id_product'"));
        $totalPage = ceil($totalRow / $rowsPerPage);

        $listPage = '';
        for ($i = 1; $i <= $totalPage; $i++) {
            if ($trang == $i) {
                $listPage .= '<li class="page-item active"><a class="page-link" '
                        . 'href="index.php?page=chi-tiet-san-pham&slug-san-pham='.$slug_sp.'&trang='.$i.'">'.$i.'</a></li>';
            } else {
                $listPage .= '<li class="page-item"><a class="page-link" '
                        . 'href="index.php?page=chi-tiet-san-pham&slug-san-pham='.$slug_sp.'&trang='.$i.'">'.$i.'</a></li>';
            }
        }
        ?>
        <div class="col-md-12">
            <div class="product-tab">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">Mô tả sách</a></li>
                        <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="true">Phản hồi <span>(<?php echo $sl_cmt; ?>)</span></a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="product-page-tab-content">
                                <p><?php echo $row['mo_ta']; ?></p>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="review-form-wrapper">
                                        <?php
                                            if(isset($_SESSION['id_kh']) && isset($_SESSION['ho_ten']) && isset($_SESSION['email'])) {                                               
                                                $id_kh = $_SESSION['id_kh'];
                                                $ho_ten = $_SESSION['ho_ten'];
                                                $email = $_SESSION['email'];
                                                if(isset($_POST['feedback'])) {
                                                    $noi_dung = $_POST['noi_dung'];
                                                    if($p->themxoasua("INSERT INTO phan_hoi(noi_dung, date, id_kh, id_sp) "
                                                            . "VALUES ('$noi_dung', now(), '$id_kh', '$id_product')") == 1) {
                                                        echo '<p class="text-primary">Thêm phản hồi thành công!</p>';
                                                    } else {
                                                        echo '<p class="text-danger">Thêm phản hồi không thành công!</p>';
                                                    }
                                                }                                      
                                        ?>
                                        <h3>Gửi phản hồi</h3>
                                        <form action="" method="POST">
                                            <input type="text" class="form-control" name="ho_ten" value="<?php echo $ho_ten; ?>">
                                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                                            <textarea id="product-message" class="form-control" name="noi_dung" cols="30" rows="10" placeholder="Nội dung"></textarea>
                                            <button type="submit" name="feedback" class="btn btn-primary">Gửi phản hồi</button>
                                        </form>
                                        <?php
                                            } else {
                                        ?>
                                        <p class="text-danger" style="font-size: 18px;">
                                            Vui lòng đăng nhập để gửi phản hồi tới shop!
                                        </p>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    if($sl_cmt > 0) {
                                        while ($row_cmt = mysqli_fetch_array($query_cmt)) {
                                    ?>
                                    <div class="product-comments">
                                        <div class="product-comments-content">
                                            <p><strong><?php echo $row_cmt['ho_ten']; ?></strong> -
                                                <span><?php echo $row_cmt['date']; ?></span>
                                            </p>
                                            <div class="desc">
                                                <?php echo $row_cmt['noi_dung']; ?>
                                            </div>
                                            <div style="margin: 6px 0 0 16px;">
                                                <?php
                                                    if($row_cmt['tra_loi'] != '') {
                                                ?>
                                                <p><strong>Admin</strong></p>
                                                <p style="margin-top: -12px;">
                                                    <?php echo $row_cmt['tra_loi']; ?>
                                                </p>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
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
                                    <?php
                                        } else {
                                    ?>
                                        <p class="text-danger" style="font-size: 18px; margin-top: 24px;">
                                            Sản phẩm hiện tại chưa có phản hồi!
                                        </p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>					
            </div>
        </div>
    </div>
    <?php
        $query_catesp = mysqli_query($link, "SELECT * FROM category_sp WHERE id_category='$id_cateproduct'");
        $row_samecatesp = mysqli_fetch_assoc($query_catesp);
    ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="section-heading">
                <h3>
                    Sản phẩm cùng danh mục 
                    <a href="index.php?page=san-pham&slug=<?php echo $row_samecatesp['slug_danhmuc']; ?>" class="section-heading_show-all">Xem tất cả</a>
                </h3>
            </div>
        </div>
        <div class="clear"></div>
        <div class="row">
            <?php
                $p->read_sp_3("SELECT * FROM san_pham WHERE id_danhmuc=$id_cateproduct AND id_sp NOT IN ($id_product) LIMIT 4");
            ?>
        </div>					
    </div>
</div>