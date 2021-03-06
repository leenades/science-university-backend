<?php 
include('includes/header.php');
include('includes/navbar.php');

require_once 'database.php';


$sql = "SELECT courses.id, courses.category_title, courses.course_image, courses.course_link, courses.is_active, user.name
FROM db_science_university_courses as courses JOIN db_science_university_users as user
WHERE user.id = courses.db_science_university_users_id	";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
?>
<?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
</div>
<?php endif ?>
<div class="modal fade" id="addcourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Courses Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/courses/coursesInsert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputCourseCategory">Course Category</label>
            <input type="text" class="form-control" id="inputCourseCategory" name="inputCourseCategory" placeholder="Enter Category" >
          </div>
          <div class="form-group">
            <label for="inputCourseImage">Course Image</label>
            <input type="file" class="form-control" id="inputCourseImage" name="inputCourseImage" placeholder="Choose file" required>
          </div>
          <div class="form-group">
            <label for="inputCourseLink">Course Link</label>
            <input type="text" class="form-control" id="inputCourseLink" name="inputCourseLink" placeholder="Enter Link" >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputCoursesActive" name="inputCoursesActive" value="1" >
            <label for="inputCoursesActive">Yes</label>
                  
            <input type="radio" id="inputCoursesActive" name="inputCoursesActive" value="0" >
            <label for="inputCoursesActive">No</label>
            </label>
          </div>
          <button type="submit" class="btn btn-primary" id="submitBtn" name="submitBtn">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit nav row modal start -->

<div class="modal fade" id="updaterow" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Courses Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/courses/coursesUpdate.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputCourseCategoryEdit">Course Category</label>
            <input type="text" class="form-control" id="inputCourseCategoryEdit" name="inputCourseCategoryEdit" placeholder="Enter Category" >
          </div>
          <div class="form-group">
            <label for="inputCourseImageEdit">Course Image</label>
            <input type="file" class="form-control" id="inputCourseImageEdit" name="inputCourseImageEdit" placeholder="Choose file" required>
          </div>
          <div class="form-group">
            <label for="inputCourseLinkEdit">Course Link</label>
            <input type="text" class="form-control" id="inputCourseLinkEdit" name="inputCourseLinkEdit" placeholder="Enter Link" >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputCoursesActiveEdit_1" name="inputCoursesActiveEdit" value="1" >
            <label for="inputCoursesActiveEdit_1">Yes</label>
                  
            <input type="radio" id="inputCoursesActiveEdit_0" name="inputCoursesActiveEdit" value="0" >
            <label for="inputCoursesActiveEdit_0">No</label>

            </label>
          </div>
          <input type="hidden" name="id_hidden" id="id_hidden">  
          <button type="submit" class="btn btn-primary" id="insert" name="updateBtn">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- edit nav row modal end -->

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Courses
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcourse">
                    Add Course
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Category</th>
                            <th>Course Image</th>
                            <th>Course Link</th>
                            <th>Is Active</th>
                            <th>Added by Admin</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['category_title'];?></td>
                            <td><?php echo $row['course_image'];?></td>
                            <td><?php echo $row['course_link'];?></td>
                            <td><?php echo $row['is_active'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                              <a 
                              href="CRUD/courses/coursesDelete.php/?delete=<?php echo $row['id'];?>" 
                              class="btn btn-danger">Delete</a>
                              </td>
                        </tr>
                    <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
include('includes/script.php');
include('includes/footer.php');?>
<script>

$(document).on('click', '.edit_data', function(){
  var id = $(this).attr('id');
  $('#id_hidden').val(id);  
  $.ajax({
    url: 'CRUD/courses/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      newdata = JSON.parse(data);
      
      $('#updaterow').modal('show');
      $('#inputCoursesActiveEdit_1').val(newdata.courseActive);
      $('#inputCoursesActiveEdit_0').val(newdata.courseActive);
      if(newdata.courseActive == 1){
        $('#inputCoursesActiveEdit_1').prop('checked', true);
      } else {
        $('#inputCoursesActiveEdit_0').prop('checked', true);
      }
      $('#inputCourseCategoryEdit').val(newdata.catTitle);
      $('#inputCourseImageEdit').val(newdata.courseImage);
      $('#inputCourseLinkEdit').val(newdata.courseLink);

    }
  });
});
</script>