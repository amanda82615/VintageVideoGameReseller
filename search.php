<!DOCTYPE html>
<html>
    <title>Items for sale</title>
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
            .filterDiv {
                float: left;
                background-color: #2196F3;
                color: #ffffff;
                width: 100px;
                line-height: 100px;
                text-align: center;
                margin: 2px;
                display: none;
            }
            .show {
                display: block;
            }

            .container {
                margin-top: 20px;
                overflow: hidden;
            }

                /* Style the buttons */
            .btn {
                border: none;
                outline: none;
                padding: 12px 16px;
                background-color: #f1f1f1;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #ddd;
            }

            .btn.active {
                background-color: #808080;
                color: white;
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
            .search {
                border: 5px;
                border-color: LightGray;
                color: LightGray;
                background-color: White;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
            }
        </style>
    </head>
    <body>
        <div class="sidenav">
        <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px; text-align: center;">Buy something new to you!</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Buy</a> <br>
            <a href="create_listing.php">Sell</a> <br>
            <a href="profile.php">Account</a>
        </div>
        
        <div class="main">
        <h2>Vintage Video Game Reseller</h2>
            <!--put user code here****
                <p style="font-size: 18px; text-align:right;">vintage_gamer</p>-->
            <p>Search through all listings</p>
            <h4>By Name:</h4>
            <div class="row">
            <form action="search.php" style="margin:left;max-width:500px" method="post">
                <input type="text" class = "search" placeholder="Search..." name="name">
                <button type="submit"><img src="Images/searchicon.png" alt="search icon" style="width:20px"></button>
            </form>
        </div>
            <br>
            <h4>By Seller:</h4>
            <form action="search.php" style="margin:left;max-width:500px" method="post">
                <input type="text" class = "search" placeholder="Search..." name="seller">
                <button type="submit"><img src="Images/searchicon.png" alt="search icon" style="width:20px"></button>
            </form>

                
            
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
