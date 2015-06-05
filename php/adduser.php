<?PHP
/*
	Version: 0.0.1
	Author: Benjamin Burkett
	File:  addUser.php
	Createad: 05/10/15
	Contributors:
	Last Updated: 05/10/15
*/
	extract( $_POST );
	
	include 'password.php';
	include 'PDO_functions.php';
	
	//check for the hidden input to see whether or not it was set
	if( !empty( $honeypot ) && isset( $honeypot ) ){
		echo -1;
		exit();
	}
	
	$sql = "SELECT COUNT(username) FROM users WHERE username = '$email'";
	$result = pdoSelect( $sql );
	if( $result == 0 ){
		echo -1;
		exit;
	}
	
	if ($password !== $cfmpass){
		echo -1;
		exit();
	}	else {
		$hashpassword = password_hash($firstpassword, PASSWORD_DEFAULT);
	}
	
	$sql = "INSERT INTO users ( username, password, privilege, created ) VALUES ( :username, :password, :privilege, NOW() )";
	$vars = array( ':username' => $email, ':password' => $hashpassword, ':privilege' => 0 );
	
	$result = pdoInsert( $sql, $vars );
	
	if( $result == 0 ){
		echo -1;
		exit();
	} else {
		echo 1;
	}


/*
							Change log
-------------------------------------------

	0.0.1 -- 05/08/15 -- BAB -- Created file

--------------------------------------------
*/
?>