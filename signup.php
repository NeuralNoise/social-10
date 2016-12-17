<html>
<head>

<script>

function val(){
	var name = document.getElementById('name').value;
	var pass = document.getElementById('pass').value;

if((name==0) || (pass == 0)){
	alert('please complete the form !');
	return false;
}
}

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
$error = "";
$success = "";
$con= mysqli_connect($server,$uname,$pass,$db);

if(isset($_POST['submit'])){
	if(isset($_POST['name']) && isset($_POST['pass'])){
		$uname = $_POST['name'];
		$upass = $_POST['pass'];
		$user_check = "SELECT * FROM users WHERE name='".$uname."'";
		$row = mysqli_query($con,$user_check);
		$check = mysqli_num_rows($row);
		
		if($check >= 1)
		{
			
			$error = "user already exist!";
			//echo "user already exist!";
		}
		else{
			$sql = "INSERT INTO users (name,pass) VALUES('".$uname."','".$upass."')";
			if($query = mysqli_query($con,$sql)){
				
				$success = "successfully registered";
				//echo"successfully registered";
			}
		}	
	}
}
?>

<form name="signup" action="signup.php" method="post" >
<label>Name</label><input type="text" name="name" id="name"></input>
<label>Password</label><input type="password" name="pass" id="pass"></input>
<input type="submit" name="submit" onclick="return val()"></input>
<div id="error"><?php echo $error?></div><br>
<div id="success"><?php echo $success?></div><br>
<button name="view">View all users</button><br>
<?php
	if(isset($_POST['view'])){
		$get_user = "SELECT name FROM users";
		$user_sql = mysqli_query($con,$get_user);
		
		
		
		while ($user_arr = mysqli_fetch_array($user_sql)) {
			echo $user_arr['name'];
			echo "<br><br>";
		}
	}
?>
</form>

</body>
</html>