<?php
session_start();
unset($_SESSION['user_username']);
session_destroy();
header("location:index.php");

?>