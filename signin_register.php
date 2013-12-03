<?php 
	session_start();

	if (isset($_SESSION['logged_in']))
	{
		header("Location: wall.php");
	}
	else if (!isset($_SESSION['entered_info']))
	{
		$_SESSION['entered_info'] = array();
		$_SESSION['entered_info']['email'] = '';
		$_SESSION['entered_info']['first_name'] = '';
		$_SESSION['entered_info']['last_name'] = '';
	}
?>

<!doctype html>
<html>
	<head>
		<title>PHP Advanced_Wall - Sign In / Register</title>
		<link rel="stylesheet" type="text/css" href="css.css">
	</head>
	<body>
		<div class="container">
			<!-- header -->
			<div id="header">
				<h1>the wall</h1>
			</div>
			<div id="content">
<?php 			if (isset($_SESSION['regist_errors'])) 
					echo "<div>".$_SESSION['regist_errors']."</div>";
				if (isset($_SESSION['login_errors']))
					echo "<div>{$_SESSION['login_errors']}</div>";
?>
				<!-- LOGIN FORM -->
				<div id="signin">
					<h2>or login</h2>
					<form action="signin_register_process.php" method="post">
						<input type="hidden" name="action" value="login">
						<input type="text" name="email" placeholder="email" id="email" value="<?=$_SESSION['entered_info']['email'];?>"><br />
						<input type="password" name="password" placeholder="password" id="password"><br />
						<button type="submit" class="btn btn-message">Login</button>
					</form>
				</div>

				<!-- REGISTER FORM -->
				<div id="register">
					<h2>register</h2>
					<p class="notice">* are required to register</p>
					<form action="signin_register_process.php" method="post">
						<input type="hidden" name="action" value="register">
						<label for="email">Email *</label><br />
						<input type="text" name="email" placeholder="email" id="email" value="<?=$_SESSION['entered_info']['email'];?>"><br />
						<label for="password">Password *</label>
						<input type="password" name="password" placeholder="password" id="password"><br />
						<label for="conf_password">Confirm Password above*</label>
						<input type="password" name="conf_password" placeholder="password" id="conf_password"><br />
						<label for="first_name">First Name *</label>
						<input type="text" name="first_name" placeholder="first name" id="first_name" value="<?=$_SESSION['entered_info']['first_name'];?>"><br />
						<label for="last_name">Last Name *</label>
						<input type="text" name="last_name" placeholder="last name" id="last_name" value="<?=$_SESSION['entered_info']['last_name'];?>"><br />
						<button type="submit" class="btn btn-message">Register</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

<?php 
	unset($_SESSION['entered_info']);
	unset($_SESSION['regist_errors']);
	unset($_SESSION['regist_message']);
	unset($_SESSION['login_errors']);
?>