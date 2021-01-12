<?php
include("includes/db.php");


function getIpAdd()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}




function cart(){
    if(isset($_GET['add_cart']))
    {
        $id = $_SESSION['id'];
          
        global $conn;
        $ip=getIpAdd();
        
        $book_id = $_GET['add_cart'];

        $check_product = "SELECT `book_id`, `quantity` FROM `basket` WHERE  book_id='$book_id' AND user_id ='$id'";
        $run_check = mysqli_query($conn, $check_product);

        if(mysqli_num_rows($run_check) > 0)
        {
          $addMore = "UPDATE `basket` SET `quantity` = `quantity` + 1 WHERE book_id='$book_id' AND user_id='$id'";
          mysqli_query($conn, $addMore);
          echo "<script>window.open('index.php','_self')</script>";
        }
        else 
        {
          $insert_cart = "INSERT INTO `basket`(`book_id`, `quantity`, `user_id`) VALUES ('$book_id', 1, '$id')";
          mysqli_query($conn, $insert_cart);

          echo "<script>window.open('index.php','_self')</script>";
        }
    }
}
function total_items(){
  global $conn;
  $count = 0;

  $id = $_SESSION['id'];
  $get_items = "SELECT * FROM `basket` WHERE `user_id` = '$id'";

  $run = mysqli_query($conn, $get_items);
  while($row = mysqli_fetch_array($run))
      $count+= $row['quantity'];

    echo $count;
}

function mycart() 
{
  global $conn;
  $ip = getIpAdd();

  $id = $_SESSION['id'];

  $count = 1;

  $get_cart = "SELECT * FROM `products` WHERE `pid` IN (SELECT `book_id` FROM basket WHERE user_id = '$id')";

  $cart_items = mysqli_query($conn, $get_cart);

  $total_price = 0;    
  while($bk = mysqli_fetch_array($cart_items)){

    $single_price = $bk['price'];
    
    $bk_title = $bk['name'];
    $bk_id = $bk['pid'];

    $getQuantity = "SELECT `quantity` FROM `basket` WHERE `user_id` = '$id' AND `book_id` = '$bk_id'";

    $quantityArr = mysqli_query($conn, $getQuantity);

      if (mysqli_num_rows($quantityArr) > 0) 
        while($row = mysqli_fetch_array($quantityArr))
            $quantity = $row[0];

      else
        $quantity = $quantityArr;
      
      $total_price += $single_price * $quantity;  
      echo "<tr>
                <td scope='row'><h3>".$count++."</h3></td>
                 <td scope='row' class='td-actions'>
                   
                   <h3> <div class='checkbox'>
                        <label>
		                  <input type='checkbox'  name='remove[]' value='".$bk['pid']."'>
		                      
	                   </label>
                       </div></h3>
                      
                </td>
                <td><img src='assets/images/".$bk['image']."' width='60px' height='80px'></td>
                <td><h3>".$bk_title."</h3></td>
                <td><h3>$quantity</h3></td>
                <td><h3>&#8378;".$single_price."</h3></td>
                <td><h3>&#8378;".$quantity * $single_price."</h3></td>
                
               
            </tr>";
  }
    echo "<tr><td colspan='7' align='right'><h3>Total Price = &#8378;".$total_price."</h3></td></tr>" ;
  
}

function getcats(){
	global $conn;

  $query4="SELECT DISTINCT category FROM products";
  $result=mysqli_query($conn, $query4);
	while($row=mysqli_fetch_array($result))
	{
		echo "<li role=\"presentation\"><a href=\"index.php?category=".$row['category']."\">".$row['category']."</a></li>";
	}

}

  function getauths(){
	global $conn;

	$query3="SELECT DISTINCT author FROM products";
	$result=mysqli_query($conn, $query3);
	while($row=mysqli_fetch_array($result))
	{
		echo "<li role=\"presentation\"><a href=\"#".$row['author']."\">".$row['author']."</a></li>";
	}

}

function getbooks(){
	global $conn;
  if(!isset($_GET['category']))
  {
    if(isset($_POST['sortByName']))
    {
      $query="SELECT * from products ORDER BY `name`";
    }
    else if(isset($_POST['sortByPrice']))
    { 
       $query="SELECT * from products ORDER BY price";
    }
    else if(isset($_POST['sortByRating']))
    {
      $query="SELECT * from products ORDER BY rating";
    }
    else
    {
      $query="SELECT * from products";
    }
    $result=mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($result))
    {
      echo "<div class='col-lg-4 col-md-6'>
                              <div class='card'>
                                  <img class='card-img' height='200px' width='100px' src='assets/images/".$row['image']."'>
                                  <span class='content-card'>
                                      <h6>".$row['name']."</h6>
                                      <h7>".$row['author']."</h7>
                                  </span>
                                  <a href='index.php?add_cart=".$row['pid']."'>
                                  <button class='buybtn btn btn-warning btn-round btn-sm'>
                    Add <i class='material-icons'>add_shopping_cart</i>
                  </button></a>
                                  <button class='knowbtn btn btn-warning btn-round btn-sm' data-toggle='modal' data-target='#".$row['pid']."'>
                    Know More
                  </button>";
                                  
            //code for modal
          echo "<div class='modal fade' id='".$row['pid']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                          <h4 class='modal-title' id='myModalLabel'>".$row['name']."</h4>
                        </div>
                        <div class='modal-body'>
                        <h4><p align='right'>&#8378;".$row['price']."</p></h4>".
                            $row['info']."</div>
                      
                  ";    //the last </div>s are from previous echo.

                          
                        $p_id = $row['pid'];

                        $numRatings = "SELECT rating from user_rates where p_id = '$p_id'";
                        $arr = mysqli_query($conn, $numRatings);
                        $num = mysqli_num_rows($arr);
                        
                        if($num == 0)
                          echo "<p>No Rating</p>";
                        else
                        {
                          $av = "SELECT AVG(`rating`) FROM `user_rates` WHERE `p_id` = '$p_id'";
                          echo "<script>alert('$av')</script>";
                          $ratings = mysqli_query($conn, $av);
                          while($rws = mysqli_fetch_row($ratings))
                          {
                            $rating = $rws[0];
                            echo "<p>Rating: $rating</p>";
                          }
                          
  
                        }
                        

                      $qr1 = "SELECT ccp.comment, c.c_name
                              FROM customer_comment_product ccp, products p, customers c
                              WHERE p.pid = '$p_id' AND ccp.p_id = p.pid AND c.c_id = ccp.c_id 
                          ";

                      $qr2 = "SELECT ccp.comment
                              FROM customer_comment_product ccp, products p, guests g
                              WHERE p.pid = '$p_id' AND ccp.p_id = p.pid AND g.g_id = -ccp.c_id 
                          ";
                            $sqlRun = mysqli_query($conn, $qr1);
                            $howMany = 0;
                            $howMany+= mysqli_num_rows($sqlRun);
                            $sqlRun2 = mysqli_query($conn, $qr2);
                            $howMany+= mysqli_num_rows($sqlRun2);
                            if($howMany == 0)
                              echo "<p>No comments</p>";
                            else
                              {
                                echo "<b>Comments: </b> <br>";
                                while($rw = mysqli_fetch_row($sqlRun))
                                {
                                  echo "<b>User $rw[1] - $rw[0]</p>";
                                }
                                while($rw = mysqli_fetch_row($sqlRun2))
                                {
                                  echo "<b>A guest - $rw[0]</p>";
                                }
                              }
               echo "     </div>
               </div>
             </div>          </div>
          </div>";
    }
    }
}

function get_bycat()
{
  global $conn;
  if(isset($_GET['category']))
  {
    $cat_id= $_GET['category'];
    
    if(isset($_POST['sortByName']))
    {
      $get_cat_pro="SELECT * from products WHERE category = '$cat_id' ORDER BY `name`";
    }
    else if(isset($_POST['sortByPrice']))
    { 
       $get_cat_pro="SELECT * from products WHERE category = '$cat_id' ORDER BY price";
    }
    else if(isset($_POST['sortByRating']))
    {
      $get_cat_pro="SELECT * from products WHERE category = '$cat_id' ORDER BY rating";
    }
    else
    {
      $get_cat_pro = "SELECT * FROM products WHERE category = '$cat_id'";
    }

    
    $run_cat_pro=mysqli_query($conn,$get_cat_pro);
    $count_cat = mysqli_num_rows($run_cat_pro);
    if($count_cat==0)
      echo "<h2>No books found</h2>";

    while($row=mysqli_fetch_array($run_cat_pro))
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

               

           //code for modal
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
                      
                    
                                
      ";    //the last two </div> are from previous echo.


                        $p_id = $row['pid'];

                        $numRatings = "SELECT rating from user_rates where p_id = '$p_id'";
                        $arr = mysqli_query($conn, $numRatings);
                        $num = mysqli_num_rows($arr);
                        
                        if($num == 0)
                          echo "<p>No Rating</p>";
                        else
                        {
                          $av = "SELECT AVG(`rating`) FROM `user_rates` WHERE `p_id` = '$p_id'";
                          echo "<script>alert('$av')</script>";
                          $ratings = mysqli_query($conn, $av);
                          while($rws = mysqli_fetch_row($ratings))
                          {
                            $rating = $rws[0];
                            echo "<p>Rating: $rating</p>";
                          }
                        }

                        $qr1 = "SELECT ccp.comment, c.c_name
                                FROM customer_comment_product ccp, products p, customers c
                                WHERE p.pid = '$p_id' AND ccp.p_id = p.pid AND c.c_id = ccp.c_id 
                            ";

                            $qr2 = "SELECT ccp.comment
                            FROM customer_comment_product ccp, products p, guests g
                            WHERE p.pid = '$p_id' AND ccp.p_id = p.pid AND g.g_id = -ccp.c_id 
                        ";
                            $sqlRun = mysqli_query($conn, $qr1);
                            $howMany = 0;
                            $howMany+= mysqli_num_rows($sqlRun);
                            $sqlRun2 = mysqli_query($conn, $qr2);
                            $howMany+= mysqli_num_rows($sqlRun2);
                            if($howMany == 0)
                              echo "<p>No comments</p>";
                            else
                              {
                                //echo "<script> alert('hello') </script>";
                                echo "<b>Comments: </b> <br>";
                                while($rw = mysqli_fetch_row($sqlRun))
                                {
                                  echo "<b>User $rw[1] - $rw[0]</p>";
                                }
                                while($rw = mysqli_fetch_row($sqlRun2))
                                {
                                  echo "<b>A guest - $rw[0]</p>";
                                }
                              }
               echo "     </div>
               </div>
             </div>          </div>
          </div>";
      }
    }
  }


  function edit_pm()
  {
    global $conn;
    if(!isset($_GET['category']))
    {
      $query="SELECT * from products";
      $result=mysqli_query($conn, $query);
      
      while($row = mysqli_fetch_array($result))
      {
        $rowid = $row['pid'];
        echo "<div class='col-lg-4 col-md-6'>
                                <div class='card'>
                                    <img class='card-img' height='200px' width='100px' src='assets/images/".$row['image']."'>
                                    <span class='content-card'>
                                        <h6>".$row['name']."</h6>
                                        <h7>".$row['author']."</h7>
                                    </span>
                                    <a href='pm.php?remove_product=$rowid'><button class='buybtn btn btn-warning btn-round btn-sm'>
                                    Remove
                                    </button></a>
                                <button class='knowbtn btn btn-warning btn-round btn-sm' data-toggle='modal' data-target='#".$row['pid']."'>
	 								          Know More
								          </button>
                                    ";
                                    
              //code for modal
        echo "
        
        <div class='modal fade' id='".$row['pid']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>

        <div class='modal-dialog'>

          <div class='modal-content'>

            <div class='modal-header'>
              <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
              <h4 class='modal-title' id='myModalLabel'>Book Name: ".$row['name']."</h4>
            </div>
            <div class='modal-body'>

            <h4><p align ='left'>Id = ".$row['pid']."</p></h4> 
            <h4><p align='right'>Price: &#8378;".$row['price']."</p></h4>Info: ".
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
      if(isset($_GET['remove_product']))
      {
        $pid = $_GET['remove_product'];
        mysqli_query($conn, "DELETE from products where pid = '$pid'");
      }
  }
  
  

function rmZeros()
{
  global $conn;
  mysqli_query($conn, "DELETE FROM `BASKET` WHERE `QUANTITY` <= 0");
}
?>
