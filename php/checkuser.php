<?PHP

	function checkuser(){
		if( !isset($_SESSION['userID']) && empty($_SESSION['userID']) ){
			header('Location: login.php');
			die();
		}
	}
	
	function returnCheck(){
		if( !isset($_SESSION['userID']) && empty($_SESSION['userID']) ){
			return false;
		} else {
			return true;
		}
	}
		
?>