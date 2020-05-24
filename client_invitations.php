	<?php
include "DB.php";
include "auth.php";
if($_SESSION['client_userrole'] !== 'Client' )
{
	header("Location: register.php");
}

$profile_id = $_SESSION['client_id'];
?>


	<?php

	$invites = "";
	$client_profile = "";
	if(isset($_GET['invite']))
	{
		if(isset($_GET['client_profile']))
		{
			$invites = $_GET['invite'];
			$client_profile = $_GET['client_profile'];
		}
	}
	$query_check = "INSERT INTO invitations(client_profile,user_token,invitation, status, invite_date, client_status)";
	$query_check .= "VALUES($client_profile,'{$invites}','invited', 'WAIT', CURRENT_TIMESTAMP, 'Not_checked')";
	
	$result_query = mysqli_query($connection,$query_check);
	if($result_query)
	{
		header("Location: client_invitations.php");
	}
	
	

	$clientprofile = "";
	$usertoken = "";
	if(isset($_GET['client_id']))
	{
		if(isset($_GET['usertoken']))
		{
			$clientprofile = $_GET['client_id'];
			$usertoken = $_GET['usertoken'];	
		}
	}
	$query_update = "UPDATE invitations SET invitations.client_status = 'Checked' WHERE invitations.client_profile = {$clientprofile} AND invitations.user_token = '{$usertoken}' ";
	$result_update = mysqli_query($connection,$query_update);
	if($result_update)
	{
		header("Location: client_invitations.php");
	}

	?>




	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Your Invites </title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="my-hires.css">

		<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>
		<style>
			body {
				min-height: 100%;
				background-image: -webkit-linear-gradient(65deg, rgb(0, 0, 0), rgba(45, 168, 168, 0.658));
			}

			.container {
				padding-top: 1%;
			}

			.top-header {
				border-radius: 11px 0 110px 0;
				padding: 0.5% 13%;
				margin-bottom: 1%;
			}

			.top-header a {
				color: white;
			}

			.content .card-header {
				border-radius: 0 0 150px 150px;
			}

			.card:hover {
				background-color: rgb(242, 247, 246);
			}

			.card-link {
				text-decoration: none;
				cursor: pointer;
			}

			.row {
				margin: 0;
			}

			ul.navbar-nav a:hover {
				color: wheat !important;
			}

		</style>
	</head>

	<body class="text-left">

		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
			<a class="navbar-brand" style="color: teal; font-weight: bold;" href="client_invitations.php"><img src="images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px; margin-bottom: -15px;"> Your Invites <br>
				<span style="font-size: 15px; margin-left: 50px;">( INIESTA )</span></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a href="client-dashboard.php" class="nav-link" style="padding-top: 20px; color: white;">Back To Dashboard </a>
					</li>
					<li class="nav-item dropdown">
						<a href="search_freelancer.php" class="nav-link" style="padding-top: 20px; color: white;"> Invite a Freealncer </a>
					</li>

					<li class="nav-item dropdown">
						<a type="button" class="nav-link" style="color: white;">
							<?php echo $_SESSION['client_firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['client_userrole']."</span> )"; ?>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link" href="logout.php" style="padding-top: 20px; color: red;"> Logout </a>
					</li>
				</ul>
			</div>
		</nav>
		<form action="" method="post">
			<div class="row justify-content-md-center mb-3 content">
				<div class="col-md-8">
					<div class="card-header bg-dark text-center">
						Invites
					</div>

				</div>
			</div>
			<div class="row justify-content-md-center">
				<div class="col-md-8">
					<div class="card mb-1">
						<?php 	
					$verify = false;
			$select = "";
			if(isset($_POST['submit']))
			{
				$select = $_POST['select1'];
			}
			$query = "SELECT * FROM profilee, titletb, hourlytb, invitations WHERE profilee.profile_id = titletb.profile_id 
			AND hourlytb.profile_id = profilee.profile_id AND invitations.user_token = profilee.user_token_id ORDER BY invite_date DESC ";
			$result = mysqli_query($connection,$query);
			while($row = mysqli_fetch_array($result))
			{
				$verify = true;
				$user_name = $row['firstname'];
				$expertise = $row['expertise'];
				$title = $row['title'];
				$description = $row['professional_overview'];
				$rate = $row['hourly_rate'];
				$skills = $row['skills'];
				$user_token = $row['user_token_id'];
				$status = $row['status'];
				$client_status = $row['client_status'];
				$accepted_date = $row['user_accepted_date'];
			
			
		?>

						<div class="card-body">

							<h5 class="card-title">Freelancer's Name: <?php echo $user_name; ?></h5>
							<h6>Expertise: <span class="font-weight-bold"><?php echo $expertise; ?></span></h6>
							<p> $<?php echo $rate; ?> / <span class="text-muted">hr</span></p>
							<p class="card-text">
								<span class="font-weight-bold">About:</span><br>
								<?php echo $description; ?>
							</p>
							<p><b>Skills: </b> <?php echo $skills; ?></p>
							<?php 
						if($client_status == 'Checked')
						{
							echo "<a href = '#'><p class='text-right'><button class='btn btn-success' type='button'> Chat </button></p></a>";
							echo "<p style='margin-top: -5%;'> <b>Status : </b>  $status</p><br>
								 <p style='margin-top: -4%;'><b>Accepted on: </b> $accepted_date </p>";
						}
						else
						{
							echo "<p class='text-right'><button class='btn btn-success' type='button' disabled> Invited </button></p>";
							echo "<p style='margin-top: -5%;'> <b>Status : </b> 'Waiting' </p>";
						}
						
						?>
							<!-- <p><i class="fas fa-map-marker-alt"></i> India</p> -->

						</div>

						<div class="card-footer"><i class="fas fa-map-marker-alt"></i> India </div>
						<hr style="border: 1px dashed black;">
						<?php  } if(!$verify) { ?>

						<div class="text-center" style="height: 300px; margin-top: 10px;">
							<img src="images/emp.png" alt="" style="height:110px;weight:110px;"><br><br>
							<h3>Please Invite A freelancer <a href="search_freelancer.php">Click Here to Invite</a></h3>
							<p>Your Invited Freelancer Displays Here.</p>
						</div>


						<?php } ?>


					</div>

					<!-- Demo cards: Remove this while doing backend on it -->
					<!-- Upto here -->
				</div>
			</div>

		</form>



		<!-- footer -->
		<div class="footer text-center mt-3">
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
							Our goal is to develop and nurture the world's largest digital marketplace, a place where
							people
							can find and purchase all the services they need and create any company they dream of. As an
							employee, the progress of our users and the celebration of your own personal development
							inspires your work. Join in with us. <br>
							<b>Our purpose comes first.</b><br>
							It still feels like day one We believe the freelance economy is still at its earliest
							stages. We
							take
							the view that — as early advocates of it — our task is to do it as holistically as we can,
							to
							introduce to all our goal of encouraging people to dream of living their work. <br>
							We are an organisation powered by intent. Everything we do stems from our desire to inspire
							people around the world to live their dream of working, develop their company from the
							ground
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
							realized his close friend in Athens would be perfect for an internet project. The team
							agreed he
							was the most effective choice, but were concerned about working with someone halfway round
							the
							globe. <br>

							<b>A new way of working is born</b><br>
							In response, the 2 friends created a brand new web-based platform that brought visibility
							and
							trust to remote work. it had been so successful the 2 realized other businesses would also
							take
							pleasure in reliable access to a bigger pool of quality talent, while workers would enjoy
							freedom and adaptability to seek out jobs online. Together they decided to begin a
							corporation
							that might deliver on the promise of this technology.
							Fast-forward to today, that technology is that the foundation of Iniesta — the most
							important
							global freelancing website. With countless jobs posted on Iniesta annually, freelancers are
							earning money by providing companies with over 5,000 skills across over 70 categories of
							labor.
							<br>
							<b>A world of opportunities</b><br>
							Through Iniesta businesses get more done, connecting with freelancers to figure on projects
							from
							web and mobile app development to SEO, social media marketing, content writing, graphic
							design,
							admin help and thousands of other projects. Iniesta makes it fast, simple, and
							cost-effective to
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
