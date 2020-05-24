<?php 
session_start();
ob_start();
include "DB.php";
include "functions.php";
?>

<?php 
$error = "";
$db_username = "";
$db_password = "";
$db_user_role = "";
$USERNAME = "";
$PASSWORD = "";
if(isset($_POST['signin']))
{
	$USERNAME = trim($_POST['username']);
	$PASSWORD = trim($_POST['password']);
	
	$username = mysqli_real_escape_string($connection,$USERNAME);
	$password = mysqli_real_escape_string($connection,$PASSWORD);
	
	$query = "SELECT * FROM login WHERE user_email = '{$username}' ";
	$result_query = mysqli_query($connection,$query);
	if(!$result_query)
	{
		die("Connection Failed!".mysqli_error($connection));
	}
	while($row = mysqli_fetch_assoc($result_query))
	{
		$db_id = $row['user_id'];
		$db_username = $row['user_email'];
		$db_lastname = $row['lastname'];
		$db_firstname = $row['firstname'];
		$db_password = $row['user_password'];
		$db_user_role = $row['user_role'];
	}
	if($db_username !== $USERNAME && $db_password !== $PASSWORD)
	{
//		$error = "Invalid Username or Password!";
		echo "<script>alert('Invalid Username or Password')</script>";
		
	}
	else if ($db_username == $USERNAME && $db_password == $PASSWORD && $db_user_role == "Client")
	{
		$_SESSION['firstname'] = $db_firstname;
		$_SESSION['userrole'] = $db_user_role;
		$_SESSION['id'] = $db_id;
		header("Location: client-dashboard.php");
	}
	
	else if ($db_username == $USERNAME && $db_password == $PASSWORD && $db_user_role == "Freelancer")
	{
		$_SESSION['id'] = $db_id;
		$_SESSION['userrole'] = $db_user_role;
		$_SESSION['firstname'] = $db_firstname;
		$_SESSION['lastname'] = $db_lastname;
		$_SESSION['email'] = $db_username;
		
		check_profile($_SESSION['id']);
	}
	
	
	else
	{
			echo "<script>alert('Invalid Username or Password')</script>";
	}
	
	$session_id = session_id();
	$_SESSION['auth'] = $session_id;
	
	

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> INIESTA </title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link href="style.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="images/iniesta-logo.jpg">
	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>

	<script>
		$(".contentContainer").css("min-height", $(window).height());
		$("#image").css("min-height", $("#beeweek").height());
		$(document).ready(function() {

			$("#submitButton").click(function() {

				$("#myModal").modal('show');
			})
		});
		$(".video-container").css("min-height", $(window).height());

	</script>


</head>

<body>



	<style>
		.fa-info-circle {
			color: black;
			float: right;
			position: absolute;
			top: 25px;
			right: 25px;
			font-size: 1.2em;
			border-color: black transparent transparent transparent;
		}

		ul.navbar-nav a:hover {
			color: wheat !important;
		}

	</style>



	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="#"><img src="images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px;"> INIESTA Freelancing</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">

				<li class="nav-item dropdown">
					<a href="#" class="nav-link" style=" color: white;">Solutions</a>
				</li>
				<li class="nav-item dropdown trainings">
					<a href="register.php" class="nav-link" style=" color: white;">Post a job</a>
				</li>
				<li class="nav-item dropdown">
					<a href="register.php" class="nav-link" style=" color: white;">Register</a>
				</li>
				<li class="nav-item dropdown">
					<a type="button" class="nav-link" data-toggle="modal" data-target="#exampleModal" style="color: yellow;">
						Login >
					</a>
				</li>
			</ul>
		</div>
	</nav>


	<!-- Login modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Login</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="index.php" method="post">
					<div class="modal-body">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Username" name="username" required><a href="#" onclick="return false" data-toggle="tooltip" title="Username is your Email Id which you provided at the time of registeration"><i class="fas fa-info-circle"></i></a>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" name="password" required>

						</div>
						<div style="text-align: right;">
							<a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forget password?</a>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="signin" class="btn btn-info">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Login modal end -->



	<div class="welcome-title">
		<h1>In-demand talent on demand&#8482;</h1>
		<h1 class="green">INIESTA-Freelancing is how.</h1>
		<h6>INIESTA-Freelancing expertly connects professionals and agencies to businesses seeking specialized talent.
		</h6>
	</div>

	<style>
		.card-body p {
			color: black;
		}

	</style>
	<!-- <hr class="green"> -->
	<div class="container-fluid body-section" style="padding-top: 4%;">
		<?php //echo $count; ?>
		<h1 style="color: teal; text-shadow: 1px 1px 2px grey; line-height: 2;">Find quality talent and agencies</h1>
		<div class="category-container row">
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Web,Mobile&SoftwareDev.png" class="card-img-top" alt="...">
					<div class="card-body">
						<a href="register.php">
							<p>Mobile & Website dev</p>
						</a>
					</div>
				</div>
			</div>

			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Writing.png" class="card-img-top" alt="...">
					<div class="card-body">
						<a href="register.php">
							<p>Writing</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Sales&Marketing.png" class="card-img-top" alt="...">
					<div class="card-body">
						<a href="register.php">
							<p>Sale & Marketing</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Engineering&Architecture.png" class="card-img-top" alt="...">
					<div class="card-body">
						<a href="register.php">
							<p>Engineering & Architecture</p>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="category-container row">
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Design&Creative.png" class="card-img-top" alt="...">
					<div class="card-body"><a href="register.php">
							<p>Design & Creative</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/DataScience&Analytics.png" class="card-img-top" alt="...">
					<div class="card-body"><a href="register.php">
							<p>DataScience & Analytics</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/CustomerService.png" class="card-img-top" alt="...">
					<div class="card-body"><a href="register.php">
							<p>Customer Service</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Admin Support.png" class="card-img-top" alt="...">
					<div class="card-body"><a href="register.php">
							<p>Admin Support</p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- footer -->
	<div class="footer">
		<div class="footer-top row">
			<div class="col-lg-4">
				<h5><u><b>Help for you</b></u></h5>
				<h6><a type="button" data-toggle="modal" data-target="#contactModal">Contact Support</a></h6>
				<h6>FAQs</h6>
			</div>
			<div class="col-lg-4">
				<h5><u><b>Safety and Privacy</b></u></h5>
				<h6><a href="terms.pdf">Terms of services</a></h6>
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
		<a href="">
			<h6>&copy; INIESTA 2020</h6>
		</a>
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

	<script lang="javascript" type="text/javascript">
		window.history.forward();

	</script>

	<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

	</script>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="index.js"></script>
</body>

</html>
