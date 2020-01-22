<?php

/*
 * stores data of a project with three fields
 * 1) projectID
 * 2) name
 * 3) $employeeID
 */

class project
{
    protected $projectID, $name, $employeeID;

    public function __construct($dbRow) {
        $this->projectID = $dbRow['projectID'];
        $this->name = $dbRow['name'];
        $this->employeeID = $dbRow['employeeID'];
    }
    public function getProjectID(){
        return $this-> projectID;
    }

    public function getName(){
        return $this-> name;
    }
    public function getEmployeeID(){

        return $this-> employeeID;
    }


}
