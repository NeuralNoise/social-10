<?php

include 'db.php';

session_start();
				if(isset($_POST['req'])){	
					$req_id=$_POST['req'];
					$id=$_SESSION['id'];
					$sql_request_search_1 = "SELECT * FROM friend_request WHERE id_1='".$id."' AND id_2='".$req_id."' ";
					$sql_request_search_2 = "SELECT * FROM friend_request WHERE id_2='".$id."' AND id_1='".$req_id."' ";
					
					$request_search_1 = mysqli_query($con,$sql_request_search_1);
					$request_search_2 = mysqli_query($con,$sql_request_search_2);
					
					$request_search_1_res = mysqli_fetch_array($request_search_1);
					$request_search_2_res = mysqli_fetch_array($request_search_2);
					
					if($request_search_1_res || $request_search_2_res){
						if(($request_search_1_res['status']==0) || ($request_search_2_res['status']==0)){
							echo "Request already sent !";
						}
						else
						if(($sql_request_search_1['status']==1) || ($sql_request_search_2['status']==1)){
							echo "You are already friends !";
						}	
			
					}
						
					else{
						$sql_request = "INSERT INTO friend_request(id_1,id_2,status) VALUES('".$id."','".$req_id."',0)";
						
						if($request_query = mysqli_query($con,$sql_request)){
							echo"request sent";
						}						
					}	
				}			

?>

<?php

if(isset($_POST['accept'])){
	$accept_name = $_POST['accept'];
	
	$sql_accept = "INSERT INTO friends(friend_1,friend_2) VALUES('".$accept_name."','".$_SESSION['name']."')";
	$sql_accept_query = mysqli_query($con,$sql_accept);

	$sql_accept_remove = "DELETE FROM friend_request WHERE id_2='".$_SESSION['id']."' ";
	$sql_accept_remove_query = mysqli_query($con,$sql_accept_remove);

		if($sql_accept_query && $sql_accept_remove_query){
			echo "you and " .$accept_name. " are now friends" ;
		}
}

if(isset($_POST['ignore'])){
	$ignore_name = $_POST['ignore'];
	
	
	$sql_ignore_remove = "DELETE FROM friend_request WHERE id_2='".$_SESSION['id']."' ";
	$sql_ignore_remove_query = mysqli_query($con,$sql_ignore_remove);

		if($sql_ignore_remove_query){
			echo "you have declined " .$ignore_name. "'s request" ;
		}
}



?>
