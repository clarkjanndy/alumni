<?php include('db_connect.php');?>

<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row small">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Jobs List</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_career">
					<i class="fa fa-plus"></i>New Job</button>
				</span>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Company</th>
									<th class="">Job Title</th>
									<th class="">Posted By</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$jobs =  $conn->query("SELECT c.*,u.name from careers c inner join users u on u.id = c.user_id order by id desc");
								while($row=$jobs->fetch_assoc()):
									
								?>
								<tr>
									
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p><b><?php echo ucwords($row['company']) ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['job_title']) ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['name']) ?></b></p>
										 
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_career" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
										<button class="btn btn-sm btn-outline-primary edit_career" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_career" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div><br><br>

				<?php
					if(isset($_POST['submit_jobs'])){
						mysqli_query($conn, "INSERT INTO top_jobs(job_name, course) VALUES('".$_POST['job_desc']."','".$_POST['course']."')");
					}
				?>





				
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add A Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST">
      <div class="modal-body">
        
			Course:
			<select class="form-control" name="course">
				<?php
					$get_courses = mysqli_query($conn, "SELECT * FROM courses");
					foreach($get_courses as $get_courses){
						echo "<option value='".$get_courses['id']."'>".$get_courses['course']."</option>";
					}
				?>
			</select>

			<br>Job Desription:<input type="text" class="form-control" name="job_desc">
		</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submit_jobs">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	  </form>
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
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_career').click(function(){
		uni_modal("New Entry","manage_career.php",'mid-large')
	})
	
	$('.edit_career').click(function(){
		uni_modal("Manage Job Post","manage_career.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.view_career').click(function(){
		uni_modal("Job Opportunity","view_jobs.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.delete_career').click(function(){
		_conf("Are you sure to delete this post?","delete_career",[$(this).attr('data-id')],'mid-large')
	})

	function delete_career($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_career',
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
</script>