<?php

require_once __dir__."/Object.php";
require_once __dir__."/ObjectHandler.php";

$object = new Object();
$object->id = 1;
$object->name = "Hello PDO";
if ($object->recordObject()) {
  echo "New record with ID: ".$object->id."<br /><br />";
} else {
  echo " -Could not record. "."<br /><br />";
}

$obj1 = new Object(2, "Inexistent object");
$obj2 = new Object(1, "Existent object");

$oHandler = new ObjectHandler();
$oHandler->recordTwoObjects(array($obj1, $obj2));