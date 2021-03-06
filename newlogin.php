<!DOCTYPE html>
<?php
include("function/functions.php");
include("includes/db.php");

?>
<html lang="en">
<head>

	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="Login_v1/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/css/main.css">
<!--===============================================================================================-->
</head>
<body>

 
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="Login_v1/images/bookImg.jpg" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="newlogin.php" method="post" >
					<span class="login100-form-title">
						Member Login
					</span>
					<div class="wrap-input100" >  <!-- data-validate = "Valid email is required: ex@abc.xyz"  Removed since it doesn't allow to go signup page-->
						<input class="input100" type="text" name="loginemail" id="loginemail" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" name="loginpass" id="loginpass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login">
							Login
                        </button>
					</div>

					<div class="text-center p-t-190">

					<button class="txt2	" href="#" type="submit" name="goguest">
						Shop without signing in!
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </button>
					</div>

					<div class="text-center p-t-10">

					<button class="txt2	" href="#" type="submit" name="signUp">
						Create your Account
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </button>
					</div>
                </form>
                
			</div>
		</div>
	</div>

 
    <?php
    //login
            if(isset($_POST['login']))
            {
                $email= $_POST['loginemail'];
				$pass = $_POST['loginpass'];

				$pmusername = $_POST['loginemail'];
				$pmpass = $_POST['loginpass'];
				
				$smusername= $_POST['loginemail'];
				$smpass = $_POST['loginpass'];
				
				//sec test: 
				// SELECT * from customers where c_password='arman' OR 1 = 1'' AND c_mail='arman' OR 1 = 1''

				$sel_c = "SELECT * from customers where c_password='$pass' AND c_mail='$email'";
                $run_c = mysqli_query($conn,$sel_c);
				
				$check_customer = mysqli_num_rows($run_c);
				
				if($check_customer == 0)
				{
					$sel_pm = "SELECT * from product_manager where pm_password='$pmpass' AND pm_username='$pmusername'";
						$run_pm = mysqli_query($conn,$sel_pm);
						$check_pm = mysqli_num_rows($run_pm);
						
						if($check_pm == 0)
						{
							$sel_sm = "SELECT * from sales_manager where sm_password='$smpass' AND sm_username='$smusername'";
							$run_sm = mysqli_query($conn,$sel_sm);
							$check_sm = mysqli_num_rows($run_sm);
							
							//If not sm
							if($check_sm == 0) 
								echo "<script>alert('Password or Username is incorrect')</script>";
							else // if sm
							{
								$_SESSION['smusername'] = $smusername;
								echo "<script>alert('Welcome Sales Manager')</script>";
								echo "<script>window.open('sm.php','_self')</script>";
							}

						}
						else
						{
							$_SESSION['pmusername'] = $pmusername;
							echo "<script>alert('Welcome Product Manager')</script>";
							echo "<script>window.open('pm.php','_self')</script>";
							
						}
							
				}

				else
				{
					$_SESSION['email'] = $email;
					$toRun = "SELECT  c_name, c_phone, c_address, c_password, c_id  FROM customers where c_password='$pass' AND c_mail='$email'";
					$results = mysqli_query($conn, $toRun);
					while($row = mysqli_fetch_row($results))
					{
						$_SESSION['name'] = $row[0];
						$_SESSION['phone'] = $row[1];
						$_SESSION['address'] = $row[2];
						$_SESSION['password'] = $row[3];
						$_SESSION['id'] = $row[4];
						$_SESSION['isC'] = true;
					}
					
					echo "<script>alert('Login Successful')</script>";
					echo "<script>window.open('index.php','_self')</script>";
					

					
                }
			}

			else if(isset($_POST['signUp']))
				echo "<script>window.open('sign_up.php','_self')</script>";

			else if(isset($_POST['goguest']))
			{
				echo "<script>window.open('index.php','_self')</script>";
				session_destroy();
			}
				
				
    ?>	
    
<!--===============================================================================================-->	
	<script src="Login_v1/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_v1/vendor/bootstrap/js/popper.js"></script>
	<script src="Login_v1/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_v1/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_v1/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="Login_v1/js/main.js"></script>

</body>
</html>