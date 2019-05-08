<?php
  class Genre {
    //DB Stuff
    private $conn;
    private $table = 'genres';
    
    // Genre properties
    public $id;
    public $alcohol;
    
    // Construct with DB
    public function __construct($db) {
      $this->conn = $db;
    }
  
    // Get Genres
    public function read() {
      // Create query
      $query = 'SELECT
          id,
          alcohol
        FROM
          ' . $this->table;
    
      // Prepare Statement
      $stmt = $this->conn->prepare($query);
    
      // Execute query
      $stmt->execute();
    
      return $stmt;
    }
    
    // Get Genre
    public function read_single() {
      // Create query
      $query = 'SELECT
          id,
          alcohol
        FROM
          ' . $this->table . '
        WHERE
          alcohol = ?
        LIMIT 0,1';
      
      // Prepare Statement
      $stmt = $this->conn->prepare($query);
      
      // Bind ID
      $stmt->bindParam(1, $this->alcohol);
      
      // Execute query
      $stmt->execute();
      
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
      // Set properties
      $this->id = $row['id'];
      $this->alcohol = $row['alcohol'];
    }
    
    // Create genre
    public function create() {
      // Create query
      $query = 'INSERT INTO ' . $this->table . '
      SET
        alcohol = :alcohol';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      // Clean data
      $this->alcohol = htmlspecialchars(strip_tags($this->alcohol));
      
      // Bind data
      $stmt->bindParam(':alcohol', $this->alcohol);
      
      // Execute query
      if($stmt->execute()){
        return true;
      }
        // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
        return false;
    }
  }
  
?>