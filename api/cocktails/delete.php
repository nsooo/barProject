<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE ');
  header('Access-Control-Allow-Headers:
    Access-Control-Allow-Headers,
    Content-Type,
    Access-Control-Allow-Methods,
    Authorization,
    X-Requested-With');
  
  include_once '../../config/Database.php';
  include_once '../../models/Drink.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate liquor object
  $drink = new Drink($db);
  
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  
  $drink->id = $data->id;
  
  // Delete post
  if ($drink->delete()) {
    echo json_encode(
      array('message' => 'Drink Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Drink Not Deleted')
    );
  }
?>