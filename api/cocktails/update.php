<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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
  $drink->name = $data->name;
  $drink->picture_url = $data->picture_url;
  
  // Update liquor
  // TODO: Check if it exists in db.
  if ($drink->update()) {
    echo json_encode(
      array('message' => 'Drink Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Drink Not Updated')
    );
  }
?>