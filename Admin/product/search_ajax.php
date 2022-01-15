<?php
    include_once '../database/class_data.php';
    
    $p = new database();
    $link = $p->connect();
    
    if(isset($_POST['key_search']) != '') {
        $key_name = $_POST['key_search'];
        
        $sql = "SELECT * FROM san_pham INNER JOIN category_sp ON san_pham.id_danhmuc=category_sp.id_category WHERE ten_sp LIKE '%".$key_name."%'";
        $query = mysqli_query($link, $sql);
        $i = 1;
        if(mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {
                $id_sp = $row['id_sp'];
                $ten_sp = $row['ten_sp'];
                $image = $row['image'];
                $ten_cate = $row['ten_danhmuc'];
                $tac_gia = $row['tac_gia'];
                $ma_qr = $row['ma_qr'];
                $gia_sp = number_format($row['gia_sp']).' VNĐ';
                if($row['gia_km'] != '') {
                    $gia_km = number_format($row['gia_km']).' VNĐ';
                } else {
                    $gia_km = 'Không giảm giá';
                }
                
                echo '<tr>
                    <th scope="row">'.$i++.'</th>
                    <td width="12%">'.$ten_sp.'</td>
                     <td width="14%">
                         <img src="../img/product/'.$image.'" alt="" width="100%" height="120">
                     </td>
                     <td>'.$ten_cate.'</td>
                     <td>'.$tac_gia.'</td>
                     <td width="14%">
                         <img src="../img/qr_code/'.$ma_qr.'" alt="" width="100%" height="120">
                     </td>
                     <td>'.$gia_sp.'</td>         
                     <td>'.$gia_km.'</td>     
                     <td class="text-center"> 
                         <a href="?page_layout=update-product&id='.$id_sp.'" class="btn btn-primary">Cập nhật</a>
                         <a data-confirm="Bạn có chắc chắn muốn xóa sản phẩm này không?"
                            href="?page_layout=delete-product&id='.$id_sp.'" class="btn btn-danger delete">Xóa</a>
                     </td>
                 </tr>';
            }
        }
    }
?>

