<?php
    $p = new database();
    $link = $p->connect();
    //Hóa đơn, khách hàng
    if(isset($_GET['ma_hd'])) {
        $ma_hd = $_GET['ma_hd'];
        $query_hd = mysqli_query($link, "SELECT * FROM hoa_don INNER JOIN khach_hang ON hoa_don.id_kh=khach_hang.id_kh"
            . " WHERE hoa_don.ma_hd='$ma_hd' LIMIT 1");
        $row_hd = mysqli_fetch_assoc($query_hd);
    }
?>

<div class="container" style="background-color: #fff;">
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="../img/logo.png" alt="" class="mt-4">
        </div>
        <div class="col-md-6 text-center">
            <img src="../img/hoa_don/<?php echo $row_hd['ma_qr']; ?>" alt="" class="img-thumbnail" width="150" height="150">
        </div>
    </div>
    <div class="title">
        <h3 class="h3 text-center">HÓA ĐƠN THANH TOÁN</h3>
        <p class="text-center">-------oOo-------</p>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <h3 class="h4 text-center mb-4">Thông tin khách hàng</h3>
            <p class="h6 ml-4 font-weight-bold mb-2">Họ tên: <span class="font-weight-normal"><?php echo $row_hd['ho_ten']; ?></span></p>
            <p class="h6 ml-4 font-weight-bold mb-2">Email: <span class="font-weight-normal"><?php echo $row_hd['email']; ?></span></p>
            <p class="h6 ml-4 font-weight-bold mb-2">Số điện thoại: <span class="font-weight-normal"><?php echo $row_hd['phone']; ?></span></p>
            <p class="h6 ml-4 font-weight-bold mb-2">Địa chỉ: <span class="font-weight-normal"><?php echo $row_hd['dia_chi']; ?></span></p>
            <p class="h6 ml-4 font-weight-bold mb-2">Thanh toán: 
                <span class="font-weight-normal">
                    <?php
                        if($row_hd['thanh_toan'] == 1) {
                            echo 'Thanh toán tại nhà!';
                        } else {
                            echo 'Thanh toán online!';
                            
                        //Check thanh toán online!
                            $query_pay = mysqli_query($link, "SELECT * FROM payments WHERE ma_hd='$ma_hd' LIMIT 1");
                            if(mysqli_num_rows($query_pay) == 1) {
                                $row_pay = mysqli_fetch_assoc($query_pay);
                    ?>
                        <p class="h6 ml-4 font-weight-bold mb-2">Mã thanh toán: <span class="font-weight-normal"><?php echo $row_pay['code_vnpay']; ?></span></p>
                        <p class="h6 ml-4 font-weight-bold mb-2">Ngân hàng: <span class="font-weight-normal"><?php echo $row_pay['code_bank']; ?></span></p>
                        <p class="h6 ml-4 font-weight-bold mb-2">Thời gian thanh toán: <span class="font-weight-normal"><?php echo $row_pay['time']; ?></span></p>
                    <?php
                        } else {
                            echo '<p class="text-danger ml-4">Hóa đơn chưa thanh toán!</p>';
                        }
                    }
                    ?>
                </span>
            </p>
            <p class="h6 ml-4 font-weight-bold mb-2">Ghi chú: <span class="font-weight-normal"><?php echo $row_hd['ghi_chu']; ?></span></p>
        </div>
        <div class="col-md-8">
            <h3 class="h4 mb-4 text-center">Chi tiết đơn hàng</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="140">Mã hóa đơn</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col" width="120">Giá</th>
                        <th scope="col" width="20">Số lượng</th>
                        <th scope="col" width="120">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query_ct = mysqli_query($link, "SELECT * FROM ct_hoadon INNER JOIN hoa_don "
                                . "ON ct_hoadon.ma_hd=hoa_don.ma_hd WHERE ct_hoadon.ma_hd='$ma_hd'");
                        while ($row_ct = mysqli_fetch_array($query_ct)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row_ct['ma_hd']; ?></th>
                        <td><?php echo $row_ct['ten_sp']; ?></td>
                        <td><?php echo number_format($row_ct['gia']); ?> VNĐ</td>
                        <td><?php echo $row_ct['so_luong']; ?></td>
                        <td><?php echo number_format($row_ct['gia']*$row_ct['so_luong']); ?> VNĐ</td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td colspan="5" class="font-weight-bold h5">Tổng hóa đơn: <span class="text-danger">
                            <?php echo number_format($row_hd['tong_tien']); ?> VNĐ
                        </span></td>
                    </tr>
                </tbody>
            </table>
            <a href="bill/in_bill.php?ma_hd=<?php echo $ma_hd; ?>" class="btn btn-primary mt-2 mb-2">In hóa đơn</a>
        </div>
    </div>
</div>
