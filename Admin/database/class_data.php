<?php
    class database 
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
            $query = mysqli_query($link, "SELECT * FROM admin WHERE email='$email' AND pass='$pass'");
            
            $i = mysqli_num_rows($query);
            
            if($i > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $name = $row['name'];
                    $email = $row['email'];
                    $pass = $row['pass'];
                    
                    session_start();
                    
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['pass'] = $pass;
                    
                    header('location: index.php');
                }
            } else {
                echo '<p class="text-danger">Thông tin tài khoản hoặc mật khẩu chưa chính xác!</p>';
            }
        }
        
        function cf_login($name, $email, $pass) {
            $sql = "SELECT * FROM admin WHERE name='$name' AND email='$email' AND pass='$pass'";
            
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            $i = mysqli_num_rows($query);
            
            if($i != 1) {
                header('location: login.php');
            }
        }
        
        function read_slide($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            
            $i = mysqli_num_rows($query);
            $stt = 1;
            if($i > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $id_slide = $row['id_slide'];
                    $image = $row['image'];
                    $active = $row['active'];
                    
                    if($active == 1) {
                        $ac = '<p class="text-primary">Kích hoạt</p>';
                     } else {
                        $ac = '<p class="text-danger">Chưa kích hoạt</p>';
                     }
                     
                    echo '<tr>
                        <th scope="row">'.$stt++.'</th>
                        <td width="50%">
                            <img src="../img/slider/'.$image.'" alt="" width="80%" height="180" />
                        </td>
                        <td>'.$ac.'</td>
                        <td>
                            <a href="?page_layout=update-slide&id='.$id_slide.'" class="btn btn-primary">Cập nhật</a>
                            <a data-confirm="Bạn có chắc chắn muốn xóa slide này không?" href="?page_layout=delete-slide&id='.$id_slide.'" class="btn btn-danger delete">Xóa</a>
                        </td>
                    </tr>';
                }             
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật</p';
            }
        }
        
        function read_voucher($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            
            $i = mysqli_num_rows($query);
            $stt = 1;
            $date = date("d-m-Y");
            
            if($i > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $id_voucher = $row['id_voucher'];
                    $tieu_de = $row['tieu_de'];
                    $mo_ta = $row['mo_ta'];
                    $image = $row['image'];
                    $ma_voucher = $row['ma_voucher'];
                    $diem = $row['diem'];
                    $ngay_bd= $row['ngay_bd'];
                    $ngay_kt = $row['ngay_kt'];
                    
                    if(strtotime($date) > strtotime($ngay_kt)) {
                        $nkt = $ngay_kt."<p class='text-danger'> (Đã hết hạn)</p>";                   
                    } else {
                        $nkt = $ngay_kt;
                    }
                
                    echo '<tr>
                        <th scope="row">'.$stt++.'</th>
                        <td width="20%">
                            <img src="../img/voucher/'.$image.'" alt="" width="80%" height="80" />
                        </td>
                        <td>'.$tieu_de.'</td>
                        <td>'.mb_substr($mo_ta, 0, 80).'</td>
                        <td>'.$diem.'</td>
                        <td>'.$ma_voucher.'</td>
                        <td>'.$ngay_bd.'</td>
                        <td>'.$nkt.'</td>
                        <td class="text-center">
                            <a href="?page_layout=update-voucher&id='.$id_voucher.'" class="btn btn-primary">Cập nhật</a>
                            <a data-confirm="Bạn có chắc chắn muốn xóa voucher này không?" href="?page_layout=delete-voucher&id='.$id_voucher.'" class="btn btn-danger delete">Xóa</a>
                        </td>
                    </tr>';           
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật</p';
            }
        }
        
        function read_cateblog($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            
            $i = mysqli_num_rows($query);
            $stt = 1;
            if($i > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $id_cate = $row['id_cate'];
                    $ten_danhmuc = $row['ten_danhmuc'];
                    $slug_danhmuc = $row['slug_danhmuc'];
                    $ngay_tao = $row['ngay_tao'];
                    
                    echo '<tr>
                    <th scope="row">'.$stt++.'</th>
                    <td>'.$ten_danhmuc.'</td>
                    <td>'.$slug_danhmuc.'</td>
                    <td>'.$ngay_tao.'</td>
                    <td>
                        <a href="?page_layout=update-category-blog&id='.$id_cate.'" class="btn btn-primary">Cập nhật</a>
                        <a data-confirm="Bạn có chắc chắn muốn xóa danh mục blog này không?" href="?page_layout=delete-category-blog&id='.$id_cate.'" class="btn btn-danger delete">Xóa</a>
                    </td>
                </tr>';
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật</p';
            }
        }
        
        function read_catesp($sql) {
            $link = $this->connect();
            $query = mysqli_query($link, $sql);
            
            $i = mysqli_num_rows($query);
            $stt = 1;
            if($i > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $id_category = $row['id_category'];
                    $ten_danhmuc = $row['ten_danhmuc'];
                    $slug_danhmuc = $row['slug_danhmuc'];
                    $ngay_tao = $row['ngay_tao'];
                    
                    echo '<tr>
                        <th scope="row">'.$stt++.'</th>
                        <td>'.$ten_danhmuc.'</td>
                        <td>'.$slug_danhmuc.'</td>
                        <td>'.$ngay_tao.'</td>
                        <td>
                            <a href="?page_layout=update-category-product&id='.$id_category.'" class="btn btn-primary">Cập nhật</a>
                            <a data-confirm="Bạn có chắc chắn muốn xóa danh mục sản phẩm này không?" href="?page_layout=delete-category-product&id='.$id_category.'" class="btn btn-danger delete">Xóa</a>
                        </td>
                    </tr>';
                }
            } else {
                echo '<p class="text-danger">Dữ liệu chưa được cập nhật</p';
            }
        }
        
        function themxoasua($sql) {
            $link = $this->connect();
            if(mysqli_query($link, $sql)) {
                return 1;
            } else {
                return 0;
            }
        }
    }
?>

