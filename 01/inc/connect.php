<?php
/*	
	mysql_pconnect("localhost","root","root");
	mysql_select_db("whmcs");
	mysql_query("SET NAMES 'utf8'");
*/	
$host = "localhost";
$db = "whmcs";
$charset = "utf8";
$user = "root";
$pass = "";



$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $user, $pass, $opt);

?>