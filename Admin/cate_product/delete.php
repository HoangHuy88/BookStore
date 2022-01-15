<?php
    if (isset($_GET['id'])) {
        $id_cate = $_GET['id'];

        $p = new database();
        if ($p->themxoasua("DELETE FROM category_sp WHERE id_category='$id_cate'") == 1) {
            echo '<p class="text-success">Xóa danh mục sản phẩm thành công!</p>';
            echo '<a href="?page_layout=category-product" class="btn btn-primary">Quay lại</a>';
        } else {
            echo 'Xóa danh mục sản phẩm không thành công!';
        }
    }
?>