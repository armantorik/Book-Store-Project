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

                    echo "<li><a>Hi SM " . $_SESSION['smusername'] . " !</a></li>";
                    echo "<li><a href='logout.php'>Logout</a></li>";

                    ?>
                </ul>
            </div>

        </div>
    </nav>
    <!-- end navbar -->


    <!-- Column names of orders table -->
    <div class="container">
        <table class="table-striped table">
            <thead class="thead-inverse">
                <tr>
                    <th> Order Id </th>
                    <th> Invoice </th>
                    <th> User</th>
                    <th> Summary </th>
                    <th> Status </th>
                    <th> Change Status </th>
                    <th> Remove </th>
                </tr>
                <?php




                // Display all of the orders with radio and button next to them to edit and remove
                $orderQ = "SELECT * from orders";
                $arr = mysqli_query($conn, $orderQ);

                while ($rw = mysqli_fetch_array($arr)) {
                    echo "<tr>";
                    if ($rw['customer_id'] > 0) { // customer id > 0 means it is customer, not a guest
                        $cnames = mysqli_query($conn, "SELECT  c.c_name from customers c, orders o where c.c_id = o.customer_id");
                        while ($cname = mysqli_fetch_array($cnames)) 
                            $a = $cname[0];

                        echo "<td>" . $rw['order_id'] . "</td> <td>" . $rw['invoice'] . "</td> <td> $a</td>  <td>" . $rw['invoice_summary'] . "</td>  <td>" . $rw['Status'] . "</td>";
                    }
                     else { // if it is guest, then print its guest id 
                        $gidtoW = $rw['customer_id'];
                        echo "<td>" . $rw['order_id'] . "</td> <td>" . $rw['invoice'] . "</td> <td> $gidtoW</td>  <td>" . $rw['invoice_summary'] . "</td>  <td>" . $rw['Status'] . "</td>";
                    }
                    $oid = $rw['order_id']; // use order_id to distinguish button and radio names
                    echo "
                               <td>
                                <form  name = 'ma_form' method='post' action='sm.php'>
                            
                                <input type='radio' name='status" . $rw['order_id'] . "' value='inProg'> In Progress </input>
                                <input type='radio' name='status" . $rw['order_id'] . "' value='ship'> Shipped </input>
                                <input type='radio' name='status" . $rw['order_id'] . "' value='del'> Delivered </input>
                                <button name='sbt" . $rw['order_id'] . "' type='submit'>Submit</button>

                               </td>
                                </form>


                                <td>
                            <form name = 'anothaForm' method = 'post' action 'sm.php'>
                            <button name='rm" . $rw['order_id'] . "' type='submit' class='btn btn-danger'>Remove</button>
                            </form>
                                </td>


                            </tr>";

                    $order_id = $rw['order_id'];
                    
                    if (isset($_POST["sbt" . $rw['order_id'] . ""])) { // if submit button pressed for radio

                        if (isset($_POST["status" . $rw['order_id'] . ""]) && $_POST["status" . $rw['order_id'] . ""] == "inProg") { // if radio 1 pressed
                            mysqli_query($conn, "UPDATE `orders` SET `Status` = 'In Progress' WHERE `orders`.`order_id` = '$order_id' ");
                            unset($_POST["sbt" . $rw['order_id'] . ""]);
                        }
                         else if (isset($_POST["status" . $rw['order_id'] . ""]) && $_POST["status" . $rw['order_id'] . ""] == "ship") {// if radio 2 pressed
                            mysqli_query($conn, "UPDATE `orders` SET `Status` = 'Shipped' WHERE `orders`.`order_id` = '$order_id' ");
                            unset($_POST["sbt" . $rw['order_id'] . ""]);
                        }
                         else if (isset($_POST["status" . $rw['order_id'] . ""]) && $_POST["status" . $rw['order_id'] . ""] == "del") {// if radio 3 pressed
                            mysqli_query($conn, "UPDATE `orders` SET `Status` = 'Delivered' WHERE `orders`.`order_id` = '$order_id' ");
                            unset($_POST["sbt" . $rw['order_id'] . ""]);
                        }
				            echo "<script>window.open('sm.php','_self')</script>"; 
                    }

                    if (isset($_POST["rm" . $rw['order_id'] . ""])) {
                        if ($rw['Status'] != "Delivered"){
                            mysqli_query($conn, "DELETE from orders where order_id = '$order_id'");
				            echo "<script>window.open('sm.php','_self')</script>";
                        }
                        else
                            echo "<script> alert('This order is already delivered, it is too late to be cancelled') </script>";

                        unset($_POST["rm" . $rw['order_id'] . ""]);
                    }
                }

                ?>

    </div>
    </table>
    </thead>

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