<?php echo $_SESSION['login_alumnus_id'];
    if(isset($_POST['add_company'])){
    $alumnus_id = $_GET['id'];
    $current_company = $_POST['current_company'];
    $current_position = $_POST['current_position'];
    $contact_info = $_POST['contact_info'];
    $date_started = $_POST['date_started'];
    $sector = $_POST['sector'];
    $status = $_POST['status'];
    mysqli_query($conn, "INSERT INTO employment_status(id, company, position, address, date_started,sector, status) 
    VALUES('".$alumnus_id."','".$current_company."','".$current_position."','".$contact_info."','".$date_started."','".$sector."','".$status."')");
    mysqli_query($conn,"DELETE FROM employment_status WHERE company='' AND address='' AND position='' ");
    }
$company = ""; $address="";$position="";$contact_info = "";$date_started="";$sector="";$status="";

if(isset($_POST['edit_company'])){
    $alumnus_id = $_GET['id'];
    $current_company = $_POST['current_company'];
    $current_position = $_POST['current_position'];
    $contact_info = $_POST['contact_info'];
    $date_started = $_POST['date_started'];
    $sector = $_POST['sector'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE employment_status SET company = '".$current_company."',position = '".$current_position."',address = '".$contact_info."',date_started='".$date_started."',sector = '".$sector."', status ='".$status."' WHERE counter='".$_GET['edit']."'");
    echo "<script>window.location.href='index.php?page=employment_status&&id=".$_SESSION['login_alumnus_id']."'</script>";
    if(isset($_GET['edit'])){
    foreach(mysqli_query($conn, "SELECT * FROM employment_status WHERE counter = '".$_GET['edit']."'") as $edit_company){
        $company = $edit_company['company'];
        $address = $edit_company['address'];
        $position = $edit_company['position'];
        $contact_info = $edit_company['address'];
        $date_started = $edit_company['date_started'];
        $sector = $edit_company['sector'];
        $status = $edit_company['status'];
    }
}
}
if(isset($_GET['edit'])){
    foreach(mysqli_query($conn, "SELECT * FROM employment_status WHERE counter = '".$_GET['edit']."'") as $edit_company){
        $company = $edit_company['company'];
        $address = $edit_company['address'];
        $position = $edit_company['position'];
        $contact_info = $edit_company['address'];
        $date_started = $edit_company['date_started'];
        $sector = $edit_company['sector'];
        $status = $edit_company['status'];
    }
}
if(isset($_GET['delete'])){
    mysqli_query($conn, "DELETE FROM employment_status WHERE counter='".$_GET['delete']."'");
    echo "<script>window.location.href='index.php?page=employment_status&&id=".$_SESSION['login_alumnus_id']."'</script>";
}
?>
<header class="masthead">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end mb-4 page-title">
                    	<h3 class="text-white">EMPLOYMENT STATUS</h3>
                        <hr class="divider my-4" />

                    <!-- <div class="col-md-12 mb-2 justify-content-center">
                    </div>                         -->
                    </div>
                    
                </div>
            </div>
        </header>


<div class="container-fluid p-4 bg-theme">
    <div class="row justify-content-center text-center">
        <div class="col-md-3">
            <div class="card text-left">
                <div class="card-header">
                Current Employment Information
                </div>
                <div class="card-body">
                        
                        <form method="POST">
                            Current Agency/Business Name<input type="text" name="current_company" class="form-control" value="<?php echo $company; ?>" id="agency">
                            Current Position<input type="text" name="current_position" class="form-control" value="<?php echo $position; ?>">
                            Address<input type="text" name="contact_info" class="form-control" value="<?php echo $contact_info; ?>" id="address">
                            Date Started<input type="date" name="date_started" class="form-control" value="<?php echo $date_started; ?>">
                            Sector<select class="form-control" name="sector" id="sector">
                                <option></option>
                                <option <?php if($sector == "Government"){ echo "selected";} ?>>Government</option>
                                <option <?php if($sector == "Private"){ echo "selected";} ?>>Private</option>
                                <option <?php if($sector == "NGO"){ echo "selected";} ?>>NGO</option>
                            </select>
                            Status<select class="form-control" name="status" aria-label="Ngano" id="status_dropdown">
                                <option></option>
                                <option <?php if($status == "Permanent"){ echo "selected";} ?> >Permanent/Regular</option>
                                <option <?php if($status == "Temporary"){ echo "selected";} ?> >Temporary</option>
                                <option <?php if($status == "Contractual"){ echo "selected";} ?> >Contractual</option>
                                <option <?php if($status == "Part-time"){ echo "selected";} ?> >Part-time</option>
                                <option <?php if($status == "Self-Employed"){ echo "selected";} ?> >Self-Employed</option>
                            </select>
                            <br>
                            <?php if(isset($_GET['edit'])){ ?>
                                <div class="text-center"><input type="submit" name="edit_company" class="btn btn-success btn-sm" value="Edit"></div>
                            <?php } else { ?>
                                <div class="text-center"><input type="submit" name="add_company" class="btn btn-success btn-sm"></div> 
                            <?php } ?>
                        </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Update Employment Status
                    <table class="table table-sm table-striped small">
                        <thead>
                            <th>Company</th>
                            <th>Address</th>
                            <th>Position</th>
                            <th>Date Started</th>
                            <th>Sector</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </thead>
                        <tbody>
                            <?php 
                            $get_company_list = mysqli_query($conn, "SELECT * FROM employment_status WHERE id = '".$_GET['id']."' ORDER BY date_started DESC");
                            foreach($get_company_list as $get_company_list){?>
                            <tr>
                                <td><?php echo $get_company_list['company']; ?></td>
                                <td><?php echo $get_company_list['address']; ?></td>
                                <td><?php echo $get_company_list['position']; ?></td>
                                <td><?php echo $get_company_list['date_started']; ?></td>
                                <td><?php echo $get_company_list['sector']; ?></td>
                                <td><?php echo $get_company_list['status']; ?></td>
                                <td><a href="index.php?page=employment_status&&id=<?php echo $_SESSION['login_alumnus_id'];  ?>&&edit=<?php echo $get_company_list['counter'];  ?>" class="btn btn-sm btn-warning p-1 px-2"><i class="fa fa-edit"></i></a>
                                <!--<a href="index.php?page=employment_status&&id=<?php echo $_SESSION['login_alumnus_id'];  ?>&&delete=<?php echo $get_company_list['counter'];  ?>" class="btn btn-sm btn-danger p-1 px-2"><i class="fa fa-times"></i></a></td>-->
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="self-employed-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bussines Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label>Business Type:</label>
                <input class="form-control" type="text" required id="bussiness_type">
            </div>

            <div class="form-group">
                <label>Business Name:</label>
                <input class="form-control" type="text" required id="bussiness_name">
            </div>

            <div class="form-group">
                <label>Business Address:</label>
                <input class="form-control" type="text" required id="bussiness_address">
            </div>

       
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="save_changes">Save changes</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function() {
        // Listen for change event on the dropdown
        $('#status_dropdown').change(function() {
            var selectedOption = $(this).val();
            
            // Check if the selected option should trigger the modal
            if (selectedOption === 'Self-Employed') {
            // Open the modal
            $('#self-employed-modal').modal('show');
            }
        });

         // Listen for change event on the dropdown
         $('#save_changes').click(function(evt) {  
            evt.preventDefault()

            $('#agency').val($('#bussiness_name').val())
            $('#address').val($('#bussiness_address').val())

            // Create the new option element
            var newOption = $('<option></option>').val($('#bussiness_type').val()).text($('#bussiness_type').val());
            // Append the new option to the select field
            $('#sector').append(newOption);
            // Set the new option as selected
            newOption.prop('selected', true);

            $('#self-employed-modal').modal('hide');
            
        });
    });
</script>