<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){

    $header_title = $_POST['inputHeaderTitle'];
    $header_image = $_FILES["inputHeaderImage"]["name"]; 
    $header_order = $_POST['inputHeaderOrder'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO db_science_university_header (image_path_file, header_title, order_, db_science_university_users_id) VALUES (?, ?, ?, ?)");
    $sql->execute([$header_image, $header_title, $header_order, $userID]);
    if($runQuery){     
        header('Location: ../../header.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../header.php');
    }
} else {
    header('Location: ../../header.php');
}

?>