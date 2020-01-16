<?php

require_once 'Models/Time.php';
require_once 'Models/UserDataSet.php';
session_start();
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
// fetch projects so they are available to select from dropdown box
if(isset($_SESSION['login'])){
    $view->projects =$userDataSet->fetchAssignedProjects($_SESSION['login']->getUserID());
}
else{
    $view->projects =$userDataSet->fetchAllProjects();
}

require_once('Views/time.phtml');