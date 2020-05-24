<?php include "DB.php"; ?>
<?php include "functions.php"; ?>

<?php
require "vendor/phpmailer/phpmailer/PHPMailerAutoload.php";
require "classes/config.php";


$error = "";

if(!isset($_GET['forgot']))
{
    header("Location: index");
}

if(ifItIsMethod('post'))
{
	if(isset($_POST['recover-submit']))
	{
		
		$email = $_POST['email'];
		
		$length = 50;
		
		$token = bin2hex(openssl_random_pseudo_bytes($length));
		
		if(email_exist($email))
		{
		
			$query = "UPDATE regestration SET token='{$token}' WHERE user_email = '{$email}' ";
			if($result = mysqli_query($connection, $query))
			{
			
//				mysqli_stmt_bind_param($stmt, "s", $email);
//				mysqli_stmt_execute($stmt);
//				mysqli_stmt_close($stmt);
				
				
				$mail = new PHPMailer();
				
		                   
				$mail->isSMTP();                                            
				$mail->Host       = config::SMTP_HOST;  
				
				$mail->SMTPAuth   = true;  
				$mail->SMTPSecure = 'tls';
				$mail->Port       = config::SMTP_PORT;
				$mail->Username   = config::SMTP_USER;                    
				$mail->Password   = config::SMTP_PASSWORD;                
				    							 
				      				
							
				
				
				$mail->setFrom('debarshimondal121@gmail.com', 'Debarshi');
				$mail->addAddress($email);     
			    
				$mail->isHTML(true);
				$mail->Subject = "This is a Test mail";
				$mail->Body = '<p>Please Click to Reset your password
					
					<a href="http://localhost/Project-INIESTA/reset.php?email='.$email.'&token='.$token.' ">http://localhost:8888/reset.php?email='.$email.'&token='.$token.' </a>
					
				</p>';	
				
				if($mail->send())
				{
					$emailsent = true;
					
				}
				
				
			}
			
		} 
		else
		{
			$error = "<p style='color: red; '>Invalid! Kindly give your Registered Email ID.</p>";
		}
	
	}
	else
	{
		die("Connection Failed!");
	}
		
		
}
	




?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Forgot Password</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
</head>

<body>

	<style>
		.form-gap {
			padding-top: 150px;
		}
	</style>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<div class="form-gap"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">

							<?php if(!isset($emailsent)): ?>

							<h3><i class="fa fa-lock fa-4x"></i></h3>
							<h2 class="text-center">Forgot Password?</h2>
							<p>You can reset your password here.</p>
							<div class="panel-body">

								<form id="register-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<?php echo $error;?>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>

											<input id="email" name="email" placeholder="email address" class="form-control" type="email">
										</div>
									</div>
									<div class="form-group">
										<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
									</div>

									<a href="index.php">Back To Login</a>

									<input type="hidden" class="hide" name="token" id="token" value="">
								</form>

							</div>

							<?php else: ?>
							<hr>
							<p style="color: green"> Email Succesfully Sent</p>
							<br>
							<h3>Kindly Check your Inbox!</h3>
							<br>
							<a href="index.php">Back To Login</a>

							<?php endIf; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="foter" style="padding-top: 50px;">
			<a href="" style="text-decoration: none; text-align: center;">
				<h6 style="font-size: 1.2em;">&copy; INIESTA 2020</h6>
			</a>
		</div>
	</div>

</body>

</html>