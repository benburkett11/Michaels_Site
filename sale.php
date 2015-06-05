<?php
/*
	Author: Ben Burkett
	File: rent.php
*/
	include 'php/PDO_functions.php';
    $count = 1;
	
	$sql = "SELECT * FROM propertiesForSale WHERE active = '+'";
	$result = pdoSelect( $sql );
    if( $result ){
        foreach( $result as $r ){
            extract( $r );
            if( empty( $images ) ) {
                $images = '';
            } else {
                $images = explode( '|', $images );
                $imageContent = "<div id=\"scroller$count\" class=\"scroller\">";
                foreach( $images as $img ){

                    $imageContent .= "<img src=\"$img\" width=\"240\" height=\"320\" />";
                }
                $imageContent .= "</div>";
            }

            $content .= <<<TAG
<div class="col-md-10 col-md-offset-1 forsale">
    <div class="col-md-6">
        <h2>$nickname</h2>
        <p>$description<p>
        <p>$address<br/>$city $state, $zip<p>
        <p>$$cost<p>
        <p>$notes</p>
    </div>
    <div class="col-md-6">
        $imageContent
    </div>
    <div class="col-md-12">
        <p>You can contact us about this house by clicking <a href="contact.php?nickname=$nickname">here</a>.<p>
    </div>
</div>
TAG;
            $count++;
            $imageContent = '';
        }
    } else {
        $content .= '<div class="col-md-10 col-md-offset-1 forsale"><p style="margin: 15px auto;">We currently have no listings for sale.  If you would like us to contact you when we add a listing, head on over to contact us page and send us a message.</p></div>';
    }

    $title = 'Properties for Sale';
	include 'templates/topPage.php';
	include 'templates/header.html';
?>
    <div class="container content" style="color: white;">
        <div class="col-md-10 col-md-offset-1 forsale">
            <p style="margin: 15px auto;">Welcome to our Properties for Sale page. This page displays all of our current listings for sale.  Below you will see a complete list of each house.  We have gallery you can view of the house by hovering over the picture to the right of the description.  If you have any questions about a house, feel free to contact us from the <a href="contact">Contact Us</a> page.</p>
        </div>
    </div>
	<div class="container salespage">
        <?=$content;?>
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
