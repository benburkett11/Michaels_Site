<?php

include 'php/PDO_functions.php';
$count = 1;

$sql = "SELECT * FROM gallery WHERE active = '+'";
$result = pdoSelect( $sql );
if( $result ){
    foreach( $result as $r ){
        extract( $r );
        if( empty( $imagesBefore ) ) {
            $imagesBefore = '';
            $imagesAfter = '';
        } else {
            $imagesBefore = explode( '|', $imagesBefore );
            $imagesAfter = explode( '|', $imagesAfter );

            $imageContentBefore = "<div id=\"scroller$count\" class=\"scroller\">";
            $count++;
            $imageContentAfter = "<div id=\"scroller$count\" class=\"scroller\">";

            foreach( $imagesBefore as $img ){
                //list($width, $height, $type, $attr) = getimagesize($img);
                //if ( $height > $width )
                    $imageContentBefore .= "<a href=\"/$img\"><img src=\"$img\" width=\"240\" height=\"320\" /></a>";
                //else
                //    $imageContentBefore .= "<img src=\"$img\" width=\"240\" height=\"320\" />";
            }
            foreach( $imagesAfter as $img ){
                $imageContentAfter .= "<a href=\"/$img\"><img src=\"$img\" width=\"240\" height=\"320\" /></a>";
            }

            $imageContentBefore .= "</div>";
            $imageContentAfter .= "</div>";
        }


        $content .= <<<TAG
<div class="col-md-10 col-md-offset-1 backdrop divmargin">
    <div class="col-md-12">
        <h2>$nickname</h2>
        <p>$notes<p>
    </div>
    <div class="col-md-6 margin">
        <h3 class="text-center">Before</h3>
        $imageContentBefore
    </div>
    <div class="col-md-6 margin">
        <h3 class="text-center">After</h3>
        $imageContentAfter
    </div>
</div>
TAG;
        $count++;
        $imageContent = '';
    }
} else {
    $content .= '<div class="col-md-10 col-md-offset-1 backdrop"><p style="margin: 15px auto;">We currently have no remodels to view.  </p></div>';
}



$title = 'Photo Gallery';
include 'templates/topPage.php';
include 'templates/header.html';
?>

<div class="container content" style="color: white;">
    <div class="col-md-10 col-md-offset-1 forsale">
       <p style="margin: 15px auto;">Welcome to our picture gallery. This page displays all of our past remodels with pictures from before and after.</p></div>
    </div>
<div class="container content gallery">
    <?=$content;?>
</div>

<?php
include 'templates/bottomPage.html';
?>