<!DOCTYPE html>
<html>
    <title>Homepage</title>
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
                background-color: white;
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
            <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px;">Welcome!</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Search</a> <br>
            <a href="create_listing.php">Sell</a> <br>
            <a href="profile.php">Account</a>
        </div>
        
        <div class="main">
            <h2>Vintage Video Game Reseller</h2>
            
			<form action="search.php" method="post">
                <h3>Browse By Category</h3>
                <div class="row">
                    <div class="column">
					<input type="submit" class= "button1" name= "Category" value="Games">
					<img src="Images/gamesicon.png" alt="game icon" style="width:100px">
                    </div>
                    <div class="column">
                    <input type="submit" class= "button1" name= "Category" value="Consoles">
					<img src="Images/consoleicon.png" alt="consoles icon" style="width:100px">
                    </div>
                    <div class="column">
					<input type="submit" class= "button1" name= "Category" value="Accessories">
					<img src="Images/accessoriesicon.png" alt="accessories icon" style="width:100px">
                    </div>
                </div>
                <h3>Browse By Brand</h3>
                <div class="row">
                    <div class="column">
                    <input type="submit" class= "button1" name= "Brand" value="Nintendo">
					<img src="Images/nintendoicon.png" alt="nintendo icon" style="width:150px">
                    </div>
                    <div class="column">
                    <input type="submit" class= "button1" name= "Brand" value="Atari">
					<img src="Images/atariicon.png" alt="atari icon" style="width:150px">
                    </div>
                    <div class="column">
                    <input type="submit" class= "button1" name= "Brand" value="Sega">
					<img src="Images/segaicon.png" alt="sega icon" style="width:150px">
                    </div>
                </div>
			</form>
            <h3>Most Recent Listings</h3>
                <div class="row"; style="width: auto; height: 325px; background-color: white;" >
				<?php
					$server = "localhost";
					$sqlUsername = "group9";
					$sqlPassword = "group9password";
					$databaseName = "vvgr";
					$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					echo "<table class=\"table1\">";
					echo "<tr>";
					$sql = "SELECT i.ItemName as 'Item', i.Brand, i.Category, i.State AS 'Condition', i.Price, i.Status, u.UserName as 'Sold By' FROM ITEM as i JOIN USER AS u ON i.SellerId = u.UserId WHERE i.Status = 'Available' ORDER BY i.ItemId DESC LIMIT 10";
					$result = $conn->query($sql);
					while ($fieldMetadata = $result->fetch_field() ) {
						echo "<th>".$fieldMetadata->name."</th>";
					}
					echo "</tr>";
					// fetch rows in the table
					while( $row = $result->fetch_assoc() ) {
						echo "<tr>\n";
						foreach ($row as $cell) {
							echo "<td> $cell </td>";
						}
						echo "</tr>\n";
					}
					echo "</table>";
					$results->free();	
					$conn->close();
				?>
				</div>
			</div>

    </body>
</html>
