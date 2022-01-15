<?php
    if(isset($_GET['ma_hd'])) {
        $ma_hd = $_GET['ma_hd'];
        
        $p = new database();
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM hoa_don WHERE ma_hd='$ma_hd' LIMIT 1");
        $row = mysqli_fetch_array($query);
        if($p->themxoasua("DELETE FROM hoa_don WHERE ma_hd='$ma_hd'") == 1) {
            //Xóa mã qr_code
            unlink("../img/hoa_don/".$row['ma_qr']);
            
            echo '<p class="text-success">Xóa hóa đơn thành công!</p>';
            echo '<a href="?page_layout=bill" class="btn btn-primary">Quay lại</a>';
        } else {
            echo 'Xóa hóa đơn không thành công!';
        }
    }
?>