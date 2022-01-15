<?php
    include_once '../database/class_data.php';
    $p = new database();
    $p->read_voucher("SELECT * FROM voucher ORDER BY id_voucher DESC");
?>

