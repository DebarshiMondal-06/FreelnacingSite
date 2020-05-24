<?php include "auth.php"; 
include "DB.php";
$profile_id = $_SESSION['id'];
if($_SESSION['userrole'] !== 'Freelancer' )
{
	header("Location: register.php");
}


$db_rate = "";
$db_title = "";
$query = "SELECT * FROM profilee, eduactiontb, e_leveltb, employmenttb, hourlytb, locationtb, phonetb, languagetb,  titletb,  imagetb  WHERE profilee.profile_id = {$profile_id} AND eduactiontb.profile_id = {$profile_id} 
AND e_leveltb.profile_id = {$profile_id} AND employmenttb.profile_id = {$profile_id} AND hourlytb.profile_id = {$profile_id} AND locationtb.profile_id = {$profile_id} 
AND phonetb.profile_id = {$profile_id} AND languagetb.profile_id = {$profile_id} AND titletb.profile_id = {$profile_id}  AND imagetb.profile_id = {$profile_id}";

$result = mysqli_query($connection,$query);

if(!$result)
{
	die("Connection Failed!".mysqli_error($connection));
}
while($row = mysqli_fetch_assoc($result))
{
	$db_expertise = $row['expertise'];
	$db_skills = $row['skills'];
	
	$db_degree = $row['degree'];
	$db_college = $row['college_name'];
	$db_area_study = $row['area_study'];
	
	$db_level = $row['expertise_level'];
	
	$db_company = $row['employ_company'];
	$db_city = $row['employ_city'];
	$db_state = $row['employ_state'];
	$db_country = $row['employ_country'];
	$db_job_title  = $row['employ_job_title'];
	
	$db_rate = $row['hourly_rate'];
	
	$db_phone = $row['phone_number'];
	
	$db_user_street = $row['street_address'];
	$db_user_city = $row['city'];
	$db_user_state = $row['state'];
	$db_user_country = $row['country'];
	$db_pincode = $row['pincode'];
	
	$db_english = $row['lang_profiency'];
	$db_other_lang = $row['other_lang'];
	
	
	$db_title = $row['title'];
	$db_overview = $row['professional_overview'];
	
	$db_image = $row['user_image'];
	
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style_view_profile.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css">
</head>

<body>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

	<!---------------------------------------------------     NAV  section ---------------------------------------------->

	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="view_profile.php"><img src="images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px; margin-bottom: -12px;"> Update Profile <br> <span style="font-size: 15px; margin-left: 40px;">( INIESTA )</span> </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<style>
					ul.navbar-nav a:hover {
						color: wheat !important;
					}

				</style>

				<li class="nav-item dropdown">
					<a href="user_dasboard.php" class="nav-link" style="color: white; padding-top: 20px;"> Go To Dashboard </a>
				</li>
				<li class="nav-item dropdown trainings">
					<a href="update_user.php?u_id=<?php echo $_SESSION['id']; ?>" class="nav-link" style="color: white; padding-top: 20px;"> Update_Profile </a>
				</li>

				<li class="nav-item dropdown">
					<a type="button" class="nav-link" style="color: white;">
						Login as <?php echo $_SESSION['firstname'],"<br>"."( <span style='color: orange;'>". $_SESSION['userrole']."</span> )"; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a href="logout.php" type="button" class="nav-link" style="color: red; padding-top: 20px;">
						Logout
					</a>
				</li>
			</ul>
		</div>
	</nav>
	<!--------------------------------------------------------------------------	NAv section ends---------------------------------------->

	<br>

	<div class="container">

		<div class="team-single">

			<div class="row">

				<div class="col-lg-4 col-md-5 xs-margin-30px-bottom">
					<div class="team-single-img">
						<?php echo "<img class='img-responsive' src='images/$db_image' width='200px'>"; ?>
					</div>
					<div class="bg-light-gray padding-30px-all md-padding-25px-all sm-padding-20px-all text-center">
						<h4 class="margin-10px-bottom font-size24 md-font-size22 sm-font-size20 font-weight-600"> <?php echo $db_title; ?>. </h4>
						<p class="sm-width-100 sm-margin-auto"><?php echo $db_overview; ?>.<br><span style="float:left; width:300px; padding: 10px;"><strong>Languages Known:</strong> English(<?php echo $db_english; ?>), <?php echo $db_other_lang; ?> </span></p><br>
						<div class="margin-20px-top team-single-icons">
							<ul class="no-margin" style="margin-right: 25px;">
								<li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
								<li><a href="javascript:void(0)"><i class="fab fa-google-plus-g"></i></a></li>
							</ul>
						</div>
						<a href="update_user.php?u_id=<?php echo $_SESSION['id']; ?>" class="btn btn-success"> Update </a>
					</div>

				</div>

				<div class="col-lg-8 col-md-7">
					<div class="team-single-text padding-50px-left sm-no-padding-left">
						<h4 class="font-size38 sm-font-size32 xs-font-size30 text-uppercase"><?php echo $_SESSION['firstname']; ?></h4>
						<div class="contact-info-section margin-40px-tb">
							<ul class="list-style9 no-margin">
								<br>
								<li>
									<div class="row">
										<div class="col-md-5 col-5">
											<i class="fas fa-envelope text-pink"></i>
											<strong class="margin-10px-left xs-margin-four-left text-pink">Email:</strong>
										</div>
										<div class="col-md-7 col-7">
											<p><?php echo $_SESSION['email']; ?></p>
										</div>
									</div>
								</li>
								<li>

									<div class="row">
										<div class="col-md-5 col-5">
											<i class="far fa-lightbulb text-orange"></i>
											<strong class="margin-10px-left text-orange"> Expertise </strong>
											<p>Service: </p>
											<p> Skills: </p>
											<p> Level: </p>
										</div>
										<div class="col-md-7 col-7">

											<br>
											<p><?php echo $db_expertise; ?></p>
											<p><?php echo $db_skills; ?></p>
											<p><?php echo $db_level; ?></p>
										</div>
									</div>

								</li>
								<li>

									<div class="row">
										<div class="col-md-5 col-5">
											<i class="fas fa-dollar-sign text-green"></i>
											<strong class="margin-10px-left text-green"> Hourly Rate:</strong>
										</div>
										<div class="col-md-7 col-7">
											<p><b>$ <?php echo $db_rate; ?></b></p>
										</div>
									</div>

								</li>

								<li>

									<div class="row">
										<div class="col-md-5 col-5">
											<i class="fas fa-suitcase text-lightred"></i>
											<strong class="margin-10px-left text-lightred"> Past Expertise </strong>
											<p> Company: </p>
											<p> Location: </p>
											<p> Job Role: </p>
										</div>
										<div class="col-md-7 col-7">
											<br>
											<p> <?php echo $db_company; ?></p>
											<p class="text-uppercase"><?php echo $db_city, "<span>, " . $db_state. ", " . $db_country. "</span>"; ?></p>
											<p><?php echo $db_job_title; ?></p>
										</div>
									</div>

								</li>
								<li>

									<div class="row">
										<div class="col-md-5 col-5">
											<i class="fas fa-graduation-cap text-yellow"></i>
											<strong class="margin-10px-left text-yellow"> Education : </strong>

										</div>
										<div class="col-md-7 col-7">
											<p><?php echo $db_degree,","."<span> ".$db_area_study. "</span> "."from ". $db_college;?></p>
										</div>
									</div>

								</li>
								<li>

									<div class="row">
										<div class="col-md-5 col-5">
											<i class="fas fa-mobile-alt text-purple"></i>
											<strong class="margin-10px-left xs-margin-four-left text-purple">Contact</strong>
											<p> Phone: </p>
											<p> Address: </p>
										</div>
										<div class="col-md-7 col-7">
											<br>
											<p><?php echo $db_phone; ?></p>
											<p><?php echo $db_user_street.", ".$db_user_city. ", ".$db_user_state.", ".$db_user_country.", ".$db_pincode; ?></p>
										</div>
									</div>

								</li>

							</ul>
						</div>

					</div>
				</div>

				<div class="col-md-12">

				</div>
			</div>
		</div>
	</div>
	<script lang="javascript" type="text/javascript">
		window.history.forward();

	</script>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<!--	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</body>

</html>
