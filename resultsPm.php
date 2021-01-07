<!doctype html>
<?php include("function/functions.php");
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

    <!-- Navbar will come here -->

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
                    <li><a href="pm.php">Home</a></li>
                    <?php 
                                                    
                            echo "<li><a>Hi PM ".$_SESSION['pmusername']." !</a></li>"; 
                            echo "<li><a href='logout.php'>Logout</a></li>"; 
                        
                                                     
                    ?>
                    <li><a href="editBooks.php">EDIT BOOKS<span></span></a></li>
                    <li  class="active"><a href="addBooks.php">ADD BOOKS<span></span></a></li>
                </ul>
                <form action="resultsPm.php" method="get" class="navbar-form navbar-right">
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
            
            <div class="col-lg-10 col-md-10 " id="mainarea">


                <div class="container-fluid">
                    <div class="row">

                        <?php if(isset($_GET['search'])){
    $search_query=$_GET['user_query'];
   
    $result = "select * from products where keywords like '%$search_query%' ";
     $result=mysqli_query($conn, $result);
    while($row=mysqli_fetch_array($result))
	{
		echo "<div class='col-lg-4 col-md-6'>
                            <div class='card'>
                                <img class='card-img' height='200px' width='100px' src='assets/images/".$row['image']."'>
                                <span class='content-card'>
                                    <h6>".$row['name']."</h6>
                                    <h7>".$row['author']."</h7>
                                </span>
                                <a href='index.php?add_cart=".$row['pid']."'><button class='buybtn btn btn-warning btn-round btn-sm'>
	 								Add <i class='material-icons'>add_shopping_cart</i>
								</button></a>
                                <button class='knowbtn btn btn-warning btn-round btn-sm' data-toggle='modal' data-target='#".$row['pid']."'>
	 								Know More
								</button>";
                                
          
        echo "<div class='modal fade' id='".$row['pid']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title' id='myModalLabel'>".$row['name']."</h4>
                      </div>
                      <div class='modal-body'>
                      <h4><p align='right'>&#8377;".$row['price']."</p></h4>".
                          $row['info']
                      ."</div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-default btn-simple' data-dismiss='modal'>Close</button>
                        
                      </div>
                    </div>
                  </div>
                </div>
                                
							</div>
                        </div>";    //the last two </div> are from previous echo.
	}
}
?> 
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
