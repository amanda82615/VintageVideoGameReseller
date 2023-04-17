<?php
    session_start();
    $_SESSION['userID'] = '12345678';
    echo "Create a session variable<br>";
    echo $_SESSION['userID'];
?>