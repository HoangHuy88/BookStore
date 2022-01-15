<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hóa đơn</h1>
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-4 my-2 my-md-0 mw-100 navbar-search" method="POST">
        <div class="input-group">
            <div class="form-group">
                <label>Từ ngày</label>
                <input type="date" class="form-control bg-light border-0 small" name="date_start">
            </div>
             <div class="form-group">
                <label>đến ngày</label>
                <input type="date" class="form-control bg-light border-0 small" name="date_end">
            </div>
            
            <div class="input-group-append">
                <button type="submit" name="search_bill" class="btn btn-dark">
                    <i class="fas fa-search fa-sm"></i> Tìm kiếm
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Content Row -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Mã hóa đơn</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Ngày đặt</th>
            <th scope="col">Tổng tiền</th>
            <th scope="col" width="220" class="text-center">Tình trạng</th>
            <th scope="col">Thanh toán</th>
            <th scope="col" class="text-center">Quản lý</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $p = new database();
            $link = $p->connect();
            //Cập nhật trạng thái
            if(isset($_POST['cap_nhat'])) {
                $ma_hd = $_POST['ma_hoadon'];
                $trang_thai = $_POST['trang_thai'];
                if($p->themxoasua("UPDATE hoa_don SET trang_thai = '$trang_thai' WHERE ma_hd='$ma_hd' LIMIT 1") == 1) {
                    if($trang_thai == 5) {
                        //Lấy thông tin khách hàng
                        $query_kh = mysqli_query($link, "SELECT * FROM hoa_don INNER JOIN khach_hang ON "
                                . "hoa_don.id_kh=khach_hang.id_kh WHERE hoa_don.ma_hd='$ma_hd'");
                        $row_kh = mysqli_fetch_assoc($query_kh);
                        $id_kh = $row_kh['id_kh'];
                        $huy_don = $row_kh['huy_don'];
                        $huy_don_new = $huy_don + 1;
                        if($p->themxoasua("UPDATE khach_hang SET huy_don='$huy_don_new' WHERE id_kh='$id_kh' LIMIT 1") == 1) {
                            header("refresh: 0");
                        }
                    }                   
                }
            }
            //Phân trang
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $rowPerPage = 4;
            $perRow = $page*$rowPerPage - $rowPerPage;
    
            $query = mysqli_query($link, "SELECT * FROM khach_hang INNER JOIN hoa_don ON khach_hang.id_kh=hoa_don.id_kh "
                    . "ORDER BY ngay_dat DESC LIMIT $perRow, $rowPerPage");
            
            //Tính tổng số trang
            $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM hoa_don"));
            $totalPage = ceil($totalRow/$rowPerPage);

            $listPage = '';
            for($i = 1; $i <= $totalPage; $i++) {
                if($page == $i) {
                    $listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=bill&page='.$i.'">'.$i.'</a></li>';
                } else {
                    $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=bill&page='.$i.'">'.$i.'</a></li>';
                }
            }
        ?>
        
        <?php
            //Xử lý tìm kiếm
            if(isset($_POST['search_bill'])) {
                $date_start = $_POST['date_start'];
                $date_end = $_POST['date_end'];
                $sql_tk_bill = "SELECT * FROM khach_hang INNER JOIN hoa_don ON khach_hang.id_kh=hoa_don.id_kh "
                    . "WHERE ngay_dat BETWEEN '$date_start' AND '$date_end' ORDER BY ngay_dat DESC";
                $query_tk_bill = mysqli_query($link, $sql_tk_bill);
                $sl_bill = mysqli_num_rows($query_tk_bill);
                $tong_thu_nhap = 0;
                while ($row_tk_bill = mysqli_fetch_array($query_tk_bill)) {
                    $tong_thu_nhap += $row_tk_bill['tong_tien'];
        ?>   
            <form action="" method="POST">
                <tr>
                    <th scope="row"><?php echo $row_tk_bill['ma_hd']; ?></th>
                    <td><?php echo $row_tk_bill['ho_ten']; ?></td>
                    <td><?php echo $row_tk_bill['ngay_dat']; ?></td>
                    <td><?php echo number_format($row_tk_bill['tong_tien']); ?> VNĐ</td>
                    <td>                
                        <input type="hidden" name="ma_hoadon" value="<?php echo $row_tk_bill['ma_hd']; ?>"/>
                        <?php
                            if($row_tk_bill['trang_thai'] != 3) {
                        ?>
                        <div class="form-group">
                            <select class="form-control" id="" name="trang_thai">                 
                            <option <?php if($row_tk_bill['trang_thai'] == 0) {echo 'selected';} ?> value="0">Chờ xử lý</option>
                            <option <?php if($row_tk_bill['trang_thai'] == 1) {echo 'selected';} ?> value="1">Đang chuẩn bị hàng</option>
                            <option <?php if($row_tk_bill['trang_thai'] == 2) {echo 'selected';} ?> value="2">Đang giao hàng</option>
                            <option <?php if($row_tk_bill['trang_thai'] == 4) {echo 'selected';} ?> value="4">Chờ hủy đơn</option>
                            <option <?php if($row_tk_bill['trang_thai'] == 5) {echo 'selected';} ?> value="5">Chấp nhận hủy đơn</option>
                        </select>
                      </div>
                        <?php
                            } else {
                        ?>
                            <p class="text-primary font-weight-bold">Giao hàng thành công!</p>
                        <?php
                            }
                        ?>
                    </td>
                    <?php
                        if($row_tk_bill['thanh_toan'] == 1) {
                    ?>
                        <td>Thanh toán tại nhà!</td>
                    <?php
                        } else {
                    ?>
                        <td>Thanh toán online!</td>
                    <?php
                        }
                    ?>
                    <td class="text-center">  
                        <?php
                            if($row_tk_bill['trang_thai'] != 3) {
                        ?>
                        <button type="submit" name="cap_nhat" class="btn btn-success">Cập nhật</button>
                        <?php
                            }
                        ?>
                        <a href="?page_layout=bill-details&ma_hd=<?php echo $row_tk_bill['ma_hd']; ?>" class="btn btn-primary">Chi tiết</a>
                        <a data-confirm="Bạn có chắc chắn muốn xóa hóa đơn này không?"
                       href="?page_layout=delete-bill&ma_hd=<?php echo $row_tk_bill['ma_hd']; ?>" class="btn btn-danger delete">Xóa</a>
                    </td>
                </tr>                
            </form>
        <?php
                }
            echo '<h4 class="h4">Tổng thu nhập: <span class="text-danger"Tổng thu nhập>'.number_format($tong_thu_nhap).' VNĐ</span></h4>'; 
            }
            else {
                while($row = mysqli_fetch_array($query)) {
        ?>
        <form action="" method="POST">
            <tr>
                <th scope="row"><?php echo $row['ma_hd']; ?></th>
                <td><?php echo $row['ho_ten']; ?></td>
                <td><?php echo $row['ngay_dat']; ?></td>
                <td><?php echo number_format($row['tong_tien']); ?> VNĐ</td>
                <td>                
                    <input type="hidden" name="ma_hoadon" value="<?php echo $row['ma_hd']; ?>"/>
                    <?php
                        if($row['trang_thai'] != 3) {
                    ?>
                    <div class="form-group">
                        <select class="form-control" id="" name="trang_thai">                 
                        <option <?php if($row['trang_thai'] == 0) {echo 'selected';} ?> value="0">Chờ xử lý</option>
                        <option <?php if($row['trang_thai'] == 1) {echo 'selected';} ?> value="1">Đang chuẩn bị hàng</option>
                        <option <?php if($row['trang_thai'] == 2) {echo 'selected';} ?> value="2">Đang giao hàng</option>
                        <option <?php if($row['trang_thai'] == 4) {echo 'selected';} ?> value="4">Chờ hủy đơn</option>
                        <option <?php if($row['trang_thai'] == 5) {echo 'selected';} ?> value="5">Chấp nhận hủy đơn</option>
                    </select>
                  </div>
                    <?php
                        } else {
                    ?>
                        <p class="text-primary font-weight-bold">Giao hàng thành công!</p>
                    <?php
                        }
                    ?>
                </td>
                <?php
                    if($row['thanh_toan'] == 1) {
                ?>
                    <td>Thanh toán tại nhà!</td>
                <?php
                    } else {
                ?>
                    <td>Thanh toán online!</td>
                <?php
                    }
                ?>
                <td class="text-center">  
                    <?php
                        if($row['trang_thai'] != 3 && $row['trang_thai'] != 5) {
                    ?>
                    <button type="submit" name="cap_nhat" class="btn btn-success">Cập nhật</button>
                    <?php
                        }
                    ?>
                    <a href="?page_layout=bill-details&ma_hd=<?php echo $row['ma_hd']; ?>" class="btn btn-primary">Chi tiết</a>
                    <a data-confirm="Bạn có chắc chắn muốn xóa hóa đơn này không?"
                   href="?page_layout=delete-bill&ma_hd=<?php echo $row['ma_hd']; ?>" class="btn btn-danger delete">Xóa</a>
                </td>
            </tr>
        </form>
        <?php
                }
            }
        ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php
             echo $listPage;
        ?>
        <li class="page-item">
            <a class="page-link" href="" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>