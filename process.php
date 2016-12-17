<?php 

$server = 'localhost';
$uname= 'root';
$pass='';
$db='login';

$con= mysqli_connect($server,$uname,$pass,$db);




$uname = $_POST['name'];
$upass = $_POST['pass'];

$sql = "SELECT * FROM `users` WHERE name='".$uname."' and pass='".$upass."' ";
$query = mysqli_query($con,$sql);



if( mysqli_num_rows($query) == 1){
	
	echo "login successful";
	
}
else{
	
	echo "login failed";
	
}

?>