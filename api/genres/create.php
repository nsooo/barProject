<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers:
    Access-Control-Allow-Headers,
    Content-Type,
    Access-Control-Allow-Methods,
    Authorization,
    X-Requested-With');
    
  include_once '../../config/Database.php';
  include_once '../../models/Genre.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate Genre object
  $genre = new Drinks($db);
  
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  
  $genre->alcohol = $data->alcohol;
  
  // Create genre
  // TODO: Check if it already exist in db.
  if ($genre->create()) {
    echo json_encode(
      array('message' => 'Genre Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Genre Not Created')
    );
  }
?>