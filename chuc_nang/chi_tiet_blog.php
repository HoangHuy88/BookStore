<?php
    $p = new data();
    $link = $p->connect();
    
    if(isset($_GET['slug_blog'])) {
        $slug_blog = $_GET['slug_blog'];
        //Cập nhật lượt xem
        $query_update = $p->themxoasua("UPDATE blog SET luot_xem=luot_xem+1 WHERE slug_blog='$slug_blog'");
        
        $query = mysqli_query($link, "SELECT * FROM blog WHERE slug_blog='$slug_blog'");
        $row = mysqli_fetch_assoc($query);
    }
?>
<div class="container">
    <ul class="breadcrumb">
        <li><a href="../index.php">Trang chủ</a></li>
        <li>Blog</li>
        <li><?php echo $row['tieu_de']; ?></li>
    </ul>
</div>

<!-- Content -->
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="section-heading">
                <h3><?php echo $row['tieu_de']; ?></h3>
            </div>
            <div class="content_blog">
                <div class="content_blog-firt">
                    <p class="content_blog-firt-summary">
                        <?php echo $row['tom_tat']; ?>
                    </p>
                    <p class="content_blog-firt-content">
                        <?php echo $row['noi_dung']; ?>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="section-heading">
                <h3>Bài viết mới</h3>
                <?php
                    $query_newblog = mysqli_query($link, "SELECT * FROM blog ORDER BY id_blog DESC LIMIT 3");
                    while($row_newblog = mysqli_fetch_array($query_newblog)) {
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <img src="./img/blog/<?php echo $row_newblog['image']; ?>" alt="" class="img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <a href="?page=chi-tiet-blog&slug_blog=<?php echo $row_newblog['slug_blog']; ?>"><?php echo $row_newblog['tieu_de']; ?></a>
                    </div>
                </div> <br>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>