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

                    echo "<li><a>Hi PM " . $_SESSION['pmusername'] . " !</a></li>";
                    echo "<li><a href='logout.php'>Logout</a></li>";


                    ?>
                    <li><a href="editBooks.php">EDIT BOOKS<span></span></a></li>
                    <li class="active"><a href="addBooks.php">ADD BOOKS<span></span></a></li>
                </ul>
                <form action="resultsPm.php" method="get" class="navbar-form navbar-right">
                    <div class="form-group label-floating">
                        <label class="control-label">Search Books</label>
                        <input type="text" name="user_query" class="form-control">
                    </div>
                    <button type="submit" name="search" class="btn btn-round btn-just-icon btn-primary"><i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </form>


            </div>

        </div>
    </nav>
    <!-- end navbar -->


    <!-- Display the column names using bootstrap modal -->
    <form action="addBooks.php" method="post">
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>

                    <label class='control-label'>Name</label>
                    <input type='text' class='form-control input-lg' name='chName'>


                    <label class='control-label'>ID</label>
                    <input type='text' class='form-control input-lg' name='chId'>


                    <label class='control-label'>Info</label>
                    <input type='text' class='form-control input-lg' name='chInfo'>

                    <!--                               
                              <label class='control-label'>Rating</label>
                                  <input type='text' class='form-control input-lg' name='chRating' >
                              
                               -->
                    <label class='control-label'>Price</label>
                    <input type='text' class='form-control input-lg' name='chPrice'>


                    <label class='control-label'>Category</label>
                    <input type='text' class='form-control input-lg' name='chCat'>

                    <!--                               
                              <label class='control-label'>Comment</label>
                                  <input type='text' class='form-control input-lg' name='chComment' >
                              
                               -->
                    <label class='control-label'>Image</label>
                    <input type='text' class='form-control input-lg' name='chImage'>


                    <label class='control-label'>Author</label>
                    <input type='text' class='form-control input-lg' name='chAuthor'>


                    <label class='control-label'>Keywords</label>
                    <input type='text' class='form-control input-lg' name='chKeywords'>

                    <button name="addBook" type="submit" class="btn btn-danger">ADD</button>
    </form>

    </div>
    </div>
    </div>

    <?php

    // Leaving a field empty is not allowed
    if (isset($_POST['addBook']) && isset($_POST['chName']) && isset($_POST['chId']) && isset($_POST['chInfo'])  && isset($_POST['chPrice']) && isset($_POST['chCat']) && isset($_POST['chImage']) && isset($_POST['chAuthor']) && isset($_POST['chKeywords'])) {

        $chName = $_POST['chName'];

        $chid = $_POST['chId'];

        $chInfo = $_POST['chInfo'];

        // $chRating = $_POST['chRating'];

        $chPrice = $_POST['chPrice'];

        $chCat = $_POST['chCat'];

        // $chComment = $_POST['chComment'];

        $chImage = $_POST['chImage'];

        $chAuthor = $_POST['chAuthor'];

        $chKeywords = $_POST['chKeywords'];

        $addBook = "INSERT INTO `products` (`pid`, `name`, `price`, `info`, `category`, `image`, `author`, `keywords`) VALUES ('$chid', '$chName', '$chPrice', '$chInfo', '$chCat', '$chImage', '$chAuthor', '$chKeywords')";
        $try = mysqli_query($conn, $addBook);
        if(!$try) 
        {
            $er = mysqli_error($conn);
            echo '<script>alert("SQL error: '.$er.'")</script>';
        }    
        unset($_POST['addBook']);
        
       // if (isset($_POST['addBook']))
           // echo "<script>alert('Prblm!')</script>";

    }
    else if(isset($_POST['addBook']))
        echo "<script>alert('Don't leave empty fields!')</script>";
    else 
        //echo "<script>alert('No Prblm!')</script>";

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