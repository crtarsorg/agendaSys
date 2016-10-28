<?php
$hostname_mysqlcon = "127.0.0.1";
$database_mysqlcon = "agenda";
$username_mysqlcon = "root";
$password_mysqlcon = "root";

$mysqli = new mysqli($hostname_mysqlcon, $username_mysqlcon, $password_mysqlcon,$database_mysqlcon);
$mysqli->set_charset("utf8");
?>