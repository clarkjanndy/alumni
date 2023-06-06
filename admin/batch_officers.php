<?php include('db_connect.php');?>
<div class="container-fluid">
    <div  class="card">
        <div class="card-body">
            BATCH OFFICERS

            <div class="d-flex justify-content-end mb-3 mt-3">
			    <button class="btn btn-primary btn-sm" id="new_batch_officer" data-toggle="modal" data-target="#add_officer"><i class="fa fa-plus"></i> New Batch Officer</button>
	        </div>

            <?php if(isset($_SESSION['add_officer'])){ ?>
					<div class="alert alert-success">
						<strong>Success!</strong> <?php echo $_SESSION['add_officer_message']?>
					</div>
			<?php
            unset($_SESSION['add_officer']);
            unset($_SESSION['add_officer_message']);
            }
            ?>	
            <?php if(isset($_SESSION['add_officer_error'])){ ?>
					<div class="alert alert-danger">
						<strong>Failed!</strong> <?php echo $_SESSION['add_officer_error_message']?>
					</div>
			<?php
            unset($_SESSION['add_officer_error']);
            unset($_SESSION['add_officer_error_message']);
            }
            ?>	


            <?php if(isset($_SESSION['delete_officer'])){ ?>
					<div class="alert alert-danger">
						<strong>Failed!</strong> <?php echo $_SESSION['delete_officer_message']?>
					</div>
			<?php
            unset($_SESSION['delete_officer']);
            unset($_SESSION['delete_officer_message']);
            }
            ?>	

            <?php 
            $batch_query = mysqli_query($conn, "SELECT DISTINCT batch FROM batch_officers ORDER BY batch DESC;");
            if (mysqli_num_rows($batch_query) > 0) {
                while ($batch = mysqli_fetch_assoc($batch_query)) {
            ?>

            <div class="batch mt-3">
            <div><b>Batch of <?php echo $batch["batch"]?></b></div>
                <table class="table table-sm table-bordered table-condensed small">
                    <thead class="text-center">
                        <td>Position</td>
                        <td>Name</td>
                        <td>Photo</td>
                        <td>Action</td>
                    </thead>
                    <tbody>
                    <?php 
                    $officers_query = mysqli_query($conn, "SELECT * FROM batch_officers WHERE batch = '".$batch["batch"]."'");
                    if (mysqli_num_rows($officers_query) > 0) {
                        while ($officer = mysqli_fetch_assoc($officers_query)) {
                        $user_query = mysqli_query($conn,  "SELECT * FROM alumnus_bio WHERE id = '".$officer["alumnus_id"]."' LIMIT 1");
                        $alumnus = mysqli_fetch_assoc($user_query);
                            if ($alumnus){
                    ?>
                                <tr>
                                    <td class="text-center"><?php echo $officer["position"]?></td>
                                    <td class="text-center"><?php echo $alumnus["firstname"]." ".$alumnus["middlename"]." ". $alumnus["lastname"]?></td>
                                    <td class="text-center"><img class="img-thumbnail" alt="off" id="img" src="./assets/uploads/<?php echo $alumnus["avatar"] ?>" width="100px;" style="border-radius: 50%;" onerror="this.src='./officer_uploads/bcc_logo.jpg'"></td>
                                    <td class="text-center"><a class="btn btn-sm btn-outline-danger" href="processors/batch_officers.php?delete_officer=<?php echo $officer["id"]?>">Delete</a></td> 
                                </tr>
                    <?php
                            }
                        }
                    }            
                    ?>
                    </tbody>
                </table>
            </div>

            <?php
                }
            }else{            
            ?>
            <div class="alert alert-info">
						No Batch Officers yet. Try to add one!
			</div>
            <?php 
            }?>
            
        </div>
    </div>
</div>


<div class="modal fade" id="add_officer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Batch Officer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
        <div class="modal-body">
            <form method="POST" action = "processors/batch_officers.php">
                <label>Position:</label>
                <select  class="form-control" name="position" required  >
                    <option value="">- - -</option>
                    <option value="President">President</option>
                    <option value="Vice-President">Vice-President</option>
                    <option value="Secretary">Secretary</option>
                    <option value="Treasurer">Treasurer</option>
                    <option value="Auditor">Auditor</option>
                    <option value="Public Information Officer">Public Information Officer</option>
                    <option value="Batch Representative">Batch Representative</option>
                </select><br>
                <label>Batch:</label>
                <input type="text" class="form-control" name="batch" id="batch" required placeholder="Batch" readonly><br>
                <input type="text" class="form-control d-none" name="alumnus_id" id="alumnus_id" required placeholder="Alumnus Id" style="font-style: bold">
                <label>Alumnus Name:</label>
                <input type="text" class="form-control" name="alumnus" id="alumnus" required placeholder="Alumnus Name" readonly><br>
                 
                <div class="d-flex justify-content-end">
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_officer" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                
            </form>
            <div>Select Alumnus for the Position</div>
            <div class="card p-3 shadow mt-3">
                <table class="table table-hover w-100" id = "alumnis">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Batch</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">---</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $almunus_query = mysqli_query($conn, "SELECT * FROM alumnus_bio");
                        if (mysqli_num_rows($almunus_query) > 0) {
                            while ($row = mysqli_fetch_assoc($almunus_query)) {
                        ?>
                        <tr>
                            <td class=""><?php echo $row["id"]?></td>
                            <td class=""><?php echo $row["batch"]?></td>
                            <td class=""><?php echo $row["firstname"]. " ".$row["middlename"]. " ".$row["lastname"]?></td>
                            <td class="text-center"><button class=" btn btn-sm btn-primary" id = "action-button">Select</button></td>
                        </tr>
                        <?php
                            }
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
       
     
    </div>
  </div>
</div>


<script>
    $(document).ready(function() {
            // Initialize DataTable
            var table =  $('#alumnis').DataTable()
            table.column(0).visible(false);

            // Handle button click event using event delegation
            $('#alumnis').on('click', '#action-button', function() {
                var $row = $(this).closest('tr');
                var rowData = table.row($row).data();

                // Access the values of each column in the clicked row
                var id = rowData[0];
                var batch = rowData[1];
                var name = rowData[2];

                $('#batch').val(batch)
                $('#alumnus_id').val(id)
                $('#alumnus').val(name)
            });
        });
</script>

<script type="text/javascript">
    function editOfficer(position, id){
        document.getElementById('officer_id').value = id;
        document.getElementById('position').innerHTML = "Position: "+position;
        $('#showModalForOff').modal('show');
    }
</script>