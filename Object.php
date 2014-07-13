<?php

require_once __dir__."/Connection.php";

/**
 * Object Class
 * Simple object
 * 
 * @author Kubilay Erdogan <kublaios@gmail.com>
 * @copyright (c) 2014, Kubilay Erdogan
 */
class Object {
  // class variables
  public $db;
  public $id;
  public $name;

  public function __construct($id = 0, $name = "") {
    // create a new PDO connection instance
    $this->db = new Connection();
    $this->db = $this->db->dbConnect();
    // set variables
    $this->id = $id;
    $this->name = $name;
  }

  // Record function for object with properties set
  public function recordObject() {
    // create sql query
    $sql = "INSERT INTO `table` (`name`) VALUES (?) ";
    // prepare connection with the query
    $stmt = $this->db->prepare($sql);
    // bind parameters to query
    $stmt->bindParam(1, $this->name);
    // execute the statement
    if ($stmt->execute()) {
      // if statement has success, set self id to last insert id
      $this->id = $this->db->lastInsertId();
      return true;
    } else {
      return false;
    }
  }
}