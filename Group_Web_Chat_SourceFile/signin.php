<?php
	include 'connection.php';
	session_start();
	if (isset($_POST['user_name'])) 
	{
		$user_name=$_POST['user_name'];
		$password=md5($_POST['password']);
		$error=1;
		$user_name_message='';
		$password_message='';
		$importantnote_message='';
		if(!trim($user_name))
		{
			$error=0;
			$user_name_message='The User Name Field is required';
		}
		if(!trim($user_name))
		{
			$error=0;
			$password_message='The Password Field is required';
		}
		if($error==1)
		{
			$sql="SELECT * FROM user_details WHERE user_name='".$user_name."' AND password='".$password."' ";
			$result=mysqli_query($conn,$sql);
			$count=mysqli_num_rows($result);
			if($count > 0)
			{
				while($row=mysqli_fetch_array($result))
				{
					$_SESSION['id']=$row['id'];
					$_SESSION['user_name']=$row['user_name'];
					$_SESSION['password']=$row['password'];
					$_SESSION['first_name']=$row['first_name'];
					$_SESSION['last_name']=$row['last_name'];
					$_SESSION['user_email']=$row['user_email'];
					$_SESSION['user_contactnumber']=$row['user_contactnumber'];
					$_SESSION['date_of_birth']=$row['date_of_birth'];
				}
				$sql="UPDATE user_details SET last_seen='Active Now' WHERE user_name='".$user_name."'";
				$result=mysqli_query($conn,$sql);
			}
			else
			{
				$error=2;
				$importantnote_message='Username / Password is incorrect';
			}
		}
		$output = array(
			'error'					=>	$error,
			'user_name_message'		=>	$user_name_message,
			'password_message'		=>	$password_message,
			'importantnote_message'	=> $importantnote_message,
		);
		echo json_encode($output);
	}
?>