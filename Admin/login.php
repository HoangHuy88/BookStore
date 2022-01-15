<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BOOKSTORE - Quản lý</title>
    <link rel="icon" href="./img/icon.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="./img/quan_ly.jpg" alt="" class="img-thumbnail" style="margin-top: 32px;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Quản lý BookStore!</h1>
                                    </div>
                                    <?php
                                        include_once './database/class_data.php';
                                        $p = new database();
                                        
                                        $data = array();
                                        $error = array();
                                        if(isset($_POST['login'])) {
                                            $data['email'] = isset($_POST['email']) ? $_POST['email'] : ''; 
                                            $data['pass'] = isset($_POST['pass']) ? $_POST['pass'] : '';            
                                            
                                            //Kiểm tra
                                            $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
                                            if(empty($data['email'])) {
                                                $error['email'] = '<p class="text-danger">Vui lòng nhập địa chỉ email!</p>';
                                            } else if(!preg_match($partten, $data['email'])) {
                                                $error['email'] = '<p class="text-danger">Địa chỉ email không đúng định dạng!</p>';
                                            }
                                            if(empty($data['pass'])) {
                                                $error['pass'] = '<p class="text-danger">Vui lòng nhập mật khẩu!</p>';
                                            }
                                            
                                            if(!$error) {
                                                $p->login($data['email'], $data['pass']);
                                            }                                   
                                        }
                                    ?>
                                    <form action="" class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="email" value="<?php if(isset($data['email'])) {echo $data['email'];} ?>" placeholder="Email của bạn...">
                                            <?php
                                                echo isset($error['email']) ? $error['email'] : '';
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="pass" placeholder="Mật khẩu">
                                            <?php
                                                echo isset($error['pass']) ? $error['pass'] : '';
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ghi nhớ tôi</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-dark">Đăng nhập</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>