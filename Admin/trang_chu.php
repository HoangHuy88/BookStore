<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Trang chủ</h1>
</div>
<!-- Content Row -->
<?php
    $p = new database();
    $link = $p->connect();
    $voucher = mysqli_num_rows(mysqli_query($link, "SELECT * FROM voucher"));
    $blog = mysqli_num_rows(mysqli_query($link, "SELECT * FROM blog"));
    $product = mysqli_num_rows(mysqli_query($link, "SELECT * FROM san_pham"));
    $bill = mysqli_num_rows(mysqli_query($link, "SELECT * FROM hoa_don"));
?>
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Voucher</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $voucher; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Blog</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $blog; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-blogger fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sản phẩm
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php
                                        echo $product;
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Hóa đơn</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                echo $bill;
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice-dollar fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <h4 class="h5">Thống kê doanh thu: <span id="text-date"></span></h4>
    <div class="form-group">
        <select class="form-control select-date" id="">
            <option selected="">Thống kê</option>
            <option value="30ngay">30 ngày qua</option>
            <option value="90ngay">90 ngày qua</option>
            <option value="365ngay">365 ngày qua</option>
        </select>
  </div>
    <div id="chart" style="height:340px;">
        
    </div>
</div>
