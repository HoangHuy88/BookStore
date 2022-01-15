<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sản phẩm</h1>
    <form autocomplete="off" class="d-none d-sm-inline-block form-inline mr-auto ml-md-4 my-2 my-md-0 mw-100 navbar-search" method="POST">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" id="key_search" name="key" placeholder="Tìm kiếm sản phẩm, tác giả" style="width: 260px;">
            <div class="input-group-append">
                <button type="submit" name="search" class="btn btn-dark">
                    <i class="fas fa-search fa-sm"></i> Tìm kiếm
                </button>
            </div>
        </div>
    </form>
    <a href="?page_layout=add-product" class="btn btn-dark">Thêm sản phẩm</a>
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
    
    $query = mysqli_query($link, "SELECT * FROM san_pham INNER JOIN category_sp "
            . "WHERE san_pham.id_danhmuc=category_sp.id_category ORDER BY id_sp DESC LIMIT $perRow, $rowPerPage");
    
    //Tính tổng số trang
    $totalRow = mysqli_num_rows(mysqli_query($link, "SELECT * FROM san_pham"));
    $totalPage = ceil($totalRow/$rowPerPage);
    
    $listPage = '';
    for($i = 1; $i <= $totalPage; $i++) {
        if($page == $i) {
            $listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>';
        } else {
            $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>';
        }
    }
?>  
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Danh mục</th>         
            <th scope="col">Tác giả</th>
            <th scope="col">Mã qrCode</th>
            <th scope="col">Giá sản phẩm</th>
            <th scope="col">Giá khuyến mại</th>
            <th scope="col">Quản lý</th>
        </tr>
    </thead>
    <tbody id="output_ajax">
        <?php
            if(isset($_POST['search'])) {
                $key = $_POST['key'];
                
                //Xử lý tìm kiếm
                $key_New = trim($key);
                $arr_key_New = explode(' ', $key_New);
                $key_New = implode('%', $arr_key_New);
                $key_New = '%'.$key_New.'%';
                
                $query_search = mysqli_query($link, "SELECT * FROM san_pham INNER JOIN category_sp ON san_pham.id_danhmuc=category_sp.id_category WHERE ten_sp LIKE ('$key_New') "
                    . "OR tac_gia LIKE ('$key_New') ORDER BY id_sp DESC");
                $i = 1;
                while ($row_search = mysqli_fetch_array($query_search)) {
                   $id_sp = $row_search['id_sp'];
        ?>
        <tr>
           <th scope="row"><?php echo $i++; ?></th>
           <td width="12%"><?php echo $row_search['ten_sp']; ?></td>
            <td width="14%">
                <img src="../img/product/<?php echo $row_search['image']; ?>" alt="" width="100%" height="120">
            </td>
            <td><?php echo $row_search['ten_danhmuc']; ?></td>
            <td><?php echo $row_search['tac_gia']; ?></td>
            <td width="14%">
                <img src="../img/qr_code/<?php echo $row_search['ma_qr']; ?>" alt="" width="100%" height="120">
            </td>
            <td><?php echo number_format($row_search['gia_sp']).' VNĐ'; ?></td>            
            <?php
                if($row_search['gia_km'] != '') {
            ?>
                <td class="text-primary"><?php echo number_format($row_search['gia_km']).' VNĐ'; ?></td>
            <?php
                } else {
            ?>
                <td><p class="text-danger">Không giảm giá</p></td>
            <?php
                }
            ?>
            <td class="text-center"> 
                <a href="?page_layout=update-product&id=<?php echo $id_sp; ?>" class="btn btn-primary">Cập nhật</a>
                <a data-confirm="Bạn có chắc chắn muốn xóa sản phẩm này không?"
                   href="?page_layout=delete-product&id=<?php echo $id_sp; ?>" class="btn btn-danger delete">Xóa</a>
            </td>
        </tr>
        <?php
                }
            }
            else {
                $stt = 1;
                while ($row = mysqli_fetch_array($query)) {
                    $id_sp = $row['id_sp'];
        ?>
        <tr>
           <th scope="row"><?php echo $stt++; ?></th>
           <td width="12%"><?php echo $row['ten_sp']; ?></td>
            <td width="14%">
                <img src="../img/product/<?php echo $row['image']; ?>" alt="" width="100%" height="120">
            </td>
            <td><?php echo $row['ten_danhmuc']; ?></td>
            <td><?php echo $row['tac_gia']; ?></td>
            <td width="14%">
                <img src="../img/qr_code/<?php echo $row['ma_qr']; ?>" alt="" width="100%" height="120">
            </td>
            <td><?php echo number_format($row['gia_sp']).' VNĐ'; ?></td>            
            <?php
                if($row['gia_km'] != '') {
            ?>
                <td class="text-primary"><?php echo number_format($row['gia_km']).' VNĐ'; ?></td>
            <?php
                } else {
            ?>
                <td><p class="text-danger">Không giảm giá</p></td>
            <?php
                }
            ?>
            <td class="text-center"> 
                <a href="?page_layout=update-product&id=<?php echo $id_sp; ?>" class="btn btn-primary">Cập nhật</a>
                <a data-confirm="Bạn có chắc chắn muốn xóa sản phẩm này không?"
                   href="?page_layout=delete-product&id=<?php echo $id_sp; ?>" class="btn btn-danger delete">Xóa</a>
            </td>
        </tr>
        <?php
                }
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