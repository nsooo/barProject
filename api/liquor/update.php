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
  include_once '../../models/Liquor.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate liquor object
  $liquor = new Liquor($db);
  
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  
  $liquor->id = $data->id;
  $liquor->name = $data->name;
  $liquor->type = $data->type;
  
  // Update liquor
  // TODO: Check if it exists in db.
  if ($liquor->update()) {
    echo json_encode(
      array('message' => 'Liquor Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Liquor Not Updated')
    );
  }
?>