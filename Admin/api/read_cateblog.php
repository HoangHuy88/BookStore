<?php
    include_once '../database/class_data.php';
    $p = new database();
    $p->read_cateblog("SELECT * FROM category_blog ORDER BY id_cate DESC");
?>

