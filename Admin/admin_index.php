<?php
ob_start();
include "../DB.php";
include "../auth.php";
include "../functions.php";
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
	<title> Admin DashBoard </title>
	<link href="css/styles.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<style>
	ul.navbar-nav a:hover {
		color: wheat !important;
	}

</style>

<body class="sb-nav-fixed">
	<div class="error-message"></div>
	<div class="success-message"></div>
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
					<h1 class="mt-4">Dashboard</h1>
					<ol class="breadcrumb mb-4">
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
					<div class="card mb-4">
						<div class="card-header"><i class="fas fa-table mr-1"></i> Regesitration - Users/ Clinet </div>

						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>User_ID </th>
											<th>Name</th>
											<th>Position/Role</th>
											<th>Email</th>
											<th>Approve</th>
											<th>Disapprove</th>
											<th>Operations</th>
										</tr>
									</thead>
									<tbody>
										<?php
										
										$query_r = "SELECT * FROM regestration";
										$result_r = mysqli_query($connection,$query_r);
										while($row = mysqli_fetch_array($result_r))
										{
											$user_id = $row['user_id'];
											$firstname = $row['firstname'];
											$lastname = $row['lastname'];
											$user_email = $row['user_email'];
											$user_role = $row['user_role'];
											$admin_status = $row['Admin_Status'];
											$approve_date = $row['Approved_date'];
										
										?>
										<tr>
											<td><?php echo $user_id; ?></td>
											<td><?php echo $firstname. "&nbsp;". $lastname; ?></td>
											<td><?php echo $user_role; ?></td>
											<td><?php echo $user_email; ?></td>
											<td><a href="admin_index.php?approve=<?php echo $user_id.'&email='.$user_email.'&firstname='.$firstname; ?>"><?php if($admin_status == 'Approved'){ echo "Approved"."<br>" . "<span style='color: black;'> On ". $approve_date. "</span>"; } 
											else{ echo "Want to Approve!"; }?></a></td>

											<td><a href="admin_index.php?disapprove=<?php echo $user_id; ?>"><?php if($admin_status == 'Disapproved'){ echo "Disapproved"; } 
											else{ echo "Want to Disapprove!"; }?></a></td>
											<td><a href="admin_index.php?delete=<?php echo $user_id; ?>" class="btn btn-danger">Delete User</a></td>
										</tr>

										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</main>

			<?php
			$delete_id = "";
//			if(isset($_GET['approve']))
//			{
//				$USER_ID = $_GET['approve'];
//				$query_approve  = "UPDATE regestration SET Admin_Status = 'Approved', Approved_date = CURRENT_TIMESTAMP WHERE user_id = $USER_ID AND Admin_Status = 'Disapproved' ";
//				$result_approve  = mysqli_query($connection, $query_approve);
//				if($result_approve)
//				{
//					header('Location: admin_index.php');
//				}
//			}
			if(isset($_GET['disapprove']))
			{
				$USER_ID = $_GET['disapprove'];
				$query_disapprove  = "UPDATE regestration SET Admin_Status = 'Disapproved' WHERE user_id = $USER_ID AND Admin_Status = 'Approved' ";
				$result_disapprove  = mysqli_query($connection, $query_disapprove);
				if($result_disapprove)
				{
					header('Location: admin_index.php');
				}
			}
			
			if(isset($_GET['delete']))
			{
				$delete_id = $_GET['delete'];
				$query = "DELETE FROM regestration WHERE user_id = {$delete_id} ";
				$result = mysqli_query($connection,$query);
				if($result)
				{
					header('Location: admin_index.php');
				}
			}
			
				require "../vendor/phpmailer/phpmailer/PHPMailerAutoload.php";
				require "../classes/config.php";


				$error = "";

				
					if(isset($_GET['approve']))
					{

						if(isset($_GET['email']))
						{
							if(isset($_GET['firstname']))
							{
							$user_id = $_GET['approve'];
							$email = $_GET['email'];
							$firstname = $_GET['firstname'];
							
							if(email_exist($email))
							{

							$query = "UPDATE regestration SET Admin_Status = 'Approved', Approved_date = CURRENT_TIMESTAMP WHERE user_email = '{$email}' AND user_id = {$user_id} AND Admin_Status = 'Disapproved' ";
							if($result_email = mysqli_query($connection, $query))
							{
								
								$mail = new PHPMailer();

								$mail->isSMTP();                                            
								$mail->Host       = config::SMTP_HOST;  

								$mail->SMTPAuth   = true;  
								$mail->SMTPSecure = 'tls';
								$mail->Port       = config::SMTP_PORT;
								$mail->Username   = config::SMTP_USER;                    
								$mail->Password   = config::SMTP_PASSWORD;                


								$mail->setFrom('debarshimondal121@gmail.com', $firstname);
								$mail->addAddress($email);     

								$mail->isHTML(true);
								$mail->Subject = "INIESTA-Regestration Approved";
								$mail->Body = '<p>Hey '.$firstname. ', your Regestration is Approved By our Team. Kindly Login here, 
								
								<a href="http://localhost/Project-INIESTA/">http://localhost/Project-INIESTA/</a>
								
								</p>';	
									
								if($mail->send())
								{
									header("Location: admin_index.php");

								}


							

						} 

					}
//					
				}
			}
					}
				
	?>



			<footer class="py-4 bg-light mt-auto">
				<div class="container-fluid">
					<div class="d-flex align-items-center justify-content-between small">
						<div class="text-muted">&copy; INIESTA 2020 </div>
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
	<script>
	</script>
</body>








</html>
