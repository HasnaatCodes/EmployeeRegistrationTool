<?php

session_start();

require_once 'Models/Time.php';
require_once 'Models/UserDataSet.php';
$view = new stdClass();
$view->pageTitle = 'Time';
$timeData = new Time();
$userDataSet = new UserDataSet();


/**
 *
 * * Send the values from the form to the createUser function in userDataSet and create a new User
 */
if (isset($_POST['inserttime'])) {
    $employeeID = $_POST['employeeID'];
    $projectName = $_POST['projectName'];
    $start_time = $_POST['starttime'];
    $end_time = $_POST['endtime'];
    $timeData->insertTime($employeeID, $projectName, $start_time, $end_time);

}

$view->projects =$userDataSet ->fetchProjects();
require_once('Views/time.phtml');