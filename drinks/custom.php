<!DOCTYPE html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
</head>

<?php
  // Get name
  $liquor = isset($_GET['liquor']) ? $_GET['liquor'] : die();
  $restricted = isset($_GET['restricted']) ? 'true' : 'false';
  $urlLiquors = "";
  
  foreach($liquor as $item) {
      urlencode($item);
  }
  $urlLiquors = implode('&liquor[]=', $liquor);
  $url = 'http://localhost/bartending/api/cocktails/search.php?liquor[]='.urlencode($urlLiquors);
  
  if ($restricted === 'true') {
      $url = $url . ('&restricted=').urlencode($restricted);
  }
  
  $content = file_get_contents($url);
  $content_array = json_decode($content, true);
  
  foreach($content_array['data'] as $item) {
    echo '<br><br><img src="' . $item['picture_url'] . '"><br> ------------------ <br>
      <a href="recipe.php?name='.$item['name'].'">'.$item['name'].'</a><br>';
    
  }
?>
