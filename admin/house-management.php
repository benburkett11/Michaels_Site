<?PHP
/**
	Author: Benjamin Burkett
	Version: 0.0.1
	Createad: 05/11/2015
	Updated:
	Contributors: BAB
**/

	session_start();
	include '../php/checkuser.php';
    include '../php/PDO_functions.php';
	checkuser();

    $submitButtonValue = 'Add House';

    if( isset( $_GET['houseID'] ) ) {
        $houseID = $_GET['houseID'];
        $sql = "SELECT * FROM propertiesForSale WHERE pfsID = $houseID";
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
        $submitButtonValue = 'Update House';
    }

	include 'templates/topPage.html';
?>
<!-- START OF THE PAGE'S CONTENT -->

    <div class="container">
        <div class="col-md-10 col-md-offset-1 addhouse form-group">
            <form id="update-house-for-sale" action="" method="POST" enctype="multipart/form-data">
                <!-- left side of the form -->
                <div class="col-md-6">
                    <input type="hidden" name="houseID" class="form-control" value="<?=$houseID;?>" />
                    <label class="control-label">Nickname:</label>
                    <input type="text" name="nickname" class="form-control" value="<?=$nickname;?>" required />
                    <label>Description:</label>
                    <input type="text" name="description" class="form-control" value="<?=$description;?>" required />
                    <label>Address:</label>
                    <input type="text" name="address" class="form-control" value="<?=$address;?>" required />
                    <label>City:</label>
                    <input type="text" name="city" class="form-control" value="<?=$city;?>" required />
                    <label>State:</label>
                    <input type="text" name="state" class="form-control" value="<?=$state;?>" required />
                    <label>Zip:</label>
                    <input type="text" name="zip" class="form-control" value="<?=$zip;?>" required />
                    <label>Cost:</label>
                    <input type="text" name="cost" class="form-control" value="<?=$cost;?>" required />
                    <?=$activeMessage;?>
                    <label>Notes:</label>
                    <textarea cols="100" rows="3" class="form-control" name="notes" ><?=$notes;?></textarea><br/>
                    <label>Image upload</label>
                    <input type="file" class="btn btn-default" name="filetoupload[]" id="filetoupload" multiple /><br/>
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