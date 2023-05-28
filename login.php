<div class="container pt-lg-md"><br><br><br><br>
<br><br>
	<div class="row justify-content-center">
		<div class="col-lg-4" >
			<div class="card">
				<div class="card-body">
				<div class="text-center" >
					<img src="./assets/img/bcc_logo2.png" width="120px" height="107px"style="margin-top:-25%;">
					<form action="" id="login-frm">
						<div class= "" class="form-group">
							<label for="" class="control-label">Email</label>
							<input type="email" name="username" required="" class="form-control">
						</div>
						<div class= "" class="form-group">
							<label for="" class="control-label">Password</label>
							<input type="password" name="password" required="" class="form-control">						
						</div><br>
						<button class="button btn btn-info w-100">Login</button><br><br>
						<hr>
						<small><a href="index.php?page=signup" id="new_account" class="btn btn-success w-100" >Create New Account</a></small>
					</form>
				</div>
				</div>
			</div><br><br><br><br>
		</div>
	</div>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>

<script>
	$('#login-frm').submit(function(e){
		e.preventDefault()
		$('#login-frm button[type="submit"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=login2',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
				}else if(resp == 2){
					$('#login-frm').prepend('<div class="alert alert-danger">Your account is not yet verified.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}else{
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>