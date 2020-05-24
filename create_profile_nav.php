<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="my-hires.php"><img src="images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px; margin-bottom: -15px;"> Update Profile <br> <span style="font-size: 15px; margin-left: 30px;">( INIESTA )</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<style>
			ul.navbar-nav a:hover{
				color: wheat!important;
			}	
			
		</style>
			<ul class="navbar-nav ml-auto">

				<li class="nav-item dropdown">
					<a href="user_dasboard.php" class="nav-link" style="color: white; padding-top: 20px;"> Back To Dashboard </a>
				</li>
				<li class="nav-item dropdown trainings">
					<a href="view_profile.php" class="nav-link" style="color: white; padding-top: 20px;">View Profile </a>
				</li>

				<li class="nav-item dropdown">
					<a type="button" class="nav-link" style="color: white;">
						Login as <?php echo $_SESSION['firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['userrole']."</span> )"; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a href="logout.php" type="button" class="nav-link" style="color: red; padding-top:20px;">
						Logout
					</a>
				</li>
			</ul>
		</div>
	</nav>