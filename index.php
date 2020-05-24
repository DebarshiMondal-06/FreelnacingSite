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
$db_admin_status = "";
$USERNAME = "";
$PASSWORD = "";
if(isset($_POST['signin']))
{
	$USERNAME = trim($_POST['username']);
	$PASSWORD = trim($_POST['password']);
	
	$username = mysqli_real_escape_string($connection,$USERNAME);
	$password = mysqli_real_escape_string($connection,$PASSWORD);
	
	$hashFormat = "$2y$10$";
	$salt = "iusesomecrazystrings22";
	
	$hashF_and_salt = $hashFormat . $salt;
	
	
	$password = crypt($password,$hashF_and_salt);
	
	$query = "SELECT * FROM regestration WHERE user_email = '{$username}' ";
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
		$db_email = $row['user_email'];
		$db_admin_status = $row['Admin_Status'];
	}
	if($db_username !== $USERNAME && $db_password !== $PASSWORD)
	{
//		$error = "Invalid Username or Password!";
		echo "<script>alert('Invalid Username or Password')</script>";
		
	}
	else if ($db_username == $username && $db_password == $password && $db_user_role == "Client" && $db_admin_status == 'Approved')
	{
		$_SESSION['client_email'] = $db_email;
		$_SESSION['client_firstname'] = $db_firstname;
		$_SESSION['client_userrole'] = $db_user_role;
		$_SESSION['client_id'] = $db_id;
                  $sub_query="
        INSERT INTO login_details 
        (user_id) 
        VALUES ('".$db_id."')
        ";
        $res2= mysqli_query($connection, $sub_query) or die();
        $_SESSION['user_id'] = $db_id;
		$_SESSION['userrole'] = $db_user_role;
        $_SESSION['username'] = $db_username ;
        $_SESSION['login_details_id']=$connection->insert_id;
		check_client_profile($_SESSION['client_id']);
	}
	else if ($db_username == $username && $db_password == $password && $db_user_role == "Freelancer" && $db_admin_status == 'Approved')
	{
		$_SESSION['id'] = $db_id;
		$_SESSION['userrole'] = $db_user_role;
		$_SESSION['firstname'] = $db_firstname;
		$_SESSION['lastname'] = $db_lastname;
		$_SESSION['email'] = $db_username;
		                $sub_query="
        INSERT INTO login_details 
        (user_id) 
        VALUES ('".$db_id."')
        ";
        $res2= mysqli_query($connection, $sub_query) or die();
        $_SESSION['user_id'] = $db_id;
		$_SESSION['userrole'] = $db_user_role;
        $_SESSION['username'] = $db_username ;
        $_SESSION['login_details_id']=$connection->insert_id;
		check_profile($_SESSION['id']);
	}
	else if ($db_username == $username && $db_password == $password && $db_user_role == "Admin" && $db_admin_status == 'Approved')
	{
		$_SESSION['id'] = $db_id;
		$_SESSION['userrole'] = $db_user_role;
		$_SESSION['firstname'] = $db_firstname;
		$_SESSION['lastname'] = $db_lastname;
        header('Location: Admin/admin_index.php');
		
	}
	
	
	else
	{
			echo "<script>alert('Invalid Username or Password or Status Not Approved')</script>";
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
	<title>Upwork</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css">

	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>



	<style>
		.dashed-box {
			margin: 10px;
			outline: dashed;
			outline-color: #C0C0C0;
			outline-offset: 10px;
			padding: 5px;
		}


		.card-img-top {
			border-radius: 15px;

			filter: grayscale(75%)
		}

		.choose {
			border-radius: 50%;
			height: 150px;
			width: 150px;
		}

		.bloglink {
			color: black;
		}

		.category-card .card .card-body font {
			text-align: center;
			align-items: center;
		}

		.category-card .card {

			border-radius: 15px;
			padding: 1%;
			background: white;

			-webkit-transition: 0.4s ease-out;
			transition: 0.4s ease-out;
			box-shadow: 0px 7px 10px rgba(0, 0, 0, 0.5);
		}

		.category-card .card:hover {
			-webkit-transform: translateY(20px);
			transform: translateY(20px);
		}

		.category-card .card:hover:before {
			opacity: 1;
		}

		.category-card .card:hover .info {
			opacity: 1;
			-webkit-transform: translateY(0px);
			transform: translateY(0px);
		}

		.category-card .card:before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			display: block;
			width: 100%;
			height: 100%;
			border-radius: 15px;
			background: rgba(0, 0, 0, 0.6);
			z-index: 2;
			-webkit-transition: 0.5s;
			transition: 0.5s;
			opacity: 0;
		}

		.fa-info-circle {
			color: black;
			float: right;
			position: absolute;
			top: 25px;
			right: 25px;
			font-size: 1.2em;
			border-color: black transparent transparent transparent;
		}

	</style>

</head>

<body style="background-color:#E8E8E8">

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
		<h1>Talent you seek is the talent we render&#8482;</h1>
		<h1 class="green">INIESTA-Freelancing Provides</h1>
		<h6>INIESTA-Freelancing expertly connects professionals and agencies to businesses seeking specialized talent.
		</h6>
		<h6>Find top Specialists on INIESTA-Freelancing —
			the Best freelancing website for short-term, recurring, and full-time contract work.</h6>
		<br>
		<a data-qa="cta" class="cta-group__btn btn btn-primary mb-0 mr-10" href="register.php" track-event="click">
			Get Started
		</a>
	</div>

	<!-- <hr class="green"> -->

	<div class="container-fluid body-section" style="padding-top: 4%;">
		<h1 style="color: teal; text-shadow: 1px 1px 2px grey; line-height: 2;">Find quality talent and agencies</h1>

		<div class="category-container row">
			<div class="category-card col-sm-3">
				<a class="bloglink" href="blogtemplate.html">
					<div class="card">
						<img src="images/Web,Mobile&SoftwareDev.png" class="card-img-top" alt="...">
						<div class="card-body">
							<font size="+1">Mobile & Website dev</font>
						</div>
					</div>
				</a>
			</div>
			<div class="category-card col-sm-3">
				<a class="bloglink" href="blogtemplate.html">
					<div class="card">
						<img src="images/Writing.png" class="card-img-top" alt="...">
						<div class="card-body">
							<font size="+1">Accounting & Consulting</font>
						</div>
					</div>
				</a>
			</div>
			<div class="category-card col-sm-3">
				<a class="bloglink" href="blogtemplate.html">
					<div class="card">
						<img src="images/Sales&Marketing.png" class="card-img-top" alt="...">
						<div class="card-body">
							<font size="+1">Sale & Marketing</font>
						</div>
					</div>
				</a>
			</div>
			<div class="category-card col-sm-3">
				<a class="bloglink" href="blogtemplate.html">
					<div class="card">
						<img src="images/Engineering&Architecture.png" class="card-img-top" alt="...">
						<div class="card-body">
							<font size="+1">Engineering & Architecture</font>
						</div>
					</div>
				</a>
			</div>
		</div>


		<div class="category-container row">
			<div class="category-card col-sm-3">
				<a class="bloglink" href="blogtemplate.html">
					<div class="card">
						<img src="images/Design&Creative.png" class="card-img-top" alt="...">
						<div class="card-body">
							<font size="+1">Design & Creative</font>
						</div>
					</div>
				</a>
			</div>
			<div class="category-card col-sm-3">
				<a class="bloglink" href="blogtemplate.html">
					<div class="card">
						<img src="images/DataScience&Analytics.png" class="card-img-top" alt="...">
						<div class="card-body">
							<font size="+1">DataScience & Analytics</font>
						</div>
					</div>
				</a>
			</div>
			<div class="category-card col-sm-3">
				<a class="bloglink" href="blogtemplate.html">
					<div class="card">
						<img src="images/CustomerService.png" class="card-img-top" alt="...">
						<div class="card-body">
							<font size="+1">Customer Service</font>
						</div>
					</div>
				</a>
			</div>
			<div class="category-card col-sm-3">
				<a class="bloglink" href="blogtemplate.html">
					<div class="card">
						<img src="images/Admin Support.png" class="card-img-top" alt="...">
						<div class="card-body">
							<font size="+1">Admin Support</font>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>

	<!--Hire Scope-->
	<div class="hire-scope" style="background-color:#FFFFFF; padding:4% 0% 4% 0%;">
		<div class="container">
			<div class="row">
				<div class="col-sm-3" style="padding-top: 4%;">
					<h4><b>Hire for any scope</b></h4>
				</div>
				<div class="col-sm-3" style="text-align: left;">
					<div class="dashed-box">
						<b>Complex project</b>
						<p style="padding-top: 4%;">Find specialized experts and agencies for large projects.</p>
					</div>
				</div>
				<div class="col-sm-3" style="text-align: left;">
					<div class="dashed-box">
						<b> Longer-term contract</b>
						<p style="padding-top: 4%;">Expand your team with a skilled resource.</p>
					</div>
				</div>
				<div class="col-sm-3" style="text-align: left;">
					<div class="dashed-box">
						<b> Short term </b>
						<p style="padding-top: 4%;">Build a pool of diverse experts for one-off tasks.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<!--hire scope end-->

	<!--WE Provide -->
	<div class="hire-scope" style=" padding:4% 0% 4% 0%;">
		<div class="container">
			<h3 style="color: teal; text-shadow: 1px 1px 2px grey; line-height: 2;">We Provide</h3>
			<div class="row">
				<div class="col-sm-4">
					<img class="choose" src="img/provide1.jpg">
					<div class="fc">
						<font size="+1">One place where you can find variety of job opportunities. </font>
					</div>
				</div>
				<div class="col-sm-4">
					<img class="choose" src="img/provide2.jpg">
					<div class="fc">
						<font size="+1">Flexible working hours to keep your motivation and hard work high.</font>
					</div>
				</div>
				<div class="col-sm-4">
					<img class="choose" src="img/provide3.jpg">
					<div class="fc">
						<font size="+1">Unlimited Potential and independence in work.</font>
					</div>
				</div>

				<div class="col-sm-4">
					<img class="choose" src="img/provide4.jpg" style="margin-top: 5%;">
					<div class="fc">
						<font size="+1">Compensation and Benefits according to your skills and qualification.</font>
					</div>
				</div>
				<div class="col-sm-4">
					<img class="choose" src="img/provide5.jpg" style="margin-top: 5%;">
					<div class="fc">
						<font size="+1">Maintain equal balance in your personal and professional life.</font>
					</div>
				</div>
				<div class="col-sm-4">
					<img class="choose" src="img/provide6.jpg" style="margin-top: 5%;">
					<div class="fc">
						<font size="+1" class="fc">Available at your place and accepted globally.</font>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--we provide end-->



	<!--why choose us-->
	<div class="chooseus" style="background-color:#FFFFFF;  padding:4% 0% 4% 0%;;">
		<div class="container">
			<h3 style="color: teal; text-shadow: 1px 1px 2px grey; line-height: 2;">Why Choose Us</h3>
			<div class="row">
				<div class="col-sm-2">
					<img class="choose" src="img/choose1.jpg">
					<div class="fc">
						<font size="+2">CREATIVE WORK ENVIRONMENT </font>
					</div>
				</div>
				<div class="col-sm-2">
					<img class="choose" src="img/choose2.jpg">
					<div class="fc">
						<font size="+2">QUALITY PACKAGE</font>
					</div>
				</div>
				<div class="col-sm-2">
					<img class="choose" src="img/choose3.jpg">
					<div class="fc">
						<font size="+2">GLOBAL REACH</font>
					</div>
				</div>
				<div class="col-sm-2">
					<img class="choose" src="img/choose4.jpg">
					<div class="fc">
						<font size="+2">REWARD</font>
					</div>
				</div>
				<div class="col-sm-2">
					<img class="choose" src="img/choose5.jpg">
					<div class="fc">
						<font size="+2">WIDER OPPURTUNITIES</font>
					</div>
				</div>
				<div class="col-sm-2">
					<img class="choose" src="img/choose6.jpg">
					<div class="fc">
						<font size="+2" class="fc">ENHANCE LIFE</font>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--why choose us end-->


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
				<h6><a href="TERMS OF SERVICES.pdf" target="_blank">Terms of services</a></h6>
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
			<a href="https://www.facebook.com/iniestawebtech/" target="_blank"><i class="fab fa-facebook-f fa-2x"></i></a>
			<a href="https://www.linkedin.com/in/iniesta-webtech-solution-private-limited-111b82184/" target="_blank"><i class="fab fa-linkedin fa-2x"></i></a>
			<a href="https://www.instagram.com/iniestawebtech/" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
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




	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="index.js"></script>
	<script lang="javascript" type="text/javascript">
		window.history.forward();

	</script>

	<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

	</script>
</body>

</html>
