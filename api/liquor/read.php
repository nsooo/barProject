<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Liquor.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate Liquor object
  $liquor = new Liquor($db);
  
  // Liquor query
  $result = $liquor->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any liquor
  if ($num > 0) {
    
    // Liquor array
    $liquor_array = array();
    $liquor_array['data'] = array();
    
    // We tell fetch how we want to fetch our information
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      
      $liquor_item = array(
        'id' => $id,
        'name' => $name,
        'type' => $type
      );
      
      // Push info to "data"
      array_push($liquor_array['data'], $liquor_item);
    }
    
    // Turn to JSON & output
    //return json_encode($liquor_array);
    echo json_encode($liquor_array);
    
  } else {
    echo json_encode(
      array('message' => 'No liquors found')
    );
  }
?>