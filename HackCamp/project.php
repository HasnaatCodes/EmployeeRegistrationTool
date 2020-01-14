<?php
require_once 'Models/UserDataSet.php';
session_start();
$view = new stdClass();
$view->pageTitle = 'project';


$userDataSet = new UserDataSet();
$view->projects =$userDataSet ->fetchProjects();

$view->employees = $userDataSet->fetchEmployees();



//admin has a unique email
if(isset($_SESSION['login'])){
    $view->email = $_SESSION['login']->getEmail();
}


if(isset($_POST['addProject'])){
    $projectName = $_POST['projectname'];
    //check if project already exists
    if($userDataSet->checkIfProjectExists($projectName) == null){
        $userDataSet->addProject($projectName);
        $_SESSION['addedProject'] = 'You have successfully added a project';
    }
    else{
        $_SESSION['projectExists'] = 'The project already exists';
    }

}


//assign project to admin
if(isset($_POST['assignProject'])) {
    $projectID = $_POST['projectID'];
    $user = $_SESSION['login'];
    $employeeID = $user->getUserID();

    $userDataSet->assignProject($projectID, $employeeID);
    $_SESSION['assignProject'] = 'You have successfully assigned a project';
}
require_once('Views/project.phtml');
