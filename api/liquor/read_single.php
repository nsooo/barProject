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
  
  // Get name
  $liquor->name = isset($_GET['name']) ? $_GET['name'] : die();
  
  // Get single liquor
  $liquor->read_single();
  

  $liquor_arr = array(
    'id' => $liquor->id,
    'name' => $liquor->name,
    'type' => $liquor->type
  );
  
  // Make JSON
  print_r(json_encode($liquor_arr));


?>