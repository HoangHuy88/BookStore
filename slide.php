<!-- HOME SLIDER -->
<div class="slider-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                            $p = new data();
                            $p->read_slide("SELECT * FROM slide WHERE active=1 ORDER BY id_slide DESC");
                        ?>
                    </div>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>				
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="home-4-corporate">
                    <div class="single-corporate">
                        <div class="corporate-icon">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="corporate-text">
                            <h4>MIỄN PHÍ GIAO HÀNG & ĐỔI TRẢ</h4>
                            <p>Giao hàng miễn phí các đơn hàng từ 200.000 VNĐ</p>
                        </div>
                    </div>
                    <!-- single-corporate end -->
                    <!-- single-corporate start -->
                    <div class="single-corporate">
                        <div class="corporate-icon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <div class="corporate-text">
                            <h4>THANH TOÁN AN TOÀN</h4>
                            <p>100%  thông tin thanh toán được bảo mật.</p>
                        </div>
                    </div>
                    <div class="single-corporate">
                        <div class="corporate-icon">
                            <i class="fa fa-life-bouy"></i>
                        </div>
                        <div class="corporate-text">
                            <h4>HỖ TRỢ TRỰC TUYẾN 24/7</h4>
                            <p>98% tỉ lệ phản hồi tới khách hàng</p>
                        </div>
                    </div>
                </div>					
            </div>
        </div>
    </div>
</div>
<!-- HOME SLIDER END -->
<div class="promotion-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="single-promo">
                    <img src="img/slider/banner01.jpg" alt="" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="single-promo">
                    <img src="img/slider/banner02.jpg" alt="" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="single-promo">
                    <img src="img/slider/banner03.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>