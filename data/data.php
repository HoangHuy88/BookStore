<?php
    class data
    {
        function connect() {
            $conn = mysqli_connect("localhost", "bookstore", "123456", "bookstore");
            
            if(!$conn) {
                echo 'Kết nối không thành công!';
            } else {
                mysqli_set_charset($conn, "UTF8");
                return $conn;
            }
        }
        
        function login($email, $pass) {
            $pass = md5($pass);
            $link = $this->connect();
            $query = mysqli_query($link, "SELECT * FROM khach_hang WHERE email='$email' AND pass='$pass' LIMIT 1");
            
            $i = mysqli_num_rows($query);
            if($i > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $id_kh = $row['id_kh'];
                    $ho_ten = $row['ho_ten'];
                    $email = $row['email'];
                    $pass = $row['pass'];
                    
                    session_start();
                    
                    $_SESSION['id_kh'] = $id_kh;
                    $_SESSION['ho_ten'] = $ho_ten;
                    $_SESSION['email'] = $email;
                    $_SESSION['pass'] = $pass;
                    
                    header('location: index.php');
                }
            } else {
                echo '<p class="text-danger">Tài khoản không tồn tại!</p>';
            }
        }
                       
        function read_catesp($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            $i = mysqli_num_rows($query);
            if($i > 0) {
                while($row = mysqli_fetch_array($query)) {
                    $ten_cate = $row['ten_danhmuc'];
                    $slug_cate = $row['slug_danhmuc'];
                    
                    echo '<li><a href="?page=san-pham&slug='.$slug_cate.'">'.$ten_cate.'</a></li>';
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật!</p>';
            }
        }
        
        function read_cateblog($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            $i = mysqli_num_rows($query);
            if($i > 0) {
                while($row = mysqli_fetch_array($query)) {
                    $ten_cate = $row['ten_danhmuc'];
                    $slug_cate = $row['slug_danhmuc'];
                    
                    echo '<li><a href="?page=blog&slug='.$slug_cate.'">'.$ten_cate.'</a></li>';
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật!</p>';
            }
        }
        
        function read_slide($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            $i = mysqli_num_rows($query);
            if($i>0) {
                while($row = mysqli_fetch_array($query)) {
                    $id_slide = $row['id_slide'];
                    $image = $row['image'];
                    $active = $id_slide == '2' ? 'active'  : '';          
                    echo '<div class="item '.$active.'">
                            <img src="img/slider/'.$image.'" alt="">
                        </div>';
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật!</p>';
            }
        }
         
        function read_sp_4($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            $i = mysqli_num_rows($query);
            if($i > 0) {
                while($row = mysqli_fetch_array($query)) {
                    $id_sp = $row['id_sp'];
                    $slug_sp = $row['slug_sp'];
                    $ten_sp = $row['ten_sp'];
                    $img = $row['image'];
                    $gia_sp = $row['gia_sp'];
                    $gia_km = $row['gia_km'];
                    $ma_qr = $row['ma_qr'];
                    
                    if($gia_km == '') {
                        $price = '<span class="pro-price">'.number_format($gia_sp).' VNĐ</span>';
                        $sale = '';
                    } else {
                        $price = '<span class="old-price">'.number_format($gia_sp).' VNĐ</span>
                                    <span class="pro-price">'.number_format($gia_km).' VNĐ</span>'; 
                        $sale = '<span class="sale-text">Sale</span>';
                    }
                    
                    $gia_sp_cart = $gia_km ? $gia_km : $gia_sp;
                    
                    echo '<div class="col-sm-6 col-md-4">
                            <div class="single-features">
                                '.$sale.'
                                <div class="product-img">
                                    <a href="?page=chi-tiet-san-pham&slug-san-pham='.$slug_sp.'">
                                        <img class="first-img" src="img/product/'.$img.'" alt="" />
                                    </a>                         
                                    <a class="modal-view" href="?page=chi-tiet-san-pham&slug-san-pham='.$slug_sp.'">Chi tiết</a>
                                </div>
                                <img style="position: absolute; width: 100px; margin-top: -100px; margin-left: 170px;" src="img/qr_code/'.$ma_qr.'" alt="" />
                                <div class="product-content">
                                    <div class="pro-rating">
                                        <a href=""><i class="fa fa-star"></i></a>
                                        <a href=""><i class="fa fa-star"></i></a>
                                        <a href=""><i class="fa fa-star"></i></a>
                                        <a href=""><i class="fa fa-star"></i></a>
                                    </div>
                                    <h5><a href="?page=chi-tiet-san-pham&slug-san-pham='.$slug_sp.'">'.mb_substr($ten_sp, 0, 22).'...</a></h5>
                                    '.$price.'
                                    <div class="action-buttons">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_sp" value="'.$id_sp.'">
                                            <input type="hidden" name="ten_sp" value="'.$ten_sp.'">
                                            <input type="hidden" name="image" value="'.$img.'">
                                            <input type="hidden" name="gia_sp" value="'.$gia_sp_cart.'">
                                            
                                            <button class="btn_add-cart" name="them_cart" onclick="add_cart_succes();">
						<i class="fa fa-shopping-cart"></i> ADD TO CART
                                            </button>
                                        </form>
                                    </div>										
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật!</p>';
            }
        }
        
        function read_sp_3($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            $i = mysqli_num_rows($query);
            if($i > 0) {
                while($row = mysqli_fetch_array($query)) {
                    $id_sp = $row['id_sp'];
                    $slug_sp = $row['slug_sp'];
                    $ten_sp = $row['ten_sp'];
                    $img = $row['image'];
                    $gia_sp = $row['gia_sp'];
                    $gia_km = $row['gia_km'];
                    $ma_qr = $row['ma_qr'];
                    
                    if($gia_km == '') {
                        $price = '<span class="pro-price">'.number_format($gia_sp).' VNĐ</span>';
                        $sale = '';
                    } else {
                        $price = '<span class="old-price">'.number_format($gia_sp).' VNĐ</span>
                                    <span class="pro-price">'.number_format($gia_km).' VNĐ</span>'; 
                        $sale = '<span class="sale-text">Sale</span>';
                    }
                    
                    $gia_sp_cart = $gia_km ? $gia_km : $gia_sp;
                    
                    echo '<div class="col-sm-6 col-md-3">
                            <div class="single-features">
                                '.$sale.'
                                <div class="product-img">
                                    <a href="?page=chi-tiet-san-pham&slug-san-pham='.$slug_sp.'">
                                        <img class="first-img" src="img/product/'.$img.'" alt=""/>
                                    </a>
                                    <a class="modal-view" href="?page=chi-tiet-san-pham&slug-san-pham='.$slug_sp.'">Chi tiết</a>
                                </div>
                                <img style="position: absolute; width: 100px; margin-top: -100px; margin-left: 170px;" src="img/qr_code/'.$ma_qr.'" alt="" />
                                <div class="product-content">
                                    <div class="pro-rating">
                                        <a href=""><i class="fa fa-star"></i></a>
                                        <a href=""><i class="fa fa-star"></i></a>
                                        <a href=""><i class="fa fa-star"></i></a>
                                        <a href=""><i class="fa fa-star"></i></a>
                                    </div>
                                    <h5><a href="?page=chi-tiet-san-pham&slug-san-pham='.$slug_sp.'">'.mb_substr($ten_sp, 0, 22).'...</a></h5>
                                    '.$price.'
                                    <div class="action-buttons">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_sp" value="'.$id_sp.'">
                                            <input type="hidden" name="ten_sp" value="'.$ten_sp.'">
                                            <input type="hidden" name="image" value="'.$img.'">
                                            <input type="hidden" name="gia_sp" value="'.$gia_sp_cart.'">
                                            
                                            <button class="btn_add-cart" name="them_cart" onclick="add_cart_succes();">
						<i class="fa fa-shopping-cart"></i> ADD TO CART
                                            </button>
                                        </form>
                                    </div>										
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật!</p>';
            }
        }
        
        function blog_index($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            $i = mysqli_num_rows($query);
            if($i>0) {
                while ($row = mysqli_fetch_array($query)) {
                    $tieu_de = $row['tieu_de'];
                    $slug_blog = $row['slug_blog'];
                    $tom_tat = $row['tom_tat'];
                    $ngay_tao = $row['ngay_tao'];
                    
                    echo '<div class="recent-post">
                            <div class="post-info">
                                <span class="recent-post-date">'.$ngay_tao.'</span>
                                <h3><a href="?page=chi-tiet-blog&slug_blog='.$slug_blog.'">'.$tieu_de.'</a></h3>
                                <p>'.mb_substr($tom_tat, 0, 100).'...</p>
                                <a class="read-more" href="?page=chi-tiet-blog&slug_blog='.$slug_blog.'">Đọc tiếp</a>
                            </div>
                        </div>';
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật!</p>';
            }
        }
        
        function cmt_index($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            $i = mysqli_num_rows($query);
            if($i>0) {
                while ($row= mysqli_fetch_array($query)) {
                    $noi_dung = $row['noi_dung'];
                    $ho_ten = $row['ho_ten'];
                    
                    echo '<div class="testimonial-list">
                            <div class="test-content">
                                <span><i class="fa fa-quote-left"></i></span>
                                <p>'.$noi_dung.'</p>
                            </div>
                            <div class="test-img">
                                <div class="test-author">
                                    <span class="test-name">'.$ho_ten.'</span>
                                </div>
                            </div>							
                        </div>	';
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật!</p>';
            }
        }
        
        function themxoasua($sql) {
            $link = $this->connect();
            if(mysqli_query($link, $sql)) {
                return 1;
            } else {
                return 2;
            }
        }
    }
?>

