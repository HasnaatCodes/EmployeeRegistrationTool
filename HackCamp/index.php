<?php

require_once 'Models/UserDataSet.php';
session_start();

$view = new stdClass();
$view->pageTitle = 'Homepage';
header("Location: login.php");
require_once('Views/index.phtml');
