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
                    <li class="active"><a href="index.php">Home</a></li>
                    <?php 
                          
                        $_SESSION['rated'] = false;
                        if(isset($_SESSION['email'])) // if email set, then it is a customer not a guest 
                        {
                            echo "<li><a href = 'Profile.php'>Hi ".$_SESSION['name']." !</a></li>"; 
                            echo "<li><a href='logout.php'>Logout</a></li>"; 
                            $email = $_SESSION['email'];
                            $toRun = "SELECT  c_id  FROM customers where c_mail='$email'";
					        $results = mysqli_query($conn, $toRun);
					        while($row = mysqli_fetch_row($results))
					        {
						        $_SESSION['id']  = $row[0];
                            }
                            $_SESSION['isC'] = true;
                        }  
                        else // If guest,
                        {
						    $_SESSION['isC'] = false;
                            echo "<li><a>Hi, Guest</a></li>";
                            echo "<li><a href='newlogin.php'>Login</a></li>";
                          
                            if(!isset($_SESSION['id']))
                            {
                                $newGuest="INSERT INTO `guests` VALUES()"; // Then assign a auto_incremented value as their id
                                $run = mysqli_query($conn, $newGuest);
                                $lastElmnt = "SELECT `g_id` FROM `guests` ORDER BY `g_id` DESC LIMIT 1";
                                $queryIt = mysqli_query($conn, $lastElmnt);
                                while($gid = mysqli_fetch_row($queryIt)) 
                                    $_SESSION['id'] = $gid[0];   

                            }
                        }         
                    ?>

                    <li><a href="cart.php">Go to Cart<span class="badge"><?php total_items(); ?></span></a></li>
                    <li><a href="Bought_Books.php">Bought Books</a></li>
                </ul>
                <form action="results.php" method="get" class="navbar-form navbar-right">
                    <div class="form-group label-floating">
                        <label class="control-label">Search Books</label>
                        <input type="text" name="user_query" class="form-control">
                    </div>
                    <button type="submit" name="search" class="btn btn-round btn-just-icon btn-primary"><i class="material-icons">search</i><div class="ripple-container"></div></button>
                </form>
            </div>
        </div>
    </nav>


    <!-- end navbar -->
    

    <div class="container-fluid">

        <div class="row">
            

            <div class="col-lg-2 col-md-2" id="myScrollspy">
            <li role="presentation">Sort By:</li>
            <form method = "post">
            <button name = "sortByName">Book Name</button>
            <button name = "sortByPrice">Price</button>
            <button name = "sortByRating">Rating</button>
            </form>
                <ul data-offset-top="225" data-spy="affix" class="nav nav-pills  nav-stacked">
                    <li role="presentation"><a href="index.php">All books</a></li>
                    <?php getcats();?>

                </ul>
            </div>
            <div class="col-lg-10 col-md-10" id="mainarea">
                <div class="container-fluid">
                    <?php cart(); ?>
                    <!-- Adding books -->
                    <div class="row">
                        <?php getbooks();?>
                        <?php get_bycat();?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
