<?php

require_once 'Models/UserDataSet.php';
$view = new stdClass();
$view->pageTitle = 'project';



$userDataSet = new UserDataSet();
$view->projects =$userDataSet ->fetchProjects();


if(isset($_POST['addproject'])){
    $projectName = $_POST['projectname'];
    $userDataSet->addProject($projectName);
}

require_once('Views/project.phtml');
