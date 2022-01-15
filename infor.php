<div class="header-top-area">
    <div class="container">
        <div class="row">
            <!-- logo start -->
            <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
                <div class="logo">
                    <a href="index.php"><img src="./img/logo.png" alt="" /></a>
                </div>
            </div>
           <?php
                if(!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];
                //Xóa sản phẩm giỏ hàng
                if(isset($_GET['delete']) && $_GET['delete'] >= 0) {
                    array_splice($_SESSION['giohang'], $_GET['delete'], 1);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
                //Lấy dữ liệu từ form
                if(isset($_POST['them_cart'])) {
                    $ten_sp = $_POST['ten_sp'];
                    $image = $_POST['image'];
                    $sl = 1;
                    $gia_sp = $_POST['gia_sp'];
                    $id_sp = $_POST['id_sp'];
                    
                    //Kiểm tra sp tồn tại chưa
                    $fl = 0;
                    for ($i=0; $i<sizeof($_SESSION['giohang']); $i++) {
                        if($_SESSION['giohang'][$i][0] == $ten_sp) {
                            $fl = 1;
                            $slNew = $sl+$_SESSION['giohang'][$i][2];
                            $_SESSION['giohang'][$i][2] = $slNew;
                            break;
                        }
                    }
                    if($fl == 0) {
                        //Thêm dữ liệu vào giỏ hàng
                        $product = [$ten_sp, $image, $sl, $gia_sp, $id_sp];                   
                        $_SESSION['giohang'][] = $product;
                    }
                } 
           ?>
            <!-- header-menu-cart start -->
            <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
                <div class="header-menu-cart">
                    <div class="cart-total">
                        <ul>
                            <li><a href=""><span class="cart-icon"><i class="fa fa-shopping-cart"></i></span> <span class="cart-no"><?php echo count($_SESSION['giohang']); ?></span></a>
                                <div class="mini-cart-content">
                                    <?php
                                        if(isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])) {
                                            $totalPrice = 0;
                                            for($i=0; $i<sizeof($_SESSION['giohang']); $i++) {
                                            $ttPrice = $_SESSION['giohang'][$i]['3'] * $_SESSION['giohang'][$i]['2'];
                                            $totalPrice += $ttPrice;
                                    ?>
                                    <div class="cart-img-details">											
                                        <div class="cart-img-photo">
                                            <img src="img/product/<?php echo $_SESSION['giohang'][$i][1]; ?>" alt=""/>
                                            <span class="quantity">
                                                <?php echo $_SESSION['giohang'][$i][2]; ?>
                                            </span>
                                        </div>
                                        <div class="cart-img-contaent">
                                            <h4><?php echo $_SESSION['giohang'][$i][0]; ?></h4>
                                            <span>
                                                <?php echo number_format($ttPrice); ?> VNĐ
                                            </span>                                           
                                        </div>
                                        <div class="pro-del"><a href="?delete=<?php echo $i; ?>"><i class="fa fa-times-circle"></i></a></div>                                        
                                    </div>
                                    <div class="clear"></div>
                                    <?php
                                        } 
                                        if(count($_SESSION['giohang']) == 0) {
                                            echo '<p class="text-danger">Giỏ hàng trống!</p>';
                                        }
                                    ?>                                    
                                    <p class="total">Tổng tiền: <span class="amount error"><?php echo number_format($totalPrice); ?> VNĐ</span></p>
                                    <div class="clear"></div>
                                    <?php
                                        }
                                    ?>
                                    <p class="cart-button-top"><a href="?page=gio-hang-cua-ban">Giỏ hàng</a></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php
                        if(isset($_SESSION['id_kh']) && isset($_SESSION['ho_ten']) && isset($_SESSION['email'])) {
                    ?>
                    <div class="cart-total">
                        <ul>
                            <li>
                                <a href=""><span class="cart-icon">
                                        <i class="fa fa-user"></i></span> <span class="cart-no" style="width: auto; padding: 9px 6px;"><?php echo $_SESSION['ho_ten']; ?></span>
                                </a>
                                <div class="mini-cart-content" style="width: 200px;">
                                    <div class="cart-img-contaent">
                                        <a href="?page=thong-tin-ca-nhan"><h5><i class="fa fa-user"></i> &nbsp; Thông tin cá nhân</h5></a>
                                    </div>
                                    <div class="cart-img-contaent">
                                        <a href="?page=don-hang"><h5><i class="fas fa-file-invoice-dollar"></i> &nbsp; Đơn hàng của bạn</h5></a>
                                    </div>
                                    <div class="cart-img-contaent">
                                        <a href="?page=voucher-cua-ban"><h5><i class="fas fa-credit-card"></i> &nbsp; Voucher</h5></a>
                                    </div>
                                    <hr>
                                    <div class="cart-img-contaent">
                                        <a href="?page=logout"><h5><i class="fas fa-sign-out-alt"></i> &nbsp; Đăng xuất</h5></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div class="cart-total">
                        <ul>
                            <li>
                                <a href="?page=login"><span class="cart-icon">
                                        <i class="fa fa-user"></i></span> <span class="cart-no" style="width: auto; padding: 9px 6px;">Tài khoản</span>
                                </a>
                            </li>
                        </ul>
                    </div> 
                    <?php
                        }
                    ?>
                </div>					
            </div>
            <!-- header-menu-cart end -->
        </div>
    </div>
</div>