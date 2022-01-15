<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Slide</h1>
    <a href="?page_layout=add-slide" class="btn btn-dark">Thêm slide</a>
</div>

<!-- Content Row -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Trạng thái</th>
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
    
            $p->read_slide("SELECT * FROM slide ORDER BY id_slide DESC LIMIT $perRow, $rowPerPage");
            
            //Tính tổng số trang
            $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM slide"));
            $totalPage = ceil($totalRow/$rowPerPage);

            $listPage = '';
            for($i = 1; $i <= $totalPage; $i++) {
                if($page == $i) {
                    $listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=slide&page='.$i.'">'.$i.'</a></li>';
                } else {
                    $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=slide&page='.$i.'">'.$i.'</a></li>';
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