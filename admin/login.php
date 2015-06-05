<?php
	session_start();
	include '../php/PDO_functions.php';
	include '../php/password.php';

	if(isset($_SESSION['userID'])&&!empty($_SESSION['userID'])){
		header('Location: /mike/admin');
		die();
	}
	
	//grab the input
	$user = $_POST['email'];
	$userpass = $_POST['password'];
	
	if( isset($user) && isset($userpass) && !empty($user) && !empty($userpass) ){
		//sql statement
		$sql = "SELECT userID, username, password, privilege FROM users WHERE username = '$user'";
		$results = pdoSelect( $sql );
	
		foreach ( $results as $result ){
			extract($result);
			if(!empty($password)){
				if(password_verify($userpass, $password) && ($privilege > 0) ){
					$_SESSION['userID'] = $userID;
					echo 1;
					die();
				} else {
					echo -1;
				}
			}
		}
		
	}
	
	include 'templates/loginPage.html';
?>

		<div class="container">
			<form class="form-signin" id="user-login" action="login.php"> 
				<h2 class="form-signin-heading">Please sign in</h2>
				<label for="email" class="sr-only">Email address</label>
				<input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus />
				<label for="password" class="sr-only">Password:</label>
				<input type="password" name="password" class="form-control" placeholder="Password" required />
				<div class="checkbox">
				  <label>
					<input type="checkbox" value="remember-me"> Remember me
				  </label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				<button class="btn btn-lg btn-primary btn-block" id="new-user-btn">New User?</button>
			</form>
		</div>
		
		<!-- start of new user container -->
		<div class="container new-user-container">
				<form class="form-signin" id="add-user" action="adduser">
				<p>Fill the form out below.</p>
					<label for="email" class="sr-only">Email:</label>
					<input type="email" name="email" class="form-control" placeholder="Email Address" required />
					<label for="firstpassword" class="sr-only">Password:</label>	
					<input type="password" name="firstpassword" id="firstPass" class="form-control" placeholder="Password" required />
					<label for="cfmpassword" class="sr-only">Re-enter your password:</label>
					<input type="password" name="cfmpassword" id="secondPass" class="form-control" placeholder="Re-enter Password" required />
					<label for="fname" class="sr-only">First Name:</label>
					<input type="text" name="fname" class="form-control" placeholder="First Name" required />
					<label for="lname" class="sr-only">Last Name:</label>
					<input type="checkbox" name="honeypot" hidden />
					<input type="text" name="lname" class="form-control" placeholder="Last Name" required />
					<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
				</form>
		</div>

	
	
<?PHP
	include 'templates/bottomPage.html';

?>