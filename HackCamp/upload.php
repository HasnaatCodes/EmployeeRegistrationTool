<?php

session_start();

$view = new stdClass();
$view->pageTitle = 'Test';
require_once 'Models/UploadFunctionality.php';

$uploadData = new UploadFunctionality();


if (isset($_POST['submitfile'])) {

    $title = $_POST['filetitle'];
    $EmployeeID = $_POST['employeeIDFile'];
    $fileLocation = storeFile($_FILES['fileToUpload']);
    $uploadData->uploadFile($EmployeeID, $title, $fileLocation);
}

function storeFile($file)
{
    $filePath = null;
    $path = './uploadedFiles/'; // upload directory
    $fl = $file['name']; //stores the original filename from the client
    $tmp = $file['tmp_name'];//stores the name of the designated temporary file
    $errorFl = $file['error']; //stores any error code resulting from the transfe
    // can upload same image using rand function, which also makes it harder to users to just guess image names.
    $final_file = rand(1000,1000000).$fl;
    $path = $path.strtolower($final_file);

    // If the image was downloaded successfully, return the location where it is stored.
    if(move_uploaded_file($tmp,$path))
    {
        $filePath = $path;
    }
    else
    {
        echo $errorFl;
    }

    return $filePath;
}
require_once('Views/time.phtml');
