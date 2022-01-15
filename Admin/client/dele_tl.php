<?php
    if(isset($_GET['id'])) {
        $id_phanhoi = $_GET['id'];
        
        $p = new database();
        if($p->themxoasua("DELETE FROM phan_hoi WHERE id_phanhoi='$id_phanhoi'") == 1) {
            echo '<p class="text-success">Xóa phản hồi thành công!</p>';
            echo '<a href="?page_layout=phan-hoi-khach-hang" class="btn btn-primary">Quay lại</a>';
        } else {
            echo 'Xóa khách hàng không thành công!';
        }
    }
?>