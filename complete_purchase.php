
<!DOCTYPE html>
<?php
    session_start();

    echo $_SESSION['UserName'];
    echo "<br>";
    echo $_SESSION['ItemId'];
    echo "<br>";
    echo $_SESSION['Price'];
?>
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
        </style>
    </head>
    <body>
        <div class="sidenav">
            <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px;">Buy Buy Buy!</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Buy</a> <br>
            <a href="create_listing.php">Sell</a> <br>
            <a href="profile.php">Account</a>
        </div>
        
        <div class="main">
        <h2>Vintage Video Game Reseller</h2>
			<?php
				//include information required to access database
				require 'authentication.php'; 

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
                    $itemId=$_SESSION['ItemId'];
                    echo "<h3>Your Purchase Information:</h3>";
                    echo "<table class=\"table2\">";
                    $sql = "SELECT * FROM TRANSACTION where ItemId=$itemId";
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
                }
            $conn->close();
            ?>


    </body>
</html>

