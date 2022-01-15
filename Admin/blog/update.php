<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật blog</h1>
</div>

<?php
    $p = new database();
    $link = $p->connect();
    //Lấy thông tin danh mục blog
    $query_dm = mysqli_query($link, "SELECT * FROM category_blog");
    
    //Lấy thông tin blog
    if(isset($_GET['id'])) {
        $id_blog = $_GET['id'];
        $query_blog = mysqli_query($link, "SELECT * FROM blog WHERE id_blog='$id_blog'");
        $row_blog = mysqli_fetch_assoc($query_blog);
    }
    
    //Cập nhật
    if(isset($_POST['update_blog'])) {
        $tieu_de = $_POST['tieu_de'];
        $slug_blog = $_POST['slug_blog'];
        
        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        $tom_tat = $_POST['tom_tat'];
        $noi_dung= $_POST['noi_dung'];
        $id_danhmuc = $_POST['id_danhmuc'];
        
        if($tieu_de != '' && $slug_blog != '' && $name == '' && $tom_tat != '' && $noi_dung != '' 
                && $id_danhmuc != '') {
            if($p->themxoasua("UPDATE blog SET tieu_de='$tieu_de', slug_blog='$slug_blog', tom_tat='$tom_tat', "
                    . "noi_dung='$noi_dung', ngay_tao=now(), id_danhmuc='$id_danhmuc' WHERE id_blog='$id_blog'") == 1) {
                echo '<p class="text-primary">Cập nhật blog thành công!</p>';
            } else {
                echo '<p class="text-danger">Cập nhật blog không thành công!</p>';
            }
        } else if($tieu_de != '' && $slug_blog != '' && $name != '' && $tom_tat != '' && $noi_dung != '' 
                && $id_danhmuc != ''){
            unlink("../img/blog/".$row_blog['image']);
            
            $name = rand(0, 9999).'_'.$name;
            move_uploaded_file($tmp_name, "../img/blog/".$name);
            
            if($p->themxoasua("UPDATE blog SET tieu_de='$tieu_de', slug_blog='$slug_blog', tom_tat='$tom_tat', "
                    . "noi_dung='$noi_dung', ngay_tao=now(), id_danhmuc='$id_danhmuc', image='$name' WHERE id_blog='$id_blog'") == 1) {
                echo '<p class="text-primary">Cập nhật blog thành công!</p>';
            } else {
                echo '<p class="text-danger">Cập nhật blog không thành công!</p>';
            }
        } else {
            echo '<p class="text-danger">Vui lòng nhập đầy đủ thông tin!</p>';
        }
    }
?>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Tiêu đề</label>
        <input type="text" class="form-control" name="tieu_de" onkeyup="ChangeToSlug();" id="slug" value="<?php echo $row_blog['tieu_de']; ?>">
    </div>
    <div class="form-group">
        <label for="">Slug blog</label>
        <input type="text" class="form-control" id="convert_slug" name="slug_blog" value="<?php echo $row_blog['slug_blog']; ?>">
    </div>
    <div class="form-group">
        <label for="">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file">
        <img src="../../BookStore/img/blog/<?php echo $row_blog['image']; ?>" alt="" width="320" height="160" />
    </div>
    <div class="form-group">
        <label for="">Tóm tắt</label>
        <textarea class="form-control" name="tom_tat" rows="3">
            <?php
                echo $row_blog['tom_tat'];
            ?>
        </textarea>
    </div>
    <div class="form-group">
        <label for="">Nội dung</label>
        <textarea class="form-control" name="noi_dung" rows="5">
            <?php
                echo $row_blog['noi_dung'];
            ?>
        </textarea>
    </div>
    <div class="form-group">
        <label for="">Danh mục</label>
        <select class="form-control" id="" name="id_danhmuc">
            <?php
                while($row_dm = mysqli_fetch_array($query_dm)) {
            ?>
            <option <?php if($row_blog['id_danhmuc'] == $row_dm['id_cate']) {echo 'selected="selected"';} ?> 
                value="<?php echo $row_dm['id_cate'] ?>">
                <?php echo $row_dm['ten_danhmuc'] ?>
            </option>
            <?php
                }
            ?>
        </select>
    </div>
    <button type="submit" name="update_blog" class="btn btn-dark mb-3">Cập nhật blog</button>
</form>