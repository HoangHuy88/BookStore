<!-- Breadcrumb -->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php">Trang chủ</a></li>
        <li>Voucher của bạn</li>
    </ul>
</div>

<?php
    $p = new data();
    if(isset($_SESSION['id_kh']) && isset($_SESSION['ho_ten']) && isset($_SESSION['email'])) {
        $id_kh = $_SESSION['id_kh'];
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM khach_hang WHERE id_kh='$id_kh' LIMIT 1");
        $row = mysqli_fetch_assoc($query);
?>
<div class="container">
    <div class="information">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="information_form">
                    <div class="information_form-tile">
                        <h3 class="h3 text-center">Voucher của bạn</h3>
                    </div>
                    <h4 class="information_form-hello">Điểm hiện tại của bạn <span><?php echo $row['diem_voucher']; ?></span></h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Voucher</th>
                                <th scope="col">Điểm</th>
                                <th scope="col">Ngày đổi</th>
                                <th scope="col">Ngày hết hạn</th>
                                <th scope="col">Mã áp dụng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query_voucher = mysqli_query($link, "SELECT * FROM voucher_kh WHERE id_kh='$id_kh'");
                                $i = mysqli_num_rows($query_voucher);
                                
                                if($i > 0) {
                                    $stt = 1;
                                    $get_date = strtotime(date('d-m-Y'));
                                                                                                        
                                    while($row_voucher = mysqli_fetch_array($query_voucher)) {
                                        $date_hh = strtotime($row_voucher['ngay_hh']);

                                        if($date_hh  == $get_date) {
                                            $ngay_end = $row_voucher['ngay_hh'].'<p class="text-danger">Voucher sắp hết hạn!</p>';
                                        } else {
                                            $ngay_end = $row_voucher['ngay_hh'];
                                        }        
                                        
                                        if($get_date > $date_hh) {
                                            //Xóa voucher hết hạn
                                            $p->themxoasua("DELETE FROM voucher_kh WHERE ngay_hh < date(now()) AND id_kh='$id_kh'");
                                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                                        }
                            ?>
                            <tr>
                                <th scope="row"><?php echo $stt++; ?></th>
                                <td><?php echo $row_voucher['tieu_de']; ?></td>
                                <td><?php echo $row_voucher['diem']; ?></td>
                                <td><?php echo $row_voucher['ngay_doi']; ?></td>
                                <td><?php echo $ngay_end; ?></td>
                                <td><?php echo $row_voucher['ma_ap']; ?></td>
                            </tr>
                            <?php
                                    }
                                } else {
                                    echo '<p class="text-danger" style="font-size: 18px;">Bạn chưa có voucher nào!</p>';
                                }
                            ?>
                        </tbody>
                    </table>			
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>			
    </div>
</div>
<?php
    } else {
        echo '<p class="text-danger">Lỗi!</p>';
    }
?>