<?php include "DB.php"; ?>
<?php

	if(!isset($_GET['email']) && !isset($_GET['token']))
	{
		header("Location: index");
	}

//$token = "3a2a5df0bf4b79ae63c97a9f646a8c56d205e6918fa879cd543878ca01d88488b4cd60aca5739cc83db6d0606f1b54ee2978";
//
//$email = "debopiku1122@gmail.com";

$verified = true;
$error = '';

if($stmt = mysqli_prepare($connection, 'SELECT firstname, user_email, token FROM regestration WHERE token=?'))
{
	mysqli_stmt_bind_param($stmt, "s", $_GET['token']);	
	
	mysqli_stmt_execute($stmt);
	
//	mysqli_stmt_bind_result($stmt, $firstname, $user_email, $token);
//	
//	mysqli_stmt_fetch($stmt);
	
	mysqli_stmt_close($stmt);
	
	
	if(isset($_POST['pass1']) && isset($_POST['pass2']))
	{
		if($_POST['pass1'] === $_POST['pass2'])
		{
			$pass1 = $_POST['pass1'];
			
			if($stmt = mysqli_prepare($connection, "UPDATE regestration SET token='', user_password='{$pass1}' WHERE user_email =?"))
			{
				mysqli_stmt_bind_param($stmt, "s", $_GET['email']);
				mysqli_stmt_execute($stmt);
				
				if(mysqli_stmt_affected_rows($stmt) >=1 )
				{
					$verified = false;
				}
				mysqli_stmt_close($stmt);
				
			}
		}
		else 
		{
			$error = "<p style='color: red; '>OOPs! Password doesn't Matched. <b>Try Again! </b></p>";
		}
	}
	





}

?>





<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Reset</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>

</head>

<body>

	<style>
		.form-gap {
			padding-top: 150px;
		}
	</style>

	<!-- Page Content -->
	<div class="container">

		<div class="form-gap"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="text-center">

								<?php if($verified): ?>

								<h3><i class="fas fa-key fa-3x"></i></h3>
								<h2 class="text-center">Reset Your Password?</h2>
								<div class="panel-body">

									<form id="register-form" action="" role="form" autocomplete="off" class="form" method="post">
										<?php echo $error; ?>

										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fas fa-key"></i></span>
												<input id="password" name="pass1" placeholder="Enter New Password" class="form-control" type="password" required>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fas fa-key"></i></span>
												<input id="password" name="pass2" placeholder="Confirm Password" class="form-control" type="password" required>
											</div>
										</div>
										<div class="form-group">
											<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
										</div>

										<input type="hidden" class="hide" name="token" id="token" value="">
									</form>

								</div><!-- Body-->

								<?php else: ?>
								<hr>
								<p style="color: green"> Password Changed Successfully </p>
								<br>
								<h3> Succesful! </h3>
								<br>
								<a href="index.php">Back To Login</a>

								<?php endIf; ?>



							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<hr>

		<div class="foter">
			<a href="" style="text-decoration: none; text-align: center;">
				<h6 style="font-size: 1.2em;">&copy; INIESTA 2020</h6>
			</a>
		</div>

	</div> <!-- /.container -->


</body>

</html>