<div class="container">
    <div class="login">
        <h3 class="h2 login_title">Đăng nhập</h3>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="login_form">
                    <div class="login_form-tile">
                        <p>Đăng nhập</p>
                        <p>Bạn chưa có tài khoản?
                            <a href="?page=register">Đăng ký</a>
                        </p>
                    </div>
                    <?php
                        $p = new data();
                        if(isset($_POST['login_index'])) {
                            $email = $_POST['email'];
                            $pass = $_POST['pass'];
                            
                            //Check
                            $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
                            if (empty($email)) {
                                $error['email'] = '<p class="error">Vui lòng nhập địa chỉ email!</p>';
                            } else if (!preg_match($partten, $email)) {
                                $error['email'] = '<p class="error">Địa chỉ email không đúng định dạng!</p>';
                            }
                            
                            if(empty($pass)) {
                                $error['pass'] = '<p class="error">Vui lòng nhập mật khẩu của bạn!</p>';
                            }
                            
                            if(empty($error) == true) {
                                $p->login($email, $pass);
                            }
                        }
                    ?>
                    <form action="" method="POST">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Email <span class="error">(*)</span></label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <?php
                                    echo isset($error['email']) ? $error['email'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Mật khẩu <span class="error">(*)</span></label>
                            <div class="col-sm-9">
                                <input type="password" name="pass" class="form-control" placeholder="Mật khẩu">
                                <?php
                                    echo isset($error['pass']) ? $error['pass'] : '';
                                ?>
                            </div>
                        </div>
                        <div class="login_form-tile">
                            <div class="form-check login_form-tile-remember">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Ghi nhớ tôi</label>
                            </div>
                            <a href="#" class="login_form-tile-link">Quên mật khẩu?</a>
                        </div>
                        <div class="product_detail-add">
                            <button type="submit" name="login_index" style="padding: 8px 46px 8px 46px;">Đăng nhập</button>
                        </div>
                    </form>
                    <h4 class="login_form-or">Hoặc</h4>
                    <div class="login_mxh">                       
                        <?php
                            //Login google
                            require_once ('gg_login/vendor/autoload.php');

                            $cliendID = '1054806773324-6sga0nqanfpmur46aisthmeait1989fq.apps.googleusercontent.com';
                            $clientSecret = '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';
                            $redirecUrl = 'http://localhost:86/BookStore/index.php?page=login';

                            $client = new Google_Client();
                            $client->setClientID($cliendID);
                            $client->setClientSecret($clientSecret);
                            $client->setRedirectUri($redirecUrl);
                            $client->addScope('profile');
                            $client->addScope('email');

                            if(isset($_GET['code'])) {
                                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                                $client->setAccessToken($token);

                                $gauth = new Google_Service_Oauth2($client);
                                $google_info = $gauth->userinfo->get();
                                $email = $google_info->email;
                                $name = $google_info->name;
                                
                                if(isset($email) && isset($name)) {
                                    $link = $p->connect();
                                    $query_check = mysqli_query($link, "SELECT * FROM khach_hang");
                                    while ($row_check = mysqli_fetch_array($query_check)) {
                                        $email_check = $row_check['email'];
                                        $name_check = $row_check['name'];
                                        
                                        if($email != $email_check && $name != $name_check) {
                                            if($p->themxoasua("INSERT INTO khach_hang(ho_ten, email) VALUES ('$name', '$email')") == 1) {                                               
                                                $query = mysqli_query($link, "SELECT * FROM khach_hang WHERE ho_ten='$name' AND email='$email' LIMIT 1");
                                                $i = mysqli_num_rows($query);
                                                if($i > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                        $id_kh = $row['id_kh'];
                                                        $ho_ten = $row['ho_ten'];
                                                        $email = $row['email'];

                                                        session_start();

                                                        $_SESSION['id_kh'] = $id_kh;
                                                        $_SESSION['ho_ten'] = $ho_ten;
                                                        $_SESSION['email'] = $email;

                                                        header('location: index.php');
                                                    }
                                                } else {
                                                    echo 'Đăng nhập không thành công!';
                                                }
                                            }
                                        } else {
                                            $query = mysqli_query($link, "SELECT * FROM khach_hang WHERE ho_ten='$name' AND email='$email' LIMIT 1");
                                            $i = mysqli_num_rows($query);
                                            if ($i > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) {
                                                    $id_kh = $row['id_kh'];
                                                    $ho_ten = $row['ho_ten'];
                                                    $email = $row['email'];

                                                    session_start();

                                                    $_SESSION['id_kh'] = $id_kh;
                                                    $_SESSION['ho_ten'] = $ho_ten;
                                                    $_SESSION['email'] = $email;

                                                    header('location: index.php');
                                                }
                                            } else {
                                                echo 'Đăng nhập không thành công!';
                                            }
                                        }
                                    }                                   
                                }
                                
                            } else {
                                echo "<a href='".$client->createAuthUrl()."' class='login_mxh-facebook'>
                                        <img src='./img/login/google.png' alt='' style='margin-left: 72%;'>
                                    </a>";
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>			
    </div>
</div>