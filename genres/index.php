<?php
  //$url = 'http://localhost/bartending/api/genres/read.php';
  $url = 'http://watsaq.se/api/genres/read.php';
  
  $content = file_get_contents($url);
  $content_array = json_decode($content, true);
  foreach($content_array['data'] as $item){
    echo $item['alcohol'] . '<br>';
    
  }
?>
