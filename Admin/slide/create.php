<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm slide</h1>
</div>

<!-- Content Row -->
<?php
    include_once 'database/class_data.php';
    $p = new database();

    if(isset($_POST['them_slide'])) {
        $active = $_POST['active'];
        
        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $type = $_FILES['image']['type'];
        $tmp = explode('.', $name);
        $file_ext = strtolower(end($tmp));
        
        $expensions = array("jpg","png","jpeg","gif");
        if($name == '') {
            $error = '<p class="text-danger">Vui lòng chọn hình ảnh!</p>';
        }
        else if(in_array($file_ext, $expensions) === false) {
            $error = '<p class="text-danger">Vui lòng chọn đúng định dạng hình ảnh!</p>';
        }
        
        if(empty($error) == true) {
            $name = rand(0, 9999).'_'.$name;
            move_uploaded_file($tmp_name, "../img/slider/".$name);
            if($p->themxoasua("INSERT INTO slide(image, active) VALUES ('$name', '$active')") == 1) {
                echo '<p class="text-primary">Thêm hình ảnh thành công!</p>';
            } else {
                echo '<p class="text-danger">Thêm hình ảnh không thành công!</p>';
            }
        }
    }
?>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file">
    </div>
    <?php
        echo isset($error) ? $error : '';
    ?>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Trạng thái</label>
        <select class="form-control" id="exampleFormControlSelect1" name="active">
            <option selected value="1">Kích hoạt</option>
            <option value="0">Không kích hoạt</option>
        </select>
    </div>
    <button type="submit" name="them_slide" class="btn btn-dark">Thêm slide</button>
</form>