<!-- Breadcrumb -->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php">Trang chủ</a></li>
        <li>Giỏ hàng</li>
    </ul>
</div>

<!-- Content -->
<div class="container">
    <h2 class="h2 text-center">Giỏ hàng của bạn</h2> <br>
    <table class="table h4">
        <?php
            if(count($_SESSION['giohang']) != 0) {
        ?>
        <thead>
            <tr>
                <th scope="col">Hình ảnh</th>
                <th scope="col" width="380">Sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col" width="200">Số lượng</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Quản lý</th>
            </tr>
        </thead>
        <?php
            } else {
        ?> 
            <h4 class="text-danger">Giỏ hàng của bạn chưa có sản phẩm nào!</h4>
        <?php
            }
            if(isset($_POST['update_cart'])) {
                $name_update = $_POST['name_update'];
                $soluong = $_POST['so_luong'];
                for($i=0; $i<sizeof($_SESSION['giohang']); $i++) { 
                    if($_SESSION['giohang'][$i][0] == $name_update) {
                        $slNew = $soluong;
                        $_SESSION['giohang'][$i][2] = $slNew;
                        header("refresh: 0");
                        break;
                    }
                }
            }
        ?>
        <tbody id="tbody">
            <?php                
                if(isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])) {
                    $totalPrice = 0;
                    for($i=0; $i<sizeof($_SESSION['giohang']); $i++) { 
                        $ttPrice = $_SESSION['giohang'][$i]['3'] * $_SESSION['giohang'][$i]['2'];
                        $totalPrice += $ttPrice;
            ?>
            <form action="" method="POST">
                <tr>
                    <th scope="row">
                        <img src="./img/product/<?php echo $_SESSION['giohang'][$i][1]; ?>" alt="" width="128" class="img-thumbnail">
                    </th>
                    <td><?php echo $_SESSION['giohang'][$i][0]; ?></td>
                    <td><?php echo number_format($_SESSION['giohang'][$i][3]); ?> VNĐ</td>
                    <td>
                        <input type="hidden" name="name_update" value="<?php echo $_SESSION['giohang'][$i][0]; ?>"/>
                        <input type="number" name="so_luong" min="1" value="<?php echo $_SESSION['giohang'][$i][2]; ?>" min="1" class="form-control">
                    </td>
                    <td><?php echo number_format($ttPrice); ?> VNĐ</td>
                    <td>
                        <a href="?delete=<?php echo $i; ?>" class="btn btn-danger" name="delete">Xóa</a>
                        <button type="submit" name="update_cart" class="btn btn-primary updatecart">Cập nhật</button>
                    </td>
                </tr>
            </form>
            <?php
                    }
                }
                
            ?>
               
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="col-md-6" style="margin-top: 20px;">
            <a href="index.php" class="btn btn-success">Mua thêm sản phẩm</a>
        </div>
        <div class="col-md-6">
            
                <h4 class="h3">Tổng giá trị đơn hàng: <span class="text-danger"><?php echo number_format($totalPrice); ?> VNĐ</span></h4>
            
                
            <?php
                if(isset($_SESSION['id_kh']) && isset($_SESSION['ho_ten']) && isset($_SESSION['email'])) {
                    $id_kh = $_SESSION['id_kh'];
                    //Kiểm tra voucher
                    $p = new data();
                    $link = $p->connect();
                    $query = mysqli_query($link, "SELECT * FROM khach_hang INNER JOIN voucher_kh ON "
                            . "khach_hang.id_kh=voucher_kh.id_kh WHERE khach_hang.id_kh='$id_kh'");
                    while($row = mysqli_fetch_array($query)) {
                        $ma_ap = $row['ma_ap'];
                        $giam = $row['giam']; 
                        
                        if(isset($_POST['ap_dung'])) {
                            $voucher = $_POST['voucher'];
                            if($voucher === $ma_ap) {
                                $totalNew = $totalPrice - ($totalPrice*$giam)/100;                               
                                if($totalNew !== '') {                                                                                                         
                                    echo '<h3 class="h3">Giá trị đơn hàng mới: <span class="text-danger">'.number_format($totalNew).' VNĐ</span></h3>';                                   
                                }
                            }
                        }
                    }
            ?>
            <form action="" method="POST" style="margin-bottom: 18px;">
                <input type="text" name="voucher" id="" class="input_voucher" placeholder="Mã voucher giảm giá"> 
                <button type="submit" name="ap_dung" class="btn btn-primary">Áp dụng</button>
            </form>                             
        </div> <br>
        <hr>
        <?php
            $query = mysqli_query($link, "SELECT * FROM khach_hang WHERE id_kh='$id_kh' LIMIT 1");
            $row = mysqli_fetch_assoc($query);
        ?>
        <?php
            if(count($_SESSION['giohang']) != 0) {
        ?>
        <div>
            <h2 class="h2 text-center">Thông tin thanh toán</h2>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?php
                        if(isset($_POST['dat_hang'])) {
                            $ho_ten = $_POST['ho_ten'];
                            $phone = $_POST['phone'];
                            $dia_chi = $_POST['dia_chi'];
                            $note = $_POST['note'];
                            $thanh_toan = $_POST['thanh_toan'];
                            $tong_tien = $_POST['tong_tien'];
                            $ma_ap = $_POST['ma_ap'];
                            $ngay_dat = date('d/m/Y');
                            //Check
                            if(empty($phone)) {
                                $error['phone'] = '<p class="error">Vui lòng nhập số điện thoại!</p>';
                            } else if(!preg_match ("/^[0-9]*$/", $phone)) {
                                $error['phone'] = '<p class="error">Số điện thoại không hợp lệ!</p>';
                            }
                            
                            if(empty($dia_chi)) {
                                $error['dia_chi'] = '<p class="error">Vui lòng nhập địa chỉ!</p>';
                            }
                            
                            //Cập nhật thông tin khách hàng
                            $ma_hd = rand(0, 99999999);
                            if(empty($error) == true) {
                                if($p->themxoasua("UPDATE khach_hang SET phone='$phone', dia_chi='$dia_chi' "
                                        . "WHERE id_kh='$id_kh'") == 1) {
                                    //Tạo mã qr_code hóa đơn
                                    include_once 'QRcode/qrlib.php';
                                    if($thanh_toan == 1) {
                                        $tt = "Thanh toán tại nhà!";
                                    } else {
                                        $tt = "Thanh toán online!";
                                    }
                                    
                                    $content = "Mã hóa đơn: ".$ma_hd."\n"."Khách hàng: ".$ho_ten."\n"."Tổng hóa đơn: ". number_format($tong_tien)."VNĐ\n".
                                            "Thanh toán: ".$tt."\n"."Ngày đặt hàng: ".$ngay_dat;
                                    $folder_qrhd = "img/hoa_don/";
                                    $name_qrhd = rand(0, 9999)."_hd_qr_code.png";
                                    $file_qrcode = $folder_qrhd.$name_qrhd;

                                    QRcode::png($content, $file_qrcode, $size=3);
            
                                    if($p->themxoasua("INSERT INTO hoa_don(ma_hd, ngay_dat, tong_tien, thanh_toan, ghi_chu, trang_thai, ma_ap, ma_qr, id_kh) VALUES "
                                            . "('$ma_hd', now(), '$tong_tien', '$thanh_toan', '$note', 0, '$ma_ap', '$name_qrhd', '$id_kh')") == 1) {                                       
                                        for($i=0; $i<count($_POST['id_sp']); $i++) {
                                            $ten_sp = $_POST['ten_sp'][$i];
                                            $gia_sp = $_POST['gia_sp'][$i];
                                            $sl = $_POST['sl'][$i];
                                            $id_sp = $_POST['id_sp'][$i];
                                            
                                            if($p->themxoasua("INSERT INTO ct_hoadon(ten_sp, gia, so_luong, ma_hd, id_sp) "
                                                    . "VALUES ('$ten_sp', '$gia_sp', '$sl', '$ma_hd', $id_sp)") == 1) {
                                                if($thanh_toan == 1) {
                                                    header("location: index.php?page=thanh-cong&ma_hd=$ma_hd");
                                                } else {
                                                    header("location: vnpay_php/index.php?ma_hd=$ma_hd");
                                                }
                                                unset($_SESSION['giohang']);
                                            }
                                        }
                                    }
                                }
                                
                            }
                        }
                    ?>
                    <form accept="" method="POST">
                        <div class="form-group">
                            <label for="">Họ tên <span class="error">(*)</span></label>
                            <input type="text" class="form-control" name="ho_ten" value="<?php echo $row['ho_ten']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Số điện thoại <span class="error">(*)</span></label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>">
                            <?php
                                echo isset($error['phone']) ? $error['phone'] : '';
                            ?>  
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ <span class="error">(*)</span></label>
                            <input type="text" class="form-control" name="dia_chi" value="<?php echo $row['dia_chi']; ?>">
                            <?php
                                echo isset($error['dia_chi']) ? $error['dia_chi'] : '';
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="">Ghi chú</label>
                            <textarea name="note" id="" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-check">
                            <label for="">Phương thức thanh toán</label> <br>
                            <input class="form-check-input" type="radio" name="thanh_toan" id="exampleRadios1" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Thanh toán tại nhà
                            </label> <br>
                            <input class="form-check-input" type="radio" name="thanh_toan" id="exampleRadios1" value="2">
                            <label class="form-check-label" for="exampleRadios1">
                                Thanh toán online
                            </label>
                        </div> <br>
                        <?php
                            if(isset($totalNew)) { 
                                $tong_tien = $totalNew;
                            } else {
                                $tong_tien = $totalPrice;
                            }
                            
                            if(isset($_POST['ap_dung'])) {
                                $ma_ap = $_POST['voucher'];
                            } else {
                                $ma_ap = '';
                            }
                            
                            for($i=0; $i<sizeof($_SESSION['giohang']); $i++) {
                               $ten_sp = $_SESSION['giohang'][$i][0];
                               $gia_sp = $_SESSION['giohang'][$i][3];
                               $sl = $_SESSION['giohang'][$i][2];
                               $id_sp = $_SESSION['giohang'][$i][4];
                        ?>
                            <input type="hidden" name="ten_sp[]" value="<?php echo $ten_sp; ?>">
                            <input type="hidden" name="gia_sp[]" value="<?php echo $gia_sp; ?>">
                            <input type="hidden" name="sl[]" value="<?php echo $sl; ?>">
                            <input type="hidden" name="id_sp[]" value="<?php echo $id_sp; ?>">
                            <input type="hidden" name="tong_tien" value="<?php echo $tong_tien; ?>">
                            <input type="hidden" name="ma_ap" value="<?php echo $ma_ap; ?>">
                        <?php
                            }
                        ?>
                        <div class="product_detail-add">
                            <button type="submit" name="dat_hang" style="margin-bottom: 16px;">Đặt hàng</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <?php
            }
        ?>
        <?php
            } else {
                echo '<h4 class="h4 text-danger">Vui lòng đăng nhập để thanh toán!</h4>';
            }
        ?> 
    </div>
</div>