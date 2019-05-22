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
  
  // Get name
  $liquor = isset($_GET['liquor']) ? $_GET['liquor'] : die();
  
  // Get restricted value
  $restricted = isset($_GET['restricted']) ? 'true' : 'false';
  
  // Drink query
  $result = $drink->search($liquor, $restricted);
  
  $num = $result->rowCount();
  
  if ($num > 0) {
    
    // Search array
    $search_array = array();
    $search_array['data'] = array();
  
    // We tell fetch how we want to fetch our information
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
    
      $search_item = array(
        //'id' => $id,
        'name' => $name,
        'picture_url' => $picture_url,
        'alcohol' => array($alcohol),
        //'amount' => array($amount)
      );
    
      // Push info to "data"
      array_push($search_array['data'], $search_item);
    }
  
    // Turn to JSON & output
    //return json_encode($liquor_array);
    echo json_encode($search_array);
  } else {
    echo json_encode(
      array('message' => 'No liquors found')
    );
  };


?>