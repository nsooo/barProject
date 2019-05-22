<!DOCTYPE html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
</head>

<?php
  // Get name
  $cocktailName = isset($_GET['name']) ? $_GET['name'] : die();
  
  $url = 'http://localhost/bartending/api/cocktails/read_single.php?name='.urlencode($cocktailName);
  //$url = 'http://watsaq.se/api/cocktails/read_single.php?name='.$cocktailName;
  
  $content = file_get_contents(htmlentities($url));
  $content_array = json_decode($content, true);
  
  $alcohol_list = explode(",", $content_array['alcohol'][0]);
  $amount_cl = explode(",", $content_array['amount'][0]);?>
  <div class="specificDrinkContainer">
        <?php
        echo '<img class="specificDrinkImg" src="' . $content_array['picture_url'] . '">';
        ?>
    <div class="specificDrinkContainerIngredients">
      <?php
      echo '<h1> '.$content_array['name'] . '</h1><hr>';
      echo '<div class="ingredients">';
        echo '<p>';
        foreach(array_combine($alcohol_list, $amount_cl) as $alcohol_item => $amount_cl_single) {
          echo '<div class="liquorType">' . $alcohol_item . ':</div>';
          echo '<div class="liquorAmount">'. $amount_cl_single . ' cl </div>';
        };
        echo '</p>';
        echo '</div>';
      ?>
    </div>
  </div>
  <div class="drinkHowTo">
    <!-- Text about how to make drink -->
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
  </div>
