<?php   
    $p = new data();
    $link = $p->connect();
?>  

<div class="mainmenu-area">
    <div class="container">
        <div class="menu-container-bg">
            <div class="row">
                <div class="col-lg-12 col-md-12">					
                    <div class="mainmenu">
                        <nav>
                            <ul>
                                <li><a href="index.php">Trang chủ</a></li>
                                <li><a href="?page=gioi-thieu">Giới thiệu</a></li>
                                <li><a href="">Sản phẩm <span><i class="fa fa-caret-down"></i></span></a>
                                    <ul class="sub-menu">
                                        <?php
                                            $p->read_catesp("SELECT * FROM category_sp ORDER BY id_category ASC");
                                        ?>
                                    </ul>								
                                </li>
                                <li><a href="?page=voucher">Voucher</a></li>
                                <li><a href="">Blog <span><i class="fa fa-caret-down"></i></span></a>
                                    <ul class="sub-menu">
                                        <?php
                                            $p->read_cateblog("SELECT * FROM category_blog ORDER BY id_cate ASC");
                                        ?>
                                    </ul>								
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-search">						
                        <div class="top-category">
                            <ul>
                                <li><a href="">Tất cả danh mục</a>
                                    <ul>
                                        <?php
                                            $p->read_catesp("SELECT * FROM category_sp ORDER BY id_category ASC");
                                        ?>
                                    </ul>
                                </li>
                                <li class="search-top">
                                    <form autocomplete="off" action="index.php?page=tim-kiem" method="POST">
                                        <input type="text" name="tu_khoa" id="keywords" placeholder="Sản phẩm, tác giả..." />
                                        <div id="search_ajax">
                                            
                                        </div>
                                        <!--<button type="submit" name="tim_kiem"><i class="fa fa-search"></i></button>-->
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>	
            <!-- mobile menu start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="mobile-menu">
                        <nav>
                            <ul id="mobile-menu">
                                <li><a href="index.php">Trang chủ</a></li>
                                <li><a href="?page=gioi-thieu">Giới thiệu</a></li>
                                <li><a href="">Sản phẩm <span><i class="fa fa-caret-down"></i></span></a>
                                    <ul class="sub-menu">
                                        <?php
                                            $p->read_catesp("SELECT * FROM category_sp ORDER BY id_category ASC");
                                        ?>
                                    </ul>								
                                </li>
                                <li><a href="?page=voucher">Voucher</a></li>
                                <li><a href="">Blog <span><i class="fa fa-caret-down"></i></span></a>
                                    <ul class="sub-menu">
                                        <?php
                                            $p->read_cateblog("SELECT * FROM category_blog ORDER BY id_cate ASC");
                                        ?>
                                    </ul>								
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>			
        </div>
    </div>
</div>

