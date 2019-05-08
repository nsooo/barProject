<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Genre.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate Genre object
  $genre = new Genre($db);
  
  // Genre query
  $result = $genre->read();
  
  // Get row count
  $num = $result->rowCount();
  
  if ($num > 0) {
    
    // Liquor array
    $genre_array = array();
    $genre_array['data'] = array();
    
    // We tell fetch how we want to fetch our information
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      
      $genre_item = array(
        'id' => $id,
        'alcohol' => $alcohol,
      );
      
      // Push info to "data"
      array_push($genre_array['data'], $genre_item);
    }
    
    // Turn to JSON & output
    //return json_encode($liquor_array);
    echo json_encode($genre_array);
    
  } else {
    echo json_encode(
      array('message' => 'No liquors found')
    );
  }

  
?>