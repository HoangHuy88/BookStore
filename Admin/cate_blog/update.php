<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật danh mục blog</h1>
</div>

<?php
    $p = new database();
    
    //Lấy thông tin
    if(isset($_GET['id'])) {
        $id_cate = $_GET['id'];
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM category_blog WHERE id_cate='$id_cate'");
        $row = mysqli_fetch_assoc($query);
    }
    
    //Cập nhật thông tin
    if(isset($_POST['update_cate'])) {
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $slug_danhmuc = $_POST['slug_danhmuc'];
        
        if($ten_danhmuc == '') {
            $error['name'] = '<p class="text-danger">Vui lòng nhập tên danh mục blog!</p>';
        }
        
        if(empty($error) == true) {
            if($p->themxoasua("UPDATE category_blog SET ten_danhmuc='$ten_danhmuc', slug_danhmuc='$slug_danhmuc', "
                    . "ngay_tao=now() WHERE id_cate='$id_cate'") == 1) {
                echo '<p class="text-primary">Cập nhật danh mục blog thành công!</p>';
            } else {
                echo '<p class="text-danger">Slug blog đã tồn tại!</p>';
            }
        }
    }
?>
<form method="POST" action="">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" name="ten_danhmuc" onkeyup="ChangeToSlug();" id="slug" value="<?php echo $row['ten_danhmuc']; ?>">
        <?php
            echo isset($error['name']) ? $error['name'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Slug danh mục blog</label>
        <input type="text" class="form-control" id="convert_slug" name="slug_danhmuc" value="<?php echo $row['slug_danhmuc']; ?>">
    </div>
    <button type="submit" name="update_cate" class="btn btn-dark">Cập nhật danh mục blog</button>
</form>