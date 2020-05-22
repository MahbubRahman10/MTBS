<?php

$servername="localhost";
$username="root";
$password="";
$db="mtbs";
$con=new mysqli($servername,$username,$password,$db);
if($con -> connect_error){
     die("Error : " .$con -> connect_error);
}


?>


