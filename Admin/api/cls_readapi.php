<?php
class read_api {

    function read_json($url) {
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        $results = json_decode($response);
        return $results;
    }    
    
    function readapi_slide($url) {
        $results = $this->read_json($url);
        $stt = 1;
        
        if($results > 0) {
            foreach ($results as $data) {
            if($data->active == 1) {
               $ac = '<p class="text-primary">Kích hoạt</p>';
            } else {
               $ac = '<p class="text-danger">Chưa kích hoạt</p>';
            }
        
            echo '<tr>
                    <th scope="row">'.$stt++.'</th>
                    <td width="50%">
                        <img src="../img/slider/'.$data->image.'" alt="" width="80%" height="180" />
                    </td>
                    <td>'.$ac.'</td>
                    <td>
                        <a href="?page_layout=update-slide&id='.$data->id_slide.'" class="btn btn-primary">Cập nhật</a>
                        <a data-confirm="Bạn có chắc chắn muốn xóa slide này không?" href="?page_layout=delete-slide&id='.$data->id_slide.'" class="btn btn-danger delete">Xóa</a>
                    </td>
                </tr>';
            }
        } else {
            echo '<p class="text-danger">Slide chưa được cập nhật!</p>';
        }
    }
    
    function readapi_voucher($url) {
        $results = $this->read_json($url);
        $stt = 1;
        $date = date("d-m-Y");
        if($results > 0) {
            foreach ($results as $data) {
                if(strtotime($date) > strtotime($data->ngay_kt)) {
                    $nkt = $data->ngay_kt."<p class='text-danger'> (Đã hết hạn)</p>";                   
                } else {
                    $nkt = $data->ngay_kt;
                }
            echo '<tr>
                    <th scope="row">'.$stt++.'</th>
                    <td width="20%">
                        <img src="../img/voucher/'.$data->image.'" alt="" width="80%" height="80" />
                    </td>
                    <td>'.$data->tieu_de.'</td>
                    <td>'.mb_substr($data->mo_ta, 0, 80).'</td>
                    <td>'.$data->diem.'</td>
                    <td>'.$data->ma_voucher.'</td>
                    <td>'.$data->ngay_bd.'</td>
                    <td>'.$nkt.'</td>
                    <td class="text-center">
                        <a href="?page_layout=update-voucher&id='.$data->id_voucher.'" class="btn btn-primary">Cập nhật</a>
                        <a data-confirm="Bạn có chắc chắn muốn xóa voucher này không?" href="?page_layout=delete-voucher&id='.$data->id_voucher.'" class="btn btn-danger delete">Xóa</a>
                    </td>
                </tr>';
            }
        } else {
            echo '<p class="text-danger">Slide chưa được cập nhật!</p>';
        }
    }
    
    function readapi_cateblog($url) {
        $results = $this->read_json($url);
        $stt = 1;
        
        if($results > 0) {
            foreach ($results as $data) {
 
            echo '<tr>
                    <th scope="row">'.$stt++.'</th>
                    <td>'.$data->ten_danhmuc.'</td>
                    <td>'.$data->slug_danhmuc.'</td>
                    <td>'.$data->ngay_tao.'</td>
                    <td>
                        <a href="?page_layout=update-category-blog&id='.$data->id_cate.'" class="btn btn-primary">Cập nhật</a>
                        <a data-confirm="Bạn có chắc chắn muốn xóa danh mục blog này không?" href="?page_layout=delete-category-blog&id='.$data->id_cate.'" class="btn btn-danger delete">Xóa</a>
                    </td>
                </tr>';
            }
        } else {
            echo '<p class="text-danger">Slide chưa được cập nhật!</p>';
        }
    }
    
    function readapi_catesp($url) {
        $results = $this->read_json($url);
        $stt = 1;
        
        if($results > 0) {
            foreach ($results as $data) {
 
            echo '<tr>
                    <th scope="row">'.$stt++.'</th>
                    <td>'.$data->ten_danhmuc.'</td>
                    <td>'.$data->slug_danhmuc.'</td>
                    <td>'.$data->ngay_tao.'</td>
                    <td>
                        <a href="?page_layout=update-category-product&id='.$data->id_category.'" class="btn btn-primary">Cập nhật</a>
                        <a data-confirm="Bạn có chắc chắn muốn xóa danh mục sản phẩm này không?" href="?page_layout=delete-category-product&id='.$data->id_category.'" class="btn btn-danger delete">Xóa</a>
                    </td>
                </tr>';
            }
        } else {
            echo '<p class="text-danger">Danh mục sản phẩm chưa được cập nhật!</p>';
        }
    }
}
?>

