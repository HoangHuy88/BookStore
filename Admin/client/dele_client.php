<?php
    if(isset($_GET['id'])) {
        $id_kh = $_GET['id'];
        
        $p = new database();
        if($p->themxoasua("DELETE FROM khach_hang WHERE id_kh='$id_kh'") == 1) {
            header('location: index.php?page_layout=client');
            echo '<p class="text-success">Xóa khách hàng thành công!</p>';
            echo '<a href="?page_layout=client" class="btn btn-primary">Quay lại</a>';
        } else {
            echo 'Xóa khách hàng không thành công!';
        }
    }
?>