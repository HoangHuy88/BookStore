<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Danh mục sản phẩm</h1>
    <a href="?page_layout=add-category-product" class="btn btn-dark">Thêm danh mục</a>
</div>

<!-- Content Row -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Slug_danh mục</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Quản lý</th>
        </tr>
    </thead>
    <tbody>
        <?php      
            $p = new database();
            $p->read_catesp("SELECT * FROM category_sp ORDER BY id_category DESC");
        ?>
    </tbody>
</table>