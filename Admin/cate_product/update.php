<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật danh mục sản phẩm</h1>
</div>

<?php
    $p = new database();
    //Lấy thông tin
    if(isset($_GET['id'])) {
        $id_cate = $_GET['id'];
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM category_sp WHERE id_category='$id_cate'");
        $row = mysqli_fetch_assoc($query);
    }
    
    //Cập nhật thông tin
    if(isset($_POST['update_catesp'])) {
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $slug_danhmuc = $_POST['slug_danhmuc'];
        
        if($ten_danhmuc == '') {
            $error = '<p class="text-danger">Vui lòng nhập tên danh mục sản phẩm!</p>';
        }
        
        if(empty($error) == true) {
            if($p->themxoasua("UPDATE category_sp SET ten_danhmuc='$ten_danhmuc', "
                    . "slug_danhmuc='$slug_danhmuc' WHERE id_category='$id_cate'") == 1) {
                echo '<p class="text-primary">Cập nhật danh mục sản phẩm thành công!</p>';
            } else {
                echo '<p class="text-danger">Danh mục sản phẩm đã tồn tại!</p>';
            }
        }
    }
?>
<form method="POST" action="">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="ten_danhmuc" 
               value="<?php echo $row['ten_danhmuc']; ?>">
        <?php
            echo isset($error) ? $error : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Slug danh mục sản phẩm</label>
        <input type="text" class="form-control" id="convert_slug" name="slug_danhmuc" value="<?php echo $row['slug_danhmuc']; ?>">
    </div>
    <button type="submit" name="update_catesp" class="btn btn-dark">Cập nhật danh mục sản phẩm</button>
</form>