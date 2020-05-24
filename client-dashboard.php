<?php include "auth.php"; 
include "DB.php";
$profile_id = $_SESSION['client_id'];
if($_SESSION['client_userrole'] !== 'Client' )
{
	header("Location: register.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post Jobs</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css">
	<link rel="icon" type="image/png" href="images/iniesta-logo.jpg">

	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light text-left">

	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="client-dashboard.php"><img src="images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px; margin-bottom: -10px;"> Client Dashboard<br>
			<span style="font-size: 15px; margin-left: 80px;">( INIESTA )</span> </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<style>
				ul.navbar-nav a:hover {
					color: wheat !important;
				}


				.noti {
					padding: 10px;
					text-align: center;
					/*		font-weight: bold;*/
					font-family: 'Roboto Slab', serif;
				}

				.noti span {
					background-color: limegreen;
					border-radius: 30px;
					font-size: 15px;

				}

				.dropdown-divider {
					margin: 0 !important;
				}

				.dropdown-item {
					background-color: ghostwhite;
				}

				.dropdown-item img {
					width: 50px;
					height: 50px;
					border-radius: 50px;
				}

				small {
					font-style: italic;
				}

				ul.mr-auto a:hover {
					color: black !important;
				}

				body {

					min-height: 100vh;
					background-image: -webkit-linear-gradient(65deg, rgb(0, 0, 0), rgba(45, 168, 168, 0.658));
					font-family: "proxima-nova", "Source Sans Pro", sans-serif;
					font-size: 1em;
					letter-spacing: 0.1px;
					color: #32465a;
					text-rendering: optimizeLegibility;
					text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
					-webkit-font-smoothing: antialiased;
					overflow-x: hidden;
				}

			</style>




			<ul class="navbar-nav ml-auto">
				<?php
				$query = "SELECT * FROM client_job_posting, users_applied_jobs
					WHERE client_job_posting.c_token = users_applied_jobs.client_token  AND client_job_posting.client_id = {$profile_id} ";
				$result = mysqli_query($connection,$query);
				while($row = mysqli_fetch_array($result))
				{
					$freelancer_id = $row['user_profile_id']; 
				
				
				
				$message = "";
				$query = "SELECT * FROM chat_message WHERE from_user_id = {$freelancer_id} AND status = 1 ";
				$result = mysqli_query($connection,$query);
				while($row = mysqli_fetch_array($result))
				{
					$message++;
				}
				}
				?>

				<li class="nav-item dropdown">
					<a href="client_chat.php" class="nav-link" style="padding-top: 20px; color: white;"><i class="fas fa-envelope"> </i> </a>
				</li>&nbsp;

				<?php if($message>0) { ?>
				<span class="text-success" style="margin-top: 10px; font-weight: bold; margin-left: -10px;"> <?php echo $message; ?></span>
				<?php } ?>&nbsp;&nbsp;


				<li class="nav-item dropdown">
					<a href="client_profile/view_update_profile.php" class="nav-link" style="padding-top: 20px; color: white;">Check Profile &nbsp;</a>
				</li>
				<li class="nav-item dropdown trainings">
					<a href="applied_freelancer.php" class="nav-link" style="padding-top: 20px; color: white;"> Applied Freelancer </a>
				</li>&nbsp;



				<ul class="navbar-nav mr-auto" style="hover: none;">
					<li class="nav-item dropdown">
						<style>
							.fa-bell:hover {
								color: wheat !important;
							}

						</style>

						<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

							<i class="fas fa-bell" style="color: white; padding-top: 18px;">
								<?php 
							$count = "";
					$query = "SELECT * FROM client_job_posting, users_applied_jobs
					WHERE client_job_posting.c_token = users_applied_jobs.client_token  AND client_job_posting.client_id = {$profile_id} AND  users_applied_jobs.status = 'unread' ";
					$result_query = mysqli_query($connection,$query);
					while($row = mysqli_fetch_assoc($result_query))
					{
						$count++;
						
					}
					if($count>0)
					{
					?>
								<span class="badge badge-success"> <?php echo $count; ?></span>
								<?php } ?>
							</i>
						</a>

						<div style="margin-left: -20px;" class="dropdown-menu" aria-labelledby="navbarDropdown">
							<p class="noti" style="text-align: center; ">Notifications <span class="badge badge-success"> <?php echo $count; ?></span></p>
							<div class="dropdown-divider"></div>
							<?php
					$query = "SELECT * FROM client_job_posting, users_applied_jobs
					WHERE client_job_posting.c_token = users_applied_jobs.client_token  AND client_job_posting.client_id = {$profile_id} ";
					$result_query = mysqli_query($connection,$query);
					while($row = mysqli_fetch_assoc($result_query))
					{
						$date = $row['date'];
						$applied_for = $row['applied_for'];
						$status = $row['status'];
						$username = $row['user_name'];
						$client_token = $row['client_token'];
						$user_token = $row['user_token_id'];
						
					
					?>
							<a class="dropdown-item" href="applied_freelancer.php?client_token=<?php echo $client_token.'&user_token='.$user_token; ?> ">
								<p><?php echo $username; ?><br><?php if($status == 'unread'){echo "<b><span style='color: lightskyblue;'>$applied_for</span></b>";}else{ echo $applied_for; } ?><br><small>Applied on: <?php echo $date; ?></small></p>
							</a>
							<div class="dropdown-divider"></div>
							<?php } ?>
						</div>
					</li>
				</ul>&nbsp;

				<li class="nav-item dropdown">
					<a type="button" class="nav-link" style="color: white;">
						<?php echo $_SESSION['client_firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['client_userrole']."</span> )"; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="logout.php" style="padding-top: 20px; color: red;" data-toggle="modal" data-target="#myModal"> Logout </a>
				</li>
				<!-- The Modal -->
				<div class="modal fade" id="myModal">
					<div class="modal-dialog">
						<div class="modal-content">
							<!-- Modal Header -->
							<div class="modal-header" style="background-color: tan;">
								<h4 class="modal-title" style="color: red;">Are You Sure to Logout? </h4>
								<button type="button" class="close" data-dismiss="modal">×</button>
							</div>
							<!-- Modal body -->
							<div class="modal-body">
								All Your Data will be Saved.
							</div>
							<!-- Modal footer -->
							<div class="modal-footer">

								<button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button>
								<a class="btn btn-primary" href="logout.php" style="color: white;"> Logout </a>
							</div>
						</div>
					</div>
				</div>
			</ul>
		</div>
	</nav>

	<div class="container top-container-client-dashboard">
		<div class="text-right mb-5 mt-3">
			<a href="view_job_post.php" class="btn btn-info"> View Posted Jobs </a>
			&nbsp;&nbsp;
			<a href="my-hired.php" class="btn btn-secondary text-light"> View Hired Freelancer </a>
			<?php
			
			$query = "SELECT * FROM invitations WHERE client_status = 'Not_checked' AND status = 'Accepted' AND client_profile = {$profile_id} ";
			$query_update = mysqli_query($connection,$query);
			while(mysqli_fetch_array($query_update))
			{
				$count++;
			}
			
			?>


			<a href="search_freelancer.php" class="btn btn-info text-light" style="float: left;"><i style="color: lightgreen;" class="fas fa-search"></i>&nbsp; Serach Freelancer
				&nbsp;<span style="color: black; font-size: 18px;"><b><?php echo $count; ?></b></span> </a>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-md-6">
				<div class="card text-center card-client-dashboard">
					<div class="card-header bg-dark text-light card-header-client-dashboard" style="border-radius: 10px 10px 0 0;">
						My Job Postings
					</div>
					<div class="card-body" style="padding: 10% 5%;">

						<?php
						$check_jobs = true;
						$count = "";
						$query_check = "SELECT * FROM client_job_posting WHERE client_id = {$profile_id}  ";
						$result_check = mysqli_query($connection,$query_check);
						 $row = mysqli_num_rows($result_check);
						if($row >= 1)
						{
						?>
						<div class="alert alert-info" role="alert">
							<strong> Note! </strong> So! Far Job Posted: <a href="view_job_post.php" class="alert-link" style="color: blue;"><?php echo $row."+"; ?></a>
						</div>
						<?php } else { ?>
						<div class="alert alert-warning">
							<strong> Note! </strong> It has been seen that You haven't Posted Any Job Yet!
						</div>
						<?php } ?>
						<a class="btn btn-secondary btn-lg btn-block" href="post-a-job.php">Post a Job</a>
						<br>
						<p class="card-text">
							<h5 class="teal"><b>Or use a job template to get started!</b></h5>

							<br>
							<i class="fas fa-sign-in-alt fa-5x text-secondary"></i>
					</div>
				</div>
			</div>
		</div>
	</div>


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
