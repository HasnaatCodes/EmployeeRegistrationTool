<?php

$view = new stdClass();
$view->pageTitle = 'Page1';
require_once('Views/page1.phtml');

//echo $changedDate = date("Y-m-d H:i:s", strtotime($_POST["testdate"]));