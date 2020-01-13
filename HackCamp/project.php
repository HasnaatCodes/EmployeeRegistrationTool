<?php

require_once 'Models/UserDataSet.php';
$view = new stdClass();
$view->pageTitle = 'project';
require_once('Views/project.phtml');


$userDataSet = new UserDataSet();

if(isset($_POST['addproject'])){
    $projectName = $_POST['projectname'];
    $userDataSet->addProject($f, $lastname, $email, $password);
}
