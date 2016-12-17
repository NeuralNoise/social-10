<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
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
	
	<style>
	th{padding:10px}
	input[type="text"]{
		border:none;
		height:40px;
		width:200px;
		padding:5px;
	}
	input[type="password"]{
		border:none;
		height:40px;
		width:200px;
		padding:5px;
	}
	input[type="submit"]{
		border:none;
		height:40px;
		width:200px;
		padding:5px;
	}
	</style>
</head>
<body>
	<div class="container" style="width:100%">
		<div class="row">
			<div class="col-lg-6" style="height:100%;background-color:#f60">
				<?php 
				session_start();

					$server = 'localhost';
					$uname= 'root';
					$pass='';
					$db='login';
					$con= mysqli_connect($server,$uname,$pass,$db);
				?>

                <div class="col-lg-12 " style="">
					<div style="margin:auto">
						<form name="login" action="<?=$_SERVER['PHP_SELF']?>" method="post" >
							<table border="0" style="" align=center>
							<tr><th><label>Name</label><th><input type="text" name="name" id="name"></input></tr>
							<tr><th><label>Password</label><th><input type="password" name="pass" id="pass"></input></tr>
							<tr><th><th class="text-center"><input type="submit"  name="submit"></input><br></tr>

							<?php
							$invalid = "";
							if(isset($_POST['submit'])){
							if(isset($_POST['name']) && isset($_POST['pass'])){
									$uname = $_POST['name'];
									$upass = $_POST['pass'];
									
									
										
										$sql = "SELECT * FROM `users` WHERE name='".$uname."' and pass='".$upass."' ";
										$query = mysqli_query($con,$sql);
										$row = mysqli_fetch_array($query);
										$db_name = $row['name'];
										$db_pass = $row['pass'];
										$db_id = $row['id'];
											if(($db_name== $uname)&&($db_pass== $upass)){
												$_SESSION['name']=$uname;
												$_SESSION['id']=$db_id;
												$_SESSION['loggedin']="1";
													header("Location: success.php");
													
											}
											else{
												
												$invalid = "invalid username or password";
											}	
										}
									}		

							?>
								<tr><th colspan="2"><div id="text"><?php echo $invalid ?></div></tr>
								</table>	
							</div>
						</div>
						</form>
					</div>	
					
				<div class="col-lg-6" style="height:100%;background-color:#444">
				
				</div>		
			</div>
			
		</div>	

</body>
</html>