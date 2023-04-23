<!DOCTYPE html>
<?php
    session_start();

/*     echo $_SESSION['UserName'];
    echo "<br>";
    echo $_SESSION['ItemId'];
    echo "<br>";
    echo $_SESSION['Price']; */
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

					if (isset($_POST['Address']) || isset($_POST['City']) || isset($_POST['State']) || isset($_POST['Zip'])) {
						$address = $_POST['Address'];
						$city = $_POST['City'];
						$state = $_POST['State'];
                        $zip = $_POST['Zip'];
                        $itemId = $_SESSION['ItemId'];
                        $UserName = $_SESSION['UserName'];
                        $price = floatval($_SESSION['Price']);
                        $tax = $price * 0.15;
                        $total = $price + $tax;

                        $sql = "INSERT INTO TRANSACTION VALUES (NULL, $itemId, (SELECT UserId FROM USER WHERE UserName='$UserName'), now(), $price, $tax, $total, '$address', '$city', '$state', '$zip')";
                        $query_result = $conn->query($sql);
                        if (!$query_result) {
                            echo "Problem with query: $sql";
                            die;
                        } else {
                            echo "Purchase Complete!";
                        }
                    }
					// close the connection
					$conn->close();
				}
			?>
			<h3>Enter Your Information:</h3>
			<form action="purchase.php" method="post" name="newTransaction" id="newTransaction">
				<table width="300" border="1" align="left" cellpadding="2" cellspacing="2">
					<tr>
					<tr>
					<td width="150">Address</td>
					<td><input name="Address" type="text" id="Address"></td>
					</tr>
					<tr>

					<tr>
					<td width="150">City</td>
					<td><input name="City" type="text" id="City"></td>
					</tr>
					<tr>
					<tr>
					<td width="150">State</td>
					<td><input name="State" type="text" id="State"></td>
					</tr>
					<tr>
					<td width="150">Zip</td>
					<td><input name="Zip" type="text" id="Zip"></td>
					</tr>
					<tr>
                    <tr>
					<tr>
					<td width="150">&nbsp;</td>
					<td><input name="btnLogin" type="submit" id="btnLogin" value="Complete Your Purchase"></td>
					</tr>
				</table>
			</form>

			
    	</div>

    </body>
</html>

