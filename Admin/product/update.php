<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật sản phẩm</h1>
</div>

<?php
    $p = new database();
    $link = $p->connect();
    
    //Lấy danh mục sản phẩm
    $query = mysqli_query($link, "SELECT * FROM category_sp ORDER BY id_category ASC");
    
    //Lấy thông tin sản phẩm
    if(isset($_GET['id'])) {
        $id_sp = $_GET['id'];
        $query_sp = mysqli_query($link, "SELECT * FROM san_pham WHERE id_sp='$id_sp' LIMIT 1");
        $row_sp = mysqli_fetch_assoc($query_sp);
    }
    
    //Cập nhật thông tin
    if(isset($_POST['update_sp'])) {
        $ten_sp = $_POST['ten_sp'];
        $slug_sp = $_POST['slug_sp'];
        $type = $_POST['type'];
        $tom_tat = $_POST['tom_tat'];
        $mo_ta = $_POST['mo_ta'];
        $gia_sp = $_POST['gia_sp'];
        $gia_km = $_POST['gia_km'];
        $tac_gia = $_POST['tac_gia'];
        $nha_xb= $_POST['nha_xb'];
        $id_danhmuc = $_POST['id_danhmuc'];
        
        //Image
        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        //Kiểm tra
        if(empty($ten_sp)) {
            $error['ten_sp'] = '<p class="text-danger">Vui lòng nhập tên sản phẩm!</p>';
        }
        if(empty($slug_sp)) {
            $error['slug_sp'] = '<p class="text-danger">Vui lòng nhập slug của sản phẩm!</p>';
        }
        if(empty($tom_tat)) {
            $error['tom_tat'] = '<p class="text-danger">Vui lòng nhập tóm tắt sản phẩm!</p>';
        }
        if(empty($mo_ta)) {
            $error['mo_ta'] = '<p class="text-danger">Vui lòng nhập mô tả sản phẩm!</p>';
        }
        if(empty($gia_sp)) {
            $error['gia_sp'] = '<p class="text-danger">Vui lòng nhập giá sản phẩm!</p>';
        }
        if(empty($tac_gia)) {
            $error['tac_gia'] = '<p class="text-danger">Vui lòng nhập tác giả sản phẩm!</p>';
        }
        if(empty($nha_xb)) {
            $error['nha_xb'] = '<p class="text-danger">Vui lòng nhập nhà xuất bản sản phẩm!</p>';
        }
        
        if(empty($error) == true) {
            //Xoa ma qr cu
            unlink("../img/qr_code/".$row_sp['ma_qr']);
            
            //Tao ma qr code
            include_once '../QRcode/qrlib.php';
            $query_cate = mysqli_query($link, "SELECT * FROM category_sp WHERE id_category='$id_danhmuc'");
            $row_catesp = mysqli_fetch_assoc($query_cate);
            $ten_catesp = $row_catesp['ten_danhmuc'];
            
            if($type == 1) {
                $type_sp = "Loại sản phẩm: Sản phẩm nổi bật"."\n";
            } else {
                $type_sp = "Loại sản phẩm: Sản phẩm thường"."\n";
            }
            
            if($gia_km != '') {
                $qr_km = "Giá khuyến mại: ".number_format($gia_km)." VNĐ"."\n";
            } else {
                $qr_km = '';
            }
            
            $content = "Tên sản phẩm: ".$ten_sp."\n".$type_sp.
                    "Giá sản phẩm: ".number_format($gia_sp)." VNĐ"."\n".$qr_km.
                    "Tác giả: ".$tac_gia."\n"."Nhà xuất bản: ".$nha_xb."\n"."Danh mục: ".$ten_catesp;
            $folder_qr = "../img/qr_code/";
            $name_qr = rand(0, 9999)."_qr_code.png";
            $file_qrcode = $folder_qr.$name_qr;
            
            QRcode::png($content, $file_qrcode, $size=3);
            
            if($name == '') {
                if($p->themxoasua("UPDATE san_pham SET ten_sp='$ten_sp', slug_sp='$slug_sp', tac_gia='$tac_gia', "
                        . "nha_xb='$nha_xb', type='$type', tom_tat='$tom_tat', mo_ta='$mo_ta', gia_sp='$gia_sp', "
                        . "gia_km='$gia_km', id_danhmuc='$id_danhmuc', ma_qr='$name_qr' WHERE id_sp='$id_sp'") == 1) {
                    echo '<p class="text-primary">Cập nhật sản phẩm thành công!</p>';  
                } else {
                    echo '<p class="text-danger">Cập nhật sản phẩm không thành công!</p>';
                }
            } else {
                unlink("../img/product/".$row_sp['image']);
                $name = rand(0, 9999).'_'.$name;
                move_uploaded_file($tmp_name, "../img/product/".$name);
                if($p->themxoasua("UPDATE san_pham SET ten_sp='$ten_sp', slug_sp='$slug_sp', tac_gia='$tac_gia', "
                        . "nha_xb='$nha_xb', image='$name',type='$type', tom_tat='$tom_tat', mo_ta='$mo_ta', gia_sp='$gia_sp', "
                        . "gia_km='$gia_km', id_danhmuc='$id_danhmuc', ma_qr='$name_qr' WHERE id_sp='$id_sp'") == 1) {
                    echo '<p class="text-primary">Cập nhật sản phẩm thành công!</p>';  
                } else {
                    echo '<p class="text-danger">Cập nhật sản phẩm không thành công!</p>';
                }
            }
        }
    }
?>
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Tên sản phẩm <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="ten_sp" value="<?php echo $row_sp['ten_sp']; ?>">
        <?php
            echo isset($error['ten_sp']) ? $error['ten_sp'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Slug sản phẩm <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" id="convert_slug" name="slug_sp" value="<?php echo $row_sp['slug_sp']; ?>">
        <?php
            echo isset($error['slug_sp']) ? $error['slug_sp'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Hình ảnh <span class="text-danger">(*)</span></label>
        <input type="file" name="image" class="form-control-file">
        <img src="../img/product/<?php echo $row_sp['image']; ?>" alt="" width="160" height="200" class="mt-3">
    </div>
    <div class="form-group">
        <label for="">Loại sản phẩm</label>
        <select class="form-control" id="" name="type">
            <?php
                if($row_sp['type'] == 0) {
            ?>
            <option selected="" value="0">Sản phẩm thường</option>
            <option value="1">Sản phẩm nổi bật</option>
            <?php
                } else {
            ?> 
            <option value="0">Sản phẩm thường</option>
            <option selected="" value="1">Sản phẩm nổi bật</option>
            <?php } ?>
        </select>
  </div>
    <div class="form-group">
        <label for="">Tóm tắt <span class="text-danger">(*)</span></label>
        <textarea class="form-control" name="tom_tat" rows="3">
            <?php
                echo $row_sp['tom_tat'];
            ?>
        </textarea>
        <?php
            echo isset($error['tom_tat']) ? $error['tom_tat'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Mô tả <span class="text-danger">(*)</span></label>
        <textarea class="form-control" name="mo_ta" rows="5">
            <?php
                echo $row_sp['mo_ta'];
            ?>
        </textarea>
        <?php
            echo isset($error['mo_ta']) ? $error['mo_ta'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Giá sản phẩm <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" name="gia_sp" value="<?php echo $row_sp['gia_sp']; ?>">
        <?php
            echo isset($error['gia_sp']) ? $error['gia_sp'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Giá khuyến mại</label>
        <input type="text" class="form-control" name="gia_km" value="<?php echo $row_sp['gia_km']; ?>">
    </div>
    <div class="form-group">
        <label for="">Tác giả <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" name="tac_gia" value="<?php echo $row_sp['tac_gia']; ?>">
        <?php
            echo isset($error['tac_gia']) ? $error['tac_gia'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Nhà xuất bản <span class="text-danger">(*)</span></label>
        <input type="text" class="form-control" name="nha_xb" value="<?php echo $row_sp['nha_xb']; ?>">
        <?php
            echo isset($error['nha_xb']) ? $error['nha_xb'] : '';
        ?>
    </div>
    <div class="form-group">
        <label for="">Thuộc danh mục</label>
        <select class="form-control" id="" name="id_danhmuc">
            <?php
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <option <?php if($row_sp['id_danhmuc'] == $row['id_category']) {echo 'selected="selected"';} ?> value="<?php echo $row['id_category']; ?>">
                    <?php echo $row['ten_danhmuc']; ?>
                </option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" name="update_sp" class="btn btn-dark mb-3">Cập nhật sản phẩm</button>
</form>