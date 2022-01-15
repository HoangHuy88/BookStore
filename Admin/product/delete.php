<?php
    if(isset($_GET['id'])) {
        $id_sp = $_GET['id'];
        
        $p = new database();
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM san_pham WHERE id_sp='$id_sp' LIMIT 1");
        $row = mysqli_fetch_array($query);
        if($p->themxoasua("DELETE FROM san_pham WHERE id_sp='$id_sp'") == 1) {
            //Xóa slide
            unlink("../img/product/".$row['image']);
            //Xóa mã qr_code
            unlink("../img/qr_code/".$row['ma_qr']);
            
            echo '<p class="text-success">Xóa sản phẩm thành công!</p>';
            echo '<a href="?page_layout=product" class="btn btn-primary">Quay lại</a>';
        } else {
            echo 'Xóa sản phẩm không thành công!';
        }
    }
?>