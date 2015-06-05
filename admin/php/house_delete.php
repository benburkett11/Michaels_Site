<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 5/22/2015
 * Time: 11:24 PM
 */
    session_start();
    include '../../php/PDO_functions.php';
    include '../../php/checkuser.php';

    if( returnCheck() ){
        $sql = "DELETE FROM propertiesForSale
                WHERE pfsID = :houseID";
        $vars = array( ':houseID' => $_POST['houseID'] );
        $result = pdoDelete( $sql, $vars );
        if( $result ){
            echo 1;
        } else {
            echo -1;
        }

    }
?>