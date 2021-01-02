<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$conn=mysqli_connect("localhost", "root", "","group20commercialupd");
  
?>