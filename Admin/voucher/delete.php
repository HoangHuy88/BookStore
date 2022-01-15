<?php
    if(isset($_GET['id'])) {
        $id_voucher = $_GET['id'];
        
        $p = new database();
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM voucher WHERE id_voucher='$id_voucher' LIMIT 1");
        $row = mysqli_fetch_array($query);
        if($p->themxoasua("DELETE FROM voucher WHERE id_voucher='$id_voucher'") == 1) {
            //Xóa slide
            unlink("../img/voucher/".$row['image']);
            
            echo '<p class="text-success">Xóa voucher thành công!</p>';
            echo '<a href="?page_layout=voucher" class="btn btn-primary">Quay lại</a>';
        } else {
            echo 'Xóa slide không thành công!';
        }
    }
?>