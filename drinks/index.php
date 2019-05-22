<!DOCTYPE html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
</head>

<?php
  $url = 'http://localhost/bartending/api/cocktails/read.php';
  //$url = 'http://watsaq.se/api/cocktails/read.php';
  
  echo '<div class="drinkContainer">';
  $content = file_get_contents($url);
  $content_array = json_decode($content, true);
  foreach($content_array['data'] as $item){
    $alcohol_list = explode(",", $item['alcohol'][0]);
    $amount_cl = explode(",", $item['amount'][0]);
    echo '<br><br><img src="' . $item['picture_url'] . '"><br> ------------------ <br>
      <a href="recipe.php?name='.$item['name'].'">'.$item['name'].'</a><br>';
    foreach(array_combine($alcohol_list, $amount_cl) as $alcohol_item => $amount_cl_single) {
      echo $alcohol_item . ': ' . $amount_cl_single . ' cl <br>';
    }
  };
  echo '</div>';
?>
