<?php
    include_once '../database/class_data.php';
    $p = new database();
    $p->read_slide("SELECT * FROM slide ORDER BY id_slide DESC");
?>

