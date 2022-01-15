<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm voucher</h1>
</div>

<!-- Content Row -->
<?php
    include_once 'database/class_data.php';
    $p = new database();
    $error = array();
    
    if(isset($_POST['them_voucher'])) {
        $tieu_de = $_POST['tieu_de'];
        $noi_dung = $_POST['noi_dung'];
        
        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $tmp = explode('.', $name);
        $file_ext = strtolower(end($tmp));
        
        $expensions = array("jpg","png","jpeg","gif");
        
        $diem = $_POST['diem'];
        $ma = $_POST['ma'];
        $giam = $_POST['giam'];
        $ngay_bd = $_POST['ngay_bd'];
        $ngay_kt = $_POST['ngay_kt'];
        
        //Kiểm tra
        if($tieu_de == '') {
            $error['tieu_de'] = '<p class="text-danger">Vui lòng nhập tiêu đề!</p>';
        }
        if($noi_dung == '') {
            $error['noi_dung'] = '<p class="text-danger">Vui lòng nhập nội dung!</p>';
        }
        if($name == '') {
            $error['img'] = '<p class="text-danger">Vui lòng chọn hình ảnh!</p>';
        }
        else if(in_array($file_ext, $expensions) === false) {
            $error['img'] = '<p class="text-danger">Vui lòng chọn đúng định dạng hình ảnh!</p>';
        }
        if($diem == '') {
            $error['diem'] = '<p class="text-danger">Vui lòng nhập điểm voucher!</p>';
        }
        if($ma == '') {
            $error['ma'] = '<p class="text-danger">Vui lòng nhập mã voucher!</p>';
        }
        if(!preg_match("/^[0-9]*$/", $giam)) {
            $error['giam'] = '<p class="text-danger">Phần trăm giảm phải là số!</p>';
        }
        else if($giam == '') {
            $error['giam'] = '<p class="text-danger">Vui lòng số phần trăm giảm cho voucher!</p>';
        }
        if($ngay_kt == '') {
            $error['ngay_kt'] = '<p class="text-danger">Vui lòng chọn ngày kết thúc!</p>';
        }
        
        ///Chèn dữ liệu
        if(empty($error) == true) {
            $name = rand(0, 9999).'_'.$name;
            move_uploaded_file($tmp_name, "../img/voucher/".$name);
            if($p->themxoasua("INSERT INTO voucher(tieu_de, mo_ta, image, ma_voucher, giam, diem, ngay_bd, ngay_kt) "
                    . "VALUES ('$tieu_de', '$noi_dung', '$name', '$ma', '$giam', '$diem', '$ngay_bd', '$ngay_kt')") == 1) {
                echo '<p class="text-primary">Thêm voucher thành công!</p>';
            } else {
                echo '<p class="text-danger">Thêm voucher không thành công!</p>';
            }
        }
    }
?>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Tiêu đề</label>
        <input type="text" class="form-control" name="tieu_de" placeholder="Tiêu đề">
        <?php
            echo isset($error['tieu_de']) ? $error['tieu_de'] : '';
        ?>
    </div>   
    <div class="form-group">
        <label for="">Nội dung</label>
        <textarea class="form-control" name="noi_dung" rows="4"></textarea>
        <?php
            echo isset($error['noi_dung']) ? $error['noi_dung'] : '';
        ?>
    </div>
    
    <div class="form-group">
        <label for="">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file">
        <?php
            echo isset($error['img']) ? $error['img'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Điểm voucher</label>
        <input type="text" class="form-control" name="diem" placeholder="Điểm voucher">
        <?php
            echo isset($error['diem']) ? $error['diem'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Mã voucher</label>
        <input type="text" class="form-control" name="ma" placeholder="Mã voucher">
        <?php
            echo isset($error['ma']) ? $error['ma'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Phần trăm giảm</label>
        <input type="text" class="form-control" name="giam" placeholder="Phần trăm giảm cho hóa đơn">
        <?php
            echo isset($error['giam']) ? $error['giam'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Ngày bắt đầu</label>
        <input type="date" class="form-control" name="ngay_bd" value="<?php echo date('Y-m-d'); ?>">
    </div>
    <div class="form-group">
        <label for="">Ngày kết thúc</label>
        <input type="date" class="form-control" name="ngay_kt">
        <?php
            echo isset($error['ngay_kt']) ? $error['ngay_kt'] : '';
        ?>
    </div>
    <button type="submit" name="them_voucher" class="btn btn-dark mb-4">Thêm voucher</button>
</form>