<?php 
include "auth.php";
include "DB.php";
if($_SESSION['userrole'] !== 'Freelancer' )
{
	header("Location: register.php");
}
?>
<?php 
$user_profile_id = $_SESSION['id'];
?>


<?php 
	$client_id = "";
	$user_token = "";
	if(isset($_GET['client_id']))
	{
		if(isset($_GET['user_token']))
		{
			$client_id = $_GET['client_id'];
			$user_token = $_GET['user_token'];
		}
	}
	$query_update = "UPDATE invitations SET invitations.status = 'Accepted', invitations.user_accepted_date = CURRENT_TIMESTAMP WHERE user_token = '{$user_token}' AND client_profile = {$client_id}";
	$result_update = mysqli_query($connection,$query_update);
	if($result_update)
	{
		header("Location: user_accepted_invitation.php");
	}

	$query = "SELECT * FROM profilee WHERE profilee.profile_id = {$user_profile_id} ";
	$result = mysqli_query($connection,$query);
	while($row = mysqli_fetch_array($result))
	{
		$user_token_id = $row['user_token_id'];
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
		.container {
			padding-top: 1%;
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

	</style>
</head>

<body class="bg-light text-left">

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
					<a class="nav-link" href="user_dasboard.php" style="padding-top: 20px; color: white"> Back To Dashboard </a>
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

	<div class="container">
		<div class="top-header bg-dark text-light text-center">
			<h1> Client Invites </h1>
		</div>
	</div>

	<div class="tab-content" id="myTabContent">
		<!------------------------------------------ my feed ----------------------------------------->
		<div class="tab-pane fade show active container" id="home" role="tabpanel" aria-labelledby="home-tab">
			<div class="row justify-content-md-center">




				<?php 
				$verify = false;
			$query = "SELECT * FROM invitations WHERE invitations.invitation = 'invited' AND invitations.status = 'Accepted' AND invitations.user_token = '{$user_token_id}' ";
				$result = mysqli_query($connection,$query);
				while($row = mysqli_fetch_array($result))
				{
					$verify = true;
					$client_id = $row['client_profile'];
					$client_status = $row['client_status'];
					$client_invited_date = $row['invite_date'];
					$your_accepted_date = $row['user_accepted_date'];
					$your_status = $row['status'];
					
					$query_verify = "SELECT * FROM client_profile WHERE client_profile.client_id = {$client_id} ";
					$result_query = mysqli_query($connection,$query_verify);
					while($row = mysqli_fetch_array($result_query))
					{
						$company_name = $row['client_company'];
						$client_email = $row['client_email'];
						$client_name = $row['client_name'];
				
				
				
				
				?>
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"><b>Company Name :</b> <?php echo $company_name; ?></h5>
							<h6><b>Client Name : </b> <?php echo $client_name; ?> <p style="float: right;"><b>Invited On : </b><span class="text-uppercase"><?php echo $client_invited_date; ?></span></p>
							</h6>

							<p class="card-text">
								<b>Client Email :</b> <?php echo $client_email; ?>
							</p>
							<p><b>Your Status :</b> <?php echo $your_status; ?> <b>On</b> <?php echo $your_accepted_date; ?></p>
							<p><b>Client Status :</b> <?php echo $client_status; ?></p>

							<p><i class="fas fa-map-marker-alt"></i> India</p>

							<a href="index_2.php" class="btn btn-info" style="float:right; margin-top: -5%;"> Want to Chat </a>
						</div>
					</div>
				</div>

				<?php  }} if(!$verify) { ?>

				<div class="text-center" style="height: 100%; margin-top: 10px;">
					<img src="images/emp.png" alt="" style="height:110px;weight:110px;"><br><br>
					<h3>Its seems that none of the Client Invited you Yet! </h3>
					<h5> Want to Apply to a job <a href="find_work.php"> Check Here! </a></h5>
					<p> Client Invites Displays here. <strong>Note!</strong> Client Invites based on your Profile. <a href="view_profile.php">Update or View Profile</a></p>
				</div>
				<?php } ?>

			</div>

			<!-------------------------------------------- upto-here -------------------------------------------->
		</div>
		<!------------------------------------------ recommended ----------------------------------------->
		<div class="tab-pane fade container" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			<div class="row justify-content-md-center mb-3">
				<div class="col-md-8">
					<div class="card-header bg-dark text-center">
						Recommended
					</div>
				</div>
			</div>
			<div class="row justify-content-md-center">
				<div class="col-md-8">
					<div class="card">

						<div class="card-body">
							<h5 class="card-title">Company's Name</h5>
							<p>Fixed Price - Expert - Est. Budget $500 - Posted 13 minutes ago</p>
							<p class="card-text">
								Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, magnam blanditiis.
								Repellendus vitae ipsum laudantium. Cum veritatis placeat ullam non rerum quaerat modi
								est nesciunt at, fugit quod! Rerum, perferendis.
							</p>
							<p>Proposals: Less than 5</p>
							<p><i class="fas fa-map-marker-alt"></i> India</p>
						</div>
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
