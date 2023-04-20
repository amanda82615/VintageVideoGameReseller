<?php
    session_start();
    $_SESSION['UserId'] = '12345678';
    echo "Create a session variable<br>";
    echo $_SESSION['UserId'];
?>