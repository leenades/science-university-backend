<?php
session_start();

require_once '../../database.php';

if(isset($_GET['delete'])){ 
    $_SESSION['message'] = "Record has been deleted successfully";
    $_SESSION['msg_type'] = "danger";

    $id = $_GET['delete'];

    $childSQL = $conn->prepare("DELETE FROM db_science_university_events
    WHERE event_category_category_id=?");
    $childSQLResult = $childSQL->execute([$id]);

    $sql = $conn->prepare("DELETE FROM events_category
    WHERE category_id=? ");
    $result = $sql->execute([$id]);
    if($result){
        header('Location: ../../../eventsCategory.php');
    } else {
        echo 'SQL statement DELETE was unsuccessful';
    }
} else {
    echo 'not working';
}

?>