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
        if(isset($_SESSION['email']))
          $maill = $_SESSION['email'];
        else
          $gid = $_SESSION['gid'];
          
        global $conn;
        $ip=getIpAdd();
        
        $book_id = $_GET['add_cart'];
        if(isset($_SESSION['email']))
          $check_product = "SELECT `book_id`, `quantity` FROM `basket` WHERE  book_id='$book_id' AND customer_mail ='$maill'";
        else
          $check_product = "SELECT `book_id`, `quantity` FROM `basket` WHERE  book_id='$book_id' AND customer_mail ='$gid'";
          
        $run_check = mysqli_query($conn, $check_product);

        if(mysqli_num_rows($run_check) > 0)
        {
          if(isset($_SESSION['email']))
            $addMore = "UPDATE `basket` SET `quantity` = `quantity` + 1 WHERE book_id='$book_id' AND customer_mail='$maill'";
          else
            $addMore = "UPDATE `basket` SET `quantity` = `quantity` + 1 WHERE book_id='$book_id' AND customer_mail='$gid'";

          $run_cart = mysqli_query($conn, $addMore);
          echo "<script>window.open('index.php','_self')</script>";
        }
        else 
        {
          if(isset($_SESSION['email']))
            $insert_cart = "INSERT INTO `basket`(`book_id`, `quantity`, `customer_mail`) VALUES ('$book_id', 1, '$maill')";
          else
            $insert_cart = "INSERT INTO `basket`(`book_id`, `quantity`, `customer_mail`) VALUES ('$book_id', 1, '$gid')";

          $run_cart = mysqli_query($conn, $insert_cart);
          echo "<script>window.open('index.php','_self')</script>";
        }
    }
}
function total_items(){
  global $conn;
  $count = 0;
  if(isset($_SESSION['email']))
  {
    $maill = $_SESSION['email']; 
    $get_items = "SELECT * FROM `basket` WHERE `customer_mail` = '$maill'";
    
  }
  else
  {
    $gid = $_SESSION['gid'];
    $get_items = "SELECT * FROM `basket` WHERE `customer_mail` = '$gid'";

  }
  $run = mysqli_query($conn, $get_items);
  while($row = mysqli_fetch_array($run))
      $count+= $row['quantity'];

    echo $count;
}

function mycart() 
{
  global $conn;
  $ip = getIpAdd();

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
  while($bk = mysqli_fetch_array($cart_items)){
    $price_arr = array($bk['price']);
    //$total_price = array_sum($price_arr);
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
    $query="SELECT * from products";
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
                        <h4><p align='right'>&#8378;".$row['price']."</p></h4>".
                            $row['info']
                        ."</div>
                      
                      </div>
                    </div>
                  </div>
                                  
                </div>
                          </div>";    //the last two </div> are from previous echo.
    }
    }
}

function edit_pm(){
	global $conn;
  if(!isset($_GET['category']))
  {
    $query="SELECT * from products";
    $result=mysqli_query($conn, $query);
    $ids = 0;
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
                                  <button class='knowbtn btn btn-warning btn-round btn-sm' data-toggle='modal' data-target='#$rowid'>
                    Edit
                  </button>";
                                  
            //code for modal
          echo "<div class='modal fade' id='$rowid' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                        <form action='pm.php' method='POST'>
                          <button type='button' class='close' data-dismiss='modal aria-hidden='true'>&times;</button>
                          <button type='submit' aria-hidden='true' name = 'upd' class='btn btn-primary'>UPDATE</button> 
                          <br>
                          <div class='form-group'>
                        <label class='control-label'>Product Name</label>
                            <input type='text' class='form-control input-lg' name='chName'>
                            </div>
                              <div>
                              <label class='control-label'>Info</label>
                                  <input type='text' class='form-control input-lg' name='chInfo' >
                              </div>
                              <div>
                              <label class='control-label'>Rating</label>
                                  <input type='text' class='form-control input-lg' name='chRating' >
                              </div>
                              <div>
                              <label class='control-label'>Price</label>
                                  <input type='text' class='form-control input-lg' name='chPrice' >
                              </div>
                              <div>
                              <label class='control-label'>Category</label>
                                  <input type='text' class='form-control input-lg' name='chCat' >
                              </div>
                              <div>
                              <label class='control-label'>Comment</label>
                                  <input type='text' class='form-control input-lg' name='chComment' >
                              </div>
                              <div>
                              <label class='control-label'>Image</label>
                                  <input type='text' class='form-control input-lg' name='chImage' >
                              </div>
                              <div>
                              <label class='control-label'>Author</label>
                                  <input type='text' class='form-control input-lg' name='chAuthor' >
                              </div>
                              <div>
                              <label class='control-label'>Keywords</label>
                                  <input type='text' class='form-control input-lg' name='chKeywords' >
                              </div>
                              </form>
                            </div>
                        <div class='modal-body'>
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

    
    if(isset($_POST['upd']))
    {
      if($_POST['chName'] != "")
      {
        $chName =$_POST['chName'];
        echo "<script> alert('$chName')</script>";
        mysqli_query($conn, "UPDATE `products` SET `name` = '$chName' WHERE `products`.`pid` = $rowid");
      }
        
      if($_POST['chInfo'] != "")
      {
        $chInfo =$_GET['chInfo'];
        mysqli_query($conn, "UPDATE `products` SET `info` = '$chInfo' WHERE `products`.`pid` = $rowid");
      }
      if($_POST['chRating'] != "")
      {
        $chRating =$_GET['chRating'];
        mysqli_query($conn, "UPDATE `products` SET `rating` = '$chRating' WHERE `products`.`pid` = $rowid");
      }
      if($_POST['chPrice'] != "")
      {
        $chPrice =$_GET['chPrice'];
        mysqli_query($conn, "UPDATE `products` SET `price` = '$chPrice' WHERE `products`.`pid` = $rowid");
      }
      if($_POST['chCat'] != "")
      {
        $chCat =$_GET['chCat'];
        mysqli_query($conn, "UPDATE `products` SET `category` = '$chCat' WHERE `products`.`pid` = $rowid");
      }
      if($_POST['chComment'] != "")
      {
        $chComment =$_GET['chComment'];
        mysqli_query($conn, "UPDATE `products` SET `comment` = '$chComment' WHERE `products`.`pid` = $rowid");
      }
      if($_POST['chImage'] != "")
      {
        $chImage =$_GET['chImage'];
        mysqli_query($conn, "UPDATE `products` SET `image` = '$chImage' WHERE `products`.`pid` = $rowid");
      }
      if($_POST['chAuthor'] != "")
      {
        $chAuthor =$_GET['chAuthor'];
        mysqli_query($conn, "UPDATE `products` SET `author` = '$chAuthor' WHERE `products`.`pid` = $rowid");
      }                     
      if($_POST['chKeywords'] != "")
      {
        $chKeywords =$_GET['chKeywords'];
        mysqli_query($conn, "UPDATE `products` SET `keywords` = '$chKeywords' WHERE `products`.`pid` = $rowid");
      }
    }
}


function get_bycat()
{
  global $conn;
  if(isset($_GET['category']))
  {
    $cat_id= $_GET['category'];
    $get_cat_pro = "SELECT * FROM products WHERE category = '$cat_id'";
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
                      
                    </div>
                  </div>
                </div>
                                
              </div>
                        </div>";    //the last two </div> are from previous echo.
      }
    }
  }


function rmZeros()
{
  global $conn;
  mysqli_query($conn, "DELETE FROM `BASKET` WHERE `QUANTITY` <= 0");
}
?>
