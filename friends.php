
<?php
include 'db.php';

session_start();

if($_SESSION['loggedin']==true){

if(isset ($_SESSION['name'])){
$res="";
$res_err="";
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$abc="aaaa";


	

	



if(isset($_POST['search_txt'])){
	
	$search_txt= $_POST['search_txt'];
	$sql_search = "SELECT * FROM users WHERE name LIKE '%$search_txt%' ";	
	$search_query = mysqli_query($con,$sql_search);
	
	if($search_res = mysqli_fetch_array($search_query)){
		
		
		while($search_res = mysqli_fetch_array($search_query)){		 		 
			echo $search_res['name'];
			echo "<form action='request.php' method=\"post\">";	
			echo "&nbsp;<button value='".$search_res['id']."' name='req' >add friend</button>";
			echo "</form>";	
			echo "<br>";
			 
			 
			 //$search_id=$search_res['id'];
			 //request($id,$search_res['id'],0,$con);
			 
			 
		}
	}
	
	else{
		$res_err =  'no results found';
	}
	
	

}


}
}


else{echo'please log in';}

function request($id_1,$id_2,$status,$con){
				
	}
?>


<?php
/*$a=mysqli_query($con,"CREATE TABLE $abc(abc VARCHAR(10))");
$b=mysqli_query($con,"INSERT INTO $abc(abc) VALUES('$abc')");
echo $name;*/
?>

<?php

//$search_friend = "SELECT  * FROM friends WHERE friend_1='".$name."' OR friend_2='".$name."' ";
//$search_freind_query = mysqli_query($con,$search_friend);
//$friend_list = mysqli_fetch_array($search_friend_query);

	$check_friend_1 = mysqli_query($con,"SELECT  friend_2 FROM friends WHERE friend_1='".$name."'");
	$check_friend_2 = mysqli_query($con,"SELECT  friend_1 FROM friends WHERE friend_2='".$name."'");
	




	/*while($check_friend_1_list = mysqli_fetch_array($check_friend_1)){

		echo $check_friend_1_list['friend_2'] ;
		echo "<br>";

	}

	while($check_friend_2_list = mysqli_fetch_array($check_friend_2)){

		echo $check_friend_2_list['friend_1'] ;
		echo "<br>";

	}*/






?>
<div id="text"><?php// echo $id ?></div>
<div id="text"><?php echo $res_err ?></div>