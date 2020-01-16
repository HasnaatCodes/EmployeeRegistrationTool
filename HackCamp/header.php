<?php

require_once 'Models/UserDataSet.php';
session_start();

$view = new stdClass();
$view->pageTitle = 'Sign Up';
$userDataSet = new UserDataSet();

$view->employees = $userDataSet->fetchEmployees();

/**
 *
 * * Send the values from the form to the createUser function in userDataSet and create a new User
 */

if(isset($_SESSION['login'])){
    $view->email = $_SESSION['login']->getEmail();
}


require_once('Views/template/newheader.phtml');
