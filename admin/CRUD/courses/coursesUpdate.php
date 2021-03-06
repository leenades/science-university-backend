<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";

    $id = $_POST['id_hidden'];

    $sql = "SELECT course.category_title, course.course_image, course.course_link, course.is_active
    FROM db_science_university_courses course
    WHERE id='$id'";

    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $resultCol = $result->fetch();

    $course_category = $_POST['inputCourseCategoryEdit'];
    $course_link = $_POST['inputCourseLinkEdit'];
    $course_image = $_FILES["inputCourseImageEdit"]["name"];
    $course_active = $_POST["inputCoursesActiveEdit"];

    $updateSQL = "UPDATE db_science_university_courses 
    SET category_title=?, course_image=?, course_link=?, is_active=?
    WHERE id='$id'";
    $result = $conn->prepare($updateSQL);
    $runQuery = $result->execute([$course_category, $course_image, $course_link, $course_active]);
    if($runQuery){
        header('Location: ../../courses.php');
    } else {
        echo 'failed to update';
        header('Location: ../../courses.php');
    }
}
?>