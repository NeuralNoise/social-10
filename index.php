<html>
<head>

<script>

	function ajax(){
		var xmlhttp = new XMLHttpRequest()
		
		xmlhttp.onreadystatechange = function (){
			
			var name = document.getElementById('name');
			var pass = document.getElementById('pass');
			
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200 ){
				var rec = document.getElementById('text');
				rec.innerHTML= xmlhttp.responseText;
			}
		};
		xmlhttp.open('GET','check.php',true);
		xmlhttp.send();
		
		return false;
	} 
	
	
</script>
</head>
<body>

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

<form name="login" action="login.php" method="post" >
<label>Name</label><input type="text" name="name" id="name"></input>
<label>Password</label><input type="password" name="pass" id="pass"></input>
<input type=submit></input>
<div id="text"></div>
</form>

</body>
</html>