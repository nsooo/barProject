<?php
  class Liquor
  {
    //DB Stuff
    private $conn;
    private $table = 'liquor';
  
    // Liquor properties
    public $id;
    public $type;
    public $name;
  
    // Construct with DB
    public function __construct($db)
    {
      $this->conn = $db;
    }
  
    // Get Liquors
    public function read()
    {
      // Create query
      $query = 'SELECT
          l.id,
          name,
          g.alcohol as type
        FROM
          ' . $this->table . ' l
        LEFT JOIN
          genres g ON type = g.id
        ORDER BY
          type';
    
      // Prepare Statement
      $stmt = $this->conn->prepare($query);
    
      // Execute query
      $stmt->execute();
    
      return $stmt;
    }
  
  
    // Get Liquors
    public function read_single()
    {
      // Create query
      $query = 'SELECT
          l.id,
          l.name,
          g.alcohol as type
        FROM
          ' . $this->table . ' l
        LEFT JOIN
          genres g ON type = g.id
        WHERE
          name = ?
        LIMIT 0,1';
    
      // Prepare Statement
      $stmt = $this->conn->prepare($query);
    
      // Bind name
      $stmt->bindParam(1, $this->name);
    
      // Execute query
      $stmt->execute();
    
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
      // Set properties
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->type = $row['type'];
    }
  
  
    // Create liquor
    public function create()
    {
      // Create query
      $query = 'INSERT INTO ' . $this->table . '
      SET
        name = :name,
        type = :type';
    
      // Prepare statement
      $stmt = $this->conn->prepare($query);
    
      // Clean data
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->type = (int)htmlspecialchars(strip_tags($this->type));
    
      // Bind data
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':type', $this->type);
    
      // Execute query
      if ($stmt->execute()) {
        return true;
      }
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
  
  
    // Update liquor
    public function update()
    {
      // Create query
      $query = 'UPDATE ' . $this->table . '
      SET
        name = :name,
        type = :type
      WHERE
        name = :name';
    
      // Prepare statement
      $stmt = $this->conn->prepare($query);
    
      // Clean data
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->type = htmlspecialchars(strip_tags($this->type));
    
      // Bind data
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':type', $this->type);
    
      // Execute query
      if ($stmt->execute()) {
        return true;
      }
    
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
  
  
    // Delete liquor
    public function delete()
    {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    
      //Prepare statement
      $stmt = $this->conn->prepare($query);
    
      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
    
      // Bind data
      $stmt->bindParam(':id', $this->id);
    
      // Execute query
      if ($stmt->execute()) {
        return true;
      }
    
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
  
  
    // Get Liquors
    public function read_type()
    {
      // Create query
      $query = 'SELECT
          l.id,
          l.name,
          g.alcohol as type
        FROM
          ' . $this->table . ' l
        LEFT JOIN
          genres g ON type = g.id
        WHERE
          g.alcohol = ?';
    
      // Prepare Statement
      $stmt = $this->conn->prepare($query);
    
      // Bind name
      $stmt->bindParam(1, $this->type);
    
      // Execute query
      $stmt->execute();
  
      return $stmt;
    }
  }

?>