<?php

//require_once 'source/db_connect.php';
require_once '../source/session.php';
include_once '../classes/dbh.class.php'; 
include_once '../classes/events.class.php'; 

//echo " signup.php_1";	

// trick to see output of print_r($_POST); is to put random wrong statement (make_error=> code stops but you see output before it stops)
// signup.php_1Array ( [user-name] => fgh [user-email] => f@gmail.com [user-pass] => f3 [signup-btn] => Signup )
// Fatal error: Uncaught Error: Call to undefined function create_error() in C:\xampp\htdocs\signup.php:6 Stack trace: #0 {main} thrown in C:\xampp\htdocs\signup.php on line 6
//print_r($_POST);
//create_error($_POST);
	//$tmp = isset($_POST['eventSubmit-btn']);
	//echo $tmp; // produces 1 i.e. true
	//create_error($_POST);
	$object = new Events;
	//create_error($_POST);

	$object->setEventsForUser($_POST['eventTitle'], $_POST['eventDate'], $_POST['startTime'],$_POST['endTime'],$_SESSION['id']);
	header('location: ../cal.genda/index.php');
	// works ?inconvenient to remembr that argyn==1
	
?>

