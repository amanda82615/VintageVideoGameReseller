<!DOCTYPE html>
<html>
    <title>Sell Sell Sell</title>
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
            .row:after {
                content: "";
                display: table;
                clear: both;
            }
        </style>
    </head>
    <body>
        <div class="sidenav">
            <p style="color:white; font-size:30px; padding: 6px 8px 6px 16px; text-align: center;">Sell your items here</p>
            <a href="home.php">Home</a> <br>
            <a href="search.php">Buy</a> <br>
            <a href="create_listing.php">Sell</a> <br>
            <a href="profile.php">Account</a>
        </div>
        
        <div class="main">
            <h2>Vintage Video Game Seller</h2>
            <p>New lisitng information</p>
            <form action="create_listing.php">
                <label for="ItemName">Item name</label><br>
                <input type="text" id="ItemName" name="ItemName"><br>
                <label for="Brand">Brand</label><br>
                <input type="text" id="Brand" name="Brand"><br>
                <label for="price">Price</label><br>
                <input type="text" id="price" name="price"><br>
                <label for="category">Choose a category:</label>
                <select id="category" name="category">
                  <option value="games">Games</option>
                  <option value="consolses">Consoles</option>
                  <option value="accessories">Accessories</option>
                  <option value="other">Other</option>
                </select><br><br>
                <label for="state">Choose the condition:</label>
                <select id="state" name="state">
                  <option value="Excellent">Excellent</option>
                  <option value="Near Mint">Near Mint</option>
                  <option value="Like New">Like New</option>
                  <option value="Good">Good</option>
                  <option value="Fair">Fair</option>
                  <option value="Some Wear and Tear">Some Wear and Tear</option>
                  <option value="Used">Used</option>
                </select><br><br>
                <input type="submit" value="Submit">
              </form>
            

    </body>
</html>
