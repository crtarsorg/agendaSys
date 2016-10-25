<?php
$hostname_mysqlcon = "127.0.0.1";
$database_mysqlcon = "agenda";
$username_mysqlcon = "root";
$password_mysqlcon = "root";
//$db = mysqli_connect($hostname_mysqlcon, $username_mysqlcon, $password_mysqlcon) ; //or trigger_error(mysql_error(),E_USER_ERROR);
//mysqli_query($db,'utf8');
//mysqli_set_charset($db,"utf8");
//mysqli_select_db($db, $database_mysqlcon );

$mysqli = new mysqli($hostname_mysqlcon, $username_mysqlcon, $password_mysqlcon,$database_mysqlcon);
?>