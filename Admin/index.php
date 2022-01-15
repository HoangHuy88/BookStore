<?php
    ob_start();
    session_start();
    
    if(isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['pass'])) {
        include_once './database/class_data.php';
        $q = new database();
        $q->cf_login($_SESSION['name'], $_SESSION['email'], $_SESSION['pass']);            
    } else {
        header('location: login.php');
    }
?>

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
    <link rel="stylesheet" href="../css/fontawesome/css/all.min.css" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">QUẢN LÝ</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang chủ</span></a>
            </li>
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="?page_layout=slide">
                    <i class="fas fa-images"></i>
                    <span>Quản lý slide</span></a>
            </li>

             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link" href="?page_layout=voucher">
                    <i class="fas fa-tags"></i>
                    <span>Quản lý voucher</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fab fa-blogger"></i>
                    <span>Quản lý blog</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?page_layout=category-blog">Danh mục blog</a>
                        <a class="collapse-item" href="?page_layout=blog">Blog</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-book"></i>
                    <span>Quản lý sản phẩm</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?page_layout=category-product">Danh mục sản phẩm</a>
                        <a class="collapse-item" href="?page_layout=product">Sản phẩm</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="?page_layout=client">
                    <i class="fas fa-users"></i>
                    <span>Quản lý khách hàng</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page_layout=phan-hoi-khach-hang">
                    <i class="fas fa-comments"></i>
                    <span>Phản hồi khách hàng</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="?page_layout=bill">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Quản lý hóa đơn</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <img src="../img/logo.png" height="50" class="ml-2"/>
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php
                                        if(isset($_SESSION['name'])) {
                                            echo $_SESSION['name'];
                                        }
                                    ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="./img/avt.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Thông tin nhân viên
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cài đặt
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Hoạt động đăng nhập
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                        if(isset($_GET['page_layout'])) {
                            switch ($_GET['page_layout']) {
                                case 'slide':
                                    include_once './slide/read.php';
                                    break;
                                case 'add-slide':
                                    include_once './slide/create.php';
                                    break;
                                case 'update-slide':
                                    include_once './slide/update.php';
                                    break;
                                case 'delete-slide':
                                    include_once './slide/delete.php';
                                    break;
                                //----------------VOUCHER-----------------
                                case 'voucher':
                                    include_once './voucher/read.php';
                                    break;
                                case 'add-voucher':
                                    include_once './voucher/create.php';
                                    break;
                                case 'update-voucher':
                                    include_once './voucher/update.php';
                                    break;
                                case 'delete-voucher':
                                    include_once './voucher/delete.php';
                                    break;
                                //--------------BLOG_CATEGORY------------
                                case 'category-blog':
                                    include_once './cate_blog/read.php';
                                    break;
                                case 'add-category-blog':
                                    include_once './cate_blog/create.php';
                                    break;
                                case 'update-category-blog':
                                    include_once './cate_blog/update.php';
                                    break;
                                case 'delete-category-blog':
                                    include_once './cate_blog/delete.php';
                                    break;
                                //-------------------BLOG----------------
                                case 'blog':
                                    include_once './blog/read.php';
                                    break;
                                case 'add-blog':
                                    include_once './blog/create.php';
                                    break;
                                case 'update-blog':
                                    include_once './blog/update.php';
                                    break;
                                 case 'delete-blog':
                                    include_once './blog/delete.php';
                                    break;
                                //--------------PRODUCT_CATEGORY-------------
                                case 'category-product':
                                    include_once './cate_product/read.php';
                                    break;
                                case 'add-category-product':
                                    include_once './cate_product/create.php';
                                    break;
                                case 'update-category-product':
                                    include_once './cate_product/update.php';
                                    break;
                                case 'delete-category-product':
                                    include_once './cate_product/delete.php';
                                    break;
                                //----------------PRODUCT---------------
                                case 'product':
                                    include_once './product/read.php';
                                    break;
                                case 'add-product':
                                    include_once './product/create.php';
                                    break;
                                case 'update-product':
                                    include_once './product/update.php';
                                    break;
                                case 'delete-product':
                                    include_once './product/delete.php';
                                    break;
                                //----------------KHACH_HANGS---------------
                                case 'client':
                                    include_once './client/read.php';
                                    break;
                                case 'phan-hoi-khach-hang':
                                    include_once './client/phan_hoi.php';
                                    break;
                                case 'delete-client':
                                    include_once './client/dele_client.php';
                                    break;
                                case 'tra-loi':
                                    include_once './client/tra_loi.php';
                                    break;
                                case 'delete-tra-loi':
                                    include_once './client/dele_tl.php';
                                    break;
                                //----------------BILL---------------
                                case 'bill':
                                    include_once './bill/read.php';
                                    break;
                                case 'bill-details':
                                    include_once './bill/bill-details.php';
                                    break;
                                case 'delete-bill':
                                    include_once './bill/delete.php';
                                    break;
                                
                            }
                        } else {
                            include_once './trang_chu.php';
                        }
                    ?>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <p class="font-weight-bold">Phát triển <span class="text-danger">Hoàng Huy & Tùng Dương</span></p>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    
    
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> 
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        CKEDITOR.replace( 'noi_dung');
        CKEDITOR.replace( 'mo_ta' );
        CKEDITOR.replace( 'tom_tat' );
    </script>
</body>
<script>
    var deleteLinks = document.querySelectorAll('.delete');

    for (var i = 0; i < deleteLinks.length; i++) {
      deleteLinks[i].addEventListener('click', function(event) {
          event.preventDefault();

          var choice = confirm(this.getAttribute('data-confirm'));

          if (choice) {
            window.location.href = this.getAttribute('href');
          }
      });
    }
</script>
<!--Tạo slug tự động-->
<script type="text/javascript">
        function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');

            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");

            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');

            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        thongke();
        var char = new Morris.Area({
            element: 'chart',
            lineColors: ['#5a5c69'],
            pointFillColors: ['#4C4C4C'],
            fillOpacity: 0.5,
            hideHover: 'auto',
            parseTime: false,
            xkey: 'date',
            ykeys: ['sales'],
            labels: ['Tổng doanh thu ngày']
        });
        
        $('.select-date').change(function () {
            var thoigian = $(this).val();
            
            if(thoigian == '30ngay') {
                var text = '30 ngày qua';
            } else if(thoigian == '90ngay') {
                var text = '90 ngày qua';
            } else if(thoigian == '365ngay') {
                var text = '365 ngày qua';
            }
                       
            $.ajax({
                url: "thong_ke.php",
                method: "POST",
                dataType: "JSON",
                data:{thoigian:thoigian},
                
                success:function(data) 
                {
                    char.setData(data);
                    $('#text-date').text(text);
                }
            });
        });
        
        function thongke() {
            var text = '30 ngày qua';
            
            $.ajax({
               url:"thong_ke.php",
               method:"POST",
               dataType:"JSON",
               
               success:function(data)
               {
                   char.setData(data);
                   $('#text-date').text(text);
               }
            });
        }
    });
</script>
<script type="text/javascript">
    $('#key_search').keyup(function () {
               var key_search = $(this).val();
               
               if(key_search != '') {
                   $.ajax({
                      url:'product/search_ajax.php',
                      method: 'POST',
                      data:{
                          key_search:key_search
                      },
                      success:function(data) {
                          $('#output_ajax').fadeIn();
                          $('#output_ajax').html(data);
                      }
                   });
               } else {
                   $('#output_ajax').fadeOut();
               }
            });
</script>
</html>