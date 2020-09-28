<?php
	include 'connection.php';
	session_start();
	$message=0;
	if(isset($_SESSION['id'])) 
	{
		$friend_user_name=$_POST['user_name'];
		$user_name=$_SESSION['user_name'];
		$sql="INSERT INTO `$user_name`(friend_id,status) VALUE ('".$friend_user_name."','2')";
		$result=mysqli_query($conn,$sql);
		$sqla="INSERT INTO `$friend_user_name`(friend_id,status) VALUE ('".$user_name."','0')";
		$resulta=mysqli_query($conn,$sqla);
		$message=1;
	}
	$output=array(
			'message'	=> $message,
	);
	echo json_encode($output);
?>