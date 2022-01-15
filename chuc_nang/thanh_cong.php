<!-- Breadcrumb -->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php">Trang chủ</a></li>
        <li>Đơn hàng của bạn</li>
    </ul>
</div>

<div class="container">
    <h5 class="h4">Bạn đã đặt hàng thành công! Vui lòng kiểm tra tình trạnh đơn hàng trong phần tài khoản.</h5>
    <?php
        if(isset($_GET['ma_hd'])) {
            $ma_hd = $_GET['ma_hd'];
        }
        $p = new data();
        $link = $p->connect();
        $sql = "SELECT * FROM hoa_don INNER JOIN khach_hang ON hoa_don.id_kh=khach_hang.id_kh "
                . "WHERE ma_hd='$ma_hd' LIMIT 1";
        $query_kh = mysqli_query($link, $sql);
        $row_kh = mysqli_fetch_assoc($query_kh);
        
    ?>
    <div class="row">
        <div class="col-md-4">
            <h4 class="h3 text-danger">Thông tin khách hàng</h4>
            <ul style="font-size: 16px;">
                <li>Họ tên: <span><?php echo $row_kh['ho_ten']; ?></span></li>
                <li>Mã đơn hàng: <span><?php echo $row_kh['ma_hd']; ?></span></li>
                <li>Số điện thoại: <span><?php echo $row_kh['phone']; ?></span></li>
                <li>Địa chỉ: <span><?php echo $row_kh['dia_chi']; ?></span></li>
                <li>Email: <span><?php echo $row_kh['email']; ?></span></li>
                <li>Hình thức thanh toán: 
                    <?php
                        if($row_kh['thanh_toan'] == 1) {
                    ?>
                        <span>Thanh toán tại nhà!</span>
                    <?php
                        } else {
                            echo '<span>Thanh toán online!</span>';
                        //Check thanh toán online!
                            $query_pay = mysqli_query($link, "SELECT * FROM payments WHERE ma_hd='$ma_hd' LIMIT 1");
                            if(mysqli_num_rows($query_pay) == 1) {
                                $row_pay = mysqli_fetch_assoc($query_pay);
                    ?>
                        <li>Mã thanh toán: <span><?php echo $row_pay['code_vnpay']; ?></span></li>
                        <li>Ngân hàng: <span><?php echo $row_pay['code_bank']; ?></span></li>
                        <li>Thời gian thanh toán: <span><?php echo $row_pay['time']; ?></span></li>
                    <?php
                        } else {
                            echo '<p class="text-danger ml-4">Hóa đơn này chưa được thanh toán. Nếu không thanh toán, hóa đơn này sẽ bị hủy sau 24h!</p>';
                            echo '<a href="vnpay_php/index.php?ma_hd='.$ma_hd.'" class="btn btn-primary">Thanh toán ngay!</a>';
                        }
                    }
                    ?>
                </li>
                <li>Ghi chú: <span><?php echo $row_kh['ghi_chu']; ?></span></li>
            </ul>
        </div>
        <div class="col-md-8">
            <h4 class="h3 text-danger">Thông tin đơn hàng</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql_dh = "SELECT * FROM hoa_don INNER JOIN ct_hoadon ON hoa_don.ma_hd=ct_hoadon.ma_hd "
                                . "WHERE hoa_don.ma_hd='$ma_hd'";
                        $query_dh = mysqli_query($link, $sql_dh);
                        $stt = 1;
                        while($row_dh = mysqli_fetch_array($query_dh)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $stt++; ?></th>
                        <td><?php echo $row_dh['ten_sp']; ?></td>
                        <td><?php echo number_format($row_dh['gia']); ?> VNĐ</td>
                        <td><?php echo $row_dh['so_luong']; ?></td>
                        <td><?php echo number_format($row_dh['gia']*$row_dh['so_luong']); ?> VNĐ</td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td colspan="5" class="h4">Tổng hóa đơn: <span class="text-danger">
                            <?php echo number_format($row_kh['tong_tien']); ?> VNĐ
                            </span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> <br>
    <a href="index.php" class="btn btn-primary">Trở về</a> <br><br>
</div>