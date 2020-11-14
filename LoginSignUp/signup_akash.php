<?php

require_once '../source/db_connect.php';
//echo " signup.php_1";	

// trick to see output of print_r($_POST); is to put random wrong statement (make_error=> code stops but you see output before it stops)
// signup.php_1Array ( [user-name] => fgh [user-email] => f@gmail.com [user-pass] => f3 [signup-btn] => Signup )
// Fatal error: Uncaught Error: Call to undefined function create_error() in C:\xampp\htdocs\signup.php:6 Stack trace: #0 {main} thrown in C:\xampp\htdocs\signup.php on line 6
//print_r($_POST);
//create_error($_POST);
//	$tmp = isset($_POST['signup-btn']);
//	echo $tmp; // produces 1 i.e. true
//$tmp1=555;
//echo $tmp1;

if(isset($_POST['signup-btn'])){
	$username = $_POST['user-name'];
	$email = $_POST['user-email'];
	$password = $_POST['user-pass'];
	
	//create_error($_POST);
	
//print_r($_POST);	

	//$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$hashed_password = $password;
	try{
		//$SQLInsert = "INSERT INTO users (username,password, email, to_date)
			//	VALUES (:username, :password, :email, now())";


		$SQLInsert = "INSERT INTO users (username, email, password, to_date)
				VALUES (:username, :email, :password, now())";
				
		$statement = $conn->prepare($SQLInsert);
	
		
		$statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));
		echo " signup.php_3";
		
		if($statement->rowCount()==1){
			$result = header('location: index.html');
		}
	}

	catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
}
?>

