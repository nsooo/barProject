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
  $genre = new Drink($db);
  
  // Get ID
  $genre->alcohol = isset($_GET['name']) ? $_GET['name'] : die();
  
  // Get single genre
  $genre->read_single();
  
  // Create array
  $genre_arr = array(
    'id' => $genre->id,
    'alcohol' => $genre->alcohol
  );
  
  // Make JSON
  print_r(json_encode($genre_arr));
  

?>