<?php
    $p = new data();
?>

<div class="home-4-internal-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="section-heading">
                            <h3>Sản phẩm nổi bật</h3>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="features-curosel-home-4">
                        <?php
                            $p->read_sp_4("SELECT * FROM san_pham WHERE type=1 ORDER BY id_sp DESC LIMIT 6");
                        ?>
                    </div>						
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="section-heading">
                            <h3>Sản phẩm giảm giá</h3>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="features-curosel-home-4">
                        <?php
                            $p->read_sp_4("SELECT * FROM san_pham WHERE gia_km!='' ORDER BY id_sp DESC LIMIT 6");
                        ?>
                    </div>						
                </div>
            </div>
            <!-- home-4-right-sidebar start -->
            <div class="col-lg-3 col-md-3 col-sm-3">
                <!-- recent-post-right start -->
                <div class="recent-post-right">
                    <div class="home-4-right-sidebar-title">
                        <h3>Blogs</h3>
                    </div>
                    <div class="recent-post-curosel-home-4">
                        <?php
                            $p->blog_index("SELECT * FROM blog ORDER BY id_blog DESC LIMIT 3");
                        ?>  
                    </div>
                </div>

                <div class="logo-brand-right">
                    <div class="home-4-right-sidebar-title">
                        <h3>Đối tác liên kết</h3>
                    </div>
                    <div class="logo-right-curosel-home-4">
                        <div class="single-right-logo">								
                            <div class="brand-img">
                                <a href="#"><img src="img/brand/vnpost.png" alt="" /></a>
                            </div>								
                            <div class="brand-img">
                                <a href="#"><img src="img/brand/icon_giao_hang_nhanh.png" alt="" /></a>
                            </div>								
                        </div>
                        <div class="single-right-logo">															
                            <div class="brand-img">
                                <a href="#"><img src="img/brand/vnpay_logo.png" alt="" /></a>
                            </div>								
                            <div class="brand-img">
                                <a href="#"><img src="img/brand/ZaloPay.png" alt="" /></a>
                            </div>															
                        </div>	
                        <div class="single-right-logo">															
                            <div class="brand-img">
                                <a href="#"><img src="img/brand/ahamove_logo.png" alt="" /></a>
                            </div>								
                            <div class="brand-img">
                                <a href="#"><img src="img/brand/shopeepay.png" alt="" /></a>
                            </div>															
                        </div>						
                    </div>						
                </div>

                <div class="right-testimonial">
                    <div class="home-4-right-sidebar-title">
                        <h3>Khách hàng đánh giá</h3>
                    </div>
                    <div class="right-testimonial-curosel">	
                        <?php
                            $p->cmt_index("SELECT * FROM phan_hoi INNER JOIN khach_hang ON "
                                    . "phan_hoi.id_kh=khach_hang.id_kh ORDER BY id_phanhoi DESC LIMIT 3");
                        ?>											
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home-4-internal-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-heading">
                    <h3>Sản phẩm mới nhất</h3>
                </div>
            </div>
            <div class="clear"></div>
            <div class="row">
                <?php
                    $p->read_sp_3("SELECT * FROM san_pham ORDER BY id_sp DESC LIMIT 8");
                ?>
            </div>						
        </div>
    </div>
</div>