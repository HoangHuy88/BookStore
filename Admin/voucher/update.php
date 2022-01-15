<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật voucher</h1>
</div>

<?php
    $p = new database();
    
    //Lấy thông tin
    if(isset($_GET['id'])) {
        $id_voucher = $_GET['id'];
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM voucher WHERE id_voucher='$id_voucher'");
        $row = mysqli_fetch_assoc($query);
    }

    $error = array();
    if(isset($_POST['update_voucher'])) {
        $tieu_de = $_POST['tieu_de'];
        $noi_dung = $_POST['noi_dung'];
        
        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
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
        
        //Cập nhật thông tin
        if(empty($error) == true) {
            if($tieu_de != '' && $noi_dung != '' && $name == '' && $diem != '' && $ma != '' 
                && $ngay_kt != '') {
                if($p->themxoasua("UPDATE voucher SET tieu_de='$tieu_de', mo_ta='$noi_dung', ma_voucher='$ma', giam='$giam',"
                        . "diem='$diem', ngay_bd='$ngay_bd', ngay_kt='$ngay_kt' WHERE id_voucher='$id_voucher'") == 1) {
                    //header("Refresh:3");
                    echo '<p class="text-primary">Cập nhật voucher thành công!</p>';
                } else {
                    echo '<p class="text-danger">Cập nhật voucher không thành công!</p>';
                }
            } else {
                unlink("../img/voucher/".$row['image']);
                
                $name = rand(0, 9999).'_'.$name;
                move_uploaded_file($tmp_name, "../img/voucher/".$name);
                
                if($p->themxoasua("UPDATE voucher SET tieu_de='$tieu_de', mo_ta='$noi_dung', image='$name', ma_voucher='$ma', giam='$giam',"
                        . "diem='$diem', ngay_bd='$ngay_bd', ngay_kt='$ngay_kt' WHERE id_voucher='$id_voucher'") == 1) {
                    //header("Refresh:3");
                    echo '<p class="text-primary">Cập nhật voucher thành công!</p>';
                } else {
                    echo '<p class="text-danger">Cập nhật voucher không thành công!</p>';
                }
            }
        }
    }
?>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Tiêu đề</label>
        <input type="text" class="form-control" name="tieu_de" value="<?php echo $row['tieu_de']; ?>">
        <?php
            echo isset($error['tieu_de']) ? $error['tieu_de'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Nội dung</label>
        <textarea class="form-control" name="noi_dung" rows="3">
            <?php
                echo $row['mo_ta'];
            ?>
        </textarea>
        <?php
            echo isset($error['noi_dung']) ? $error['noi_dung'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Hình ảnh</label>
        <input type="file" name="image" class="form-control-file">
        <img src="../../BookStore/img/voucher/<?php echo $row['image']; ?>" alt="" width="280" height="180" class="mt-3">
    </div>
    <div class="form-group">
        <label for="">Điểm voucher</label>
        <input type="text" class="form-control" name="diem" value="<?php echo $row['diem']; ?>">
        <?php
            echo isset($error['diem']) ? $error['diem'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Mã voucher</label>
        <input type="text" class="form-control" name="ma" value="<?php echo $row['ma_voucher']; ?>">
        <?php
            echo isset($error['ma']) ? $error['ma'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Phần trăm giảm</label>
        <input type="text" class="form-control" name="giam" value="<?php echo $row['giam']; ?>">
        <?php
            echo isset($error['giam']) ? $error['giam'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Ngày bắt đầu</label>
        <input type="date" class="form-control" name="ngay_bd" value="<?php echo $row['ngay_bd']; ?>">
    </div>
    <div class="form-group">
        <label for="">Ngày kết thúc</label>
        <input type="date" class="form-control" name="ngay_kt" value="<?php echo $row['ngay_kt']; ?>">
        <?php
            echo isset($error['ngay_kt']) ? $error['ngay_kt'] : '';
        ?>
    </div>
    <button type="submit" name="update_voucher" class="btn btn-dark mb-4">Cập nhật voucher</button>
</form>