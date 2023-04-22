<!DOCTYPE html>
<html>
    <title>My account</title>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        </style>
    </head>
    <body>
        <div class="sidenav">
            <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px;">Your Profile</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Buy</a> <br>
            <a href="create_listing.php">Sell</a> <br>
            <a href="profile.php">Account</a>
        </div>
        
        <div class="main">
			<?php
				//include information required to access database
				require 'authentication.php'; 

				//start a session 
				session_start();

				//still logged in?
				if (!isset($_SESSION['db_is_logged_in'])
					|| $_SESSION['db_is_logged_in'] != true) {
					//not logged in, move to login page
					header('Location: login.php');
					exit;
				} else {

					//logged in 
					// Connect database server
					$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

					if (isset($_POST['FirstName']) || isset($_POST['LastName']) || isset($_POST['Email'])) {
						$newFirst = $_POST['FirstName'];
						$newLast = $_POST['LastName'];
						$newEmail = $_POST['Email'];
					}

					// Prepare query
					$table = "USER";
					$uid = $_SESSION['UserName'];

					if ($newFirst != "" && $newLast != "" && $newEmail != "") {
						$sql = "UPDATE $table SET FirstName='$newFirst', LastName='$newLast', Email='$newEmail' WHERE UserName='$uid'";
						$query_result = $conn->query($sql);
						if (!$query_result) {
							echo "Could not execute query: $sql";
							die;
						}
					}

					$sql = "SELECT UserName, FirstName, LastName, Email FROM USER where UserName = '$uid'";

					// Execute query
					$query_result = $conn->query($sql);
					if (!$query_result) {
						echo "Query is wrong: $sql";
						die;
					}

					echo "<h2>Hello, $uid!</h2>";
					echo "<h4>Account Info: </h4>";

					// Output query results: HTML table
					echo "<table border=1>";
					echo "<tr>";
						
					// fetch attribute names
					while ($fieldMetadata = $query_result->fetch_field()) {
						echo "<th>".$fieldMetadata->name."</th>";
							}
					echo "</tr>";
						
					// fetch table records
					while ($line = $query_result->fetch_assoc()) {
						echo "<tr>\n";
						foreach ($line as $cell) {
							echo "<td> $cell </td>";
						}
						echo "</tr>\n";
					}
					echo "</table>";

					$sql = "SELECT i.ItemId, i.ItemName, i.Price, i.Status FROM ITEM as i, USER as u WHERE i.SellerId=u.UserId AND u.UserName='$uid'";
					$query_result = $conn->query($sql);
					if (!$query_result) {
						echo "Query is wrong: $sql";
						die;
					}

					echo "<h4>Your Current Listings:</h4>";

					// Output query results: HTML table
					echo "<table border=1>";
					echo "<tr>";
						
					// fetch attribute names
					while ($fieldMetadata = $query_result->fetch_field()) {
						echo "<th>".$fieldMetadata->name."</th>";
							}
					echo "</tr>";
						
					// fetch table records
					while ($line = $query_result->fetch_assoc()) {
						echo "<tr>\n";
						foreach ($line as $cell) {
							echo "<td> $cell </td>";
						}
						echo "</tr>\n";
					}
					echo "</table>";
					
					// close the connection
					$conn->close();
				}
			?>
			<h2>Have Something You Want to Sell? List a New Item <a href='create_listing.php'>Here!</a></h2>
			<h3>Update Your Profile Information:</h3>
			<form action="profile.php" method="post" name="profileUpdate" id="profileUpdate">
				<table width="300" border="1" align="left" cellpadding="2" cellspacing="2">
					<tr>
					<tr>
					<td width="150">First Name</td>
					<td><input name="FirstName" type="text" id="FirstName"></td>
					</tr>
					<tr>

					<tr>
					<td width="150">Last Name</td>
					<td><input name="LastName" type="text" id="LastName"></td>
					</tr>
					<tr>
					<tr>
					<td width="150">Email Address</td>
					<td><input name="Email" type="text" id="Email"></td>
					</tr>
					<tr>
					<td width="150">&nbsp;</td>
					<td><input name="btnLogin" type="submit" id="btnLogin" value="Update"></td>
					</tr>
				</table>
			</form>
			<br><br><br><br><br><br>

			<p><a href="logout.php">Logout</a> </p>

			
    	</div>

    </body>
</html>

