<?php

//session_start();

require_once 'Models/PostsDataSet.php';
$view = new stdClass();
$view->pageTitle = 'New Post';
$postDataSet = new PostsDataSet();

/**
 *
 * When the user submits the new post form, post the data into the posts data
 */
if(isset($_POST['threadsubmit'])){
    $user_id      = $_POST['userID'];
    $subject       = $_POST['subject'];
    $post          = $_POST['threadspost'];
    $postDataSet->createPost($subject, $post, $user_id);
}
require_once('Views/newpost.phtml');