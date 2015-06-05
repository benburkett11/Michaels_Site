<?PHP
    session_start();
    include '../php/checkuser.php';
    checkuser();

    include 'templates/topPage.html';
?>



<div class="container">
    <p>Yo dawg, what you wanna do.</p>
</div>



<?php

    include 'templates/bottomPage.html';

?>