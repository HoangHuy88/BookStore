<?php
    ob_start();
    session_start();
    include_once './data/data.php';
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>BookStore - Cung cấp sách các loại</title>
        <meta name="description" content="">		
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>		
        <link rel="shortcut icon" type="image/x-icon" href="img/icon.png">

        <!-- CSS  -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/owl.carousel.css">	
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/owl.transitions.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="css/animate.css">		
        <link rel="stylesheet" href="css/slicknav.css">				
        <link rel="stylesheet" href="css/main.css">		
        <link rel="stylesheet" href="css/home-4-color.css">					
        <link rel="stylesheet" href="css/responsive.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="home-4">    
        <header>
            <?php
                include_once './infor.php';
            ?>
            <!-- mainmenu-area start -->
            <?php
                include_once './nav.php';
            ?>
            <!-- mainmenu-area end -->
        </header>

        <!--CONTENT-->
        <?php
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'login':
                    include_once './chuc_nang/login.php';
                    break;
                case 'logout':
                    include_once './chuc_nang/logout.php';
                    break;
                case 'register':
                    include_once './chuc_nang/register.php';
                    break;
                case 'gioi-thieu':
                    include_once './chuc_nang/gioi_thieu.php';
                    break;
                case 'san-pham':
                    include_once './chuc_nang/san_pham.php';
                    break;
                case 'chi-tiet-san-pham':
                    include_once './chuc_nang/chi_tiet_sp.php';
                    break;
                case 'voucher':
                    include_once './chuc_nang/voucher.php';
                    break;
                case 'blog':
                    include_once './chuc_nang/blog.php';
                    break;
                case 'chi-tiet-blog':
                    include_once './chuc_nang/chi_tiet_blog.php';
                    break;
                case 'tim-kiem':
                    include_once './chuc_nang/tim_kiem.php';
                    break;
                case 'thong-tin-ca-nhan':
                    include_once './chuc_nang/thong_tin.php';
                    break;
                case 'don-hang':
                    include_once './chuc_nang/don_hang.php';
                    break;
                case 'voucher-cua-ban':
                    include_once './chuc_nang/my_voucher.php';
                    break;
                case 'gio-hang-cua-ban':
                    include_once './chuc_nang/gio_hang.php';
                    break;
                case 'thanh-toan':
                    include_once './chuc_nang/thanh_toan.php';
                    break;
                case 'thanh-cong':
                    include_once './chuc_nang/thanh_cong.php';
                    break;
            }
        } else {
            include_once './slide.php';
            include_once './trang_chu.php';
        }
        ?>

        <!-- footer start -->
        <footer>
            <!-- footer-top-area start -->
            <div class="footer-top-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4">
                            <div class="footer-widget widget-contact">
                                <h3 class="widget-title">Liên hệ</h3>
                                <ul class="footer-menu">
                                    <li><i class="fa fa-map-marker"> </i> <strong>Địa chỉ :</strong> 12 Nguyễn Văn Bảo, phường 4, quận Gò Vấp, Tp.Hồ Chí Minh</li>
                                    <li><i class="fa fa-phone"> </i> <strong>Phone :</strong> (84) 686 888 999</li>
                                    <li><i class="fa fa-envelope"> </i> <strong>Email :</strong> bookstoreiuh@gmail.com</li>
                                </ul>
                            </div>
                        </div>
                        <!-- footer-widget start -->
                        <div class="col-lg-3 col-md-3 col-sm-4">
                            <div class="footer-widget">
                                <h3 class="widget-title">Thông tin</h3>
                                <ul class="footer-menu">
                                    <li><a href="?page=gioi-thieu">Giới thiệu công ty</a></li>
                                    <li><a href="#">Tuyển dụng</a></li>
                                    <li><a href="#">Mua hàng tích điểm</a></li>
                                    <li><a href="#">Chính sách bảo mật</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- footer-widget end -->
                        <!-- footer-widget start -->
                        <div class="col-lg-3 col-md-3 col-sm-4">
                            <div class="footer-widget">
                                <h3 class="widget-title">Trợ giúp</h3>
                                <ul class="footer-menu">
                                    <li><a href="#">Hướng dẫn mua hàng</a></li>
                                    <li><a href="#">Phương thức thanh toán</a></li>
                                    <li><a href="#">Phương thức vận chuyển</a></li>
                                    <li><a href="#">Câu hỏi thường gặp</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- footer-widget end -->
                        <!-- footer-widget start -->
                        <div class="col-lg-3 col-md-3 hidden-sm">
                            <div class="footer-widget">
                                <h3 class="widget-title">Mạng xã hội</h3>
                                <div class="header-social-icon">
                                    <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="#" title="Tumblr"><i class="fab fa-tumblr"></i></a>
                                    <a href="#" title="Google"><i class="fab fa-google-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-top-area end -->
            <div class="footer-bootom-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="copyright">
                                <p>Copyright © 2021 Designed by <span style="color: red;">Hoang Huy, Tung Duong</span></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="payment">
                                <img src="img/payment1.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-bootom-area end -->
        </footer>
        <!-- footer end -->

        <!-- JS -->
        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/jquery.countdown.min.js"></script>

        <script src="js/jquery.scrollUp.min.js"></script>			

        <!-- main js -->
        <script src="js/main.js"></script>
        <!-- JavaScript -->
        <script>
            function add_cart_succes() {
                alert("Thêm sản phẩm vào giỏ hàng thành công!");
            }     
        </script>
        <script type="text/javascript">
            $('#keywords').keyup(function () {
               var keywords = $(this).val();
               
               if(keywords != '') {
                   $.ajax({
                      url:'chuc_nang/search_ajax.php',
                      method: 'POST',
                      data:{
                          keywords:keywords
                      },
                      success:function(data) {
                          $('#search_ajax').fadeIn();
                          $('#search_ajax').html(data);
                      }
                   });
               } else {
                   $('#search_ajax').fadeOut();
               }
            });
            
            $(document).on('click', '.li_timkiem_ajax', function () {
               $('#keywords').val($(this).text());
               $('#search_ajax').fadeOut();
            });
        </script>
    </body>
</html>
