<!-- Breadcrumb -->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="../index.php">Trang chủ</a></li>
        <li>Đặt hàng</li>
    </ul>
</div>

<!-- Content -->
<div class="container">
    <h2 class="h2 text-center">Đơn hàng của bạn</h2> <br>

    <table class="table h4">
        <thead>
            <tr>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php                
                if(isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])) {
                    $totalPrice = 0;
                    for($i=0; $i<sizeof($_SESSION['giohang']); $i++) { 
                        $ttPrice = $_SESSION['giohang'][$i]['3'] * $_SESSION['giohang'][$i]['2'];
                        $totalPrice += $ttPrice;
            ?>
            <form action="" method="POST"> 
                <tr>
                    <th scope="row">
                        <img src="./img/product/<?php echo $_SESSION['giohang'][$i][1]; ?>" alt="" width="128" class="img-thumbnail">
                    </th>
                    <td><?php echo $_SESSION['giohang'][$i][0]; ?></td>
                    <td><?php echo number_format($_SESSION['giohang'][$i][3]); ?> VNĐ</td>
                    <td><?php echo $_SESSION['giohang'][$i][2]; ?></td>
                    <td><?php echo number_format($ttPrice); ?> VNĐ</td>
                </tr>
                <?php
                        }
                    }               
                ?>
                <tr>
            </form>
                <th colspan="5">
                    <p class="h3 text-center">Tổng thanh toán: 
                        <span class="text-danger">
                            <?php
                                if(isset($totalNew)) {
                                   echo $totalNew;
                                } else {
                                    echo number_format($totalPrice).'VNĐ';
                                }
                            ?>                         
                        </span></p>
                </th>
            </tr>
        </tbody>
    </table>
    <hr>
    <?php
        if(isset($_SESSION['id_kh']) && isset($_SESSION['ho_ten']) && isset($_SESSION['email']) && isset($_SESSION['pass'])) {
            $id_kh = $_SESSION['id_kh'];
            $p = new data();
            $link = $p->connect();
            $query = mysqli_query($link, "SELECT * FROM khach_hang WHERE id_kh='$id_kh' LIMIT 1");
            $row = mysqli_fetch_assoc($query);
    ?>
    <div>
        <h2 class="h2 text-center">Thông tin thanh toán</h2>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form accept="" method="POST">
                    <div class="form-group">
                        <label for="">Họ tên</label>
                        <input type="text" class="form-control" name="ho_ten" value="<?php echo $row['ho_ten']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" name="dia_chi" value="<?php echo $row['dia_chi']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Ghi chú</label>
                        <textarea name="note" id="" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-check">
                        <label for="">Phương thức thanh toán</label> <br>
                        <input class="form-check-input" type="radio" name="thanh_toan" id="exampleRadios1" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Thanh toán tại nhà
                        </label> <br>
                        <input class="form-check-input" type="radio" name="thanh_toan" id="exampleRadios1" value="2">
                        <label class="form-check-label" for="exampleRadios1">
                            Thanh toán online
                        </label>
                    </div> <br>
                    <div class="product_detail-add">
                        <button type="submit" name="dat_hang" style="margin-bottom: 16px;">Đặt hàng</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <?php
        } else {
            echo '<h4 class="h4 text-danger">Vui lòng đăng nhập để thanh toán!</h4>';
        }
    ?>
</div>