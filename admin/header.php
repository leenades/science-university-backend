<?php 
include_once('includes/header.php');
include_once('includes/navbar.php');
?>

<?php
require_once 'database.php';

$sql = "SELECT header.header_id, header.image_path_file, header.header_text, header.header_title, header.order_, header.is_active, user.name 
FROM db_science_university_header as header JOIN db_science_university_users as user 
WHERE user.id = header.db_science_university_users_id";
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


<!-- add nav modal start -->
<div class="modal fade" id="addnav" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Image Slider Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/header/headerInsert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputHeaderTitle">Header Title</label>
            <input type="text" class="form-control" id="inputHeaderTitle" name="inputHeaderTitle" placeholder="Enter title"  >
          </div>
          <div class="form-group">
            <label for="inputHeaderImage">Header Image</label>
            <input type="file" class="form-control" id="inputHeaderImage" name="inputHeaderImage" aria-describedby="emailHelp" placeholder="Enter link"  required>
          </div>
          <div class="form-group">
            <label for="inputHeaderText">Header Text</label>
            <input type="text" class="form-control" id="inputHeaderText" name="inputHeaderText" aria-describedby="emailHelp" placeholder="Enter text"  >
          </div>
          <div class="form-group">
            <label>Order<br>
            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="0"  >
            <label for="inputHeaderOrder">1</label>
                  
            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="1"  >
            <label for="inputHeaderOrder">2</label>

            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="2"  >
            <label for="inputHeaderOrder">3</label>

            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="3"  >
            <label for="inputHeaderOrder">4</label>

            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="4"  >
            <label for="inputHeaderOrder">5</label>
            </label>
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputHeaderActive" name="inputHeaderActive" value="1" >
            <label for="inputNavbarActiveEdit">Yes</label>
                  
            <input type="radio" id="inputHeaderActive" name="inputHeaderActive" value="0" >
            <label for="inputHeaderActive">No</label>
            </label>
          </div>
          <button type="submit" class="btn btn-primary" id="submitBtn" name="submitBtn">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- add nav modal end -->

<!-- edit nav row modal start -->

<div class="modal fade" id="updaterow" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Image Slider Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/header/headerUpdate.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputHeaderTitleEdit">Header Title</label>
            <input type="text" class="form-control" id="inputHeaderTitleEdit" name="inputHeaderTitleEdit" placeholder="Enter title" >
          </div>
          <div class="form-group">
            <label for="inputHeaderImageEdit">Header Image</label>
            <input type="file" class="form-control" id="inputHeaderImageEdit" name="inputHeaderImageEdit" aria-describedby="emailHelp" placeholder="Enter link" required>
          </div>
          <div class="form-group">
            <label for="inputHeaderTextEdit">Header Text</label>
            <input type="text" class="form-control" id="inputHeaderTextEdit" name="inputHeaderTextEdit" aria-describedby="emailHelp" placeholder="Enter link" >
          </div>
          <div class="form-group">
            <label>Order<br>
            <input type="radio" id="inputHeaderOrderEdit" name="inputHeaderOrderEdit" value="0" >
            <label for="inputHeaderOrderEdit">1</label>
                  
            <input type="radio" id="inputHeaderOrderEdit" name="inputHeaderOrderEdit" value="1" >
            <label for="inputHeaderOrderEdit">2</label>

            <input type="radio" id="inputHeaderOrderEdit" name="inputHeaderOrderEdit" value="2" >
            <label for="inputHeaderOrderEdit">3</label>

            <input type="radio" id="inputHeaderOrderEdit" name="inputHeaderOrderEdit" value="3" >
            <label for="inputHeaderOrderEdit">4</label>

            <input type="radio" id="inputHeaderOrderEdit" name="inputHeaderOrderEdit" value="4" >
            <label for="inputHeaderOrderEdit">5</label>
            </label>
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputHeaderActiveEdit_1" name="inputHeaderActiveEdit" value="1" >
            <label for="inputHeaderActiveEdit_1">Yes</label>
                  
            <input type="radio" id="inputHeaderActiveEdit_0" name="inputHeaderActiveEdit" value="0" >
            <label for="inputHeaderActiveEdit_0">No</label>
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
            <h6 class="m-0 font-weight-bold text-primary">Image Slider
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addnav">
                    Add Image Slider
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Header Title</th>
                            <th>Header Image</th>
                            <th>Header Text</th>
                            <th>Header Order</th>
                            <th>Is Active</th>
                            <th>Admin</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['header_title'];?></td>
                            <td><?php echo $row['image_path_file'];?></td>
                            <td><?php echo $row['header_text'];?></td>
                            <td><?php echo $row['order_'];?></td>
                            <td><?php echo $row['is_active'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["header_id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                              <a 
                              href="CRUD/header/headerDelete.php/?delete=<?php echo $row["header_id"];?>" 
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
include('includes/footer.php');
?>

<script>

$(document).on('click', '.edit_data', function(){
  var id = $(this).attr('id');
  $('#id_hidden').val(id);  
  $.ajax({
    url: 'CRUD/header/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      newdata = JSON.parse(data);
      $('#updaterow').modal('show');
      $('#inputHeaderTitleEdit').val(newdata.headerTitle);
      $('#inputHeaderTextEdit').val(newdata.headerText);
      $('#inputHeaderImageEdit').val(newdata.headerImage);
      $('#inputHeaderOrderEdit').val(newdata.headerOrder);

      $('#inputHeaderActiveEdit_1').val(newdata.headerActive);
      $('#inputHeaderActiveEdit_0').val(newdata.headerActive);
      if(newdata.headerActive == 1){
        $('#inputHeaderActiveEdit_1').prop('checked', true);
      } else {
        $('#inputHeaderActiveEdit_0').prop('checked', true);

      }
  }
  });
});
</script>