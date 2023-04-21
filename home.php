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
                height: 300px;
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
            <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px;">Welcome!</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Search</a> <br>
            <a href="profile.php">My Account</a>
        </div>
        
        <div class="main">
            <h2>Vintage Video Game Reseller</h2>
            <h3>Browse By Category</h3>
			<form action="search.php" method="post">
                <div class="row">
                    <div class="column">
					<input type="submit" name = "category" value="Games">
                    </div>
                    <div class="column">
                    <input type="submit" name = "category" value="Consoles">
                    </div>
                    <div class="column">
					<input type="submit" name = "category" value="Accessories">
                    </div>
                </div>
            <h3>Browse By Brand</h3>
                <div class="row">
                    <div class="column">
                    <input type="submit" name = "description" value="Nintendo">
                    </div>
                    <div class="column">
                    <input type="submit" name = "description" value="Atari">
                    </div>
                    <div class="column">
                    <input type="submit" name = "description" value="Sega">
                    </div>
                </div>
				</form>
            <h3>Recent Listings</h3>
                <div class="row"; style="width: auto; height: 325px; background-color: #d1d1d1;" >
				<?php
					$server = "localhost";
					$sqlUsername = "group9";
					$sqlPassword = "group9password";
					$databaseName = "vvgr";
					$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					echo "<table class=\"table2\">";
					echo "<tr>";
					$sql = "SELECT ItemName, Category, State, Price, Status FROM ITEM WHERE Status = 'Available' ORDER BY ItemId DESC LIMIT 10";
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
