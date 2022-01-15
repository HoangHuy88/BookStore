<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật slide</h1>
</div>

<!-- Content Row -->
<?php
    include_once 'database/class_data.php';
    $p = new database();
    
    //Lấy thông tin update
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM slide WHERE id_slide='$id'");
        $row = mysqli_fetch_assoc($query);
    }
    
    //Cập nhật thông tin 
    if(isset($_POST['update_slide'])) {
        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        $active = $_POST['active'];
        
        if($name == '' && $active != '') {
            if($p->themxoasua("UPDATE slide SET active='$active' WHERE id_slide='$id'") == 1) {
                //header("Refresh:3");
                echo '<p class="text-primary">Cập nhật hình ảnh thành công!</p>';               
            } else {
                echo '<p class="text-danger">Cập nhật hình ảnh không thành công!</p>';
            }
        }
        else {
            unlink("../img/slider/".$row['image']);
            
            $name = rand(0, 9999).'_'.$name;
            move_uploaded_file($tmp_name, "../img/slider/".$name);
            
            if($p->themxoasua("UPDATE slide SET image='$name', active='$active' WHERE id_slide='$id'") == 1) {
                //header("Refresh:3");
                echo '<p class="text-primary">Cập nhật hình ảnh thành công!</p>';
            } else {
                echo '<p class="text-danger">Cập nhật hình ảnh không thành công!</p>';
            }
        }
    }
?>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file">
        <img src="../../BookStore/img/slider/<?php echo $row['image']; ?>" alt="" width="280" height="180" class="mt-3">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Trạng thái</label>
        <select class="form-control" id="exampleFormControlSelect1" name="active">
            <?php
                if($row['active'] == 1) {
                    echo '<option selected value="1">Kích hoạt</option>
                          <option value="0">Không kích hoạt</option>';
                } else {
                    echo '<option value="1">Kích hoạt</option>
                          <option selected value="0">Không kích hoạt</option>';
                }
            ?>
        </select>
    </div>
    <button type="submit" name="update_slide" class="btn btn-dark mb-4">Cập nhật slide</button>
</form>