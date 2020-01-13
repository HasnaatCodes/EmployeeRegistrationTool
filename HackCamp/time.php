<?php

session_start();

require_once 'Models/Time.php';
$view = new stdClass();
$view->pageTitle = 'Time';
$timeData = new Time();


/**
 *
 * * Send the values from the form to the createUser function in userDataSet and create a new User
 */
if (isset($_POST['inserttime'])) {
    $employeeID = $_POST['employeeID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $projectName = $_POST['projectName'];
    $start_time = $_POST['starttime'];
    $end_time = $_POST['endtime'];
    $timeData->insertTime($employeeID, $projectName, $start_time, $end_time);
//    $userDataSet->createUser($firstname, $lastname, $email, $password);

}
require_once('Views/time.phtml');