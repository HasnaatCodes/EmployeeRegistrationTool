<?php

//session_start();

require_once 'Models/UserDataSet.php';
$view = new stdClass();
$view->pageTitle = 'Register';
$userDataSet = new UserDataSet();


/**
 *
 * * Send the values from the form to the createUser function in userDataSet and create a new User
 */
if(isset($_POST['signup'])){
    $firstname      = $_POST['firstname'];
    $lastname       = $_POST['lastname'];
    $email          = $_POST['email'];
    $password       = $_POST['password'];
    $userDataSet->createUser($firstname, $lastname, $email, $password);

}
require_once('Views/register.phtml');