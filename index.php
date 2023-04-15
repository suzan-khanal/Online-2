<?php
require_once("admin/include/connect.php");

$fetchingElections = mysqli_query($con, "SELECT * FROM elections") or die(mysqli_error($con));
while($data = mysqli_fetch_assoc($fetchingElections))
{
	$Starting_Date = $data['Starting_Date'];
	$Ending_Date = $data['Ending_Date'];
	$Current_Date = date("Y-m-d");
	$Election_id = $data['id'];
	$Status = $data['Status'];


	// Active = Expire = Ending Date
	// InActive = Active = Starting Date

	if($Status == "Active")
	{
		$date1=date_create($Current_Date);
		$date2=date_create($Ending_Date);
		$diff=date_diff($date1,$date2);
	
		//echo var_dump((int)$diff->format("%R%a"));
	
		if((int)$diff->format("%R%a") < 0)
		{	
		//Update
		mysqli_query($con, "UPDATE elections SET Status = 'Expired' WHERE id = '". $Election_id."'") or
		 die(mysqli_error($con));
		}
	}else if($Status == "InActive"){
		$date1=date_create($Current_Date);
		$date2=date_create($Starting_Date);
		$diff=date_diff($date1,$date2);
	
		//echo (int)$diff->format("%R%a");
	
		if((int)$diff->format("%R%a") <= 0)
		{	
			//Update
			mysqli_query($con, "UPDATE elections SET Status = 'Active' WHERE id = '". $Election_id."'") or
			die(mysqli_error($con));
		}

	}
	
}
?>



<!DOCTYPE html>
<html>
    
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="assets/css/login.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/images/logo.gif" class="brand_logo" alt="Logo">
					</div>
				</div>

					<?php
					if(isset($_GET['sign-up']))
					{
						?>
						
						<div class="d-flex justify-content-center form_container">
					<form method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="su_username" class="form-control input_user"  placeholder="Username" required />
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="text" name="su_contact" class="form-control input_pass"  placeholder="Mobile Number" required />
						</div>

						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="su_password" class="form-control input_pass"  placeholder="Password" required />
						</div>

						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="su_retype" class="form-control input_pass"  placeholder="Retype Password" required />
						</div>
						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="register_btn" class="btn login_btn">Register</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links text-white">
						Already created an account? <a href="index.php" class="ml-2 text-white">Sign in</a>
					</div>
					
				</div>


					<?php

					}
					else
					{
						?>

						<div class="d-flex justify-content-center form_container">
					<form method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="mobile_no" class="form-control input_user" placeholder="Mobile Number" required />
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" placeholder="password" required />
						</div>
						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="login-btn" class="btn login_btn">Login</button>
				   </div>
					</form>
				</div>	
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links text-white">
						Don't have an account? <a href="?sign-up=1" class="ml-2 text-white">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#" class="text-white">Forgot your password?</a>
					</div>
				</div>

						<?php

					}
					?>

					<?php

						if(isset($_GET['registered']))
						{
							?>
	<span class="bg-white text-success text-center my-3"> **** Account Registration Successfull *****</span>
							<?php
						}else if(isset($_GET['invalid']))
						{
							?>


	 <span class="bg-white text-danger text-center my-3"> **** Password Didn't Match*****</span>
						<?php
						}else if(isset($_GET['not_registered']))
						{
							?>


	  <span class="bg-white text-warning text-center my-3"> **** Sorry!!! Account Not Registered*****</span>
						<?php
						}else if(isset($_GET['invalid_access']))
						{
							?>


		<span class="bg-white text-danger text-center my-3"> **** Sorry!!! Invalid Mobile Number or Password*****</span>
						<?php
						}
					?>

				
			</div>
		</div>
	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>




<?php
require_once("admin/include/connect.php");
if(isset($_POST['register_btn']))
{
	$su_username  = mysqli_real_escape_string($con, $_POST['su_username']);
	$su_contact  = mysqli_real_escape_string($con, $_POST['su_contact']);
	$su_password  = mysqli_real_escape_string($con,sha1($_POST['su_password']));
	$su_retype  = mysqli_real_escape_string($con, sha1($_POST['su_retype']));
	$user_role = "Voter";
	

	if($su_password == $su_retype)
	{
				//Query to Insert.
				mysqli_query($con, "INSERT INTO users(username, mobile, password, user_role) VALUES('". $su_username
				."', '". $su_contact."','". $su_password."', '". $user_role."')") or die(mysqli_error($con));

				?>
		<script> location.assign("?sign-up=1&registered=1");</script>

<?php
	}
	else
	{
		?>
	<script> location.assign("?sign-up=1&invalid=1");</script>
		<?php

	}
}
else if(isset($_POST['login-btn']))
{

	$mobile_no  = mysqli_real_escape_string($con, $_POST['mobile_no']);
	$password  = mysqli_real_escape_string($con, sha1($_POST['password']));


	//Query To Fetch Data.
	$fetchData = mysqli_query($con, "SELECT * FROM `users` WHERE mobile = '". $mobile_no."'") or die(mysqli_error($con));

	//Converting to ASSOCIATIVE ARRAY

	
	// echo $data['username'];

	if(mysqli_num_rows($fetchData) > 0)
	{
		$data  = mysqli_fetch_assoc($fetchData);

	// Checking Password Matches or Not.
	if($mobile_no  == $data['mobile'] AND $password == $data['password'])
	{
		session_start();
		$_SESSION['user_role'] = $data['user_role'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['Key'] = $data['user_role'];
		$_SESSION['user_id'] = $data['id'];

		
		
			if( $data['user_role'] == "Admin")
			{
				$_SESSION['Key'] == "AdminKey";
				?>
				<script> location.assign("admin/index.php?Homepage=1")</script>

			<?php
			}
			else{
				$_SESSION['Key'] == "VotersKey";

				?>
				<script> location.assign("voters/Voter_Dashboard.php")</script>



			<?php
			}
			


	}else{
		?>


	<script> location.assign("?invalid_access=1");</script>


	<?php
	}
	}
	else
	{
		?>

	<script> location.assign("?not_registered=1");</script>

<?php
	}
						
}
?>
