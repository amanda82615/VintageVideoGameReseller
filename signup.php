<?php

	//include database information and user information
	require 'authentication.php';

	//never forget to start the session
	session_start();
	$errorMessage = 'Create a user account';

	//are user ID and Password provided?
	if (isset($_POST['UserName']) && isset($_POST['Password']) &&
		isset($_POST['retxtPassword'])) {

		//get userID and Password
		$loginUserName = $_POST['UserName'];
		$loginPassword = $_POST['Password'];
		$reLoginPassword = $_POST['retxtPassword'];
		$firstName = $_POST['FirstName'];
		$lastName = $_POST['LastName'];
		$email = $_POST['Email'];

		if ($loginPassword == $reLoginPassword) {

		//connect to the database
    $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

		//table to store username and password
		$userTable = "USER";

		$ps = md5($loginPassword);

		//table for user profile
		$userTable = "USER";

		// Formulate the SQL statment to find the user
		$sql = "INSERT INTO $userTable VALUES (NULL, '$loginUserName', '$ps', '$firstName','$lastName', '$email')";

		// Execute the query
                $query_result = $conn->query($sql)
			or die( "SQL Query ERROR. User can not be created.");

		// Go to the login page
		header('Location: login.php');
			exit;
		} else {
			$errorMessage = "Passwords do not match";
		}
	}
?>

<html>
	<head>
		<title>Sign-in</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>

	<body>
		<Strong> <?php echo $errorMessage ?> </Strong>

		<form action="" method="post" name="frmLogin" id="frmLogin">
		 <table width="300" border="1" align="center" cellpadding="2" cellspacing="2">
		  <tr>
		   <td width="150">Select User ID *</td>
		   <td><input name="txtUserId" type="text" id="txtUserId"></td>
		  </tr>
		  <tr>
		   <td width="150">Type Password *</td>
		   <td><input name="txtPassword" type="password" id="txtPassword"></td>
		  </tr>
		  <tr>
		   <td width="150">Retype Password *</td>
		   <td><input name="retxtPassword" type="password" id="retxtPassword"></td>
		  </tr>


		  <tr>
		   <td width="150">First Name</td>
		   <td><input name="firstName" type="text" id="firstName"></td>
		  </tr>
		  <tr>

		  <tr>
		   <td width="150">Last Name</td>
		   <td><input name="lastName" type="text" id="lastName"></td>
		  </tr>
		  <tr>
		  <tr>
		   <td width="150">Email Address</td>
		   <td><input name="email" type="text" id="email"></td>
		  </tr>
		  <tr>
		   <td width="150">&nbsp;</td>
		   <td><input name="btnLogin" type="submit" id="btnLogin" value="Sign In"></td>
		  </tr>
		 </table>
		</form>
	</body>
</html>
