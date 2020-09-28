<?php
	include 'connection.php';
	session_start();
	$message=0;
	if(isset($_SESSION['id'])) 
	{
		if(isset($_POST['message']))
		{
			$text_message=trim($_POST['message']);
			if ($text_message!='') 
			{
				$user_name=$_SESSION['user_name'];
				$sql="INSERT INTO `message`(user_id,message) VALUE ('".$user_name."','".$text_message."')";
				$result=mysqli_query($conn,$sql);
				$message=1;
			}
		}
	}
	$output=array(
			'message'	=> $message,
	);
	echo json_encode($output);
?>