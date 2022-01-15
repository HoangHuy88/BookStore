<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm danh mục Blog</h1>
</div>

<?php
    $p = new database();
    $error = array();
    
    if(isset($_POST['add_cate_blog'])) {
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $slug_danhmuc = $_POST['slug_danhmuc'];
        
        if($ten_danhmuc == '') {
            $error['name'] = '<p class="text-danger">Vui lòng nhập tên danh mục blog!</p>';
        }
        
        //ADD
        if(empty($error) == true) {
            if($p->themxoasua("INSERT INTO category_blog(ten_danhmuc, slug_danhmuc, ngay_tao) "
                    . "VALUES ('$ten_danhmuc', '$slug_danhmuc', now())") == 1) {
                echo '<p class="text-primary">Thêm danh mục blog thành công!</p>';
            } else {
                echo '<p class="text-danger">Danh mục blog đã tồn tại!</p>';
            }
        }
    }
?>
<form method="POST" action="">
    <div class="form-group">
        <label for="">Tên danh mục blog</label>
        <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="ten_danhmuc" placeholder="Tiêu danh mục">
        <?php
            echo isset($error['name']) ? $error['name'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Slug danh mục blog</label>
        <input type="text" class="form-control" id="convert_slug" name="slug_danhmuc" placeholder="Slug danh mục blog">
    </div>
    <button type="submit" name="add_cate_blog" class="btn btn-dark">Thêm danh mục blog</button>
</form>