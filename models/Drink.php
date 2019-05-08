<?php
  class Drink {
    //DB Stuff
    private $conn;
    private $table = 'cocktails';
    
    // Drink properties
    public $id;
    public $alcohol;
    
    // Construct with DB
    public function __construct($db) {
      $this->conn = $db;
    }
  
    // Get Drinks
    public function read() {
      // Create query
      $query = 'SELECT
        name,
        picture_url,
        GROUP_CONCAT(g.alcohol) as alcohol,
        GROUP_CONCAT(attr.amount) as amount
      FROM
        ' . $this->table . '
      LEFT JOIN
        cocktail_attributes attr
      ON
        cocktails.id = attr.cocktail_id
      LEFT JOIN
        genres g
      ON
        g.id = liquor_id
      GROUP BY
        cocktails.id';
        
      // Prepare Statement
      $stmt = $this->conn->prepare($query);
    
      // Execute query
      $stmt->execute();
    
      return $stmt;
    }
    
    
    // Get Drink
    public function read_single() {
      // Create query
      $query = 'SELECT
        name,
        picture_url,
        GROUP_CONCAT(g.alcohol) as alcohol,
        GROUP_CONCAT(attr.amount) as amount
      FROM
        ' . $this->table . '
      LEFT JOIN
        cocktail_attributes attr
      ON
        cocktails.id = attr.cocktail_id
      LEFT JOIN
        genres g
      ON
        g.id = liquor_id
      WHERE
          name = ?
      LIMIT 0,1';
      
      // Prepare Statement
      $stmt = $this->conn->prepare($query);
      
      // Bind ID
      $stmt->bindParam(1, $this->name);
      
      // Execute query
      $stmt->execute();
      
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
      // Set properties
      $this->name = $row['name'];
      $this->picture_url = $row['picture_url'];
      $this->alcohol = $row['alcohol'];
      $this->amount = $row['amount'];
      
    }
    
    // Create drink
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