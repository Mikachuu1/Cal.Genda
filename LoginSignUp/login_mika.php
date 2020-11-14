<?php
	require_once '../source/session.php';
	require_once '../source/db_connect.php';
	
//echo "login_1";	
//print_r($_POST); //Array ( [user-name] => argyn [user-pass] => a1 [login-btn] => Login )
	// if checks whether login-btn clicked or not
//	$tmp = isset($_POST['login-btn']); // it is login-btn not login_btn
//echo $tmp;

// there was an error login_btn instead of login_btn
	if(isset($_POST['login-btn'])){
		$user = $_POST['user-name' ];
		$password = $_POST['user-pass'];
//$password = password_hash($password, PASSWORD_DEFAULT);
//echo $password . "   form psw" . '<br>';
//echo strlen($password). '<br>';	
		try{
			$SQLQuery = "SELECT * FROM users WHERE username = :username";
			$statement = $conn->prepare($SQLQuery);
			$statement->execute(array(':username' => $user));

//$row = $statement->fetch();
//echo $row['password'] . "   db psw" . '<br>';
//echo "CCC";
//$tmp = $statement->fetch();
//echo $tmp;
			while($row = $statement->fetch()) {
//echo "CCC";
				$id = $row['id']; //17:17 get user id and store it in $id
				$hashed_password = $row['password'];
				$username = $row['username'];
//echo "BBB" . '<br>';
//echo $row['password'] . '<br>';
//echo strlen($row['password']);
				// check whether password stored in db and entered are the same
				// it is done using predefined method in php password_verify
				// if they are the same if-block is executed, i.e. session starts for this id
				//if(password_verify($password, $hashed_password)){
				if($password == $hashed_password){
					$_SESSION['id'] = $id;
					$_SESSION['username'] = $username;
					
					// replace ../cal.genda/index.php for viewCal.php that displays events once you logged in
					//header('location: ../cal.genda/index.php'); //18:40 re-direct user to dashboard					
					header('location: ../cal.genda/index.php'); //18:40 re-direct user to dashboard					
//echo "AAA";
				}
				else{
					//header('location: ../loginsignup/index.html');
					//echo "<a href="index.html"></a>";
					echo "Error:Invalid user name or password" . '<br>'. '<br>';
					//header('location: ../loginsignup/index.html');
					// Note that html statement is in SINGLE quotes while the file name in DOUBLE (if html statement put in double quotes it fails)
					echo '<a href="../loginsignup/index.html"> Press to go back to the Login-SignUp page </a>'; // ? didn't work html in php
					//echo '<a href="http://www.website.com/page.html">Click here</a>';

					// ? how to create a pause so people read "Error ..." and Press any key to go back to login-signup page
					//header('location: index.html');
				}
			}
			
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
?>