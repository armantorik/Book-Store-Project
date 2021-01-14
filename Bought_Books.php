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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <a class="navbar-brand" href="#">MyBookStore</a>

            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <?php

                    if (isset($_SESSION['name'])) {
                        echo "<li><a href = 'Profile.php'>Hi " . $_SESSION['name'] . " !</a></li>";
                        echo "<li><a href='logout.php'>Logout</a></li>";
                    } else {
                        echo "<li><a>Hi, Guest</a></li>";
                        echo "<li><a href='newlogin.php'>Login</a></li>";
                    }

                    ?>

                    <li><a href="cart.php">Go To Cart<span class="badge"><?php total_items(); ?></span></a></li>
                    <li class="active"><a href="Bought_Books.php">Bought Books</a></li>
                </ul>
                <form action="results.php" method="get" class="navbar-form navbar-right">
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

    <div class="container">
        <table class="table-striped table">
            <thead class="thead-inverse">
                <tr>
                    <th>#</th>

                    <th colspan="2">Product </th>

                    <th>Author</th>

                    <th>Rating</th>

                    <th>Price</th>

                    <th>Your Rating</th>


                    <th>Your Comment:</th>
                </tr>
            </thead>
            <tbody>
                <form action="Bought_Books.php" method="post">


                    <?php


                    $id = $_SESSION['id'];  
                    if($_SESSION['isC']){
                        
                    //             0          1     2          3       4       5
                    $qr = "SELECT p.name, p.author, p.rating, p.image, p.price, p.pid
                            FROM customers c, bought_books_customer b, products p
                            WHERE c.c_id = '$id' AND c.c_id = b.c_id AND b.p_id = p.pid            
                            ";
                    $bookarr = mysqli_query($conn, $qr);
                }
                    else{
                        $qr = "SELECT p.name, p.author, p.rating, p.image, p.price, p.pid
                                FROM guests g, bought_books_guest b, products p
                                WHERE g.g_id = '$id' AND g.g_id = b.g_id AND b.p_id = p.pid            
                                ";
                        $bookarr = mysqli_query($conn, $qr);
                    }
                    
                    $count = 0;
                    while ($bk = mysqli_fetch_row($bookarr)) {
                        $count++;
                        echo "
                            <tr
                                </th>
                                <th>$count</th>
                                <th>$bk[0]</th>
                                <th><img width = '50px' src = 'assets/images/".$bk[3]."'</th>

                                <th>$bk[1]</th>
                                <th>$bk[2]</th>
                                <th>$bk[4]</th>
                                <th>
                                <form  name = 'ma_form' method='post' action='Bought_Books.php'>
                            
                                <fieldset class='rating'>
                                <input type='radio' name='rating".$bk[5]."' value='5' /><label for='star5' title='Rocks!'>5 stars</label>
                                <input type='radio' name='rating".$bk[5]."' value='4' /><label for='star4' title='Pretty good'>4 stars</label>
                                <input type='radio' name='rating".$bk[5]."' value='3' /><label for='star3' title='Meh'>3 stars</label>
                                <br>
                                <input type='radio' name='rating".$bk[5]."' value='2' /><label for='star2' title='Kinda bad'>2 stars</label>
                                <input type='radio' name='rating".$bk[5]."' value='1' /><label for='star1' title='Sucks big time'>1 star</label>
                                </fieldset>

                                </th>
                                <th>
                                <input name = 'txt".$bk[5]."' size = '50' type = 'text' placeholder = 'Let everyone know about your opinions'>
                                <th>
                                <button name='comment".$bk[5]."' type='submit' class='btn btn-danger'>Comment</button>
                            </th>
                                </form>
                                </th>
                            </tr>";
                        

                        if (isset($_POST["comment".$bk[5].""])) { 
                            $id = $_SESSION['id'];

                            $rated = $_SESSION['rated']; //creating a bool varibable to check if the customer has rated the product or not 

                            if (isset($_POST["rating".$bk[5].""]) && $_POST["rating".$bk[5].""] == 5 && $rated == FALSE) {
                                mysqli_query($conn, "INSERT into user_rates(u_id, rating, p_id)  values('$id', 5, '$bk[5]')");
                                unset($_POST["comment".$bk[5].""]);
                                $_SESSION['rated'] = TRUE;
                            }

                            else if (isset($_POST["rating".$bk[5].""]) && $_POST["rating".$bk[5].""] == 4 && $rated == FALSE) {
                                $id = $_SESSION['id'];
                                mysqli_query($conn, "INSERT into user_rates(u_id, rating, p_id)  values('$id', 4, '$bk[5]')");
                                unset($_POST["comment".$bk[5].""]);
                                $_SESSION['rated'] = TRUE;
                            }

                            else if (isset($_POST["rating".$bk[5].""]) && $_POST["rating".$bk[5].""] == 3 && $rated == FALSE) {
                                $id = $_SESSION['id'];
                                mysqli_query($conn, "INSERT into user_rates(u_id, rating, p_id)  values('$id', 3, '$bk[5]')");
                                unset($_POST["comment".$bk[5].""]);
                                $_SESSION['rated'] = TRUE;
                            }

                            else if (isset($_POST["rating".$bk[5].""]) && $_POST["rating".$bk[5].""] == 2 && $rated == FALSE) {
                                $id = $_SESSION['id'];
                                mysqli_query($conn, "INSERT into user_rates(u_id, rating, p_id)  values('$id', 2, '$bk[5]')");
                                unset($_POST["comment".$bk[5].""]);
                                $_SESSION['rated'] = TRUE;
                            }

                            else if (isset($_POST["rating".$bk[5].""]) && $_POST["rating".$bk[5].""] == 1 && $rated == FALSE) {
                                $id = $_SESSION['id'];
                                mysqli_query($conn, "INSERT into user_rates(u_id, rating, p_id)  values('$id', 1, '$bk[5]')");
                                unset($_POST["comment".$bk[5].""]);
                                $_SESSION['rated'] = TRUE;
                            }

                            else
                            {
                                echo "<script>alert('You have already rated the book.')</script>";

                            }
                            
                            if(isset($_POST["txt".$bk[5].""]))
                            {
                                //echo "<script> alert('$bk[1]') </script>";
                                $txt = $_POST["txt".$bk[5].""];
                                mysqli_query($conn, "INSERT INTO `customer_comment_product`(`c_id`, `p_id`, `comment`) VALUES('$id', '$bk[5]','$txt')");
                                unset($_POST["comment".$bk[5].""]);
                            }

                        }
                    }

                    ?>


            </tbody>

        </table>

        </form>
    </div>

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