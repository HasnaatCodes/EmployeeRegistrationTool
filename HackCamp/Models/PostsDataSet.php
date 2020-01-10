<?php

require_once('Models/Database.php');
require_once('Models/PostsData.php');

class PostsDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    /**
     * @return array
     *
     * Function is used to get all the posts in the database
     */
    public function fetchAllPosts() {
//        $sqlQuery = 'SELECT * FROM posts
//                     ORDER BY posts.timestamp DESC';
//
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

    /**
     * @param $subject
     * @param $text
     * @return array
     *
     * This function is used to fetch posts when the user uses the search bar
     */
    public function fetchSomePosts($subject, $text){
//        $sqlQuery = 'SELECT * FROM posts WHERE text LIKE '."\"$text%\"".' OR subject LIKE '."\"$subject%\" ".'';
//
//        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
//        $statement->execute(); // execute the PDO statement
//
//        $dataSet = [];
//        while ($row = $statement->fetch()) {
//            $dataSet[] = new PostsData($row);
//        }
//
//        return $dataSet;

    }

    /**
     * @param $subject
     * @param $text
     * @param $user_id
     *
     *
     * This function is used to create a new post
     */
    public function createPost($subject, $text, $user_id) {

//        $subject = htmlentities($subject);
//        $text = htmlentities($text);
//        $user_id = htmlentities($user_id);
//
//        $sqlQuery = 'INSERT INTO posts (subject, text, user_id) VALUES('."\"$subject\"".', '."\"$text\"".', '."\"$user_id\"".')';
//
//        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
//        $statement->execute(); // execute the PDO statement

    }

}