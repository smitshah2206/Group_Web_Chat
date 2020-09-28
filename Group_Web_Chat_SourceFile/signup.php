<?php
	include 'connection.php';
	session_start();
	if (isset($_POST['user_name'])) 
	{
		$error=1;
		$first_name_message='';
		$last_name_message='';
		$user_name_message='';
		$password_message='';
		$contact_number_message='';
		$contact_email_message='';
		$date_of_birth_message='';
		$location_message='';
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$user_name=$_POST['user_name'];
		$password=$_POST['password'];
		$contact_number=$_POST['contact_number'];
		$contact_email=$_POST['contact_email'];
		$date_of_birth=$_POST['date_of_birth'];
		$location=$_POST['location'];
		if(!trim($first_name))
		{
			$error=0;
			$first_name_message='The First Name Field is required.';
		}
		else if(!ctype_alpha($first_name))
		{
			$error=0;
			$first_name_message='The First Name Field is accept Only Character.';	
		}
		else if(strlen($first_name)>9)
		{
			$error=0;
			$first_name_message='Max-Length Upto 9 Character Only.';	
		}
		if(!trim($last_name))
		{
			$error=0;
			$last_name_message='The Last Name Field is required.';
		}
		else if(!ctype_alpha($last_name))
		{
			$error=0;
			$last_name_message='The Last Name Field is accept Only Character.';	
		}
		else if(strlen($last_name)>9)
		{
			$error=0;
			$last_name_message='Max-Length Upto 9 Character Only.';	
		}
		if(!trim($user_name))
		{
			$error=0;
			$user_name_message='The User Name Field is required.';
		}
		else if(!ctype_alnum($user_name))
		{
			$error=0;
			$user_name_message='The User Name Field is accept Only Character & Number.';	
		}
		else if(strlen($user_name)>9)
		{
			$error=0;
			$user_name_message='Max-Length Upto 9 Character Only.';	
		}
		else
		{
			$sql="SELECT * FROM user_details WHERE 	user_name='".$user_name."' ";
			$result=mysqli_query($conn,$sql);
			$count=mysqli_num_rows($result);
			if($count > 0)
			{
				$error=0;
				$user_name_message='User Name is already used.';		
			}
		}
		if(!trim($password))
		{
			$error=0;
			$password_message='The Password Field is required.';
		}
		else if(strlen($password)>9 OR strlen($password)<5)
		{
			$error=0;
			$password_message='Length Should be 5-9 Character Only.';	
		}
		if(!trim($contact_number))
		{
			$error=0;
			$contact_number_message='The Contact Number Field is required.';
		}
		else if(!ctype_digit($contact_number))
		{
			$error=0;
			$contact_number_message='The Contact Number Field is accept Only Number.';	
		}
		else if(strlen($contact_number)!=10)
		{
			$error=0;
			$contact_number_message='Length Equal to 10 Digit Only.';	
		}
		else
		{
			$sql="SELECT * FROM user_details WHERE 	user_contactnumber='".$contact_number."' ";
			$result=mysqli_query($conn,$sql);
			$count=mysqli_num_rows($result);
			if($count > 0)
			{
				$error=0;
				$contact_number_message='Contact Number is already used.';		
			}
		}
		if(!trim($contact_email))
		{
			$error=0;
			$contact_email_message='The Contact Email Field is required.';
		}
		else
		{
			$sql="SELECT * FROM user_details WHERE 	user_email='".$contact_email."' ";
			$result=mysqli_query($conn,$sql);
			$count=mysqli_num_rows($result);
			if($count > 0)
			{
				$error=0;
				$contact_email_message='Contact Email is already used.';		
			}
		}
		if(!trim($date_of_birth))
		{
			$error=0;
			$date_of_birth_message='The Date Of Birth Field is required.';
		}
		if(!trim($location))
		{
			$error=0;
			$location_message='The Location Field is required';
		}
		else if(!ctype_alpha($location))
		{
			$error=0;
			$location_message='The Location Field is accept Only Character.';	
		}
		else if(strlen($location)>20)
		{
			$error=0;
			$location_message='Max-Length Upto 20 Character Only.';	
		}
		if($error==1)
		{
			$last_seen=date('Y-m-d H:i:s');
			$profile_image=substr(strtoupper($first_name),0,1);
			$password=md5($_POST['password']);
			$sql="INSERT INTO user_details (profile_image,user_name,first_name,last_name,password,user_email,user_contactnumber,date_of_birth,location,last_seen) VALUES ('".$profile_image."','".$user_name."','".$first_name."','".$last_name."','".$password."','".$contact_email."','".$contact_number."','".$date_of_birth."','".$location."','".$last_seen."') ";
			$result=mysqli_query($conn,$sql);
			$queryc = "CREATE TABLE `$user_name` (id INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,friend_id VARCHAR(255),status INT(1),created_time TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP)";
			$resultc = mysqli_query($conn, $queryc);
			if ($resultc) 
			{
				$sql="INSERT INTO `$user_name`(friend_id,status) VALUES ('".$user_name."','1') ";
				$result=mysqli_query($conn,$sql);
			}
		}
		$output = array(
			'error'						=>	$error,
			'first_name_message'		=>	$first_name_message,
			'last_name_message'			=>	$last_name_message,
			'user_name_message'			=>	$user_name_message,
			'password_message'			=>	$password_message,
			'contact_number_message'	=>	$contact_number_message,
			'contact_email_message'		=>	$contact_email_message,
			'date_of_birth_message'		=>	$date_of_birth_message,
			'location_message'			=>	$location_message,
		);
		echo json_encode($output);
	}
?>