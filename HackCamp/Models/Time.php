<?php

require_once('Models/Database.php');
require_once('Models/UserData.php');

class Time
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function insertTime($employeeID, $projectName, $start_time, $end_time) {

        $employeeID = htmlentities($employeeID);
        $projectName = htmlentities($projectName);

        $projectID = $this->getProjectID($projectName);
        $changedStartTime = date("Y-m-d H:i:s", strtotime($_POST["starttime"]));
        $changedEndTime = date("Y-m-d H:i:s", strtotime($_POST["endtime"]));

        $sqlQuery = 'INSERT INTO hoursworked (employeeID, projectID, start_time, end_time) VALUES('."\"$employeeID\"".', '."\"$projectID\"".', '."\"$changedStartTime\"".', '."\"$changedEndTime\"".')';
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        echo "Data submitted";

    }

    public function getProjectID($projectName) {
        $sql = 'SELECT projectID FROM project WHERE project.name ='."\"$projectName\"";
        $statement = $this->_dbHandle->prepare($sql); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $row = $statement->fetch();

        return $row["projectID"];
    }
}