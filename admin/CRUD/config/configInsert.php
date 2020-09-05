<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){

    $config_name = $_POST['inputConfigName'];
    $config_value = $_FILES["inputConfigValue"]["name"]; 
    $is_active = $_POST['inputConfigActive'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO db_science_university_config (config_name, config_value, is_active, db_science_university_users_id) VALUES (?, ?, ?, ?)");
    $sql->execute([$config_name, $config_value, $is_active, $userID]);
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