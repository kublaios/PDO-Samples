<?php

require_once __dir__."/Object.php";
require_once __dir__."/ObjectHandler.php";

$insertVals = array(
  new Object(4, "updated"),
  new Object(5, "updated"),
  new Object(6, "updated")
  );

$oHandler = new ObjectHandler();
$oHandler->updateAllObjects($insertVals);