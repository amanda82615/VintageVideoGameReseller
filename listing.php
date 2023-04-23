
<!DOCTYPE html>
<html>
    <title>Homepage</title>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                box-sizing: border-box;
            }
            input[type=button], input[type=submit], input[type=reset] {
                background-color: green;
                border: none;
                color: white;
                padding: 16px 32px;
                text-decoration: none;
                margin: 4px 2px;
                cursor: pointer;
            }
            table, th, td {
                padding: 15px;
                spacing: 15px;
                border: 1px solid black;
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
        <div class="sidenav">
            <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px;">Welcome!</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Buy</a> <br>
            <a href="create_listing.php">Sell</a> <br>
            <a href="profile.php">Account</a>
        </div>
        
        <div class="main">
            <h2>Vintage Video Game Reseller</h2>
            
            <h3>Item Listing</h3>
                <div class="row"; style="width: auto; height: 325px; background-color: white;" >
				<?php
                    session_start();
					$server = "localhost";
					$sqlUsername = "group9";
					$sqlPassword = "group9password";
					$databaseName = "vvgr";
					$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
                    if (isset($_SESSION['ItemId'])) {
                        $ItemId = $_SESSION['ItemId'];
                    } else {
                        $ItemId = 1196;
                    }
                    $_SESSION['ItemId'] = $ItemId;
					echo "<table class=\"table2\">";
					echo "<tr>";
                    $sql = "SELECT ItemName, Price FROM ITEM where ItemId=$ItemId";
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

                    echo "<form action='purchase.php'>";
                    echo "<input type='submit' value='Buy Now!'>";
                    echo "</form>";

					echo "<table class=\"table2\">";
                    $sql = "SELECT ItemId, SellerId, Brand, Category, State, Status FROM ITEM where ItemId=$ItemId";
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
                    $sql = "SELECT Price FROM ITEM WHERE ItemId='$ItemId'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        foreach ($row as $cell) {
                            $value = $cell;
                        }
                    }
                    $_SESSION['Price'] = $value;
					$conn->close();
				?>
				</div>
			</div>

    </body>
</html>
