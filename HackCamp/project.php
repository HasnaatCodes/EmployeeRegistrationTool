<?php
require_once 'Models/UserDataSet.php';
session_start();
$view = new stdClass();
$view->pageTitle = 'project';
$userDataSet = new UserDataSet();


$view->employees = $userDataSet->fetchEmployees();

//admin has a unique email
if(isset($_SESSION['login'])){
    $view->email = $_SESSION['login']->getEmail();
}

//admin adds project, so it may be available to employees 
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


//assign project to user(employee)
if(isset($_POST['assignProject'])) {
    $projectID = $_POST['projectID'];
    $user = $_SESSION['login'];
    $employeeID = $user->getUserID();
    $userDataSet->assignProject($projectID, $employeeID);
    $_SESSION['assignProject'] = 'You have successfully assigned the project';

}
// fetch projects so they are available to select from dropdown box
if (isset($_SESSION['login'])){
    $view->projects = $userDataSet->fetchAvailableProjects($_SESSION['login']->getUserID());
}

require_once('Views/project.phtml');
