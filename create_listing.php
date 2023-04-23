<!DOCTYPE html>
<html>
    <title>New Listing</title>
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
            .button1 {
                border: none;
                color: white;
                background-color: #62a8b0;
                padding: 15px 32px;
                text-align: left;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }
            .search {
                border: 5px;
                border-color: Black;
                color: Black;
                background-color: White;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
            }
            .table1 {
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
                background-color: #d1d1d1;
            }
            th, td {
                border: 1px solid black;
            }
            h2 {
                text-align: center;
                background: #62a8b0;
                width: auto;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="sidenav">
            <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px;">Sell Sell Sell!</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Search</a> <br>
            <a href="purchase.php">Buy</a> <br>
            <a href="create_listing.php">Sell</a> <br>
            <a href="profile.php">Account</a>
        </div>
        
        <div class="main">
        <h2>Vintage Video Game Reseller</h2>
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

					if (isset($_POST['ItemName']) || isset($_POST['Brand']) || isset($_POST['Price']) || isset($_POST['Category']) || isset($_POST['Condition'])) {
						$newItem = $_POST['ItemName'];
						$newBrand = $_POST['Brand'];
						$newPrice = floatval($_POST['Price']);
                        $newCategory = $_POST['Category'];
                        $newCondition = $_POST['Condition'];
                        $newStatus = "Available";
					}

					// Prepare query
					$table = "ITEM";
                    $userTable = "USER";
					$uid = $_SESSION['UserName'];

					if ($newItem != "" && $newBrand != "" && $newCategory != "" && $newCondition != "") {
						$sql = "INSERT INTO $table VALUES (NULL, (SELECT DISTINCT UserId FROM $userTable WHERE UserName ='$uid'), 
                            '$newItem',  '$newBrand', '$newCategory', '$newCondition', $newPrice, '$newStatus')";
						$query_result = $conn->query($sql);
						if (!$query_result) {
							echo "Could not execute query: $sql";
							die;
						}
					}

					

					$sql = "SELECT i.ItemId AS 'ID', i.ItemName AS 'Name', i.Brand, i.Category, i.State AS 'Condition', i.Price, i.Status FROM ITEM as i, USER as u WHERE i.SellerId=u.UserId AND u.UserName='$uid'";
					$query_result = $conn->query($sql);
					if (!$query_result) {
						echo "Query is wrong: $sql";
						die;
					}

					echo "<h4>Your Current Listings:</h4>";

					// Output query results: HTML table
					echo "<table class=\"table1\">";
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
			<h3>Create your listing:</h3>
			<form action="create_listing.php" method="post" name="newListing" id="newListing">
				<table width="300" border="1" align="left" cellpadding="2" cellspacing="2">
					<tr>
					<tr>
					<td width="150">Item Name</td>
					<td><input name="ItemName" type="text" id="ItemName"></td>
					</tr>
					<tr>

					<tr>
					<td width="150">Brand</td>
					<td><input name="Brand" type="text" id="Brand"></td>
					</tr>
					<tr>
					<tr>
					<td width="150">Price</td>
					<td><input name="Price" type="text" id="Price"></td>
					</tr>
                    <tr>
					<tr>
					<td width="150">Category</td>
					<td><select id="Category" name="Category">
                        <option value="Games">Games</option>
                        <option value="Consoles">Consoles</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Other">Other</option>
                        </select></td>
					</tr>
                    <tr>
					<tr>
					<td width="150">Condition</td>
					<td><select id="Condition" name="Condition">
                        <option value="Excellent">Excellent</option>
                        <option value="Near Mint">Near Mint</option>
                        <option value="Like New">Like New</option>
                        <option value="Good">Good</option>
                        <option value="Fair">Fair</option>
                        <option value="Some Wear and Tear">Some Wear and Tear</option>
                        <option value="Used">Used</option>
                        </select></td>
					</tr>
					<tr>
					<td width="150">&nbsp;</td>
					<td><input name="btnLogin" class="button1" type="submit" id="btnLogin" value="List"></td>
					</tr>
				</table>
			</form>

			
    	</div>

    </body>
</html>

