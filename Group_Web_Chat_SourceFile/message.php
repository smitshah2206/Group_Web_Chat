<?php
	include 'connection.php';
	session_start();
	$message=0;
	$output='';
	if(isset($_SESSION['id'])) 
	{
		$user_name=$_SESSION['user_name'];
		//$sql="SELECT `friend_id`,`message`,`sent_time`,`profile_image`,user_details.id FROM `$user_name`,`message`,`user_details` WHERE status=1 AND friend_id=user_id AND user_name=friend_id ORDER BY message.sent_time ASC,message.id DESC LIMIT 5";
		//$sql="SELECT * FROM (SELECT * FROM message ORDER BY id desc limit 20) tmp ORDER BY tmp.id ASC";
		$sql="SELECT * FROM (SELECT `friend_id`,`message`,`sent_time`,`profile_image`,user_details.id FROM `$user_name`,`message`,`user_details` WHERE status=1 AND friend_id=user_id AND user_name=friend_id ORDER BY message.id DESC limit 20) tmp ORDER BY tmp.sent_time ASC";
		$result=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result);
		if($count > 0)
		{
			$message=1;
			$output=array();
			while ($row=mysqli_fetch_array($result)) 
			{
				$type='friend';
				if($user_name==$row['friend_id'])
				{
					$type='user';
				}
				$sent_time=date('h : i : A',strtotime($row['sent_time']));
				$output[] = array(
								'id'			=>	$row['id'],
								'type'			=>	$type,
								'friend_id'		=>	$row['friend_id'],
								'message'		=>	$row['message'],	
								'sent_time'		=>	$sent_time,
								'profile_image' =>	$row['profile_image'],
							);
			}
		}
	}
	echo json_encode($output);
?>