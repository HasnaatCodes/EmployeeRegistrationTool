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
        $start_time = htmlentities($start_time);
        $end_time = htmlentities($end_time);

        $projectIDsql = 'SELECT projectID FROM project WHERE project.name ='."\"$projectName\"";
        $statement = $this->_dbHandle->prepare($projectIDsql); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $row = $statement->fetch();

        $projectID = $row["projectID"];

    }


//    public function createUser($firstName, $lastName, $email, $password) {
//
//        $email = htmlentities($email);
//        if(!$this->emailInDatabase($email))
//        {
//            $firstName = htmlentities($firstName);
//            $lastName = htmlentities($lastName);
//            $password = htmlentities($password);
//            $password = md5($password);
//            $sqlQuery = 'INSERT INTO users (firstname, lastname, password, email) VALUES('."\"$firstName\"".', '."\"$lastName\"".', '."\"$password\"".', '."\"$email\"".')';
//            //var_dump($sqlQuery);
//            $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
//            $statement->execute(); // execute the PDO statement
//        }
//        else
//        {
//            echo "Email already taken, please try another email!";
//        }
//    }


    /**
     * @param $email
     * @return bool
     *
     * This is a function to check whether an email already exists in the database
     * This is to prevent a user signing up again using the same email address already being used
     */
    private function emailInDatabase($email)
    {
        $exists = false;
        $sql = 'SELECT COUNT(employeeID) AS Total FROM employee WHERE email=' . "\"$email\"";
        //var_dump($sql);
        $statement = $this->_dbHandle->prepare($sql); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        if ($row = $statement->fetch()) {
            if (!$row['Total'] == 0) {
                $exists = true;
            }

        }
        return $exists;
    }

    /**
     * @param $email
     * @return UserData
     *
     *
     */
    public function getUser($email)
    {
        $sqlQuery = 'SELECT employee.* FROM employee WHERE email=' . "\"$email\"";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $row = $statement->fetch();
        return $user = new UserData($row);
    }


    /**
     * @param $email
     * @param $password
     * @return bool
     *
     * This is a function to authenticate a returning user
     * Their email and password is checked against the data present in the database
     */
    public function checkLogIn($email, $password)
    {

        $password = md5($password); //Password Encryption
        $isLoggedIn = false; //Boolean used to maintain state

        $sqlCheck = 'SELECT COUNT(employeeID) AS Found FROM employee WHERE email=' . "\"$email\" AND password = \"$password\" ";


        $statement = $this->_dbHandle->prepare($sqlCheck); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        if ($row = $statement->fetch()) {
            if (!$row['Found'] == 0) {
                $isLoggedIn = true; //If such user exists then we want to maintain state
                $_SESSION['logged_in'] = $this->getUser($email);
                $user = $this->getUser($email);
                $_SESSION['login'] = $user;
                echo "Works";
            } else {
                echo "User Not Found";
            }
        }
        return $isLoggedIn;

    }
}