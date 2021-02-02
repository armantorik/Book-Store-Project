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
                <a class="navbar-brand" href="#">MyBookStore</a>

            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li ><a href="index.php">Home</a></li>
                    <?php 
                    
                    if(isset($_SESSION['name']))
                    {
                        echo "<li><a href = 'Profile.php'>Hi ".$_SESSION['name']." !</a></li>"; 
                        echo "<li><a href='logout.php'>Logout</a></li>"; 
                        
                    }
                          
                    else
                    {
                        echo "<li><a>Hi, Guest</a></li>";
                        echo "<li><a href='newlogin.php'>Login</a></li>";
                    }

                    ?>
                   
                    <li class="active"><a href="cart.php">my Cart<span class="badge"><?php total_items(); ?></span></a></li>
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

  <div class="container">
    <table class="table-striped table">
      <thead class="thead-inverse">

      <?php

        $id = $_SESSION['id'];
        
        $count = 1;
        $get_cart = "SELECT * FROM `products` WHERE `pid` IN (SELECT `book_id` FROM `basket` WHERE `user_id` = '$id')";
        
        $cart_items = mysqli_query($conn, $get_cart);
        $total_price = 0;
        $shopSummary = "";

        $img = "emptyBasket.png";
        if(mysqli_num_rows($cart_items) == 0)
          {
            $empty = true;
          
          echo "
          <div class='modal-dialog'>

                          <div class='modal-header'>
          <h2>Wow, such empty! <span style='font-size:50px;'>&#128563;</span></h2>


          </div>
          </div>
          ";
          }
        else
        {
          $empty = false;
          echo "
        <tr>
          <th>Customer ID </th>
          <th>Order ID</th>
          <th>Shop Summary</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>";

       
      if($_SESSION['isC']){
        while ($bk = mysqli_fetch_array($cart_items)) {
          $single_price = $bk['price'];
          $bk_title = $bk['name'];
          $shopSummary = "{$shopSummary}{$bk_title}/";
          $bk_id = $bk['pid'];

            $toSql = "INSERT INTO `bought_books_customer`(`c_id`, `p_id`) VALUES('$id', '$bk_id')";

            mysqli_query($conn, $toSql);
            //$err = mysqli_error($conn);
            //echo "<script>alert('$err')</script>";


            
            $getQuantity = "SELECT `quantity` FROM `basket` WHERE `user_id` = '$id' AND `book_id` = '$bk_id'";

          $quantityArr = mysqli_query($conn, $getQuantity);

          if (mysqli_num_rows($quantityArr) > 0)
            while ($row = mysqli_fetch_array($quantityArr))
              $quantity = $row[0];
          else
            $quantity = $quantityArr;

          $total_price += $single_price * $quantity;
        }

      }
      else{


        while ($bk = mysqli_fetch_array($cart_items)) {
          $single_price = $bk['price'];
          $bk_title = $bk['name'];
          $shopSummary = "{$shopSummary}{$bk_title}/";
          $bk_id = $bk['pid'];

            $toSql = "INSERT INTO `bought_books_guest`(`g_id`, `p_id`) VALUES('$id', '$bk_id')";

            mysqli_query($conn, $toSql);

            $getQuantity = "SELECT `quantity` FROM `basket` WHERE `user_id` = '$id' AND `book_id` = '$bk_id'";

          $quantityArr = mysqli_query($conn, $getQuantity);

          if (mysqli_num_rows($quantityArr) > 0)
            while ($row = mysqli_fetch_array($quantityArr))
              $quantity = $row[0];
          else
            $quantity = $quantityArr;

          $total_price += $single_price * $quantity;
        }



        
      }





        
        
        $id = $_SESSION['id'];

        $ins = "INSERT INTO `orders`(`invoice`, `customer_id`, `invoice_summary`, `Status`) VALUES('$total_price', '$id', '$shopSummary', 'In Progress')";
        $result = mysqli_query($conn, $ins);
        $lastElmnt = "SELECT `order_id` FROM `orders` ORDER BY `order_id` DESC LIMIT 1";

        $queryIt = mysqli_query($conn, $lastElmnt);
        while ($rw = mysqli_fetch_row($queryIt))
          $order_ID = $rw[0];

        echo "<tr>
              <td><h3>" . $id . "</h3></td>
              <td><h3>$order_ID</h3></td>
              <td><h3>" . $shopSummary . "</h3></td>
              <td><h3>&#8378;" . $total_price . "</h3></td>
             
          </tr>";


          $lastDel = "DELETE from basket where user_id = $id";
          mysqli_query($conn, $lastDel);

          echo "<script>window.open('payment.php','_self')</script>";
      }
        ?>  

      </tbody>

    </table>

  </div>

<?php
if($empty)
      echo '<div class="container" align="middle">
      <h3> <a style="text-decoration:none " href="cart.php">Back to Cart</a></h3>
    </div>
  </body>';
else
      echo '<div class="container" align="right">
      <h3> <a style="text-decoration:none " href="cart.php">Back to Cart</a></h3>
    </div>
  </body>';
?>
  

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