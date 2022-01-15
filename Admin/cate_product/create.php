<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm danh mục sản phẩm</h1>
</div>

<?php
    $p = new database();
    if(isset($_POST['add_catesp'])) {
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $slug_danhmuc = $_POST['slug_danhmuc'];
        
        if($ten_danhmuc == '') {
            $error = '<p class="text-danger">Vui lòng nhập tên danh mục sản phẩm!</p>';
        }
        
        if(empty($error) == true) {
            if($p->themxoasua("INSERT INTO category_sp(ten_danhmuc, slug_danhmuc, ngay_tao) "
                    . "VALUES ('$ten_danhmuc', '$slug_danhmuc', now())") == 1) {
                echo '<p class="text-primary">Thêm danh mục sản phẩm thành công!</p>';
            } else {
                echo '<p class="text-danger">Danh mục sản phẩm đã tồn tại!</p>';
            }
        }
    }
?>
<form method="POST" action="">
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="ten_danhmuc" placeholder="Tên danh mục">
        <?php
            echo isset($error) ? $error : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Slug danh mục sản phẩm</label>
        <input type="text" class="form-control" id="convert_slug" name="slug_danhmuc" placeholder="Slug danh mục sản phẩm">
    </div>
    <button type="submit" name="add_catesp" class="btn btn-dark">Thêm danh mục sản phẩm</button>
</form>