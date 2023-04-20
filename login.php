<?php

	//include database information and user information
	require 'authentication.php';

	//never forget to start the session
	session_start();
	$errorMessage = '';

	//are user ID and Password provided?
	if (isset($_POST['UserName']) && isset($_POST['Password'])) {

		//get userID and Password
		$loginUserName = $_POST['UserName'];
		$loginPassword = $_POST['Password'];

		//connect to the database
    $connection = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

		// Authenticate the user
		if (authenticateUser($connection, $loginUserName, $loginPassword))
		{
			//the user id and password match,
			// set the session
			$_SESSION['db_is_logged_in'] = true;
			$_SESSION['UserName'] = $loginUserName;

			// after login we move to the main page
			header('Location: home.php');
			exit;
		} else {
			$errorMessage = 'Sorry, wrong username / password';
		}
	}
?>

<html>
	<head>
		<title>Basic Login</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>

	<body>
		<Strong> <?php echo $errorMessage ?> </Strong>
		If you don't have an account, please <a href="signup.php">sign up</a>.
		<form action="" method="post" name="frmLogin" id="frmLogin">
			 <table width="400" border="1" align="center" cellpadding="2" cellspacing="2">
				  <tr>
					<td width="150">Username</td>
					<td><input name="UserName" type="text" id="UserName"></td>
				  </tr>
				  <tr>
					<td width="150">Password</td>
					<td><input name="Password" type="password" id="Password"></td>
				  </tr>
				  <tr>
					<td width="150">&nbsp;</td>
					<td><input name="btnLogin" type="submit" id="btnLogin" value="Login"></td>
				  </tr>
			 </table>
		</form>
	</body>
</html>
