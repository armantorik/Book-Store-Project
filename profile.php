<!doctype html>
<?php 
include("function/functions.php");
?>
<html lang="en">

<head>
    <meta charset="utf-8" />


    <title>Books Store</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <style>
img 
{
    border-radius: 100%;
}
</style>
</head>

<body data-spy="scroll" data-target="#myScrollspy" data-offset="15">

    <!-- Navbar will come here  -->

    <nav class="navbar navbar-fixed-top" role="navigation" id="topnav">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
    		</button>
                <a class="navbar-brand" href="#">Group20 BookStore</a>

            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>                
                      <li class="active"><a href = 'Profile.php'>Hi <?php echo "$_SESSION[name]";?>  !</a></li>
                      <li><a href='logout.php'>Logout</a></li>
                    <li><a href="cart.php">Go to Cart<span class="badge"><?php total_items(); ?></span></a></li>

                </ul>
                </div>
        </div>
    </nav>



    <!-- end navbar -->


    <!-- <div class="container-fluid"> -->
    <form  name = "my_form" method="post" action="profile.php">
    <div class='container'>
    <table class='table-striped table'>
        <thead class='thead-inverse'>
        <img width='150p' src='assets/images/pp.png'>
        <h3 class= 'modal-header'>Profile</h3>
            <tr>
                <th>Info Fields:</th>
                <th>Your Info:</th>
                <th>New Info:</th>
            </tr>

            <tr>
            
           <th>Name:</th>
           <?php
           $name = $_SESSION['name'];
            echo "<th>$name</th>";
           ?>           
           <td>
            <input type="text" name="chname" placeholder = "New name">
            <button name = "b1" type="submit">Change!</button>
            </td>
       </tr>

       <tr>
           <th>Email:</th>
           <?php
           $vr = $_SESSION['email'];
            echo "<th>$vr</th>";
           ?>
           <td>
            <input type="text" name="chemail"  placeholder = "New email">
            <button name = "b2" type="submit" >Change!</button>
        </td>
       </tr> 

       <tr>    
           <th>Phone:</th> 
           <?php
           $vr = $_SESSION['phone'];
            echo "<th>$vr</th>";
           ?>
           <td>
            <input type="text" name="chphone"  placeholder = "New phone">
            <button name = "b4" type="submit" >Change!</button>
        </td>
       </tr> 

       <tr>    
           <th>Address:</th> 
           <?php
           $vr = $_SESSION['address'];
            echo "<th>$vr</th>";
           ?>
           <td>
            <input type="text" name="chaddress"  placeholder = "New address">
            <button name = "b5" type="submit" >Change!</button>
        </td>
       </tr> 

       <tr>    
           <th>Password:</th> 
           <th><?php $vr = $_SESSION['password']; echo "$vr"; ?> </th>
           
           <td>
            <input id = "pass" type="password" name="chpass"  placeholder = "New Password">
            <button name = "b3" type="submit">Change!</button>
        </td>       </tr> 

        
        </thead>
        
        </table>
        <input style="margin-left: 42em;" type="checkbox" onclick="showPassword()">Show Password 
        <script>
            function showPassword() 
            {
                var x = document.getElementById("pass");
                if (x.type === "password")
                    x.type = "text";
                else
                    x.type = "password";
            }
            </script>
        </div>
  
<?php

$email = $_SESSION['email'];
$inp = false;

if(isset($_POST['b1']))
{
    $inp = true;
    $changeName = $_POST['chname'];
    if($changeName != "")
    {
        $update = "UPDATE `customers` SET `c_name` = '$changeName' WHERE `customers`.`c_mail` = '$email' ";
        $_SESSION['name'] = $changeName;
    }
        
}

if(isset($_POST['b2']))
{
    $inp = true;
    $changemail = $_POST['chemail'];
    if($changemail != "")
    {
        $_SESSION['email'] = $changemail;
        $update = "UPDATE `customers` SET `c_mail` = '$changemail' WHERE `customers`.`c_mail` = '$email'";
        $updBas = "UPDATE `basket` SET `customer_mail` = '$changemail' WHERE `basket`.`customer_mail` = '$email'";  // It changes the basket!
    }
}
    
if(isset($_POST['b3']))
{
    $inp = true;
    $changepass = $_POST['chpass'];
    if($changepass != "")
    {
        $update = "UPDATE `customers` SET `c_password` = '$changepass' WHERE `customers`.`c_mail` = '$email' ";
        $_SESSION['password'] = $changepass;
    }
}   

if(isset($_POST['b4']))
{
    $inp = true;
    $changephone = $_POST['chphone'];
    if($changephone != "")
    {
        $update = "UPDATE `customers` SET `c_phone` = '$changephone' WHERE `customers`.`c_mail` = '$email' ";
        $_SESSION['phone'] = $changephone;
    }
}
if(isset($_POST['b5']))
{
    $inp = true;
    $changeaddress = $_POST['chaddress'];
    if($changeaddress != "")
    {
        $update = "UPDATE `customers` SET `c_address` = '$changeaddress' WHERE `customers`.`c_mail` = '$email' ";
        $_SESSION['address'] = $changeaddress;
    }
}    
if($inp === true) 
{
    if ($success = $conn->query($update)) 
    { 
        if(isset($_POST['b2']))
        {
            $qr = mysqli_query($conn, $updBas);
        }
        echo "<script> alert('Change Successful!') </script>";
        echo "<script>window.open('profile.php','_self')</script>";
    } 
    else
        echo "<script> alert('Could not change the credential, please try different input') </script>"; 
}   

?>

        </form>
</body>





<!--   Core JS Files   -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/nouislider.min.js" type="text/javascript"></script>

<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="assets/js/material-kit.js" type="text/javascript"></script>
<script src="assets/js/carousel.js" type="text/javascript"></script>
<script src="assets/js/myscripts.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

</html>
