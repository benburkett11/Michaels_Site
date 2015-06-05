<?php
/*
	Author: Ben Burkett
	File: rent.php
*/
session_start();
include '../php/PDO_functions.php';
include '../php/checkuser.php';
checkuser();

$sql = "SELECT * FROM gallery WHERE active = '+'";
$result = pdoSelect( $sql );

foreach( $result as $r ) {
    extract( $r );
    $boolNotes = !empty($notes)  ? 'Yes' : 'No';

    $imagesB = explode( '|', $imagesBefore );
    $imageBNum = count($imagesB);

    $imagesA = explode( '|', $imagesAfter );
    $imageANum = count($imagesA);
    $content .= <<<TAG
<tr class="backdrop">
    <td><a href="gallery-management?galleryID=$galleryID">Update</a></td>
    <td>$nickname</td>
    <td>$boolNotes</td>
    <td>$imageBNum</td>
    <td>$imageANum</td>
</tr>
TAG;
}


include 'templates/topPage.html';
?>


    <div class="container">
        <div class="col-md-10 col-md-offset-1 listtable listcenter">
            <div class="col-md-2 pull-right buttonmargin"><a href="gallery-management" class="btn btn-default btn-sm">Add A Gallery</a></div>
            <table id="gallerylist" class="display listcenter" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Edit</th>
                        <th>Nickname</th>
                        <th>Notes</th>
                        <th>Before Images</th>
                        <th>After Images</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$content;?>
                </tbody>
            </table>
        </div>
    </div>


<?php
include 'templates/bottomPage.html';
?>

<?php
/*
	---------------------------------
	Change log
	0.0.1 -- 05/01/2015 -- BAB -- Created file
	---------------------------------
*/
?>