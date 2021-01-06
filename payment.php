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
                <tr>
                    <th>#</th>
                    
                    <th colspan="2">Product </th>

                    <th>Quantity</th>
                    
                    <th>Price</th>

                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>

<?php
  if(isset($_SESSION['email']))
    $maill = $_SESSION['email'];
  else 
    $gid = $_SESSION['gid'];

    $count = 1;
  if(isset($_SESSION['email']))
    $get_cart = "SELECT * FROM `products` WHERE `pid` IN (SELECT `book_id` FROM basket WHERE customer_mail = '$maill')";
  else
    $get_cart = "SELECT * FROM `products` WHERE `pid` IN (SELECT `book_id` FROM basket WHERE customer_mail = '$gid')";

  $cart_items = mysqli_query($conn, $get_cart);
  $total_price = 0;    

  while($bk = mysqli_fetch_array($cart_items))
  {
    $price_arr = array($bk['price']);
    $single_price = $bk['price'];
    
    $bk_title = $bk['name'];
    $bk_id = $bk['pid'];

    if(isset($_SESSION['email']))
      $getQuantity = "SELECT `quantity` FROM `basket` WHERE `customer_mail` = '$maill' AND `book_id` = '$bk_id'";
    else
      $getQuantity = "SELECT `quantity` FROM `basket` WHERE `customer_mail` = '$gid' AND `book_id` = '$bk_id'";

      $quantityArr = mysqli_query($conn, $getQuantity);

      if (mysqli_num_rows($quantityArr) > 0) 
        while($row = mysqli_fetch_array($quantityArr))
            $quantity = $row[0];

      else
        $quantity = $quantityArr;
      
      $total_price += $single_price * $quantity;  
      echo "<tr>
                <td scope='row'><h3>".$count++."</h3></td>
                <td>
                <img src='assets/images/".$bk['image']."' width='60px' height='80px'>
                </td>
                <td>
                <h3>".$bk_title."</h3></td>
                <td><h3>$quantity</h3></td>
                <td><h3>&#8378;".$single_price."</h3></td>
                <td><h3>&#8378;".$quantity * $single_price."</h3></td>
                
               
            </tr>";
    
  }
    echo "<tr><td colspan='7' align='right'><h3>Total Price = &#8378;".$total_price."</h3></td></tr>" ;
  

?>      

   </tbody>

        </table>
      
    </div>







    <div class="container" align="right" ><h3> <a  style="text-decoration:none " href="cart.php">Back to Cart</a></h3> </div>
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
