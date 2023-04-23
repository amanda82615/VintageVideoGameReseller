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
        <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px; text-align: center;">Buy something new to you!</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Search</a> <br>
            <a href="create_listing.php">Sell</a> <br>
            <a href="profile.php">Account</a>
        </div>
        
        <div class="main">
            <h2>Vintage Video Game Reseller</h2>
            <br>
            <p><h3>Search through all listings here</h3></p>
            <form action="search.php" style="margin:left;max-width:500px" method="post">
                <table class= "table1">
                    <tr>
                        <td>Item Name</td>
                        <td>Brand</td>
                        <td>Category</td>
                        <td>Condition</td>
                        <td>Seller</td>
                    </tr>
                    <tr>
                        <td><input type="text" class = "search" placeholder="Search..." name="ItemName"></td>
                        <td><input type="text" class = "search" placeholder="Search..." name="Brand"></td>
                        <td><input type="text" class = "search" placeholder="Search..." name="Category"></td>
                        <td><input type="text" class = "search" placeholder="Search..." name="Condition"></td>
                        <td><input type="text" class = "search" placeholder="Search..." name="Seller"></td>
                        <td><input type="submit" class= "button1" name= "Submit"></td>
                    </tr>       
            </table>
            </form>
            <br>

            <p><h3>View an item here</h3></p>
            <form action="listing.php" style="margin:left;max-width:500px" method="post">
                <table class= "table1">
                    <tr>
                        <td>Item ID</td>
                    </tr>
                    <tr>
                        <td><input type="text" class = "search" placeholder="View Item..." name="ItemId"></td>
                        <td><input type="submit" class= "button1" name= "Submit"></td>
                    </tr>
                </table>
            </form>

        
            <h3>Search Results:</h3>
                <div class="row"; style="width: auto; height: auto;" >
				<?php
					$server = "localhost";
					$sqlUsername = "group9";
					$sqlPassword = "group9password";
					$databaseName = "vvgr";
					$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

                    
                    if (!empty($_POST['ItemName'])) {
                        $itemname = $_POST['ItemName'];
                    }
                    else {
                        $itemname = "";
                    }
                    if (!empty($_POST['Brand'])) {
                        $brand = $_POST['Brand'];
                    }
                    else {
                        $brand = "";
                    }
                    if (!empty($_POST['Category'])) {
                        $category = $_POST['Category'];
                    }
                    else {
                        $category = "";
                    }
                    if (!empty($_POST['Condition'])) {
                        $condition = $_POST['Condition'];
                    }
                    else {
                        $condition = "";
                    }
                    if (!empty($_POST['Seller'])) {
                        $seller = $_POST['Seller'];
                    }
                    else {
                        $seller = "";
                    }
                    $sql = "SELECT i.ItemId AS 'ID', i.ItemName as 'Item Name', i.Brand, i.Category, i.State AS 'Condition', i.Price, i.Status, u.UserName AS 'Sold By' FROM ITEM AS i JOIN USER as u ON i.SellerId=u.UserId WHERE i.ItemName LIKE '%$itemname%' AND i.Brand LIKE '%$brand%' AND i.Category LIKE '%$category%' AND i.State LIKE '%$condition%' AND u.UserName LIKE '%$seller%' AND i.Status = 'Available'";

                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        // fetch table rows from mysql db
                        echo "<table class=\"table1\">";
                        echo "<tr>";
                        
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
                    }
                    else {
                        echo "<h4>I'm sorry, no results were found. Try another search!</h4>";
                    }	
					$conn->close();
				?>
				</div>
			</div>

    </body>
</html>
