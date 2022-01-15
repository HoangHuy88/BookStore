<?php
    $p = new database();
    if (isset($_GET['id'])) {
        $id_phanhoi = $_GET['id'];

        $link = $p->connect();
        $query = mysqli_query($link, "SELECT * FROM phan_hoi INNER JOIN khach_hang ON "
                . "phan_hoi.id_kh=khach_hang.id_kh INNER JOIN san_pham ON phan_hoi.id_sp=san_pham.id_sp "
                . "WHERE id_phanhoi='$id_phanhoi' ORDER BY id_phanhoi DESC");
        $row = mysqli_fetch_assoc($query);
    }
?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Khách hàng: <?php echo $row['ho_ten']; ?></h1>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Phản hồi</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Trả lời</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $row['ten_sp']; ?></td>
                <td width="26%">
                    <img src="../img/product/<?php echo $row['image']; ?>" alt="" width="100%" height="240" />
                </td>
                <td><?php echo $row['noi_dung']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <?php
                    if($row['tra_loi'] != '') {
                ?>
                    <td><?php echo $row['tra_loi']; ?></td>
                <?php
                    } else {
                ?> 
                    <td><p class="text-danger">Chưa trả lời</p></td>
                <?php
                    }
                ?>
            </tr> 
        </tbody>
    </table>
    <?php
        if(isset($_POST['traloi_btn'])) {
            $tra_loi = $_POST['tra_loi'];
            
            if($tra_loi == '') {
                $error = '<p class="text-danger">Bạn chưa nhập câu trả lời!</p>';
            }
            
            if(empty($error) == true) {
                if($p->themxoasua("UPDATE phan_hoi SET tra_loi='$tra_loi' WHERE id_phanhoi='$id_phanhoi'") == 1) {
                    echo '<p class="text-primary">Gửi câu trả lời thành công!</p>';
                } else {
                    echo '<p class="text-danger">Gửi câu trả lời không thành công!</p>';
                }
            }
        }
    ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Nội dung trả lời</label>
            <textarea class="form-control" name="tra_loi" id="" rows="4" name="tra_loi">
                <?php
                    if($row['tra_loi'] != '') {
                        echo $row['tra_loi'];
                    }
                ?>
            </textarea>
            <?php
                echo isset($error) ? $error : '';
            ?>
        </div>
        <button type="submit" name="traloi_btn" class="btn btn-primary mb-4">Trả lời</button>
    </form>
</div>