<?php
    include_once '../data/data.php';
    $p = new data();
    $link = $p->connect();

    if (isset($_POST['keywords']) != '') {
        $tk = $_POST['keywords'];
        $sql = "SELECT * FROM san_pham WHERE ten_sp LIKE '%".$tk."%'";
        $query = mysqli_query($link, $sql);

        if (mysqli_num_rows($query) > 0) {
            $output = '<ul class="" style="display:block; width:100%;">';
            
            while($row = mysqli_fetch_array($query)) {
                $ten_sp = $row['ten_sp'];
                
                $output .= '<li class="li_timkiem_ajax" style="padding:8px 8px; font-size: 14px;">'.$ten_sp.'</li>';
            }
            
            $output .= '</ul>';
            echo $output;
        }
    }
?>

