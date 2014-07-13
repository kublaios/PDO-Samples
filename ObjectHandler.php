<?php

require_once __dir__."/Connection.php";

/**
 * ObjectHandler Class
 * For batch operations on objects
 * 
 * @author Kubilay Erdogan <kublaios@gmail.com>
 * @copyright (c) 2014, Kubilay Erdogan
 */
class ObjectHandler {
  // class variables
  private $db;

  public function __construct() {
    $this->db = new Connection();
    $this->db = $this->db->dbConnect();
  }

  // Record first two objects of given Object array
  // This function rolls back in case any error occurs
  public function recordTwoObjects($objects = array()) {
    // Begin transaction to rollback in case
    $this->db->beginTransaction();
    // create first query
    $sql1 = "INSERT INTO `latest` (`id`, `name`) VALUES (?,?),(?,?) ";
    // prepare the statement for first query with params
    $stmt = $this->db->prepare($sql1);
    $stmt->bindParam(1, $objects[0]->id);
    $stmt->bindParam(2, $objects[0]->name);
    $stmt->bindParam(3, $objects[1]->id);
    $stmt->bindParam(4, $objects[1]->name);
    try {
      // this statement should work
      if ($stmt->execute()) {
        // create second query
        $sql2 = "INSERT INTO `table` (`id`, `name`) VALUES (?,?),(?,?) ";
        // reprapere the statement with second query
        $stmt = $this->db->prepare($sql2);
        $stmt->bindParam(1, $objects[0]->id);
        $stmt->bindParam(2, $objects[0]->name);
        $stmt->bindParam(3, $objects[1]->id);
        $stmt->bindParam(4, $objects[1]->name);
        // this statement should raise duplicate key error
        if ($stmt->execute()) {
          // if has success, commit transaction
          $this->db->commit();
          echo "New record ID: ".$this->db->lastInsertId();
        } else {
          // if fails, rollback transaction (auto-commits)
          $this->db->rollBack();
          echo "Could not insert";
        } 
      }
    } catch (PDOException $e) {
      // if fails, rollback transaction (auto-commits)
      $this->db->rollBack();
      echo "PDO error: ".$e->getMessage();
    } catch (Exception $e) {
      // if fails, rollback transaction (auto-commits)
      $this->db->rollBack();
      echo "Error: ".$e->getMessage();
    }
  }
}