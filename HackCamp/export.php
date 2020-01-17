<?php
require_once 'Models/UserDataSet.php';
session_start();
$view = new stdClass();
$view->pageTitle = 'Export';
$userDataSet = new UserDataSet();


//if(isset($_SESSION['login'])){
//    $view->employees = $userDataSet->fetchEmployees();
//}
if (isset($_SESSION['login'])){
    $view->email = $_SESSION['login']->getEmail();
}
if(isset($_POST["export"])){

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=report.csv');
    $output = fopen("php://output", "w+");
    $rows = $userDataSet->getEmployeeDetails($_POST['employee_ID']);
    foreach ($rows as $row){
        $arraySize = count($row)/2;
        $newRow = array();
        $employeeDetails = '';
        $employeeTemplate=array('ID: ', ' ', '');
        for($i=0; $i<$arraySize; $i++)
        {
            $employeeDetails .=  $employeeTemplate[$i] . $row[$i] . ' ' ;
//            array_push($newRow, $row[$i]);
        }
        $newRow = array($employeeDetails);
//        fputcsv($output, $newRow);
        fputcsv($output, $newRow);
    }

    fputcsv($output, array('Project Name','Date', 'Start Time', 'End Time', 'Hours Worked'));
    $rows = $userDataSet->getTimeReport($_POST['employee_ID']);


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
