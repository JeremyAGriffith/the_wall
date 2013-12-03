<?php 
	require("connection.php");
	session_start();

	if (!isset($_SESSION['logged_in']))
	{
		header("Location: signin_register_process.php");
	}
?>

<!doctype html>
<html>
	<head>
		<title>PHP Advanced_Wall</title>
		<link rel="stylesheet" type="text/css" href="css.css">
	</head>
	<body>
		<div class="container">
			<!-- header -->
			<div id="header">
				<h1>the wall</h1>
				<div id="settings_panel">
					<h3>welcome <span class="caps"><?=$_SESSION['user']['first_name'];?></span></h3>
					<a href="signin_register_process.php">log off</a>
				</div>
			</div>
			<div id="content">
				<!-- post a new message -->
				<div id="post_message">
					<form action="post_msg_cmt_process.php" method="post">
						<input type="hidden" name="action" value="message">
						<label for="message_post">Post a message</label><br />
						<textarea type="text" name="message_post" placeholder="message" id="message_post" rows="8" cols="57"></textarea>
						<br /><button type="submit" class="btn btn-message right">post this</button>
					</form>
				</div>
				<div id="message_list">
<?php 				$msg_query = "SELECT CONCAT(users.first_name,' ', users.last_name) as name, messages.id, messages.message, DATE_FORMAT(messages.created_at, '%M %D %Y') as date_created
								  FROM messages
								  LEFT JOIN users on messages.users_id = users.id
								  ORDER BY messages.created_at DESC";
					$messages = fetch_all($msg_query);
					echo "<div class='msg_container'>";
					foreach ($messages as $message)
					{
						echo "<div class='msg'>
								<h4><span class='caps'>{$message['name']}</span> - {$message['date_created']}</h4>
								<p>{$message['message']}</p>
							  </div>";
						// comments
						$cmt_query = "SELECT CONCAT(users.first_name,' ', users.last_name) as name, comments.comment, DATE_FORMAT(comments.created_at, '%M %D %Y') as date_created
									  FROM comments
									  LEFT JOIN messages on messages.id = comments.messages_id
									  LEFT JOIN users on comments.users_id = users.id
									  WHERE messages.id = {$message['id']}
									  ORDER BY comments.created_at ASC";
						$comments = fetch_all($cmt_query);
						foreach ($comments as $comment)
						{
							echo "<div class='cmt_container'>
									 <h4><span class='caps'>{$comment['name']}</span> - {$comment['date_created']}</h4>
								  	 <p>{$comment['comment']}</p>
							  	  </div>";
						}
						// post a new comment for this parent message
						echo '<div id="post_comment">
								<form action="post_msg_cmt_process.php" method="post">
									<input type="hidden" name="action" value="comment">
									<input type="hidden" name="message_id" value="'.$message['id'].'">
									<label for="comment_post">Post a comment</label><br />
									<textarea type="text" name="comment_post" placeholder="comment" id="comment_post" rows="6" cols="55"></textarea>
									<br /><button type="submit" class="btn btn-comment right">post this</button>
								</form>
							  </div>';
					}
					echo "</div>";
?>
				</div>
			</div>
		</div>
	</body>
</html>