<?php 
include "../DB.php";
include "../auth.php";
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
								<a class="nav-link" href="Client_Job_Post.php"  data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth"> Client Jobs Post
								</a>
								
								<a class="nav-link" href="Client_Hired_Status.php"  data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth"> Client Hired Status
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
					<h1 class="mt-4"> Client Job Profile </h1>
					<ol class="breadcrumb mb-4">
						<li class="breadcrumb-item"><a href="admin_index.php">Dashboard</a></li>
						<li class="breadcrumb-item active">Client Job Profile </li>
					</ol>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Action</th>
										<th>Client User_ID </th>
										<th>Client Name</th>
										<th>Email</th>
										<th>So Far Job Posted</th>
										<th>Client Mobile No. </th>
										<th>Client Company</th>
										<th>Client Address</th>
										<th>Client Contact No.</th>
										<th>Client Contact Email</th>
										<th>Client Image</th>

									</tr>
								</thead>
								<tbody>
									<?php
										
										$query_r = "SELECT * FROM regestration WHERE user_role = 'Client' ";
										$result_r = mysqli_query($connection,$query_r);
										while($row = mysqli_fetch_array($result_r))
										{
											$user_id = $row['user_id'];
											$firstname = $row['firstname'];
											$lastname = $row['lastname'];
											$user_email = $row['user_email'];
											
											$query_check = "SELECT * FROM client_job_posting WHERE client_id = {$user_id}  ";
											$result_check = mysqli_query($connection,$query_check);
											$jobs = mysqli_num_rows($result_check);
											
											$query_client = "SELECT * FROM client_profile WHERE client_id = {$user_id} ";
											$result_client = mysqli_query($connection,$query_client);
											while($row = mysqli_fetch_array($result_client))
												{
													$client_profile_id = $row['client_id'];
													$client_mobile = $row['client_mobile'];
													$clientimage = $row['client_image'];
													$clientcompany = $row['client_company'];
													$companyaddress = $row['company_address'];
													$client_contact_email = $row['contact_email'];
													$client_contact_number = $row['contact_number'];
									?>
										
										
									<tr>
										<td><a href="ClientsJobsProfile.php?delete=<?php echo $client_profile_id; ?>" style="color: red;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
										<td class="text-info"><b><?php echo $user_id; ?></b></td>
										<td><?php echo $firstname. "&nbsp;". $lastname; ?></td>
										<td><?php echo $user_email; ?></td>
										<td><b><?php if($jobs >= 1){echo "<a href='Client_Job_Post.php'>$jobs</a>"; } else{echo "0"; } ?></b></td>
										<td><?php echo $client_mobile; ?></td>
										<td><?php echo $clientcompany ?></td>
										<td><?php echo $companyaddress; ?></td>
										<td><?php echo $client_contact_number; ?></td>
										<td><?php echo $client_contact_email; ?></td>
										<td><?php echo $clientimage; ?></td>

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
				$query = "DELETE FROM client_profile WHERE client_id = {$delete_id} ";
				$result = mysqli_query($connection,$query);
				if($result)
				{
					header('Location: ClientsJobsProfile.php');
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