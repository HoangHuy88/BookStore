<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    
    include './database/class_data.php';
    include ('./Carbon/autoload.php');
    
    if(isset($_POST['thoigian'])) {
        $thoigian = $_POST['thoigian'];
    } else {
        $thoigian = '';
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
    }
    
    if($thoigian == '30ngay') {
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
    } else if($thoigian == '90ngay') {
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
    } else if($thoigian == '365ngay') {
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    }
       
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
    
    $p = new database();
    $link = $p->connect();
    
    $query = mysqli_query($link, "SELECT ngay_dat, SUM(tong_tien) as total_money FROM hoa_don WHERE ngay_dat "
            . "BETWEEN '$subdays' AND '$now' GROUP BY ngay_dat ORDER BY ngay_dat ASC");
    
    while($row = mysqli_fetch_array($query)) {
        $total_money = $row['total_money'];
        
        $chart_data[] = array(
            'date' => $row['ngay_dat'],
            //'order' => $row['ma_hd'],
            'sales' => $total_money,
        );
    }
    echo $data = json_encode($chart_data);
?>