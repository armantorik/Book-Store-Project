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
        global $conn;
        $ip=getIpAdd();
        $maill = $_SESSION['email'];
        $book_id = $_GET['add_cart'];
        $check_product = "SELECT `book_id`, `quantity` FROM `basket` WHERE  book_id='$book_id' AND customer_mail='$maill'";
        $run_check = mysqli_query($conn, $check_product);
        if(mysqli_num_rows($run_check)>0)
        {
          //echo "Already added";
        }
        else 
        {
          if(isset($_SESSION['email']))
            $insert_cart = "INSERT INTO `basket`(`book_id`, `customer_mail`) VALUES ('$book_id', '$maill')";
          else
            $insert_cart = "INSERT INTO `basket`(`book_id`, `customer_mail`) VALUES ('$book_id', '$gid')";

          $run_cart = mysqli_query($conn, $insert_cart);
          echo "added";
          echo "<script>window.open('index.php','_self')</script>";
        }
    }
}
function total_items(){
  global $conn;
  if(isset($_SESSION['email']))
    $maill = $_SESSION['email']; 

  else
  {
    $newGuest="INSERT INTO `guests` DEFAULT VALUES";
    $run = mysqli_query($conn, $newGuest);

    $lastElmnt = "SELECT `g_id` FROM `guests`  WHERE 1 = 1 ORDER BY `g_id` DESC LIMIT 1";
    $queryIt = mysqli_query($conn, $lastElmnt);
    while($gid = mysqli_fetch_row($queryIt)) {}
    $_SESSION['gid'] = $gid[0];

  }
    if(isset($_GET['add_cart']))
    {
        $get_items="SELECT * FROM `basket` WHERE `customer_mail`='$maill'";
        $run = mysqli_query($conn, $get_items);
        $count = mysqli_num_rows($run);
    }
    else 
    {
        if(isset($_SESSION['email']))
          $get_items = "SELECT * FROM `basket` WHERE `customer_mail` = '$maill'";
        else
          $get_items = "SELECT * FROM `basket` WHERE `customer_mail` = '$gid[0]'";
          
        $run = mysqli_query($conn, $get_items);
        $count = mysqli_num_rows($run);
    }
    echo $count;
}

function mycart() 
{
  global $conn;
  $ip = getIpAdd();

  if(isset($_SESSION['email']))
    $maill = $_SESSION['email'];
  
    $count = 1;
  if(isset($_SESSION['email']))
    $get_cart = "SELECT * FROM `products` WHERE `pid` IN (SELECT `book_id` FROM basket WHERE customer_mail = '$maill')";
  else
    $get_cart = "SELECT * FROM `products` WHERE `pid` IN (SELECT `book_id` FROM basket WHERE customer_mail = '$gid[0]')";
  $cart_items = mysqli_query($conn,$get_cart);
  $total_price =0;    
  while($bk = mysqli_fetch_array($cart_items)){
    $price_arr = array($bk['price']);
    //$total_price = array_sum($price_arr);
    $single_price = $bk['price'];
    $total_price += $single_price;  
    $bk_title = $bk['name'];
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
                <td><h3>1</h3></td>
                <td><h3>&#8378;".$single_price."</h3></td>
                
               
                
            </tr>";
    
  }
    echo "<tr><td colspan='6' align='right'><h3>Total=&#8378;".$total_price."</h3></td></tr>" ;
  
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


function get_bycat(){
  global $conn;
  if(isset($_GET['category'])){
    $cat_id= $_GET['category'];
    $get_cat_pro = "SELECT * FROM products WHERE category = '$cat_id'";
    $run_cat_pro=mysqli_query($conn,$get_cat_pro);
    $count_cat = mysqli_num_rows($run_cat_pro);
    if($count_cat==0){
      echo "<h2>No books found</h2>";
    }
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


  function getProfile()
  {
    global $conn;
    $maill = $_SESSION['email'];
    $localpass = $_SESSION['password'];
    $localname = $_SESSION['name'];
    $localphone = $_SESSION['phone'];
    $localaddress = $_SESSION['address'];
    echo "
    <div class='.container-md'>
    <img align='middle' width='200p' src='assets/images/pp.png'>

            <h3><p align='middle'>$localname</p></h4>
            <h5><p align='middle'>Mail:  $maill</p></h5> 
            <h5><p align='middle'>Password: $localpass</p></h5>
            <h5><p align='middle'>Phone Number: $localphone</p></h5>
            <h5><p align='middle'>Adress: $localaddress</p></h5>
  </div> ";
    
  }
  
?>
