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

if( empty( $_FILES['imagebefore']['name'] ) ){
    $imagesBefore = '';
} else {
    $files = $_FILES[ 'imagebefore' ];
    $imagesBefore = uploadImage( $files, '../img/gallery/' );
    if ( $imagesBefore < 0 ){
        echo -2;
        die();
    }
}

if( empty( $_FILES['imageafter']['name'] ) ){
    $imagesAfter = '';
} else {
    $files = $_FILES[ 'imageafter' ];
    $imagesAfter = uploadImage( $files, '../img/gallery/' );
    if ( $imagesAfter < 0 ){
        echo -2;
        die();
    }
}

if ( !empty( $galleryID ) && isset( $galleryID )){

    $sql = "UPDATE gallery SET nickname = :nickname, notes = :notes, imagesBefore = :imagesBefore, imagesAfter = :imagesAfter, active = :active WHERE galleryID = :galleryID";
    $vars = array( ':galleryID' => $galleryID, ':nickname' => $nickname, ':notes' => $notes, ':imagesBefore' => $imagesBefore,':imagesAfter' => $imagesAfter, ':active' => $active);
    //$result = pdoUpdate( $sql, $vars );
    if ( $result > 0 ){
        echo 1;
    } else {
        echo -1;
    }

} else {

    $sql = "INSERT INTO gallery ( nickname, notes, imagesBefore, imagesAfter, dateAdded, active ) VALUES ( :nickname, :notes, :imagesBefore, :imagesAfter, NOW(), '+')";
    $vars =  array( ':nickname' => $nickname, ':notes' => $notes, ':imagesBefore' => $imagesBefore,':imagesAfter' => $imagesAfter );
    $result = pdoInsert( $sql, $vars );

    if ( $result > 0 ){
        echo 1;
    } else {
        echo -1;
    }

}

?>