<!-- Breadcrumb -->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php">Trang chủ</a></li>
        <li>Thông tin cá nhân</li>
    </ul>
</div>

<?php
    $p = new data();
    if(isset($_SESSION['id_kh']) && isset($_SESSION['ho_ten']) && isset($_SESSION['email'])) {
        $id_kh = $_SESSION['id_kh'];
        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM khach_hang WHERE id_kh='$id_kh' LIMIT 1");
        $row = mysqli_fetch_assoc($query);
?>
<div class="container">
    <div class="information">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="information_form">
                    <div class="information_form-tile">
                        <h3 class="h3 text-center">Thông tin cá nhân</h3>
                    </div>
                    <h4 class="information_form-hello">Xin chào bạn <span><?php echo $row['ho_ten']; ?></span></h4>
                    <?php
                        if(isset($_POST['cap_nhat'])) {
                            $ho_ten = $_POST['ho_ten'];
                            $email = $_POST['email'];
                            $phone= $_POST['phone'];
                            $dia_chi = $_POST['dia_chi'];
                            $pass = $_POST['pass'];
                            
                            if(empty($ho_ten)) {
                                $error['ho_ten'] = '<p class="text-danger">Vui lòng nhập tên của bạn!</p>';
                            }
                            $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
                            if (empty($email)) {
                                $error['email'] = '<p class="text-danger">Vui lòng nhập địa chỉ email!</p>';
                            } else if (!preg_match($partten, $email)) {
                                $error['email'] = '<p class="text-danger">Địa chỉ email không đúng định dạng!</p>';
                            }
                            if(empty($pass)) {
                                $error['pass'] = '<p class="text-danger">Vui lòng nhập mật khẩu của bạn!</p>';
                            }
                            if(empty($error) == true) {
                                $pass = md5($pass);
                                if($p->themxoasua("UPDATE khach_hang SET ho_ten='$ho_ten', phone='$phone', "
                                        . "email='$email', dia_chi='$dia_chi', pass='$pass' WHERE id_kh='$id_kh'") == 1) {
                                    echo '<p class="text-primary">Cập nhật thông tin thành công!</p>';
                                } else {
                                    echo '<p class="text-danger">Email đã tồn tại!</p>';
                                }
                            }
                        }
                    ?>
                    <form action="" method="POST">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Họ tên <span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="ho_ten" class="form-control" value="<?php echo $row['ho_ten']; ?>">
                                 <?php
                                    echo isset($error['ho_ten']) ? $error['ho_ten'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Email <span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                                <?php
                                    echo isset($error['email']) ? $error['email'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Số điện thoại</label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Địa chỉ</label>
                            <div class="col-sm-8">
                                <input type="text" name="dia_chi" class="form-control" value="<?php echo $row['dia_chi']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Mật khẩu <span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" name="pass" class="form-control" placeholder="Mật khẩu">
                                 <?php
                                    echo isset($error['pass']) ? $error['pass'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="product_detail-add">
                            <button type="submit" name="cap_nhat" style="padding: 8px 46px 8px 46px; margin-bottom: 20px;">Lưu</button>
                        </div>
                    </form>				
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>			
    </div>
</div>
<?php
    } else {
        echo '<p class="text-danger">Lỗi!</p>';
    }
?>