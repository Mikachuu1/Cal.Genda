<?php
$username = 'root';
$password = '';
$dsn = 'mysql:host=localhost;dbname=mydb';

try{
	$conn = new PDO($dsn, $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
//	echo "db_connect_1";

} catch(PDOException $e){

	echo "Fail to connect to the database ".$e->getMessage();
}

?>