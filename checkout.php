<?php

if(!isset($_SESSION['email'])){
    include("newlogin.php");
}
else{
    include("payment.php");
}

?>