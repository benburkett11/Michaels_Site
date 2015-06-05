<?PHP
/**
Author: Benjamin Burkett
Version: 0.0.1
Createad: 05/11/2015
Updated:
Contributors: BABC:\Users\Ben\PhpstormProjects\Michael's Site PROD\admin\gallery-management.php
 **/

session_start();
include '../php/checkuser.php';
include '../php/PDO_functions.php';
checkuser();

$submitButtonValue = 'Add a Gallery';

if( isset( $_GET['galleryID'] ) ) {
    $galleryID = $_GET['galleryID'];
    $sql = "SELECT * FROM gallery WHERE galleryID = $galleryID";
    $result = pdoSelect( $sql );

    if ( !empty( $result )){
        extract( $result[0] );
    } else {
        echo 'There was a problem getting the record';
        die();
    }

    if ( $active == '+'){
        $activeMessage = '<label>Active?</label><br/><select name="active"><option value="+">Yes</option><option value="-">No</option></select><br/>';
    } else {
        $activeMessage = '<label>Active?</label><br/><select name="active"><option value="-">No</option><option value="+">Yes</option></select><br/>';
    }

    $deletebutton = '<button type="button" id="deleterecord" class="btn btn-danger">Delete</button>';
    $submitButtonValue = 'Update a Gallery';
}

include 'templates/topPage.html';
?>

    <div class="container">
        <div class="col-md-10 col-md-offset-1 addhouse form-group">
            <form id="update-gallery" action="" method="POST" enctype="multipart/form-data">
                <!-- left side of the form -->
                <div class="col-md-6">
                    <input type="hidden" name="galleryID" class="form-control" value="<?=$galleryID;?>" />
                    <label class="control-label">Nickname:</label>
                    <input type="text" name="nickname" class="form-control" value="<?=$nickname;?>" required />
                    <?=$activeMessage;?>
                    <label>Notes:</label>
                    <textarea cols="100" rows="3" class="form-control" name="notes" ><?=$notes;?></textarea><br/>
                    <label>Before Image upload</label>
                    <input type="file" class="btn btn-default" name="imagebefore[]" id="filetoupload" multiple /><br/>
                    <label>After Image upload</label>
                    <input type="file" class="btn btn-default" name="imageafter[]" id="filetoupload" multiple /><br/>
                    <div id="loadingDiv"><img src="../img/loading.GIF"/></div>
                    <input type="submit" class="btn btn-default" value="<?=$submitButtonValue;?>" />
                    <?=$deletebutton;?>
                </div>
            </form>
        </div>


        <!-- END OF THE PAGE'S CONTENT -->
    </div>

<?PHP
include 'templates/bottomPage.html';
?>