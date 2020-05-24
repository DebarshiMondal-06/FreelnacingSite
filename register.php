<?php include "DB.php";
include "functions.php";
?>
<?php
$error = '';
$verify = true;



if(isset($_POST['submit']))
{
	$first = trim($_POST['firstname']);
	$last = trim($_POST['lastname']);
	$password = trim($_POST['password']);
	$email = trim($_POST['email']);
	
	if(trim($_POST['optradio']) == 'Client')
	{
		$user_role = 'Client';
	}
	else if(trim($_POST['optradio']) == 'Admin')
	{
		$user_role = 'Admin';
	}
	else
	{
		$user_role = 'Freelancer';
	}
	
	
	$firstname = mysqli_real_escape_string($connection,$first);
	$lastname = mysqli_real_escape_string($connection,$last);
	$email = mysqli_real_escape_string($connection, $email);
	$password = mysqli_real_escape_string($connection, $password);
	
	$hashFormat = "$2y$10$";
	$salt = "iusesomecrazystrings22";
	
	$hashF_and_salt = $hashFormat . $salt;
	
	
	$password = crypt($password,$hashF_and_salt);
	
	if(email_exist($email))
	{
		$error = "Email already exists, Please Login to continue....";
//		header("Location: register.php");
	}
	else if(strlen($password) <= 5)
	{
		$error = "Passowrd must be longer than eight character";
	}
	else
	{	
		$verify = false;
		$query ="INSERT INTO regestration(firstname, lastname, user_password, user_email, user_role, Admin_Status)";
		$query .="VALUES('$firstname','$lastname','$password','$email','$user_role', 'Disapproved')";
		
		$result_query = mysqli_query($connection,$query);
		
		if(!$result_query)
		{
			die("Connection Intrupted!".mysqli_error($connection));
		}
	}
	
	
	
	
}




?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v3.8.6">
	<title>Register as Student</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
	<meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
	<meta name="theme-color" content="#563d7c">


	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>
	<!-- Custom styles for this template -->
	<link href="register.css" rel="stylesheet">
</head>

<body class="text-center">
	<?php if($verify): ?>
	<form class="form-signin" action="register.php" method="post">
		<!-- <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
		<h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-level-up-alt"></i> Register Here </h1>
		<p style="color:red; text-align:center; width:100%;"><?php echo $error; ?></p>
		<input type="text" autocomplete="on" class="form-control" placeholder="First Name" required autofocus name="firstname">
		<input type="test" autocomplete="on" class="form-control" placeholder="Last Name" required name="lastname">
		<input type="email" class="form-control" placeholder="Email address" required name="email">

		<input type="password" class="form-control" placeholder="Password" required name="password">
		<p>What's your Role?</p>
		<div class="form-check" style="font-size:20px; margin-bottom:10px;">
			<label class="radio-inline" style="margin-left: -20px;"><input type="radio" name="optradio" value="Client" checked> Client </label>
			<label class="radio-inline" style="margin-left: 10px;"><input type="radio" name="optradio" value="Freelancer"> Freelancer </label>
			
		</div>
		<div class="checkbox" style="float:left;">
			<label><input type="checkbox" value="" required> Accept Our <a href="">Terms and Conditions</a> </label>
		</div>

		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button>
		<br>
		<p><a href="index.php">Already have an account ? Log in ></a></p>
		<p class="mt-5 mb-3 text-muted">&copy; Iniesta 2020</p>
	</form>
	<?php else: ?>

	<style>
		.container {
			border: 1px solid black;
			padding: 20px;
			width: 50%;
		}

		h4 {
			font-size: 1.8em;
			font-weight: bold;
			font-family: 'Source Sans Pro', sans-serif;
			word-spacing: 5px;
		}

		h4>span {
			font-style: italic;
			letter-spacing: 1px;
			font-family: 'Source Sans Pro', sans-serif;
			color: chocolate;
		}
	</style>
	<div class="container" style="text-algin:center;">
		<p style="color: green; font-size: 1em;"> <span style="color: black; word-spacing:5px;"> Thankyou! </span> Regestration Succesfully Done. </p>
		<br>
		<h4> Registered as <span><?php echo $user_role; ?></span></h4>
		<br>
		<a href="index.php">Back To Login</a>
	</div>


	<?php endIf; ?>
</body>

</html>