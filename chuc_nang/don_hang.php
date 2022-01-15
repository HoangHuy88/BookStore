<!-- Breadcrumb -->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php">Trang chủ</a></li>
        <li>Đơn hàng của bạn</li>
    </ul>
</div>

<!-- Content -->
<div class="container">
    <div class="information">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="information_form">
                    <div class="information_form-tile">
                        <h3 class="h3 text-center">Đơn hàng của bạn</h3>
                    </div>
                    <h4 class="information_form-hello"></h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã hóa đơn</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Thanh toán</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col" class="text-center">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $p = new data();
                                $link = $p->connect();
                                if(isset($_SESSION['id_kh']) && isset($_SESSION['ho_ten']) && isset($_SESSION['email'])) {
                                    $id_kh = $_SESSION['id_kh'];                                   
                                }
                                //Hủy đơn hàng
                                if(isset($_GET['huy_don'])) {
                                    $ma_hd = $_GET['huy_don'];
                                    if($p->themxoasua("UPDATE hoa_don SET trang_thai = 4 WHERE ma_hd='$ma_hd' LIMIT 1") == 1) {
                                        echo '<p class="text-danger">Vui lòng chờ xác nhận hủy đơn hàng!</p>';
                                    }
                                }
                                
                                //Nhận hàng thành công
                                if(isset($_GET['nhan-hang'])) {
                                    $nhan_hang = $_GET['nhan-hang'];
                                    if($p->themxoasua("UPDATE hoa_don SET trang_thai = 3 WHERE ma_hd='$nhan_hang' LIMIT 1") == 1) {
                                        
                                        //Xoa ma khuyen mai
                                        $query_apma = mysqli_query($link, "SELECT * FROM hoa_don WHERE ma_hd='$nhan_hang' LIMIT 1");
                                        $row_apma = mysqli_fetch_assoc($query_apma);
                                        if($row_apma['ma_ap'] != '') {
                                            $ma_ap = $row_apma['ma_ap'];
                                            $p->themxoasua("DELETE FROM voucher_kh WHERE id_kh='$id_kh' AND ma_ap='$ma_ap' LIMIT 1");
                                        }
                                        
                                        //Cap nhat diem voucher
                                        if($row_apma['tong_tien'] > 50000) {
                                            $diem_thuong = ceil($row_apma['tong_tien'] / 5000);
                                            //Lấy điểm cũ của khách hàng
                                            $query_kh = mysqli_query($link, "SELECT * FROM khach_hang WHERE id_kh='$id_kh' LIMIT 1");
                                            $row_kh = mysqli_fetch_assoc($query_kh);
                                            $diem_thuong_new = $row_kh['diem_voucher'] + $diem_thuong;
                                            $p->themxoasua("UPDATE khach_hang SET diem_voucher='$diem_thuong_new' WHERE id_kh='$id_kh' LIMIT 1");
                                        }
                                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                                    }
                                }
                                
                                //Phân trang
                                if(isset($_GET['trang'])) {
                                    $trang = $_GET['trang'];
                                } else {
                                    $trang = 1;
                                }

                                $rowsPerPage = 4;
                                $perRow = $trang*$rowsPerPage-$rowsPerPage;
    
                                $query = mysqli_query($link, "SELECT * FROM khach_hang INNER JOIN hoa_don ON khach_hang.id_kh=hoa_don.id_kh "
                                            . "WHERE hoa_don.id_kh='$id_kh' ORDER BY ngay_dat DESC LIMIT $perRow, $rowsPerPage");
                                
                                //Tính tổng số trang
                                $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM khach_hang INNER JOIN hoa_don ON khach_hang.id_kh=hoa_don.id_kh WHERE hoa_don.id_kh='$id_kh'"));
                                $totalPage = ceil($totalRow/$rowsPerPage);

                                $listPage = '';
                                for($i = 1; $i <= $totalPage; $i++) {
                                    if($trang == $i) {
                                        $listPage .= '<li class="page-item active"><a class="page-link" '
                                                . 'href="index.php?page=don-hang&trang='.$i.'">'.$i.'</a></li>';
                                    } else {
                                        $listPage .= '<li class="page-item"><a class="page-link" '
                                                . 'href="index.php?page=don-hang&trang='.$i.'">'.$i.'</a></li>';
                                    }
                                }  
                                  
                                    while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <th><?php echo $row['ma_hd']; ?></th>
                                <td><?php echo $row['ngay_dat']; ?></td>
                                <td><?php echo number_format($row['tong_tien']); ?> VNĐ</td>
                                <?php
                                    if($row['thanh_toan'] == 1) {
                                ?>
                                    <td>Thanh toán tại nhà</td>
                                <?php
                                    } else {                                      
                                ?>
                                    <td>Thanh toán online</td>
                                <?php
                                    }
                                ?>
                                <td>
                                    <?php
                                        if($row['trang_thai'] == 0) {
                                            echo 'Chờ xác nhận!';
                                        } else if($row['trang_thai'] == 1) {
                                            echo '<p class="text-primary">Đang chuẩn bị hàng!</p>';
                                        } else if($row['trang_thai'] == 2) {
                                            echo '<p class="text-info">Đang giao hàng!</p>';
                                        } else if($row['trang_thai'] == 3) {
                                            echo '<p class="text-warning">Nhận hàng thành công!</p>';
                                        } else if($row['trang_thai'] == 4) {
                                            echo '<p class="text-danger">Chờ hủy đơn!</p>';
                                        } else {
                                            echo '<p class="text-danger">Hủy đơn thành công!</p>';
                                        }
                                    ?>
                                    <!-- <form action="">
                                            <button type="submit" class="btn btn-primary">Đã nhận được hàng</button>
                                    </form> -->
                                </td>
                                <td class="text-center">
                                    <a href="?page=thanh-cong&ma_hd=<?php echo $row['ma_hd']; ?>" class="btn btn-primary">Chi tiết</a>
                                    <?php
                                        if($row['trang_thai'] != 3 && $row['trang_thai'] != 0 && $row['trang_thai'] != 1 
                                                && $row['trang_thai'] != 4 && $row['trang_thai'] != 5) {
                                    ?>
                                    <a href="?page=don-hang&nhan-hang=<?php echo $row['ma_hd']; ?>" class="btn btn-warning">Đã nhận hàng</a>                                  
                                    <?php
                                        } if($row['trang_thai'] != 3 && $row['trang_thai'] != 5) {
                                    ?>
                                    <a href="?page=don-hang&huy_don=<?php echo $row['ma_hd']; ?>" class="btn btn-danger">Hủy</a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                                    }
                            ?>
                        </tbody>
                    </table>	
                    
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
            <div class="col-md-1"></div>
        </div>			
    </div>
</div>

