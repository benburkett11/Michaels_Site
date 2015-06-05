<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 5/15/2015
 * Time: 7:40 PM
 */

    $title = 'The Space Coast';
    include 'templates/topPage.php';
    include 'templates/header.html';

?>

<div class="container content">

    <div class="col-md-10 col-md-offset-1 backdrop" style="text-align: center">
        <h3>Explore the Space Coast</h3>
        <div class="col-md-8 embed-responsive embed-responsive-16by9">
            <iframe src="https://www.youtube.com/embed/rmlSLuW0UPg"  style="margin: 20px auto;" allowfullscreen></iframe>
        </div>
        <div class="col-md-4" style="margin: 15px auto;">
            <p style="margin-top: 25px;">This video was uploaded by EnterpriseFlorida and takes you on a tour of our Space Coast.  If you wish to check out some other great videos, head on over to their <a href="https://www.youtube.com/channel/UCQ1Uc4P-QR_l7PWpP9-yApw">YouTube page</a> and check them out.</p>
        </div>

    </div>
</div>







<?php

    include 'templates/bottomPage.html';

?>