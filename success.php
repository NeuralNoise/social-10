<html>
<body>
<?php
include 'db.php';

session_start(); 
if(isset($_SESSION['loggedin'])){
	if(isset($_SESSION['name'])){
	echo"welcome ".$_SESSION['name'] ;
	}
}
else{
	echo"please login";
	return false;
}
?>

<a href="logout.php">logout</a><br>
<form method="post" action="friends.php">
<input type="text" name="search_txt"></input><input type="submit" name="search_sub"></input>
</form>

<div style="float:left" >
<span><h4> Friend requests </h4></span><br><br>

<?php
	//$my_requests = "SELECT * FROM friend_request WHERE id_2='".$_SESSION['id']."' ";
	//$my_requests_sql = mysqli_query($my_requests);
	
	//while($my_requests_sql_res = mysqli_fetch_array($my_requests_sql)){
		$request_join = "SELECT friend_request.id_1, users.id, users.name
							FROM friend_request
							INNER JOIN users
							ON friend_request.id_1=users.id
							WHERE friend_request.id_2 = '".$_SESSION['id']."' ";
							
							
							 
		$request_join_sql = mysqli_query($con,$request_join);
		
			while($request_join_sql_res = mysqli_fetch_array($request_join_sql)){
				
				echo "<form action='request.php' method=\"post\">";	
				echo $request_join_sql_res['name'];
				echo "&nbsp;<button value='".$request_join_sql_res['name']."' name='accept' >accept</button>";
				echo "&nbsp;<button value='".$request_join_sql_res['name']."' name='ignore' >ignore</button>";
				echo "</form>";	
				echo"<br>";
			}
	
?>
</div>

<div style="float:left;margin-left:100px" >
<span><h4> My Friends </h4></span><br>

<?php

	$friend_search_1 = "SELECT * FROM friends WHERE friend_1='".$_SESSION['name']."' ";
	$friend_search_2 = "SELECT * FROM friends WHERE friend_2='".$_SESSION['name']."' ";
	
	$friend_search_1_sql = mysqli_query($con,$friend_search_1);
	$friend_search_2_sql = mysqli_query($con,$friend_search_2);

	while($res_1 = mysqli_fetch_array($friend_search_1_sql)){
		
		echo $res_1['friend_2'];
		echo "<br>";
	}
	
	while($res_2=mysqli_fetch_array($friend_search_2_sql)){
		
		echo $res_2['friend_1'];
		echo "<br>";
	}
?>

</div>

</body>
</html>