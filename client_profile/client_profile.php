<?php 
include "../auth.php";
include "../DB.php";
if($_SESSION['client_userrole'] !== 'Client' )
{
	header("Location: ../register.php");
}
?>

<?php
if(isset($_POST['submit']))
{
	$client_id = $_SESSION['client_id'];
	$client_name = $_SESSION['client_firstname'];
	$client_email = $_SESSION['client_email'];
	$client_mobile = trim($_POST['mobile_number']);
	$client_company = trim($_POST['company_name']);
	$company_address = trim($_POST['company_address']);
	$client_contact_email = trim($_POST['contact_email']);
	$client_contact_number = trim($_POST['contact_number']);
	$client_image = $_POST['image'];
	
	$client_mobile = mysqli_real_escape_string($connection,$client_mobile);
	$client_contact_email = mysqli_real_escape_string($connection,$client_contact_email);
	$client_contact_number = mysqli_real_escape_string($connection,$client_contact_number);
	
	$query_insert = "INSERT INTO client_profile(client_id, client_name, client_email, client_mobile, client_image, client_company, company_address, contact_email, contact_number) ";
	$query_insert .= "VALUES($client_id, '{$client_name}', '{$client_email}', '{$client_mobile}', '{$client_image}', '{$client_company}', '{$company_address}', '{$client_contact_email}', '{$client_contact_number}')";
	$result_query = mysqli_query($connection,$query_insert);
	if($result_query)
	{
		header("Location: ../client-dashboard.php");
	}
	else{
		header("Location: client_profile.php");
	}
}




?>





<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">

	<style media="screen">
		#container {
			width: 50%;
			padding: 2%;
			margin: 10px auto;
		}

		#image {
			width: 96%;
			padding: 2%;
			border: 1px dashed green;
		}

		#header {
			background: #405570;
			color: white;
			text-align: center;
			padding: 2%;
		}

		#view-image {
			border-radius: 5px;
			overflow: hidden;
		}

		#preview-image {
			padding: 1%;
			border: 1px solid #efefef;
			height: 400px;
		}

		.form-control {
			border: none;
			border-bottom: 3px green solid;
		}

	</style>
</head>

<body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="jquery-3.5.1.min.js"></script>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="#"><img src="../images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px;"> INIESTA Freelancing</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown trainings">
					<a href="" class="nav-link" style="padding-top: 20px;">Report</a>
				</li>
				<li class="nav-item dropdown">
					<a type="button" class="nav-link" style="color: white;">
						Login as <?php echo $_SESSION['client_firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['client_userrole']."</span> )"; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="../logout.php" style="padding-top: 20px;"> Logout </a>
				</li>
			</ul>
		</div>
	</nav>


	<center>
		<h1> Let's Build Your Profile </h1>
	</center> <br><br><br><br>
	<div class="container">

		<form action="" method="post">
			<div class="row">
				<div class="col-sm">
					<div id="container">
						<form action="upload_file.php" method="post">
							<input type="file" name="image" id="image" / required>
						</form>
						<div id="veiw-image">
							<h3 id="header">Profile Image</h3>
							<div id="preview-image">

							</div>
						</div>
					</div>
					<button class="btn btn-success" name="submit" type="submit">Submit</button>
				</div>
				<br>

				<div class="col-md">
					<h2>Client Details</h2>

					<h4>Name: <div class="input-group mb-3">
							<input id="input1" type="text" class="form-control" value="<?php echo $_SESSION['client_firstname']; ?>" aria-describedby="button-addon2" disabled>

						</div>
					</h4>

					<h4>Email Address: <div class="input-group mb-3">
							<input id="input2" type="email" class="form-control" value="<?php echo $_SESSION['client_email']; ?>" aria-describedby="button-addon2" disabled>

						</div>
					</h4>

					<h4>Mobile Number: <div class="input-group mb-3">
							<input id="input3" type="number" class="form-control" value="" aria-describedby="button-addon2" name="mobile_number" required>

						</div>
					</h4>
					<h2>Company Details</h2>
					<br>

					<h4> Company Name: <div class="input-group mb-3">
							<input id="input4" type="text" class="form-control" value="" aria-describedby="button-addon2" name="company_name" required>

						</div>
					</h4>


					<h4> Address : <div class="input-group mb-3">
							<input id="input5" type="text" class="form-control" value="" aria-describedby="button-addon2" name="company_address" required>

						</div>
					</h4>
					<br>
					<h2>Contact Details</h2>
					<br>

					<h4>Email : <div class="input-group mb-3">
							<input id="input6" type="text" class="form-control" value="" aria-label="Email" aria-describedby="button-addon2" name="contact_email" required>

						</div>
					</h4>
					<br>

					<h4>Contact Number: <div class="input-group mb-3">
							<input id="input7" type="text" class="form-control" value="" name="contact_number" aria-label="contactnumber" aria-describedby="button-addon2" required>

						</div>
					</h4>

				</div>

			</div>
		</form>


		<script type="text/javascript">
			$(document).ready(function() {
				$('#image').change(function() {
					var data = new FormData();
					data.append('file', $('#image')[0].files[0]);
					$.ajax({
						url: 'upload_file.php',
						type: 'POST',
						data: data,
						processData: false,
						contentType: false,
						beforeSend: function() {
							$('#preview-image').html('Loading...');
						},
						success: function(data) {
							// alert(data);
							$('#preview-image').html('<img  src="' + data + '" style="width:100%"/>');

						}
					});
					return false;
				});
			});

		</script>
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
				<h6><a href="../TERMS OF SERVICES.pdf">Terms of services</a></h6>
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
	<script lang="javascript" type="text/javascript">
		window.history.forward();

	</script>

</body>

</html>
