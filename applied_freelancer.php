<?php include "auth.php"; 
include "DB.php";
include "functions.php";
if($_SESSION['client_userrole'] !== 'Client')
{
	header("Location: register.php");
}
$profile_id = $_SESSION['client_id'];
$user_token = "";
$client_token = "";

if(isset($_GET['client_token']))
{
	if(isset($_GET['user_token']))
	{
		$user_token = $_GET['user_token'];
		$client_token = $_GET['client_token'];
	}
}

$query_update = "UPDATE users_applied_jobs SET status = 'read' WHERE users_applied_jobs.client_token = '{$client_token}' 
AND users_applied_jobs.user_token_id = '{$user_token}' ";
$result_update = mysqli_query($connection,$query_update);
confirmQuery($result_update);


?>









<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post Jobs</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="my-hires.css">
	<link rel="stylesheet" href="style.css">

	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light text-left">
	<style>
		ul.navbar-nav a:hover {
			color: wheat !important;
		}

	</style>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="applied_freelancer.php"><img src="images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px; margin-bottom: -12px;"> Applied Freelancer <br> <span style="font-size: 15px; margin-left: 70px;">( INIESTA )</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a href="client-dashboard.php" class="nav-link" style="padding-top: 20px; color: white;">Back To Dashboard </a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="my-hired.php" style="padding-top: 20px; color: white;"> Hired Freelancer </a>
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


	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light rounded" id="head-navbar">

			<ul class="nav nav-tabs" id="myTab1" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="mh" data-toggle="tab" href="#hires" role="tab" aria-controls="hires" aria-selected="true"> <b>Applied Freelancer</b> </a>
				</li>
			</ul>
		</nav>

		<!--***************************************	MAIN SECTION SATRTS          ************************************************-->

		<div class="jumbotron tab-content profile-tab" id="myTab1Content" style="border:2px solid grey;shadow:2px 3px;background:white;">
			<div class="tab-pane fade show active" id="hires" role="tabpanel" aria-labelledby="home-tab">
				<?php
				$verify = false;
				$hired_client_token = "";
				$hired_user_token = "";
				$query = "SELECT users_applied_jobs.client_token, users_applied_jobs.user_token_id, users_applied_jobs.hire_status, users_applied_jobs.user_name, users_applied_jobs.apply_date, 
				profilee.skills, regestration.user_email, e_leveltb.expertise_level, users_applied_jobs.applied_for, titletb.title, 
				employmenttb.employ_company ,employmenttb.employ_job_title FROM users_applied_jobs, client_job_posting , profilee, regestration, e_leveltb, titletb, employmenttb
				WHERE users_applied_jobs.client_token = client_job_posting.c_token AND client_job_posting.client_id = {$profile_id} AND profilee.user_token_id = users_applied_jobs.user_token_id
				AND regestration.user_id = users_applied_jobs.user_profile_id AND e_leveltb.profile_id = users_applied_jobs.user_profile_id AND users_applied_jobs.user_profile_id = titletb.profile_id 
				AND employmenttb.profile_id = users_applied_jobs.user_profile_id";
				
				$result = mysqli_query($connection,$query);
				while($row = mysqli_fetch_array($result))
				{
					$verify = true;
					$username = $row['user_name'];
					$skills = $row['skills'];
					$email = $row['user_email'];
					$e_level = $row['expertise_level'];
					$userrole_position = $row['title'];
					$apply_for = $row['applied_for'];
					$past_company = $row['employ_company'];
					$past_job_title = $row['employ_job_title'];
					$apply_date = $row['apply_date'];
					$hired_status = $row['hire_status'];
					$client_token_hire = $row['client_token'];
					$user_token_hire = $row['user_token_id'];
				
				
			?>
				<div id="content" class="Data border p-2" style="line-height: 1.8;;">
					<h4>Apply for : <?php echo $apply_for; ?></h4>
					<div class="row">
						<div class="col-sm-6"><span style="font-weight: bold;">Name :</span> <?php echo $username; ?> </div>
						<div class="col-sm-6"><span style="font-weight: bold;">Email :</span> <?php echo $email; ?></div>
						<div class="col-sm-6"><span style="font-weight: bold;">Skills :</span> <?php echo $skills; ?> </div>
						<div class="col-sm-6"><span style="font-weight: bold;">Level of Expertise :</span> <?php echo $e_level; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-6"><span style="font-weight: bold;">Role or Position :</span> <?php echo $userrole_position; ?> </div>
					</div>
					<div class="row">
						<div class="col-sm-6"><span style="font-weight: bold;"> Past Experience :</span> <?php echo $past_job_title." at " . $past_company; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-6"><span style="font-weight: bold;"> Apply On :</span> <?php echo $apply_date; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-12"> <a href="my-hired.php?hired_c_token=<?php echo base64_encode($client_token_hire).'&hired_u_token='.base64_encode($user_token_hire); ?>" style="float: right; margin-top: -20px;">
								<?php if($hired_status == 'unhired'){echo "<span class='btn btn-primary'> Want to Hire </span>"; } else { echo "<button class='btn btn-success' disabled> Hired </button>"; } ?> </a></div>
					</div>
				</div>
				<hr>
				<?php } if(!$verify) { ?>

				<div class="text-center" style="height: 100%; margin-top: 10px;">
					<img src="images/emp.png" alt="" style="height:110px;weight:110px;"><br><br>
					<h3>It's Seems that none of the freelancer has applied to your job Yet! </h3>
					<h5> Or It might be you haven't Posted a job yet. <a href="view_job_post.php"> Check Here! </a> Or Wait for freelancer</h5>
					<p>Any Freelancer applied to your jobs will Displays here.</p>
				</div>
				<?php } ?>


			</div>
		</div>
	</div>

	<!--**********************************88   MAIN ENDS            ************************************************-->


	<!-- footer -->
	<div class="footer">
		<div class="footer-top row text-center">
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
		<div class="footer-icons flex-container">
			<div><a href="https://www.facebook.com/iniestawebtech/"><i class="fab fa-facebook-f fa-2x" style="padding-left:20px"></i></a></div>
			<div> <a href="https://www.linkedin.com/in/iniesta-webtech-solution-private-limited-111b82184/"><i class="fab fa-linkedin fa-2x" style="padding-left:20px"></i></a></div>
			<div> <a href="https://www.instagram.com/iniestawebtech/"><i class="fab fa-instagram fa-2x" style="padding-left:20px"></i></a></div>
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
	<!--  <script>
  $(document).ready(function() {
		    $('#saved').hide();
        //$(".icha0").css({ 'background-color' : '', 'opacity' : '' });
        $("#se").removeClass("act");
        $('#mh').addClass("act");


		    });


  $('.abc').click(function() {
     $('#content div').hide();
     var target = '.' + $(this).data('target');
     $(target).show();
     $('#mh').removeClass("act");
     $('#se').addClass("act");
})
 $('#mh').click(function(){
   $(this).addClass("act");
   $('#se').removeClass("act");
 });
</script>-->
</body>

</html>
