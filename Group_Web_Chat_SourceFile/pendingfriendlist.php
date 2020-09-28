<?php
	include 'connection.php';
	session_start();
	$message=0;
	$output='';
	if(isset($_SESSION['id'])) 
	{
		$user_name=$_SESSION['user_name'];
		$sql="SELECT user_details.id,user_details.profile_image,user_details.user_name,user_details.first_name,user_details.last_name FROM `$user_name`,`user_details` WHERE friend_id=user_name AND status=0 ORDER BY first_name";
		$result=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result);
		if($count > 0)
		{
			$message=1;
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