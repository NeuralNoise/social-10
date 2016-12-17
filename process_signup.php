<?php 

$server = 'localhost';
$uname= 'root';
$pass='';
$db='login';

$con= mysqli_connect($server,$uname,$pass,$db);

$uname = $_POST['name'];
$upass = $_POST['pass'];

$sql = "INSERT INTO users (name,pass) VALUES('".$uname."','".$upass."')";
if($query = mysqli_query($con,$sql)){
	
	echo"successfully registered";
}


?>