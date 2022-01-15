<?php
    if (isset($_GET['id'])) {
        $id_cate = $_GET['id'];

        $p = new database();
        if ($p->themxoasua("DELETE FROM category_blog WHERE id_cate='$id_cate'") == 1) {
            echo '<p class="text-success">Xóa danh mục blog thành công!</p>';
            echo '<a href="?page_layout=category-blog" class="btn btn-primary">Quay lại</a>';
        } else {
            echo 'Xóa danh mục blog không thành công!';
        }
    }
?>


