<?php
    include_once '../database/class_data.php';
    $p = new database();
    $p->read_catesp("SELECT * FROM category_sp ORDER BY id_category DESC");
?>