<?php
  $url = 'http://localhost/bartending/api/cocktails/read.php';
  
  $content = file_get_contents($url);
  $content_array = json_decode($content, true);
  foreach($content_array['data'] as $item){
    $alcohol_list = explode(",", $item['alcohol'][0]);
    $amount_cl = explode(",", $item['amount'][0]);
    echo '<br><br><img src="' . $item['picture_url'] . '"><br> ------------------ <br>' . $item['name'] . '<br>';
    foreach(array_combine($alcohol_list, $amount_cl) as $alcohol_item => $amount_cl_single) {
      echo $alcohol_item . ': ' . $amount_cl_single . ' cl <br>';
    }
  };
  
?>