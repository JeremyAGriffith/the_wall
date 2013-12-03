<?php 
	require("connection.php");
	session_start();

	if ($_POST)
	{
		if ($_POST['action'] == "login") {
			signin_action();
		}
		else if ($_POST['action'] == "register")
		{
			register_action();
		}
		else
		{
			session_destroy();
			header("Location: signin_register.php");
		}
	}
	else
	{
		session_destroy();
		header("Location: signin_register.php");
	}

	function signin_action()
	{
		// temp record user entered info
		$_SESSION['entered_info'] = array();
		$_SESSION['entered_info']['email'] = $_POST['email'];
		$_SESSION['entered_info']['first_name'] = '';
		$_SESSION['entered_info']['last_name'] = '';

		// ERROR VALIDATIONS
		$errors = '';
		// email
		if (empty($_POST['email']))
		{
			$errors .= '<p>email cannot be blank</p>';
		}
		else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$errors .= '<p>email is not in a valid format</p>';
		}

		// password
		if (strlen($_POST['password']) < 7)
		{
			$errors .= '<p>password must be at at least 7 characters long</p>';
		}

		// either display errors or move forward
		if (!empty($errors))
		{
			$_SESSION['login_errors'] = $errors;
			header("Location: signin_register.php");
		}
		else
		{
			// find all the users matching the info entered
			$query = "SELECT * FROM users WHERE email = '".mysql_real_escape_string($_POST['email'])."' AND password = '".mysql_real_escape_string(md5($_POST['password']))."'";
			$users = fetch_all($query);

			if (count($users) > 0)
			{
				$_SESSION['logged_in'] = true;
				$_SESSION['user']['email'] = $users[0]['email'];
				$_SESSION['user']['first_name'] = $users[0]['first_name'];
				$_SESSION['user']['last_name'] = $users[0]['last_name'];
				$_SESSION['user']['id'] = $users[0]['id'];
				header("Location: wall.php");
			}
			else
			{
				$errors .= 'invalid login information';
				$_SESSION['login_errors'] = $errors;
				header("Location: signin_register.php");
			}
		}
	}

	function register_action()
	{
		// temp record user entered info
		$_SESSION['entered_info'] = array();
		$_SESSION['entered_info']['email'] = $_POST['email'];
		$_SESSION['entered_info']['first_name'] = $_POST['first_name'];
		$_SESSION['entered_info']['last_name'] = $_POST['last_name'];

		// ERROR VALIDATIONS
		$errors = '';
		// email
		if (empty($_POST['email']))
		{
			$errors .= '<p>email cannot be blank</p>';
		}
		else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$errors .= '<p>email is not in a valid format</p>';
		}

		// password
		if (strlen($_POST['password']) < 7)
		{
			$errors .= '<p>password must be at at least 7 characters long</p>';
		}

		// confirm password
		if ($_POST['conf_password'] != $_POST['password'])
		{
			$errors .= '<p>please confirm your password</p>';
		}

		// first name
		if (empty($_POST['first_name']))
		{
			$errors .= '<p>first name cannot be blank</p>';
		}
		else if (contains_nums($_POST['first_name']))
		{
			$errors .= '<p>first name cannot contain numbers</p>';
		}

		// last name
		if (empty($_POST['last_name']))
		{
			$errors .= '<p>last name cannot be blank</p>';
		}
		else if (contains_nums($_POST['last_name']))
		{
			$errors .= '<p>last name cannot contain numbers</p>';
		}

		// either report any errors found or move on
		if (!empty($errors))
		{
			$_SESSION['regist_errors'] = $errors;
			header("Location: signin_register.php");
		}
		else
		{
			// $_SESSION['regist_message'] = 'Thanks for submitting your information.';
			$query = "INSERT INTO users (first_name, last_name, email, password, created_at) VALUES ('".mysql_real_escape_string($_POST['first_name'])."', '".mysql_real_escape_string($_POST['last_name'])."', '".mysql_real_escape_string($_POST['email'])."', '".mysql_real_escape_string(md5($_POST['password']))."', NOW())";
			mysql_query($query);

			$_SESSION['logged_in'] = true;
			$_SESSION['user']['email'] = $_POST['email'];
			$_SESSION['user']['first_name'] = $_POST['first_name'];
			$_SESSION['user']['last_name'] = $_POST['last_name'];
			
			$query = "SELECT id FROM users WHERE email = '".mysql_real_escape_string($_POST['email'])."' AND password = '".mysql_real_escape_string(md5($_POST['password']))."'";
			$users_id = fetch_all($query);
			$_SESSION['user']['id'] = $users_id[0]['id'];
			header("Location: wall.php");
		}
	}

	// determine if string contains any #s
	function contains_nums($str)
	{
		$arr = str_split($str);
		foreach ($arr as $char)
		{
			if (is_numeric($char))
				return true;
		}
		// NO #s
		return false;
	}
?>