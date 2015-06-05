<?PHP
	session_start();
	include 'checkuser.php';
    include 'PDO_functions.php';
    include 'common_funcs.php';
	
	if ( returnCheck() == false ){
		echo 'You do not have permission to do that';
		die();
	}

	extract( $_POST );

    if( !isset( $notes ) && empty( $notes ) ){
        $notes = '';
    }

    if( empty( $_FILES['filetoupload']['name'] ) ){
        $images = '';
    } else {
        $files = $_FILES[ 'filetoupload' ];
        $images = uploadImage( $files, '../img/upload/' );
        if ( $images < 0 ){
            echo -2;
            die();
        }
    }

    if ( !empty( $houseID ) && isset( $houseID )){

        $sql = "UPDATE propertiesForSale SET nickname = :nickname, description = :description, address = :address, city = :city, state = :state, zip = :zip, cost = :cost, notes = :notes, images = :images, updated = NOW(), active = :active WHERE pfsID = $houseID";
        $vars = array( ':nickname' => $nickname, ':description' => $description, ':address' => $address, ':city' => $city, ':state' => $state, ':zip' => $zip, ':cost' => $cost, ':notes' => $notes, ':images' => $images, ':active' => $active);
        $result = pdoUpdate( $sql, $vars );
        if ( $result > 0 ){
            echo 1;
        } else {
            echo -1;
        }

    } else {

        $sql = "INSERT INTO propertiesForSale (addedBy, nickname, description, address, city, state, zip, cost, notes, images, created, active) VALUES (:addedBy, :nickname, :description, :address, :city, :state, :zip, :cost, :notes, :images, NOW(), '+')";
        $vars =  array(':addedBy' => $_SESSION['userID'], ':nickname' => $nickname, ':description' => $description, ':address' => $address, ':city' => $city, ':state' => $state, ':zip' => $zip, ':cost' => $cost, ':notes' => $notes, ':images' => $images);

        $result = pdoInsert( $sql, $vars );

        if ( $result > 0 ){
            echo 1;
        } else {
            echo -1;
        }

    }
	





?>