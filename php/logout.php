<?php
	session_start();
	$_SESSION['userID'] = NULL;
	session_unset();
	session_destroy();
	header('Location: /');
?>