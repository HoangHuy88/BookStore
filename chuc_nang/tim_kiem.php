<!-- Breadcrumb -->
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php">Trang chủ</a></li>
        <li>Tìm kiếm</li>
    </ul>
</div>

<?php
    //Lấy từ khóa
    if(isset($_POST['tu_khoa'])) {
        $tu_khoa = $_POST['tu_khoa'];
    
    //Xử lý tìm kiếm
    $tu_khoa_New = trim($tu_khoa);
    $arr_tu_khoa_New = explode(' ', $tu_khoa_New);
    $tu_khoa_New = implode('%', $arr_tu_khoa_New);
    $tu_khoa_New = '%'.$tu_khoa_New.'%';
?>
<div class="container">
    <div class="section-heading">
        <h3>Tìm kiếm với từ khóa: <span><?php echo $tu_khoa; ?></span></h3>
    </div>
    <div class="row container">
        <?php
            $p = new data();
            $p->read_sp_3("SELECT * FROM san_pham WHERE ten_sp LIKE ('$tu_khoa_New') "
                    . "OR tac_gia LIKE ('$tu_khoa_New') ORDER BY id_sp DESC LIMIT 8");
        ?>
    </div>
</div>
<?php
    }
?>