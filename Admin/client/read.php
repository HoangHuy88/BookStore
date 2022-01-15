<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Khách hàng</h1>
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
    
    $rowPerPage = 4;
    $perRow = $page*$rowPerPage - $rowPerPage;
    
    $query = mysqli_query($link, "SELECT * FROM khach_hang ORDER BY id_kh DESC LIMIT $perRow, $rowPerPage");
    
    $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM khach_hang"));
    $totalPage = ceil($totalRow / $rowPerPage);

    $listPage = '';
    for ($i = 1; $i <= $totalPage; $i++) {
        if ($page == $i) {
            $listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=client&page=' . $i . '">' . $i . '</a></li>';
        } else {
            $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=client&page=' . $i . '">' . $i . '</a></li>';
        }
    }
?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Điểm</th>
            <th scope="col">Hủy đơn</th>
            <th scope="col">Quản lý</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $stt = 1;
            while($row = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <th scope="row"><?php echo$stt++; ?></th>
            <td><?php echo $row['ho_ten']; ?></td>
            <td><?php echo $row['dia_chi']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['diem_voucher']; ?></td>
            <td><?php echo $row['huy_don']; ?></td>
            <td>
                <a data-confirm="Bạn có chắc chắn muốn xóa khách hàng này không?" 
                   href="?page_layout=delete-client&id=<?php echo $row['id_kh']; ?>" class="btn btn-danger delete">Xóa</a>
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