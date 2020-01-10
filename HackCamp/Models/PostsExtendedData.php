<?php

require_once('Models/Database.php');
require_once('Models/PostsData.php');

class PostsExtendedData
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllPosts() {
//        $sqlQuery = 'SELECT * FROM posts ORDER BY posts.timestamp DESC ';
//
//        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
//        $statement->execute(); // execute the PDO statement
//
//        $dataSet = [];
//        while ($row = $statement->fetch()) {
//            $dataSet[] = new PostsData($row);
//        }
//        return $dataSet;
    }

}