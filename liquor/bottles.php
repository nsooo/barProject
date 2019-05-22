<?php

  // Get name
  $alcoholType = isset($_GET['type']) ? $_GET['type'] : die();
  
  $url = 'http://localhost/bartending/api/liquor/read_type.php?type='. urlencode($alcoholType);
  //$url = 'http://watsaq.se/api/liquor/read_type.php?name="'.$alcoholType.'"';
  
  $content = file_get_contents(htmlentities($url));
  $content_array = json_decode($content, true);
  
  echo '<h1> These are different ' . $content_array['data'][0]['type'] . ' bottles</h1><br>';
  foreach($content_array['data'] as $item){
    echo $item['name'] .'<br>';
  }
?>
