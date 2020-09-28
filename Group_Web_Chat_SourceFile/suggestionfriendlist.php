<?php
	include 'connection.php';
	session_start();
	$output='';
	if(isset($_SESSION['id'])) 
	{
		$user_name=$_SESSION['user_name'];
		$sql="SELECT id,profile_image,user_name,first_name,last_name FROM `user_details` WHERE user_name NOT IN (SELECT friend_id FROM `$user_name`) ORDER BY first_name";
		$result=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result);
		if($count > 0)
		{
			$output=array();
			while ($row=mysqli_fetch_array($result)) 
			{
				$output[] = array(
								'id'			=>	$row['id'],
								'profile_image'	=>	$row['profile_image'],	
								'user_name'		=>	$row['user_name'],
								'first_name'	=>	$row['first_name'],
								'last_name'		=>	$row['last_name'],
							);
			}
		}
	}
	echo json_encode($output);
?>