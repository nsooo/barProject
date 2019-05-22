<?php
  $url = 'http://localhost/bartending/api/liquor/read.php';
  //$url = 'http://watsaq.se/api/liquor/read.php';
  
  $content = file_get_contents($url);
  $content_array = json_decode($content, true);
  foreach($content_array['data'] as $item){
    echo $item['name'] . ", " . $item['type'] . '<br>';
    
  }

?>
