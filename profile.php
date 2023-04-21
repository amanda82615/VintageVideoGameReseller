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

		echo "<h3>Hello, $uid!</h3>";
		echo "<h3>Your Profile</h3>";

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

		echo "<h3>Your Current Listings:</h3>";

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
<br>

<p><a href="logout.php">Logout</a> </p>

