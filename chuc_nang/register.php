<div class="container">
    <div class="login">
        <h3 class="h2 login_title">Đăng ký thành viên</h3>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="login_form">
                    <?php
                        $p = new data();
                        if(isset($_POST['register'])) {
                            $ho_ten = $_POST['ho_ten'];
                            $email = $_POST['email'];
                            $phone = $_POST['phone'];
                            $dia_chi = $_POST['dia_chi'];
                            $pass = $_POST['pass'];
                            $repass = $_POST['repass'];
                            
                            //Kiểm tra
                            $error = array();
                            if(empty($ho_ten)) {
                                $error['ho_ten'] = '<p class="error">Vui lòng nhập họ tên của bạn!</p>';
                            }
                            $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
                            if (empty($email)) {
                                $error['email'] = '<p class="error">Vui lòng nhập địa chỉ email!</p>';
                            } else if (!preg_match($partten, $email)) {
                                $error['email'] = '<p class="error">Địa chỉ email không đúng định dạng!</p>';
                            }
                            if(!preg_match ("/^[0-9]*$/", $phone)) {
                                $error['phone'] = '<p class="error">Số điện thoại không hợp lệ!</p>';
                            }
                            if (empty($pass)) {
                                $error['pass'] = '<p class="error">Vui lòng nhập mật khẩu!</p>';
                            }  else if (strlen($pass) < 6) {
                                $error['pass'] = '<p class="error">Mật khẩu phải lớn hơn 6 ký tự!</p>';
                            }
                            if (empty($repass)) {
                                $error['repass'] = '<p class="error">Vui lòng nhập lại mật khẩu!</p>';
                            }
                            if($repass != $pass) {
                                $error['repass'] = '<p class="error">Mật khẩu nhập lại không chính xác!</p>';
                            }
                            
                            //Thêm dữ liệu
                            if(empty($error) == true) {
                                $pass = md5($pass);
                                if($p->themxoasua("INSERT INTO khach_hang(ho_ten, phone, email, dia_chi, pass) "
                                        . "VALUES ('$ho_ten', '$phone', '$email', '$dia_chi', '$pass')") == 1) {
                                    echo '<p class="success_register">Đăng ký tài khoản thành công!<p>';              
                                } else {
                                    echo '<p class="error">Email đã tồn tại!<p>';
                                }
                            } 
                        }
                    ?>
                    <form action="" style="margin-top: 24px;" method="POST">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Họ tên <span class="error">(*)</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ho_ten" placeholder="Họ tên">
                                <?php
                                    echo isset($error['ho_ten']) ? $error['ho_ten'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Email <span class="error">(*)</span></label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <?php
                                    echo isset($error['email']) ? $error['email'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Số điện thoại</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                                <?php
                                    echo isset($error['phone']) ? $error['phone'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Địa chỉ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="dia_chi" placeholder="Địa chỉ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Mật khẩu <span class="error">(*)</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="pass" placeholder="Mật khẩu">
                                <?php
                                    echo isset($error['pass']) ? $error['pass'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nhập lại mật khẩu <span class="error">(*)</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="repass" placeholder="Mật khẩu">
                                <?php
                                    echo isset($error['repass']) ? $error['repass'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="product_detail-add" style="margin-bottom: 26px;">
                            <button type="submit" name="register" style="padding: 8px 46px 8px 46px;">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>			
    </div>
</div>