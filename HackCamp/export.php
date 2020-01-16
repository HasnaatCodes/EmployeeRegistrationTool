<?php
require_once 'Models/UserDataSet.php';
session_start();
$view = new stdClass();
$view->pageTitle = 'Export';
$userDataSet = new UserDataSet();


//if(isset($_SESSION['login'])){
//    $view->employees = $userDataSet->fetchEmployees();
//}

if(isset($_POST["export"])){

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=data.csv');
//    $filename = 'uploads/'.strtotime("now").'.csv';
    $output = fopen("php://output", "w+");
//    $output = fopen($filename, "w+");
    $rows = $userDataSet->getEmployeeDetails($_POST['employee_ID']);
    fputcsv($output, array('employeeID', 'first name', 'last name'));
    foreach ($rows as $row){
        $arraySize = count($row)/2;
        $newRow = array();
        for($i=0; $i<$arraySize; $i++)
        {

            array_push($newRow, $row[$i]);
        }
        fputcsv($output, $newRow);
    }

    fputcsv($output, array('projectID', 'Project Name', 'Hours Worked'));
    $rows = $userDataSet->getAverageForProject($_POST['employee_ID']);


    foreach ($rows as $row){
        $arraySize = count($row)/2;
        $newRow = array();
        for($i=0; $i<$arraySize; $i++)
        {

            array_push($newRow, $row[$i]);
        }
        fputcsv($output, $newRow);
    }

    fclose($output);
    exit();
}

require_once('Views/export.phtml');
