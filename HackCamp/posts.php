<?php

//session_start();

require_once('Models/PostsDataSet.php');

$view = new stdClass();
$view->pageTitle = 'Posts';


$postsDataSet = new PostsDataSet();
$view->postsDataSet = $postsDataSet->fetchAllPosts();


/**
 *
 * When the user presses the search button, send the query and fetch only the posts that match the search criteria
 */
if(isset($_POST['searchbutton'])) {
    $subject = $_POST['query'];
    $text = $_POST['query'];

    $view->postsDataSet = $postsDataSet->fetchSomePosts($subject, $text);

}
require_once('Views/posts.phtml');
