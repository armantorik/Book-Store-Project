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
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="loginemail" id="loginemail" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
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

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
                </form>
                
			</div>
		</div>
	</div>

 
    <?php
    //Sign Up
            if(isset($_POST['login']))
            {

                $email= $_POST['loginemail'];
                $pass = $_POST['loginpass'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $adress = $_POST['adress'];

                if (!$mysqli -> query("INSERT INTO `customers`(`c_name`, `c_mail`, `c_password`, `c_phone`, `c_address`) VALUES ('$cname','$maill', '$password', '$phone', '$address')")
                {
                    echo("Error description: " . $mysqli -> error);
                }

                if($addCustQuery == 0)
                
                // $email= $_POST['loginemail'];
                // $pass = $_POST['loginpass'];
                // $sel_c="select * from customers where c_password='$pass' AND c_mail='$email'";
                // $run_c=mysqli_query($conn,$sel_c);
                // $check_customer=mysqli_num_rows($run_c);
                // if($check_customer==0)
                // {
                //     echo "<script>alert('Password or Username is incorrect')</script>";
                    
                // }

                // else{
                //         $_SESSION['email']=$email;
                //         echo "<script>alert('Login Successful')</script>";
                //         echo "<script>window.open('index.php','_self')</script>";
        
                //     }
    
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