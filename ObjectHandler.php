<?php

require_once __dir__."/Connection.php";

// this function helps creating imploded strings with given seperator
function placeholders($text, $count = 0, $separator = ",") {
  $result = array();
  if ($count > 0) {
    for ($i = 0; $i < $count; $i++) {
      array_push($result, $text);
    }
  }
  return implode($separator, $result);
}

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

  // Record all objects of given Object array
  public function recordObjects($objects = array()) {
    // return true if there is no object
    if (count($objects) == 0) return true;
    // we are going to need question marks in the query
    $marks = array();
    // we also should store insert values to an array
    $values = array();
    foreach ($objects as $obj) {
      $objArray = array(
        "name" => $obj->name // db_field_name => object_property
        );
      // generate question marks string
      $markString = "(".placeholders("?", count($objArray)).")"; // output is array("(?)",...)
      // we store these strings to use in query later on
      array_push($marks, $markString);
      // we collect the values to be inserted
      $values = array_merge($values, array_values($objArray));
    }

    // create query with question marks
    $sql = "INSERT INTO `table` (`name`) VALUES ".implode(",", $marks);
    // prepare the statement with the query
    $stmt = $this->db->prepare($sql);
    
    try {
      // execute the statement by passing the insert values
      if ($stmt->execute($values)) {
        // marks array would give us the number of records correctly
        echo count($marks)." records have been added.";
      }
    } catch (PDOException $e) {
      echo "PDO error: ".$e->getMessage();
    } catch (Exception $e) {
      echo "Error: ".$e->getMessage();
    }
  }
}