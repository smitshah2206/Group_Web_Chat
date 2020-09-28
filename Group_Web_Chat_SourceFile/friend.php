<!DOCTYPE html>
<html>
<head>
	<title>Friend List</title>
	<link rel="stylesheet" type="text/css" href="Css/stylefriendlist.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div id="outerbox">
		<div id="inner1">
			<div id="sidebar1">
				<div id="sideimagelogobox">
				</div>
			</div>
			<div id="sidebar2">
				<div id="sideulbox">
					<ul>
						<li><a href="dashboard.php"><i class="fa fa-comments fa-1x"></i></a></li>
						<li id="active"><a href="friend.php"><i class="fa fa-users fa-1x" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
			<div id="sidebar3">
				<a href="javascript:void(0)"><i class="fa fa-sign-out fa-1x" aria-hidden="true" id="signout"></i></a>
			</div>
		</div>
		<div id="inner2">
			<div id="inner2searchbox">
				<h2>Pending Request</h2>
			</div>
			<div id="inner2containerbox">
				<ul id="inner2containerboxul">
					
				</ul>
			</div>
			<div id="inner2searchbox2">
				<h2>Suggestion New Friend</h2>
			</div>
			<div id="inner2containerbox2">
				<ul id="inner2containerboxul2">
					
				</ul>
			</div>
		</div>
		<div id="inner3">
			<div id="inner3container">
			</div>
			<div id="inner3footer">
				<div id="inner3searchbox">
					<input type="text" name="" placeholder="Enter a search here">
					<i class="fa fa-share fa-1x" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<div id="inner4">
			<div id="inner4section1">
				<div id="inner4imageprofilebox">
					<img src="design.jpg">
				</div>
			</div>
			<div id="inner4section2">
				<div id="inner4section2section1">
					<ul>
						<li>
							<h2 id="getuserdetails_user_name"></h2>
						</li>
						<li>
							<h4 id="getuserdetails_total_friend"></h4>
						</li>
					</ul>
				</div>
				<div id="inner4section2section2">
					<ul>
						<li>
							<span>
								<i class="fa fa-user fa-1x" aria-hidden="true"></i>
							</span>
							<h4 id="getuserdetails_fullname"></h4>
						</li>
						<li>
							<span>
								<i class="fa fa-map-marker fa-1x" aria-hidden="true"></i>
							</span>
							<h4 id="getuserdetails_location"></h4>
						</li>
						<li>
							<span>
								<i class="fa fa-envelope-o fa-1x" aria-hidden="true"></i>
							</span>
							<h4 id="getuserdetails_user_email"></h4>
						</li>
						<li>
							<span>
								<i class="fa fa-phone fa-1x" aria-hidden="true"></i>
							</span>
							<h4 id="getuserdetails_user_contactnumber"></h4>
						</li>
						<li>
							<span>
								<i class="fa fa-birthday-cake fa-1x" aria-hidden="true"></i>
							</span>
							<h4 id="getuserdetails_date_of_birth"></h4>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	$(document).ready(function(){
		pendingrequestfetch();
		suggestionrequestfetch();
		$('#signout').on('click', function(event){
			event.preventDefault();
			$.ajax({
				url:"logout.php",
				dataType:"json",
				contentType:false,
				cache:false,
				processData:false,
				success:function(data)
				{
					if(data.message)
					{
						alert('Sucessfully Logout');
						window.location='index.php';
					}
				}
			})
		});
	});
		var imagecount=0;
		if(imagecount==0)
		{
			getuserdetails(0);
		}
		function getuserdetails(value)
		{
			$.ajax({
					url:"getuserdetails.php",
					method:"POST",
					data:"id="+value,
					dataType:"json",
					success:function(data)
					{
						if(data.message)
						{
							if(imagecount==0)
							{
								$('#sideimagelogobox').html('<img src="Alphabets/'+data.profile_image+'.png" onclick="getuserdetails('+data.id+')" style="cursor:pointer">');
								imagecount=1;
							}
							$('#inner4imageprofilebox').html('<img src="Alphabets/'+data.profile_image+'.png">');
							$('#getuserdetails_user_name').text(data.user_name);
							$('#getuserdetails_total_friend').text('Since : '+data.since);
							$('#getuserdetails_fullname').text(data.fullname);
							$('#getuserdetails_location').text(data.location);
							$('#getuserdetails_user_email').text(data.user_email);
							$('#getuserdetails_user_contactnumber').text(data.user_contactnumber);
							$('#getuserdetails_date_of_birth').text(data.date_of_birth);
						}
					}
				});
		}
		function sendrequest(value)
		{
			$.ajax({
					url:"sendrequest.php",
					method:"POST",
					data:"user_name="+value,
					dataType:"json",
					success:function(data)
					{
						if(data.message)
						{
							pendingrequestfetch();
							suggestionrequestfetch();
						}
					}
				});
		}
		function acceptrequest(value)
		{
			$.ajax({
					url:"acceptrequest.php",
					method:"POST",
					data:"user_name="+value,
					dataType:"json",
					success:function(data)
					{
						if(data.message)
						{
							pendingrequestfetch();
						}
					}
				});
		}
		function rejectrequest(value)
		{
			$.ajax({
					url:"rejectrequest.php",
					method:"POST",
					data:"user_name="+value,
					dataType:"json",
					success:function(data)
					{
						if(data.message)
						{
							pendingrequestfetch();
							suggestionrequestfetch();
						}
					}
				});
		}
		function pendingrequestfetch()
		{
			$.ajax({
				url:"pendingfriendlist.php",
				dataType:"json",
				success:function(data)
				{
					var  html='';
					for(var result in data)
					{
						var id=data[result]['id'];
						var user_name=data[result]['first_name']+' '+data[result]['last_name'];
						var profile_image=data[result]['profile_image'];
						var user_name_a=data[result]['user_name'];
						html=html+'<li onclick="getuserdetails('+id+')"><div id="inner2containerboximageouterbox"><div id="inner2containerboximagebox"><img src="Alphabets/'+profile_image+'.png"></div></div><ul><li><label style="cursor:pointer">'+user_name+'</label></li><div id="iconside"><i class="fa fa-check fa-1x" style="color:#2ed573;" onclick="acceptrequest(\''+user_name_a+'\')"></i><i class="fa fa-times fa-1x" style="color:#FC427B;" onclick="rejectrequest(\''+user_name_a+'\')"></i></div></ul></li>';
					}
					$('#inner2containerboxul').html(html);
				}
			});
		}
		function suggestionrequestfetch()
		{
			$.ajax({
				url:"suggestionfriendlist.php",
				dataType:"json",
				success:function(data)
				{
					var  html='';
					if(data)
					{
						for(var result in data)
						{
							var id=data[result]['id'];
							var user_name=data[result]['first_name']+' '+data[result]['last_name'];
							var profile_image=data[result]['profile_image'];
							var user_name_a=data[result]['user_name'];
							html=html+'<li onclick="getuserdetails('+id+')"><div id="inner2containerboximageouterbox2"><div id="inner2containerboximagebox2"><img src="Alphabets/'+profile_image+'.png"></div></div><ul><li><label style="cursor:pointer">'+user_name+'</label></li><div id="iconside2"><i class="fa fa-plus fa-1x" style="color:#17c0eb;" onclick="sendrequest(\''+user_name_a+'\')"></i></div></ul></li>';
						}
					}
					$('#inner2containerboxul2').html(html);
				}
			});
		}
</script>
<script type="text/javascript">
	var count=0;
	function send_message_fetch()
	{
		$.ajax({
				url:"message.php",
				dataType:"json",
				success:function(data)
				{
					var  html='';
					for(var result in data)
					{
						var id=data[result]['id'];
						var type=data[result]['type'];
						var friend_id=data[result]['friend_id'];
						var message=data[result]['message'];
						var sent_time=data[result]['sent_time'];
						var profile_image=data[result]['profile_image'];
						html=html+'<div class="chat '+type+'"><div class="user-photo"><img src="Alphabets/'+profile_image+'.png" onclick="getuserdetails('+id+')" style="cursor:pointer"></div><span onclick="getuserdetails('+id+')" style="cursor:pointer">'+friend_id+'</span><p class="chat-message">'+message+'<br><span style="font-size: 14px;">'+sent_time+'</span></p></div>';
					}
					$('#inner3container').html(html);
					if (count==0) 
					{
						$('#inner3container').scrollTop($('#inner3container')[0].scrollHeight);
						count=1;
					}
				}
			});
	}
	function send_message()
	{
		var message=document.getElementById('text_message').value;
		if(message)
		{
			$.ajax({
				url:"send_message.php",
				method:"POST",
				data:"message="+message,
				dataType:"json",
				success:function(data)
				{
					if(data.message)
					{
						send_message_fetch();
					}
					document.getElementById('text_message').value='';
				}
			});
		}
	}
	send_message_fetch();
	setInterval(send_message_fetch,20000);
</script>