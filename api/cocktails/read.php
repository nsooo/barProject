<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Drink.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate Drink object
  $drink = new Drink($db);
  
  // Drink query
  $result = $drink->read();
  
  // Get row count
  $num = $result->rowCount();
  
  if ($num > 0) {
    
    // Drink array
    $drink_array = array();
    $drink_array['data'] = array();
    
    // We tell fetch how we want to fetch our information
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      
      $drink_item = array(
        //'id' => $id,
        'name' => $name,
        'picture_url' => $picture_url,
        'alcohol' => array($alcohol),
        'amount' => array($amount)
      );
      
      // Push info to "data"
      array_push($drink_array['data'], $drink_item);
    }
    
    // Turn to JSON & output
    //return json_encode($liquor_array);
    echo json_encode($drink_array);
    
  } else {
    echo json_encode(
      array('message' => 'No liquors found')
    );
  }


?>