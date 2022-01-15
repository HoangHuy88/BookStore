<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Phản hồi khách hàng</h1>
</div>

<?php
    $p = new database();
    $link = $p->connect();
    
     //Phân trang
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    $rowPerPage = 3;
    $perRow = $page*$rowPerPage - $rowPerPage;
    
    $query = mysqli_query($link, "SELECT * FROM phan_hoi INNER JOIN khach_hang ON "
            . "phan_hoi.id_kh=khach_hang.id_kh INNER JOIN san_pham ON phan_hoi.id_sp=san_pham.id_sp "
            . "ORDER BY id_phanhoi DESC LIMIT $perRow, $rowPerPage");
    
    //Tính tổng số trang
    $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM phan_hoi"));
    $totalPage = ceil($totalRow/$rowPerPage);
    
    $listPage = '';
    for($i = 1; $i <= $totalPage; $i++) {
        if($page == $i) {
            $listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=phan-hoi-khach-hang&page='.$i.'">'.$i.'</a></li>';
        } else {
            $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=phan-hoi-khach-hang&page='.$i.'">'.$i.'</a></li>';
        }
    }
?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Sản phẩm</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Nội dung phản hồi</th>           
            <th scope="col">Thời gian</th>
            <th scope="col">Trả lời</th>
            <th scope="col">Quản lý</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $stt = 1;
            while ($row = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <th scope="row"><?php echo $stt++; ?></th>
            <td><?php echo $row['ho_ten']; ?></td>
            <td><?php echo $row['ten_sp']; ?></td>
            <td width="16%">
                <img src="../img/product/<?php echo $row['image']; ?>" alt="" width="100%" height="160">
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
                <td class="text-danger">Chưa trả lời!</td>
            <?php
                }
            ?>
                <td class="text-center">
                <a href="?page_layout=tra-loi&id=<?php echo $row['id_phanhoi']; ?>" class="btn btn-primary">Trả lời</a>
                <a data-confirm="Bạn có chắc chắn muốn xóa phản hồi này không?" 
                   href="?page_layout=delete-tra-loi&id=<?php echo $row['id_phanhoi']; ?>" class="btn btn-danger delete">Xóa</a>
            </td>
        </tr>  
        <?php
            }
        ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php
            echo $listPage;
        ?>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>