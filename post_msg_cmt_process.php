<?php 
	require("connection.php");
	session_start();

	if ($_POST)
	{
		if ($_POST['action'] == "message") {
			post_message();
		}
		else if ($_POST['action'] == "comment")
		{
			post_comment();
		}
		else
		{
			header("Location: wall.php");
		}
	}
	else
	{
		header("Location: wall.php");
	}

	// post a message
	function post_message()
	{
		// if (!empty($_POST)) {
		// 	# code...
		// }
		$msg = $_POST['message_post'];

		$query = "INSERT INTO messages (users_id, message, created_at) VALUES ({$_SESSION['user']['id']}, '".mysql_real_escape_string($msg)."', NOW())";
		mysql_query($query);
		unset($_POST['message_post']);
		header("Location: wall.php");
	}

	// post a comment
	function post_comment()
	{
		$cmt = $_POST['comment_post'];

		$query = "INSERT INTO comments (users_id, messages_id, comment, created_at) VALUES ({$_SESSION['user']['id']}, {$_POST['message_id']}, '".mysql_real_escape_string($cmt)."', NOW())";
		mysql_query($query);
		unset($_POST['comment_post']);
		header("Location: wall.php");
	}
?>