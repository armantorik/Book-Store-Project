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

<body>

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
                    <li class="active"><a href="editBooks.php">EDIT BOOKS<span></span></a></li>
                    <li><a href="addBooks.php">ADD BOOKS<span></span></a></li>
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

                 <form action="editBooks.php" method="post">      
                 <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header'>

                          <label class='control-label'>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - Please Enter id of a product you want to edit- - - - - - - - - - - - - - - - - - - - - - - - - - -  - - </label>
                                  <input type='text' class='form-control input-lg' name='theID'>

                            <label class='control-label'>New Name</label>
                                  <input type='text' class='form-control input-lg' name='chName'>

                               
                            <label class='control-label'>New ID</label>
                                  <input type='text' class='form-control input-lg' name='chId' >
                              
                                
                              <label class='control-label'>New Info</label>
                                  <input type='text' class='form-control input-lg' name='chInfo' >
                              
<!--                               
                              <label class='control-label'>Rating</label>
                                  <input type='text' class='form-control input-lg' name='chRating' >
                               -->
                              
                              <label class='control-label'>New Price</label>
                                  <input type='text' class='form-control input-lg' name='chPrice' >
                              
                              
                              <label class='control-label'>New Category</label>
                                  <input type='text' class='form-control input-lg' name='chCat' >
                              
                              
                              <!-- <label class='control-label'>Comment</label>
                                  <input type='text' class='form-control input-lg' name='chComment' >
                               -->
                              
                              <label class='control-label'>New Image</label>
                                  <input type='text' class='form-control input-lg' name='chImage' >
                              
                              
                              <label class='control-label'>New Author</label>
                                  <input type='text' class='form-control input-lg' name='chAuthor' >
                              
                              
                              <label class='control-label'>New Keywords</label>
                                  <input type='text' class='form-control input-lg' name='chKeywords' >
                                  
                                  <button name="editBook" type="submit" class="btn btn-danger">Edit</button>   
                              </form>   

                            </div>
                        </div>
                    </div>
                             
           <?php
        
                                  
                        if(isset($_POST['editBook']))
                        {
                                $theID = $_POST['theID'];

                                //$tmp = mysqli_query($conn, "SELECT `name` from products where pid = '$theID'");
                                //$num = mysqli_num_rows($tmp);
                                //echo "<script>alert('$num') </script>";

                                $qr = "SELECT * FROM products WHERE pid = '$theID'";

                                $returned = mysqli_query($conn, $qr);
                                

                                if(mysqli_num_rows($returned) == 0)
                                    die("A product with that id does not exist!");
                                else
                                {

                                    if($_POST['chName'] != "")
                                    {
                                        $chName = $_POST['chName'];
                                        mysqli_query($conn, "UPDATE `products` SET `name` = '$chName' WHERE `products`.`pid` = '$theID'");
                                    }
                                    if($_POST['chInfo'] != ""){
                                        $chInfo = $_POST['chInfo'];
                                        mysqli_query($conn, "UPDATE `products` SET `info` = '$chInfo' WHERE `products`.`pid` = '$theID'");
                                    }
        
                                    
                                    // if($_POST['chRating'] != ""){
                                    //     $chRating = $_POST['chRating'];
                                    //     mysqli_query($conn, "UPDATE `products` SET `rating` = '$chRating' WHERE `products`.`pid` = '$theID'");
                                    // }

                                    if($_POST['chPrice'] != ""){
                                        $chPrice = $_POST['chPrice'];
                                        mysqli_query($conn, "UPDATE `products` SET `price` = '$chPrice' WHERE `products`.`pid` = '$theID'");
                                    }


                                    if($_POST['chCat'] != ""){
                                        $chCat = $_POST['chCat'];
                                        mysqli_query($conn, "UPDATE `products` SET `category` = '$chCat' WHERE `products`.`pid` = '$theID'");
                                    }

                                    if($_POST['chImage'] != ""){
                                        $chImage = $_POST['chImage'];
                                        mysqli_query($conn, "UPDATE `products` SET `image` = '$chImage' WHERE `products`.`pid` = '$theID'");
                                    }

                                    if($_POST['chAuthor'] != ""){
                                        $chAuthor = $_POST['chAuthor'];
                                        mysqli_query($conn, "UPDATE `products` SET `author` = '$chAuthor' WHERE `products`.`pid` = '$theID'");
                                    }

                                    if($_POST['chId'] != ""){
                                        $chId = $_POST['chId'];
                                        mysqli_query($conn, "UPDATE `products` SET `pid` = '$chId' WHERE `products`.`pid` = '$theID'");
                                    }

                                    if($_POST['chKeywords'] != ""){
                                        $chKeywords = $_POST['chKeywords'];
                                        mysqli_query($conn, "UPDATE `products` SET `keywords` = '$chKeywords' WHERE `products`.`pid` = '$theID'");
                                    }

                                }
                                
                            } 
                               ?>
                                           
        </div>
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

</html>
