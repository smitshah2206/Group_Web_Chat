<?php
	include 'connection.php';
	session_start();
	$message=0;
	if(isset($_SESSION['id'])) 
	{
		if($_POST['id']==0)
		{
			$id=$_SESSION['id'];
		}
		else
		{
			$id=$_POST['id'];
		}
		$sql="SELECT * FROM user_details WHERE id='".$id."'";
		$result=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result);
		if($count > 0)
		{
			$message=1;
			while ($row=mysqli_fetch_array($result)) 
			{
				$profile_image=$row['profile_image'];
				$user_name=$row['user_name'];
				$fullname=$row['first_name'].' '.$row['last_name'];
				$user_email=$row['user_email'];
				$user_contactnumber=$row['user_contactnumber'];
				$date_of_birth=date('d M Y',strtotime($row['date_of_birth']));
				$location=$row['location'];
				$last_seen=$row['last_seen'];
				$since=date('d M Y',strtotime($row['created_time']));
			}
		}
		$output = array(
			'id'					=>	$id,
			'profile_image'			=>	$profile_image,
			'user_name'				=>	$user_name,
			'fullname'				=>	$fullname,
			'user_email'			=>	$user_email,
			'user_contactnumber'	=>	$user_contactnumber,
			'date_of_birth'			=>	$date_of_birth,
			'location'				=>	$location,
			'last_seen'				=>	$last_seen,
			'since'					=>  $since,
			'message'				=>  $message
		);
	}
	else
	{
		$output = array(
			'message'				=>  $message
		);	
	}
	echo json_encode($output);
?>