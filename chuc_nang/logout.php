<?php
    session_start();
    
    if(isset($_SESSION['id_kh']) && isset($_SESSION['ho_ten']) && isset($_SESSION['email'])) {
        unset($_SESSION['id_kh']);
        unset($_SESSION['ho_ten']);
        unset($_SESSION['email']);
        unset($_SESSION['pass']);
        header('location: index.php');
    } else {
        header('location: index.php');
    }
?>
