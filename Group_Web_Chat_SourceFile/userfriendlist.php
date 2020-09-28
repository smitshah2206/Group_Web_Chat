<?php
	include 'connection.php';
	session_start();
	$message=0;
	if(isset($_SESSION['id'])) 
	{
		$user_name=$_SESSION['user_name'];
		$sql="SELECT user_details.id,user_details.profile_image,user_details.first_name,user_details.last_name,user_details.last_seen FROM `$user_name`,`user_details` WHERE friend_id!='$user_name' AND friend_id=user_name AND status=1 ORDER BY first_name";
		$result=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result);
		if($count > 0)
		{
			$message=1;
			$output=array();
			while ($row=mysqli_fetch_array($result)) 
			{
				$last_seen=date('d M Y  h : i : A',strtotime($row['last_seen']));
				$output[] = array(
								'id'			=>	$row['id'],
								'profile_image'	=>	$row['profile_image'],	
								'first_name'	=>	$row['first_name'],
								'last_name'		=>	$row['last_name'],
								'last_seen'		=>	$last_seen,
							);
			}
		}
	}
	else
	{
		$output = array(
			'message'				=>  $message
		);	
	}
	echo json_encode($output);
?>