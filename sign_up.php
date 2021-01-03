<!DOCTYPE html>
<?php
include("function/functions.php");
include("includes/db.php");

?>
<html lang="en">
<head>
	<title>Create Account</title>
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
					<img src="Login_v1/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="newlogin.php" method="post" >
					<span class="login100-form-title">
						Sign Up
					</span>
					<div class="wrap-input100" > <!-- data-validate = "Email is required: ex@abc.xyz" removed because doesn't allow go back without entering all info -->
						<input class="input100" type="text" name="newEmail" id="newEmail" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" name="newPass" id="newPass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="wrap-input100">
						<input class="input100" type="text" name="newName" id="newName" placeholder="Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="text" name="newNumber" id="newNumber" placeholder="Phone Number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="text" name="newAddress" id="newAddress" placeholder="Address">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="sign">
							Sign Up!
                        </button>
					</div>

					<div class="text-center p-t-136">
						<button class="txt2" name = "goBack" href="#">
						<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
							Go back to login
						</button>
					</div>
                </form>
                
			</div>
		</div>
	</div>

 
    <?php
    //Sign Up
            if(isset($_POST['sign']))
            {

                $newEmail= $_POST['newEmail'];
                $newPass = $_POST['newPass'];
                $newName = $_POST['newName'];
                $newPhone = $_POST['newNumber'];
                $newAdress = $_POST['newAddress'];

                if (!$mysqli -> query("INSERT INTO `customers`(`c_name`, `c_mail`, `c_password`, `c_phone`, `c_address`) VALUES ('$newName','$newEmail', '$newPass', '$newPhone', '$newAdress')"))
					echo("Error description: " . $mysqli -> error);
					
			}

			else if(isset($_POST['goBack']))
				echo "<script>window.open('newlogin.php','_self')</script>";
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