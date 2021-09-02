<?php
include "auth.php";
include "DB.php";
include "functions.php";
if($_SESSION['userrole'] !== 'Freelancer' )
{
	header("Location: register.php");
}
?>


<?php
$profile_id = $_SESSION['id'];
$verify = "";
?>

<?php
	$the_token_id = "";
	$company_name = "";
	$user_token = "";

		if(isset($_GET['token_id']))
		{
			$the_token_id = $_GET['token_id'];
		}
		
$job_title = "";
$query = "SELECT * FROM client_job_posting WHERE client_job_posting.c_token = '{$the_token_id}' ";
$result_job = mysqli_query($connection,$query);

while($row = mysqli_fetch_array($result_job))
{
	$job_title = $row['job_title'];
	$company_name = $row['company_name'];
	$job_category = $row['job_category'];
	$job_description = $row['job_description'];
	$skills = $row['job_expertise_skills'];
	$job_vacancy = $row['job_vacanies'];
	$job_details = $row['job_details'];
	$pay_like = $row['client_pay_like'];
	$date = $row['date'];
	$project_time = $row['client_project_time'];
	$experience_level = $row['client_req_experience'];
//	$token = $row['c_token'];
	
}

$query_user_token = "SELECT * FROM profilee WHERE profilee.profile_id = {$profile_id} ";
$result_user_token = mysqli_query($connection,$query_user_token);
confirmQuery($result_user_token);

while($row = mysqli_fetch_array($result_user_token))
{
	$user_token = $row['user_token_id'];
}

if(isset($_POST['applied']))
{
	$user_profile_id = $_SESSION['id'];
	$user_name = $_SESSION['firstname'];
	
	
	$query_apply = "INSERT INTO users_applied_jobs(user_profile_id, user_name, client_token, user_token_id, status, applied_for, apply_date, hire_status) ";
	$query_apply .= "VALUES({$user_profile_id}, '{$user_name}', '{$the_token_id}', '{$user_token}' , 'unread', '{$job_title}', CURRENT_TIMESTAMP, 'unhired')";
	
	$result_applied = mysqli_query($connection, $query_apply);
	confirmQuery($result_applied);
	header("Location: find_work.php");
	
}
$verify = true;
$query_apply = "SELECT * FROM users_applied_jobs WHERE user_token_id = '{$user_token}' ";
$result_apply = mysqli_query($connection,$query_apply);

while($row = mysqli_fetch_array($result_apply))
{
	$user_profile = $row['user_profile_id'];
	$user_name = $row['user_name'];
	$user_token_id = $row['user_token_id'];
	$client_token = $row['client_token'];
	
	if($client_token == $the_token_id && $user_token_id == $user_token)
	{
		$verify = false;
	}
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Job Feed</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css">

	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>

	<style>
		body {
			min-height: 100%;
			background-image: -webkit-linear-gradient(65deg, rgb(0, 0, 0), rgba(45, 168, 168, 0.658));
		}

		p {
			padding-left: 2%;
		}

		.container {
			border-radius: 5px;
			min-height: 500px;
			padding: 1%;
			box-shadow: 2px 2px 9px -1px black;
		}

		.top-header {
			border-radius: 110px 0 110px 0;
			padding: 0.5% 13%;
			margin-bottom: 1%;
		}

		.top-header a {
			color: white;
		}

		.tab-content .card-header {
			border-radius: 50px;
		}

		.card:hover {
			background-color: rgb(242, 247, 246);
		}

		hr {
			width: 95%;
		}

		@media (max-width: 788px) {
			.description-header h4 {
				font-size: medium;
			}

			.btn {
				margin: 1%;
			}

			.description-header .col-md-6 {
				padding-left: 1%;
				padding-right: 1%;
			}
		}

	</style>
</head>

<body class="text-left">

	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="user_dasboard.php"><img src="images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px; margin-bottom: -10px;"> Find Work <br> <span style="font-size: 15px; margin-left: 50px;">( INIESTA )</span> </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<style>
				ul.navbar-nav a:hover {
					color: wheat !important;
				}

			</style>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link" href="user_dasboard.php" style="padding-top: 20px; color: white;"> Go To Dashboard </a>
				</li>
				<li class="nav-item dropdown text-center">
					<a type="button" class="nav-link" style="color: white;">
						<?php echo $_SESSION['firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['userrole']."</span> )"; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="logout.php" style="padding-top: 20px; color: red;"> Logout </a>
				</li>

			</ul>
		</div>
	</nav>
	<!----------------------------------------------------------Body-------------------------------------------------->



	<div class="alert alert-danger" style="width: 50%; margin-left: 25%;">
		<strong> Note! </strong><span style="font-size:15px;"> Once,You Applied will be redirect to previous page. Although! can find the applied jobs in
			<a href="users_jobs_history.php">History.</a></span>
	</div>
	<div class="container bg-light mt-4">
		<?php if($verify) { ?>

		<div class="description-header row text-center" style="margin: 0;">
			<div class="col-md-8">
				<h4 class="text-secondary" style="line-height: 2.0;"><b> <?php echo $company_name; ?></b>| <?php echo $job_title; ?> | <?php echo $job_category; ?> </h4>
			</div>
			<div class="col-md-4">
				<form action="" class="form-group" method="post">
					<button class="btn btn-primary" name="applied" type="submit"> Apply Here </button>
					<button class="btn btn-light border-dark" style="line-height: 2.0;">🤍 Save Job</button>
				</form>
			</div>
		</div>
		<hr>
		<p class="text-info text-right" style="margin: 0;"><b>Posted On</b> <span style="color:black;"><?php echo $date; ?></span></p>
		<p><br>
			<b class="text-info">Job Description</b><br>
			<?php echo $job_description; ?> <br><br>
		</p> <br>
		<hr>
		<br>
		<div class="row text-center" style="margin: 0;">
			<div class="col-md-4 mt-2">
				<b class="text-info"><i class="far fa-clock"></i> <?php echo $job_details; ?> </b><br>
				<span class="text-muted"> Job Details </span>
			</div>
			<div class="col-md-4 mt-2">
				<b class="text-info"><i class="far fa-calendar-alt"></i> <?php echo $project_time; ?></b><br>
				<span class="text-muted">Project length</span>
			</div>
			<div class="col-md-4 mt-2">
				<b class="text-info"><i class="fas fa-star-half-alt"></i> <?php echo $experience_level; ?></b><br>
				<span class="text-muted">Expertise level</span>
			</div>
		</div><br>
		<hr>
		<br>
		<p class="text-light"><b class="text-info">Skills Required : <span style="color: black!important;"> <?php echo $skills; ?> </span></b><br><br>
			<b class="text-info">Required connects : </b>&nbsp;&nbsp;<span class="bg-secondary" style="padding: 0.5% 2%; border-radius: 2px"><?php echo $job_vacancy; ?></span><br><br>
			<b class="text-info">Pay Role / Est. Budget: </b>&nbsp;&nbsp;<span class="bg-secondary" style="padding: 0.5% 2%; border-radius: 2px"><?php echo $pay_like." / $35";?></span></p><br>
		<hr>
		<p class="text-center" style="font-weight: bold;"><i class="far fa-check-circle text-success"></i> Payment Method Verified</p>
		<?php } else { ?>
		<hr>

		<p style="color: green; text-align: center; "> Job Applied Succesfully </p>
		<br>
		<p style="text-align: center; font-size:2em;"> <b>Applied!</b> </p>
		<br>
		<p style="text-align: center;"><a href="find_work.php"> Go Back! </a></p>
		<p style="text-align: center;">or</p>
		<p style="text-align: center;"><a href="users_jobs_history.php"> Checkout History </a></p>

	</div>

	<?php } ?>
	<!----------------------------------------------------------Body-------------------------------------------------->

	<!-- footer -->
	<div class="footer text-center">
		<div class="footer-top row">
			<div class="col-lg-4">
				<h5><u><b>Help for you</b></u></h5>
				<h6><a type="button" data-toggle="modal" data-target="#contactModal">Contact Support</a></h6>
				<h6>FAQs</h6>
			</div>
			<div class="col-lg-4">
				<h5><u><b>Safety and Privacy</b></u></h5>
				<h6><a href="TERMS OF SERVICES.pdf">Terms of services</a></h6>
				<h6><a href="">Privacy Policy</a></h6>
				<h6>Safety Tips</h6>
			</div>
			<div class="col-lg-4">
				<h5><u><b>About</b></u></h5>
				<h6><a type="button" data-toggle="modal" data-target="#aboutModalScrollable">About us</a></h6>
				<h6><a type="button" data-toggle="modal" data-target="#careerModalLong">Careers</a></h6>
				<h6>Media</h6>
			</div>
		</div>
		<div class="footer-icons">
			<a href="https://www.facebook.com/iniestawebtech/"><i class="fab fa-facebook-f fa-2x"></i></a>
			<a href="https://www.linkedin.com/in/iniesta-webtech-solution-private-limited-111b82184/"><i class="fab fa-linkedin fa-2x"></i></a>
			<a href="https://www.instagram.com/iniestawebtech/"><i class="fab fa-instagram fa-2x"></i></a>
		</div>
		<div class="text-center">
			<a href="">
				<h6>&copy; INIESTA 2020</h6>
			</a>
		</div>

	</div>
	<!-- footer end -->

	<!-- contact-modal -->
	<div style="text-align: left;" class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Contact Support</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Iniesta webtech solution pvt ltd <br>
						Ring us at: <br>
						9871428181 <br>
						8182818101 <br>
						Ping us at: <br>
						email- Iniestawebtech@gmail.com <br>
						Office Address <br>
						Office number 3 third floor H-61 sector 63 Noida <br>
						Uttar pradesh <br>
						201306 <br></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- terms of services model -->
	<div style="text-align: left;" class="modal fade" id="careerModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Careers</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>
						<b>Service. Community. Quality.</b><br>
						Our goal is to develop and nurture the world's largest digital marketplace, a place where people
						can find and purchase all the services they need and create any company they dream of. As an
						employee, the progress of our users and the celebration of your own personal development
						inspires your work. Join in with us. <br>
						<b>Our purpose comes first.</b><br>
						It still feels like day one We believe the freelance economy is still at its earliest stages. We
						take
						the view that — as early advocates of it — our task is to do it as holistically as we can, to
						introduce to all our goal of encouraging people to dream of living their work. <br>
						We are an organisation powered by intent. Everything we do stems from our desire to inspire
						people around the world to live their dream of working, develop their company from the ground
						up and become financially and professionally independent.
						<b>Locations</b><br>

						---------- ------------ --------------- <br>
						Teams (Our Iniesta Employees) <br>
						XXXXX <br>
						YYYYY <br>
						ZZZZZ <br>
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- About us modal -->
	<div style="text-align: left;" class="modal fade" id="aboutModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalScrollableTitle">About us</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>
						<b>Our Story</b><br>
						The Iniesta story begins over a decade ago, when the tech lead of a Silicon Valley startup
						realized his close friend in Athens would be perfect for an internet project. The team agreed he
						was the most effective choice, but were concerned about working with someone halfway round the
						globe. <br>

						<b>A new way of working is born</b><br>
						In response, the 2 friends created a brand new web-based platform that brought visibility and
						trust to remote work. it had been so successful the 2 realized other businesses would also take
						pleasure in reliable access to a bigger pool of quality talent, while workers would enjoy
						freedom and adaptability to seek out jobs online. Together they decided to begin a corporation
						that might deliver on the promise of this technology.
						Fast-forward to today, that technology is that the foundation of Iniesta — the most important
						global freelancing website. With countless jobs posted on Iniesta annually, freelancers are
						earning money by providing companies with over 5,000 skills across over 70 categories of labor.
						<br>
						<b>A world of opportunities</b><br>
						Through Iniesta businesses get more done, connecting with freelancers to figure on projects from
						web and mobile app development to SEO, social media marketing, content writing, graphic design,
						admin help and thousands of other projects. Iniesta makes it fast, simple, and cost-effective to
						seek out, hire, work with, and pay the most effective professionals anywhere, any time.
						<br>
						<b>Iniesta’s vision</b> <br>
						To be the number one flexible talent solution in the world. <br>
						<b>Iniesta's mission</b><br>
						To create economic opportunities so people have better lives. <br>
						<b>Iniesta’s values</b><br>
						Put our community first. <br>
						Inspire a boundless future of work. <br>
						Build amazing teams. <br>
						Have a bias towards action. <br>
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="index.js"></script>
</body>

</html>
