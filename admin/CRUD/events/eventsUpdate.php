<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";

    $id = $_POST['id_hidden'];

    $sql = "SELECT events_cat.category_name, events.event_title, events.event_description, events.event_image, events.event_date, events.event_start_time, events.event_end_time, events.event_location, events_cat.category_name, events.is_active
    FROM db_science_university_events events JOIN events_category events_cat 
    WHERE id='$id' AND events_cat.category_id = events.event_category_category_id";

    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $resultCol = $result->fetch();

    $event_title = $_POST['inputEventTitleEdit'];
    $event_category = $_POST['eventsCategoriesEdit'];
    $event_description = $_POST['inputEventDescriptionEdit'];
    $event_image = $_FILES["inputEventIconEdit"]["name"];
    $event_date = $_POST['inputEventDateEdit'];
    $event_start_time = $_POST['inputEventStartTimeEdit'];
    $event_end_time = $_POST['inputEventEndTimeEdit'];
    $event_location = $_POST['inputEventLocationEdit'];
    $event_active = $_POST['inputEventsActiveEdit'];

    $updateSQL = "UPDATE db_science_university_events 
    SET event_title=?, event_description=?, event_image=?, event_date=?, event_start_time=?, event_end_time=?, event_location=?, event_category_category_id=?, is_active=?
    WHERE id='$id'";
    $result = $conn->prepare($updateSQL);
    $runQuery = $result->execute([$event_title, $event_description, $event_image, $event_date, $event_start_time, $event_end_time, $event_location, $event_category, $event_active]);
    if($runQuery){
        header('Location: ../../events.php');
    } else {
        echo 'failed to update';
        header('Location: ../../events.php');
    }
}
?>