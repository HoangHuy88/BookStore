<?php
    if(isset($_GET['id'])) {
        $id_blog = $_GET['id'];
        
        $p = new database();
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM blog WHERE id_blog='$id_blog' LIMIT 1");
        $row = mysqli_fetch_array($query);
        if($p->themxoasua("DELETE FROM blog WHERE id_blog='$id_blog'") == 1) {
            //Xóa slide
            unlink("../img/blog/".$row['image']);
            
            echo '<p class="text-success">Xóa blog thành công!</p>';
            echo '<a href="?page_layout=blog" class="btn btn-primary">Quay lại</a>';
        } else {
            echo 'Xóa blog không thành công!';
        }
    }
?>