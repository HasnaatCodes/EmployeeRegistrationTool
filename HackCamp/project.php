<?php
require_once 'Models/UserDataSet.php';
session_start();
$view = new stdClass();
$view->pageTitle = 'project';



$userDataSet = new UserDataSet();
$view->projects =$userDataSet ->fetchProjects();

//admin has a unique email
if(isset($_SESSION['login'])){
    $view->email = $_SESSION['login']->getEmail();
}



if(isset($_POST['addProject'])){
    $projectName = $_POST['projectname'];
    $userDataSet->addProject($projectName);
}

if(isset($_POST['assignProject'])){
    $projectID = $_POST['projectID'];
    $user = $_SESSION['login'];
    $employeeID = $user->getUserID();
    $userDataSet->assignProject($projectID, $employeeID);
}

require_once('Views/project.phtml');
