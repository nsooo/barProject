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
  $drink->name = isset($_GET['name']) ? $_GET['name'] : die();
  
  // Get single liquor
  $drink->read_single();
  
  
  $drink_item = array(
    'name' => $drink->name,
    'picture_url' => $drink->picture_url,
    'alcohol' => array($drink->alcohol),
    'amount' => array($drink->amount)
  );
  
  // Make JSON
  print_r(json_encode($drink_item));


?>