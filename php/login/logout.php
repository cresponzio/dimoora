<?php session_start();
unset($_SESSION["userid"]);
unset($_SESSION["name"]);
unset($_SESSION["surname"]);
unset($_SESSION["email"]);
header("Location: ../../login.php");