<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm blog</h1>
</div>

<?php
    $p = new database();
    $error = array();
    
    //Lấy danh mục blog
    $link = $p->connect();
    $query = mysqli_query($link, "SELECT * FROM category_blog ORDER BY id_cate ASC");
    
    //Thêm blog
    if(isset($_POST['them_blog'])) {
        $tieu_de = $_POST['tieu_de'];
        $slug_blog = $_POST['slug_blog'];
        
        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $tmp = explode('.', $name);
        $file_ext = strtolower(end($tmp));
        
        $expensions = array("jpg","png","jpeg","gif");
        
        $tom_tat = $_POST['tom_tat'];
        $noi_dung= $_POST['noi_dung'];
        $id_danhmuc = $_POST['id_danhmuc'];
        
        //Kiểm tra
        if($tieu_de == '') {
            $error['tieu_de'] = '<p class="text-danger">Vui lòng nhập tiêu đề blog!</p>';
        }
        if($name == '') {
            $error['img'] = '<p class="text-danger">Vui lòng chọn hình ảnh!</p>';
        }
        else if(in_array($file_ext, $expensions) === false) {
            $error['img'] = '<p class="text-danger">Vui lòng chọn đúng định dạng hình ảnh!</p>';
        }
        if($tom_tat == '') {
            $error['tom_tat'] = '<p class="text-danger">Vui lòng nhập tóm tắt blog!</p>';
        }
        if($noi_dung == '') {
            $error['noi_dung'] = '<p class="text-danger">Vui lòng nhập nội dung blog!</p>';
        }
        
        //Thêm blog
        if(empty($error) == true) {
            $name = rand(0, 9999).'_'.$name;
            move_uploaded_file($tmp_name, "../img/blog/".$name);
            if($p->themxoasua("INSERT INTO blog(tieu_de, slug_blog, tom_tat, noi_dung, ngay_tao, id_danhmuc, image) "
                    . "VALUES ('$tieu_de', '$slug_blog', '$tom_tat', '$noi_dung', now(), '$id_danhmuc', '$name')") == 1) {
                echo '<p class="text-primary">Thêm blog thành công!</p>';
            } else {
                echo '<p class="text-danger">Blog đã tồn tại!</p>';
            }
        }
    }
?>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Tiêu đề</label>
        <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="tieu_de" placeholder="Tiêu đề">
        <?php
            echo isset($error['tieu_de']) ? $error['tieu_de'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Slug blog</label>
        <input type="text" class="form-control" id="convert_slug" name="slug_blog" placeholder="Slug blog">
    </div>
    <div class="form-group">
        <label for="">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file">
        <?php
            echo isset($error['img']) ? $error['img'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Tóm tắt</label>
        <textarea class="form-control" name="tom_tat" rows="3"></textarea>
        <?php
            echo isset($error['tom_tat']) ? $error['tom_tat'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Nội dung</label>
        <textarea class="form-control" name="noi_dung" rows="5"></textarea>
        <?php
            echo isset($error['noi_dung']) ? $error['noi_dung'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Danh mục</label>
        <select class="form-control" id="" name="id_danhmuc">
            <?php
                while ($row = mysqli_fetch_array($query)) {
            ?>
            <option value="<?php echo $row['id_cate']; ?>"><?php echo $row['ten_danhmuc']; ?></option>
            <?php
                }
            ?>
        </select>
    </div>
    <button type="submit" name="them_blog" class="btn btn-dark mb-3">Thêm blog</button>
</form>