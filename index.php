<?php

require_once __dir__."/Object.php";

$object = new Object();
$object->name = "Hello PDO";
if ($object->recordObject()) {
  echo "New record with ID: ".$object->id;
} else {
  echo "Could not record";
}