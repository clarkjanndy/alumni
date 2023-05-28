<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Alumni	</b>
						<div class="search-form d-flex justify-content-end">
							<div>
								<form method="POST" class="form-inline mb-2">
									<select name="search_batch" class="form-control">
											<option></option>
										<?php foreach(mysqli_query($conn,"SELECT DISTINCT batch FROM alumnus_bio") as $batches){
												echo "<option>".$batches['batch']."</option>";
										} ?>
									</select>
									<button type="submit" name="search" class="btn btn-warning"> <i class="fa fa-search"></i> </button>
									<a href="index.php?page=admin_signup" class="btn btn-primary ml-3"><i class=""></i>Add Alumni</a>
									<!-- <button class="btn btn-primary ml-3" onclick="ImportData()">Import from Excel</button> -->
								</form>

								<form method="POST" class="" action="process_csv.php" enctype="multipart/form-data">
									<div class="form-group">
										<label for="" class="control-label">Import from File: </label>
										<input type="file" class="form-control" name="csv_file" onchange="this.form.submit()"
										accept=".csv" required>
										
									</div>
								</form>	
							</div>
						</div>
						<!-- <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="index.php?page=manage_alumni" id="new_alumni">
					<i class="fa fa-plus"></i> New Entry
				</a></span> -->

				<?php if(isset($_SESSION['error'])){ ?>
					<div class="alert alert-danger">
						<strong>Falied!</strong> Error in reading csv file. Please upload the right format.
					</div>
				<?php	
					unset($_SESSION['error']);
				}?>
				
				<?php if(isset($_SESSION['num_entries'])){ 
					if($_SESSION['num_entries'] > 0){
				?>
					<div class="alert alert-success">
						<strong>Success!</strong> <?php echo $_SESSION['num_entries']. ' Alumnis created successfully.'?>
					</div>
				<?php }else{ ?>
					<div class="alert alert-info">
					<strong>Opps!</strong> There is nothing to upload.
					</div>
				<?php	
					}
					unset($_SESSION['num_entries']);
				}?>
				
					</div>
					<div class="card-body small">
						<table class="table table-condensed table-bordered table-hover">
							<!-- <colgroup>
								<col width="5%">
								<col width="10%">
								<col width="15%">
								<col width="15%">
								<col width="30%">
								<col width="15%">
							</colgroup> -->
							<thead>
								<tr>
									<th class="text-center">alumni id#</th>
									<th class="">Alumni Profile</th>
									<th class="">Name</th>
									<th class="">Course Graduated</th>
									<th class="">Batch</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								if(isset($_POST['search'])){
									if($_POST['search_batch']==""){
										$search_query="";	
									}else{
										$search_query = "AND batch = '".$_POST['search_batch']."'";
									}
								}else{
									$search_query = "";
								}
								$view_courses = mysqli_query($conn, "SELECT * FROM courses");
								foreach($view_courses as $view_courses){
								$alumni = $conn->query("SELECT a.*,c.course,Concat(a.lastname,', ',a.firstname,' ',a.middlename) as name from alumnus_bio a inner join courses c on c.id = a.course_id WHERE a.status='1' AND a.course_id='".$view_courses['id']."'".$search_query." order by Concat(a.lastname,', ',a.firstname,' ',a.middlename) asc");
								if((mysqli_num_rows($alumni))>0){
									echo "<tr><td colspan='6' class='bg-primary  text-white'>".$view_courses['course']." <div class='btn btn-sm p-0 px-2 small bg-white float-right '>".mysqli_num_rows($alumni)."</div></td></tr>";
									while($row=$alumni->fetch_assoc()):
									
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center">
										<div class="avatar">
										 <img src="assets/uploads/<?php echo $row['avatar'] ?>" class="" alt="">
										</div>
									</td>
									<td class="">
										 <p> <b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['course'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['batch'] ?></b></p>
									</td>
									
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_alumni" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
										<button class="btn btn-sm btn-outline-danger delete_alumni" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; 
								}
								else{
										echo "<tr><td colspan='6' class='bg-primary  text-white'>".$view_courses['course']."</td></tr>";
										echo "<tr><td colspan='5' class='bg-gray'><div class='ml-4 pl-3'>No Alumni has been verified</div></td></tr>";
								}

							 } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: 150px;
	}
	.avatar {
	    display: flex;
	    border-radius: 100%;
	    width: 100px;
	    height: 100px;
	    align-items: center;
	    justify-content: center;
	    border: 3px solid;
	    padding: 5px;
	}
	.avatar img {
	    max-width: calc(100%);
	    max-height: calc(100%);
	    border-radius: 100%;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	
	$('.view_alumni').click(function(){
		uni_modal("Bio","view_alumni.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.delete_alumni').click(function(){
		_conf("Are you sure to delete this alumni?","delete_alumni",[$(this).attr('data-id')])
	})
	function delete_alumni($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_alumni',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	function ImportData() {
		let input = document.createElement('input')
		input.type = 'file';
		input.onchange = _ => {

			let files = Array.from(input.files);
			console.log(files);
		};
	 	input.click();
	}
</script>