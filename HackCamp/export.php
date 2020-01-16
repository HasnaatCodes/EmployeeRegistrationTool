<?php
require_once 'Models/UserDataSet.php';
session_start();
$view = new stdClass();
$view->pageTitle = 'Export';
$userDataSet = new UserDataSet();


if(isset($_SESSION['login'])){
    $view->employees = $userDataSet->fetchEmployees();
}

if(isset($_POST["Export"])){

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Joining Date'));
    $query = "SELECT hoursworked.projectID, name, SUM(TIMESTAMPDIFF(MINUTE,start_time, end_time)) As TotalHours
FROM hoursworked, project
where project.projectID = hoursworked.projectID AND employeeID = 3
group by projectID;";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}

require_once('Views/export.phtml');
