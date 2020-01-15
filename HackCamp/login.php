<?php
session_start();

require_once ('Models/UserDataSet.php');
require_once ('Models/UserData.php');

$view = new stdClass();
$view->pageTitle = 'Login';
$view->userValidation = true;
$userDataSet = new UserDataSet();

//$isUserLoggedIn = $_SESSION['userName'];


/**
 *
 * When the user presses the log in button
 * Send the values from the form to the chechLogIn function in userDataSet and verify their details
 */
if(isset($_POST['login'])){
    $email          = $_POST['email'];
    $password       = $_POST['password'];
    $view->userValidation = $userDataSet->checkLogIn($email, $password);
    if($view->userValidation == true) {
        $URL = "http://localhost:8000/login.php";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }

}


require_once('Views/login.phtml');