<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Voucher</h1>
    <a href="?page_layout=add-voucher" class="btn btn-dark">Thêm voucher</a>
</div>

<!-- Content Row -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Tiêu đề</th>
            <th scope="col">Nội dung</th>
            <th scope="col">Điểm</th>
            <th scope="col">Mã</th>
            <th scope="col" class="text-center">Ngày bắt đầu</th>
            <th scope="col" class="text-center">Ngày hết hạn</th>
            <th scope="col">Quản lý</th>
        </tr>
    </thead>
    <tbody>
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
            
            $p->read_voucher("SELECT * FROM voucher ORDER BY id_voucher DESC LIMIT $perRow, $rowPerPage");
            
            //Tính tổng số trang
            $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM slide"));
            $totalPage = ceil($totalRow/$rowPerPage);

            $listPage = '';
            for($i = 1; $i <= $totalPage; $i++) {
                if($page == $i) {
                    $listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=voucher&page='.$i.'">'.$i.'</a></li>';
                } else {
                    $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=voucher&page='.$i.'">'.$i.'</a></li>';
                }
            }
        ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php
            echo $listPage;
        ?>
    </ul>
</nav>