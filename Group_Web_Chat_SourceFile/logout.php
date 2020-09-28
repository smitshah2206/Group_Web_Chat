<?php
	include 'connection.php';
	session_start();
	$message=0;
	if(isset($_SESSION['id'])) 
	{
		$last_seen=date('Y-m-d H:i:s');
		$user_name=$_SESSION['user_name'];
		$sql="UPDATE user_details SET last_seen='".$last_seen."' WHERE user_name='".$user_name."'";
		$result=mysqli_query($conn,$sql);
		session_destroy();
		$message=1;
		$output = array(
			'message'	=>	$message
		);
		echo json_encode($output);
	}
?>