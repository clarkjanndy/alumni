<?php include('db_connect.php');?>
<?php 
    if(isset($_POST['update_officer'])){
        mysqli_query($conn, "UPDATE officers SET name='".$_POST['officer_name']."' WHERE id='".$_POST['officer_id']."'");
    
        $target_dir = "officer_uploads/";
        $target_file = $target_dir.$_POST['officer_id'].".png";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            echo "The Officers Information Has Been Successfully Updated";
        } else {
            echo "Sorry, there was an error uploading your picture, hence the information is saved. Please upload again.";
        }
        }
    
    }
?>
<div class="container-fluid">
    <div  class="card">
        <div class="card-body">
            ALUMNI OFFICERS
            <form>
                <table class="table table-sm table-bordered table-condensed small">
                    <thead class="text-center">
                        <td>Position</td><td>Name</td><td>Photo</td><td>Action</td>
                    </thead>
                    <tbody>
                        <?php foreach(mysqli_query($conn, "SELECT * FROM officers ORDER BY counter ASC") as $officers){ ?>
                        <tr>
                            <td><?php echo $officers['position']; ?></td>
                            <td><?php echo $officers['name']; ?></td>
                            <td><img class="img-thumbnail" alt="off" id="img" src="./officer_uploads/<?php echo $officers['id'].".png"; ?>" width="100px;" style="border-radius: 50%;" onerror="this.src='./officer_uploads/bcc_logo.jpg'"></td>
                            <td><button type="button" class="btn btn-primary btn-sm " onclick="editOfficer('<?php echo $officers['position'] ?>','<?php echo $officers['id']; ?>')"><i class="fa fa-edit"></i></button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="showModalForOff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Officer Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <input type="hidden" id="officer_id" name="officer_id">
            <p id="position"></p>
            <input type="text" class="form-control" name="officer_name" required><br>
            <input type="file" name="fileToUpload" id="fileToUpload">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="update_officer" class="btn btn-primary">Save changes</button>
        </div>
     </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    function editOfficer(position, id){
        document.getElementById('officer_id').value = id;
        document.getElementById('position').innerHTML = "Position: "+position;
        $('#showModalForOff').modal('show');

    }
</script>