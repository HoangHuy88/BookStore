<?php
    $p = new data();
    $link = $p->connect();
?>
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php">Trang chủ</a></li>
        <li>Voucher</li>
    </ul>
</div>

<?php
    //Phân trang
    if (isset($_GET['trang'])) {
        $trang = $_GET['trang'];
    } else {
        $trang = 1;
    }

    $rowsPerPage = 4;
    $perRow = $trang * $rowsPerPage - $rowsPerPage;
    
    $get_date = strtotime(date("d-m-Y"));

    $query = mysqli_query($link, "SELECT * FROM voucher ORDER BY id_voucher DESC LIMIT $perRow, $rowsPerPage");
    
    //Tính tổng số trang
    $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM voucher"));
    $totalPage = ceil($totalRow/$rowsPerPage);
    
    $listPage = '';
    for($i = 1; $i <= $totalPage; $i++) {
        if($trang == $i) {
            $listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page=voucher&trang='.$i.'">'.$i.'</a></li>';
        } else {
            $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page=voucher&trang='.$i.'">'.$i.'</a></li>';
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
                <h3>Voucher mới nhất</h3>
            </div>
            <?php
                if(isset($_POST['doi_voucher'])) {
                    if (isset($_SESSION['id_kh']) && isset($_SESSION['ho_ten']) && isset($_SESSION['email'])) {
                        $id_kh = $_SESSION['id_kh'];
                        $tieu_de = $_POST['tieu_de'];
                        $diem = $_POST['diem'];
                        $giam = $_POST['giam'];
                        $ngay_hh = $_POST['ngay_hh'];
                        $ma_ap = $_POST['ma_ap'];
                        
                        //Lấy thông tin điểm khách hàng
                        $query_kh = mysqli_query($link, "SELECT * FROM khach_hang WHERE id_kh='$id_kh'");
                        $row_kh = mysqli_fetch_assoc($query_kh);
                        if($row_kh['diem_voucher'] > $diem) {
                            if($p->themxoasua("INSERT INTO voucher_kh(tieu_de, diem, giam, ngay_doi, ngay_hh, ma_ap, id_kh) "
                                    . "VALUES ('$tieu_de', '$diem', '$giam', now(),'$ngay_hh', '$ma_ap', '$id_kh')") == 1) {
                                $diem_new = $row_kh['diem_voucher'] - $diem;
                                if($p->themxoasua("UPDATE khach_hang SET diem_voucher='$diem_new' WHERE id_kh='$id_kh'") == 1) {
                                    echo '<h4 class="text-primary">Đổi voucher thành công!</h4>';
                                }                                
                            }
                        } else {
                            echo '<h4 class="error">Bạn chưa đủ điểm để đổi voucher này!</h4>';
                        }
                    } else {
                        echo '<h4 class="error">Bạn cần đăng nhập tài khoản để đổi voucher!</h4>';
                    }
                }
                while($row = mysqli_fetch_array($query)) {
            ?>
                <div class="row" style="margin-bottom: 42px;">
                    <div class="col-md-4">
                        <img src="img/voucher/<?php echo $row['image'] ?>" alt="" class="img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <div class="blogs_detail">
                            <h4 class="blogs_detail-title h4"><?php echo $row['tieu_de'] ?></h4>
                            <div class="voucher_date">
                                <p>Thời gian: <span><?php echo $row['ngay_bd'] ?></span> đến <span><?php echo $row['ngay_kt'] ?></span></p>
                            </div>
                            <p>
                                <?php echo $row['mo_ta'] ?>
                            </p>
                        </div> <br>
                        <form action="" method="POST">
                            <input type="hidden" name="tieu_de" value="<?php echo $row['tieu_de']; ?>" />
                            <input type="hidden" name="diem" value="<?php echo $row['diem']; ?>" />
                            <input type="hidden" name="giam" value="<?php echo $row['giam']; ?>" />
                            <input type="hidden" name="ngay_hh" value="<?php echo $row['ngay_kt']; ?>" />
                            <input type="hidden" name="ma_ap" value="<?php echo $row['ma_voucher']; ?>" />
                            <?php
                                if(strtotime($row['ngay_kt']) >= $get_date) {
                            ?>
                                <button type="submit" name="doi_voucher" class="product_detail-add-like">Đổi điểm <i class="fas fa-angle-double-right"></i></button>
                            <?php
                                } else {
                            ?>
                                <p class="h4 text-danger">Voucher này đã hết hạn khuyến mại!</p>
                            <?php
                                }
                            ?>
                        </form>
                    </div>
                </div>
            <?php             
                }
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php
                        echo $listPage;
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>