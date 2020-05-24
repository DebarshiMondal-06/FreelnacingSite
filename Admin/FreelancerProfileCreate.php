<?php 
include "../DB.php";
include "../auth.php";
if($_SESSION['userrole'] !== 'Admin' )
{
	header("Location: ../register.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Freelancer Job Profile</title>
	<link href="css/styles.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<style>
	ul.navbar-nav a:hover {
		color: wheat !important;
	}

</style>

<body>
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="height: 75px;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="admin_index.php"><img src="../images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px; margin-bottom: -15px;"> Admin Panel <br>
			<span style="font-size: 15px; margin-left: 50px;">( INIESTA )</span></a>
		<ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
			<!--				<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>Login as <br>(Admin)</a>-->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="userDropdown" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
					Login as <?php echo $_SESSION['firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['userrole']."</span> )"; ?>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="../logout.php">Logout</a>
				</div>
			</li>
		</ul>
	</nav>
	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
				<div class="sb-sidenav-menu">
					<div class="nav">
						<div class="sb-sidenav-menu-heading">Core</div>
						<a class="nav-link" href="admin_index.php">
							<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
							Dashboard
						</a>
						<div class="sb-sidenav-menu-heading"> Activity </div>
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
							<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
							Freelancer Activity
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="FreelancerProfileCreate.php"> Freelancer Job Profile </a><a class="nav-link" href="FreelancerJobsApplied.php"> Jobs Applied </a></nav>
						</div>

						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
							<div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
							Client Activity
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>

						<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
								<a class="nav-link" href="ClientsJobsProfile.php" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth"> Client Job Profile
								</a>
								<a class="nav-link" href="Client_Job_Post.php" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth"> Client Jobs Post
								</a>

								<a class="nav-link" href="Client_Hired_Status.php" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth"> Client Hired Status
								</a>
							</nav>
						</div>

					</div>
				</div>
			</nav>
		</div>
		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid">
					<h1 class="mt-4"> FreeLancer Job Profile </h1>
					<ol class="breadcrumb mb-4">
						<li class="breadcrumb-item"><a href="admin_index.php">Dashboard</a></li>
						<li class="breadcrumb-item active">Freelancer Job Profile </li>
					</ol>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Action</th>
										<th>Freelancer User_ID </th>
										<th>Freelancer Name</th>
										<th>Email</th>
										<th>Conatct No: </th>
										<th>Freelancer_Expertise</th>
										<th>Skills</th>
										<th>Expertise Level</th>
										<th>Desgination</th>
										<th>Language Profiecency</th>
										<th>Education:(Degree/Branch/College)</th>
										<th>Past Experience</th>
										<th>Rate:</th>
										<th>Freelancer Address:(City/State/Country/Pincode) </th>
										<th>Freelancer Photo </th>

									</tr>
								</thead>
								<tbody>
									<?php
										
										$query_r = "SELECT * FROM regestration WHERE user_role = 'Freelancer' ";
										$result_r = mysqli_query($connection,$query_r);
										while($row = mysqli_fetch_array($result_r))
										{
											$user_id = $row['user_id'];
											$firstname = $row['firstname'];
											$lastname = $row['lastname'];
											$user_email = $row['user_email'];
											
											
											$query_freelacer = "SELECT * FROM regestration, profilee, eduactiontb, e_leveltb, employmenttb, hourlytb, locationtb, phonetb, languagetb,  
											titletb,  imagetb  WHERE profilee.profile_id = {$user_id} AND eduactiontb.profile_id = {$user_id} AND e_leveltb.profile_id = {$user_id} AND 
											employmenttb.profile_id = {$user_id} AND hourlytb.profile_id = {$user_id} AND locationtb.profile_id = {$user_id} AND phonetb.profile_id = {$user_id} 
											AND languagetb.profile_id = {$user_id} AND titletb.profile_id = {$user_id}  AND imagetb.profile_id = {$user_id} AND 
											regestration.user_id = {$user_id}";
											$result_freelancer = mysqli_query($connection, $query_freelacer);
											while($row = mysqli_fetch_array($result_freelancer))
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
											
												
											
										
										?>
									<tr>
										<td><a href="FreelancerProfileCreate.php?delete=<?php echo $user_id; ?>" style="color: red;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
										<td class="text-info"><b><?php echo $user_id; ?></b></td>
										<td><?php echo $firstname. "&nbsp;". $lastname; ?></td>
										<td><?php echo $user_email; ?></td>
										<td><?php echo $db_phone; ?></td>
										<td><?php echo $db_expertise; ?></td>
										<td><?php echo $db_skills; ?></td>
										<td><?php echo $db_level; ?></td>
										<td><?php echo $db_title; ?></td>
										<td>English: (<?php echo $db_english; ?>) Other: (<?php echo $db_other_lang; ?>) </td>
										<td><?php echo $db_degree."/ ".$db_area_study."/ ".$db_college; ?></td>

										<td><b>Company :</b>(<?php echo $db_company; ?>) <br><b>Job_title :</b> <?php echo $db_job_title; ?><br><b>Country: </b> <?php echo $db_country; ?></td>
										<td><b>$</b> <?php echo $db_rate; ?>/ hour</td>
										<td><?php echo $db_user_city. "/ ".$db_user_state. "/ ".$db_user_country. "/ ".$db_pincode ; ?></td>
										<td>Uplaoding..</td>

									</tr>

									<?php }} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</main>

			<?php
			if(isset($_GET['delete']))
			{
				$delete_id = $_GET['delete'];
				$query = "DELETE FROM profilee, eduactiontb, e_leveltb, employmenttb, hourlytb, locationtb, phonetb, languagetb,  
				titletb,  imagetb  WHERE profilee.profile_id = {$delete_id} AND eduactiontb.profile_id = {$delete_id} AND e_leveltb.profile_id = {$delete_id} AND 
				employmenttb.profile_id = {$delete_id} AND hourlytb.profile_id = {$delete_id} AND locationtb.profile_id = {$delete_id} AND phonetb.profile_id = {$delete_id} 
				AND languagetb.profile_id = {$delete_id} AND titletb.profile_id = {$delete_id}  AND imagetb.profile_id = {$delete_id} ";
				$result = mysqli_query($connection,$query);
				if($result)
				{
					header('Location: FreelancerProfileCreate.php');
				}
			}
					
			
			
			?>

			<footer class="py-4 bg-light mt-auto">
				<div class="container-fluid">
					<div class="d-flex align-items-center justify-content-between small">
						<div class="text-muted">Copyright &copy; Your Website 2019</div>
						<div>
							<a href="#">Privacy Policy</a>
							&middot;
							<a href="#">Terms &amp; Conditions</a>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="js/scripts.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="assets/demo/datatables-demo.js"></script>
</body>

</html>
