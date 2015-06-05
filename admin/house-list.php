<?php
/*
	Author: Ben Burkett
	File: rent.php
*/
session_start();
include '../php/PDO_functions.php';
include '../php/checkuser.php';
checkuser();

$sql = "SELECT * FROM propertiesForSale WHERE active = '+'";
$result = pdoSelect( $sql );

foreach( $result as $r ){
    extract( $r );

    $boolNotes = !empty($notes)  ? 'Yes' : 'No';
    $boolImages = !empty( $images)  ? 'Yes' : 'No';

    $content .= <<<TAG
<tr>
    <td><a href="house-management?houseID=$pfsID">Update</a></td>
    <td>$nickname</td>
    <td>$description</td>
    <td>$address</td>
    <td>$city</td>
    <td>$state</td>
    <td>$zip</td>
    <td>$$cost</td>
    <td>$boolNotes</td>
    <td>$boolImages</td>
</tr>
TAG;
}

include 'templates/topPage.html';
include 'templates/header.html';
?>

<div class="container">
    <div class="col-md-10 col-md-offset-1 listtable text-center">
        <div class="col-md-2 pull-right buttonmargin"><a href="house-management" class="btn btn-default btn-sm">Add A House</a></div>
        <table id="houseList" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Nickname</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Cost</th>
                    <th>Notes</th>
                    <th>Images</th>
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
