<?php
    session_start();

    echo "Access session variable<br>";
    echo $_SESSION['userID'];
?>