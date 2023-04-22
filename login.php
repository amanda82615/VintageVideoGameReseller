<?php

	//include database information and user information
	require 'authentication.php';

	//never forget to start the session
	session_start();
	$errorMessage = '';

	//are username and Password provided?
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
		<style>
            * {
                box-sizing: border-box;
            }
            body {
                background-color: #62a8b0;
                font-family: open sans;
                overflow: auto;
            }
        
            .sidenav {
                height: 100%;
                width: 200px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                overflow-x: hidden;
                padding-top: 20px;
            }
        
            .sidenav a {
                padding: 6px 8px 6px 16px;
                text-decoration: none;
                font-size: 25px;
                color: #000000;
                display: block;
                background-color: white;
                border: 1px;
                border-radius: 15px;
                margin: 5px;
            }
        
            .sidenav a:hover {
                color: #0D00FF;
            }
            .main {
                margin-left: 200px;
                font-size: 22px;
                padding: 20px;
                background-color: white;
                width: auto;
                height: auto;
                margin-top: 50px;
                border-radius: 25px;
                overflow: auto;
            }
            .column {
                float: left;
                width: 30%;
                padding: 10px;
                height: 150px;
                margin: 5px;
                background-color: #d1d1d1;
            }
            .column a{
               text-decoration: none;
               color: #000000; 
            }
            .column a:hover {
                color: #0D00FF;
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }
			.button1 {
                border: none;
                color: white;
                background-color: #62a8b0;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }
        </style>
	</head>

	<body>

		<Strong> <?php echo $errorMessage ?> </Strong>
		If you don't have an account, please <a href="signup.php">sign up</a>.
		<div class="sidenav">
            <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px;">Please log in!</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Buy</a> <br>
            <a href="create_listing.php">Sell</a> <br>
            <a href="profile.php">Account</a>
        </div>

		<div class="main">
		<h2>Vintage Video Game Reseller</h2>
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
		</div>
	</body>
</html>
