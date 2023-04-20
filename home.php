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
                <div class="row">
                    <div class="column">
                        <a href="games">Games</a>
                    </div>
                    <div class="column">
                        <a href="consoles">Consoles</a>
                    </div>
                    <div class="column">
                        <a href="accessories">Accessories</a>
                    </div>
                </div>
            <h3>Browse By Brand</h3>
                <div class="row">
                    <div class="column">
                        <a href="nintendo">Nintendo</a>
                    </div>
                    <div class="column">
                        <a href="atari">Atari</a>
                    </div>
                    <div class="column">
                        <a href="sega">Sega</a>
                    </div>
                </div>
            <h3>Recent Listings</h3>
                <div class="row"; style="width: auto; height: 100px; background-color: #d1d1d1;" ></div>
        </div>

    </body>
</html>
