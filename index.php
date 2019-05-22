<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
  <nav>
      <ul>
          <li> <a href="#"><!--<img class="logo" src="img/logo.jpg" alt="no image">--> LOGO</a> </li>
          <li> <a href="drinks">Drinks</a> </li>
          <li> <a href="liquor">Booze</a> </li>
          <li> <a href="genres">Alcohol types</a> </li>
      </ul>
  </nav>
  
  <div class="searchTickBoxes">
  <?php
  $url = 'http://localhost/bartending/api/genres/read.php';
  //$url = 'http://watsaq.se/api/genres/read.php';

  $content = file_get_contents($url);
  $content_array = json_decode($content, true);
  
  echo '<form action="drinks/custom.php" method="GET">';
  foreach($content_array['data'] as $item){
    echo '<input type="checkbox" name="liquor[]" value="'.$item['alcohol'].'">'.$item['alcohol'].'<br>';
  }
  ?>
  <input type="checkbox" name="restricted" value="true" checked="checked">restricted search <br>
  <input type="submit" value="Submit">
  </form>
  </div>
</body>
</html>
