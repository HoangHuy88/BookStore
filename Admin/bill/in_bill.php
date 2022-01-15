<?php
    include_once '../database/class_data.php';
    $p = new database();   
    $link = $p->connect();
    
    if(isset($_GET['ma_hd'])) {
        $ma_hd = $_GET['ma_hd'];
        
        $query_hd = mysqli_query($link, "SELECT * FROM hoa_don INNER JOIN khach_hang ON hoa_don.id_kh=khach_hang.id_kh"
            . " WHERE hoa_don.ma_hd='$ma_hd' LIMIT 1");
        $row_hd = mysqli_fetch_assoc($query_hd);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>BOOKSTORE - In hóa đơn</title>
        <link rel="icon" href="./img/icon.png">
        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #FAFAFA;
                font: 12pt "Tohoma";
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }
            .page {
                width: 21cm;
                overflow:hidden;
                min-height:297mm;
                padding: 2.5cm;
                margin-left:auto;
                margin-right:auto;
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            .subpage {
                padding: 1cm;
                border: 5px red solid;
                height: 237mm;
                outline: 2cm #FFEAEA solid;
            }
            @page {
                size: A4;
                margin: 0;
            }
            button {
                width:100px;
                height: 24px;
            }
            .header {
                overflow:hidden;
            }
            .logo {
                text-align:left;
                float:left;
                margin-top: 28px;
            }
            .company {
                padding-top:24px;
                text-transform:uppercase;
                background-color:#FFFFFF;
                text-align:right;
                float:right;
                font-size:16px;
            }
            .title {
                text-align:center;
                position:relative;
                color:#000;
                font-weight: 600;
                font-size: 24px;
                top:1px;
            }
            .footer-left {
                text-align:center;
                text-transform:uppercase;
                padding-top:24px;
                position:relative;
                height: 150px;
                width:50%;
                color:#000;
                float:left;
                font-size: 14px;
                bottom:1px;
            }
            .footer-right {
                text-align:center;
                text-transform:uppercase;
                padding-top:24px;
                position:relative;
                height: 150px;
                width:50%;
                color:#000;
                font-size: 14px;
                float:right;
                bottom:1px;
            }
            .TableData {
                background:#ffffff;
                font: 11px;
                width:100%;
                border-collapse:collapse;
                font-family:Verdana, Arial, Helvetica, sans-serif;
                font-size:12px;
                border:thin solid #d3d3d3;
            }
            .TableData TH {
                background: rgba(0,0,255,0.1);
                text-align: center;
                font-weight: bold;
                color: #000;
                border: solid 1px #ccc;
                height: 24px;
            }
            .TableData TR {
                height: 24px;
                border:thin solid #d3d3d3;
            }
            .TableData TR TD {
                padding-right: 2px;
                padding-left: 2px;
                border:thin solid #d3d3d3;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .TableData TR:hover {
                background: rgba(0,0,0,0.05);
            }
            .TableData .cotSTT {
                text-align:center;
                width: 10%;
                font-size: 14px;               
            }
            .TableData .cotTenSanPham {
                text-align:center;
                width: 40%;
                font-size: 14px;
            }
            .TableData .cotHangSanXuat {
                text-align:center;
                width: 20%;
                font-size: 14px;
            }
            .TableData .cotGia {
                text-align:center;
                width: 120px;
                font-size: 14px;
            }
            .TableData .cotSoLuong {
                text-align: center;
                width: 50px;
                font-size: 14px;
            }
            .TableData .cotSo {
                text-align: center;
                width: 120px;
                font-size: 14px;
            }
            .TableData .tong {
                text-align: center;
                font-weight:bold;
                text-transform:uppercase;
                padding-right: 4px;
                font-size: 16px;
            }
            .TableData .cotSoLuong input {
                text-align: center;
            }
            @media print {
                @page {
                    margin: 0;
                    border: initial;
                    border-radius: initial;
                    width: initial;
                    min-height: initial;
                    box-shadow: initial;
                    background: initial;
                    page-break-after: always;
                }
            }
        </style>
    </head>

    <body onload="window.print();">
        <div id="page" class="page">
            <div class="header">
                <div class="logo"><img src="../../img/logo.png"/></div>
                <div class="company">
                    <img src="../../img/hoa_don/<?php echo $row_hd['ma_qr']; ?>" width="120" height="120"/>
                </div>
            </div>
            <br/>
            <div class="title">
                HÓA ĐƠN THANH TOÁN
                <br/>
                -------oOo-------
            </div>
            <br/>
            <br/>
            <table class="TableData">
                <tr>
                    <th class="cotSTT">Mã hóa đơn</th>
                    <th class="cotTenSanPham">Tên sản phẩm</th>
                    <th class="cotGia">Giá</th>
                    <th class="cotSoLuong">Số lượng</th>
                    <th class="cotSo">Thành tiền</th>
                </tr>
                <tr>
                    <?php
                        $query_ct = mysqli_query($link, "SELECT * FROM ct_hoadon INNER JOIN hoa_don "
                                . "ON ct_hoadon.ma_hd=hoa_don.ma_hd WHERE ct_hoadon.ma_hd='$ma_hd'");
                        while ($row_ct = mysqli_fetch_array($query_ct)) {
                    ?>
                    <tr>
                        <td class="cotSTT"><?php echo $row_ct['ma_hd']; ?></td>
                        <td class="cotTenSanPham"><?php echo $row_ct['ten_sp']; ?></td>
                        <td class="cotGia"><?php echo number_format($row_ct['gia']); ?> VNĐ</td>
                        <td class="cotSoLuong"><?php echo $row_ct['so_luong']; ?></td>
                        <td class="cotSo"><?php echo number_format($row_ct['gia']*$row_ct['so_luong']); ?> VNĐ</td>
                    </tr>
                    <?php
                        }
                    ?>
                </tr>
                <tr>
                    <td colspan="4" class="tong">Tổng cộng</td>
                    <td class="cotSo" style="font-weight: 600;"><?php echo number_format($row_hd['tong_tien']); ?> VNĐ</td>
                </tr>
            </table>
            <div class="footer-left"> Tp.Hồ Chí Minh, <?php echo $row_hd['ngay_dat']; ?><br/> <br>
                Khách hàng </div>
            <div class="footer-right"> Tp.Hồ Chí Minh, <?php echo $row_hd['ngay_dat']; ?><br/> <br>
                Nhân viên <br> <br> Huy <br> Hoàng Hữu Huy</div>
        </div>
    </body>
</html>