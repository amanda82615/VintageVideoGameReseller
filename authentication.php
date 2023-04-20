<?php

	// Server, database name, sqluserid, and sqlpassword
	// Change to your own server, database, id and password

	$server = "localhost";
	$sqlUsername = "group9";
	$sqlPassword = "group9password";
	$databaseName = "vvgr";

        $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);


	//function to authenticate user, and return TRUE or FALSE
	function authenticateUser($connection, $username, $password)
	{
	  // User table which stores userid and password
	  // Change to your own table name
	  $userTable = "userprofile";

	  // Test the username and password parameters
	  if (!isset($username) || !isset($password))
		return false;

	  $pa = md5($password);
	  // Formulate the SQL statment to find the user
	  $sql = "SELECT *
		 FROM $userTable
		 WHERE userid = '$username' AND password = '$pa'";
	  echo $sql;

	  // Execute the query
          $query_result = $connection->query($sql);
          if (!$query_result) {
              echo "Sorry, query is wrong";
              echo $sql;
          }

	  // exactly one row? then we have found the user
          $nrows = $query_result->num_rows;
	  if ( $nrows != 1)
		return false;
	  else
		return true;
	}

?>
