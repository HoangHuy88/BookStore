<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $p = new database();
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM slide WHERE id_slide='$id' LIMIT 1");
        $row = mysqli_fetch_array($query);
        if($p->themxoasua("DELETE FROM slide WHERE id_slide='$id'") == 1) {
            //Xóa slide
            unlink("../img/slider/".$row['image']);
            
            echo '<p class="text-success">Xóa slide thành công!</p>';
            echo '<a href="?page_layout=slide" class="btn btn-primary">Quay lại</a>';
        } else {
            echo 'Xóa slide không thành công!';
        }
    }
?>

