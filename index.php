<?php

require_once __dir__."/Object.php";
require_once __dir__."/ObjectHandler.php";

$insertVals = array(
  new Object(null, "an object"),
  new Object(null, "another object"),
  new Object(null, "some object")
  );

$oHandler = new ObjectHandler();
$oHandler->recordObjects($insertVals);