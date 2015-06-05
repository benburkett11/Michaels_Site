<!DOCTYPE html>
<?php
/*
	Author: Ben Burkett
	File: rent.php
*/
    if ( isset( $_GET['nickname'] ) ) {
        $house = $_GET['nickname'];
        $nickname = "<label>Name of House:</label></label><input name=\"nickname\" value=\"$house\" required />";
    } else {
        $nickname = '';
    }

    $title = 'Contact Us';
	include 'templates/topPage.php';
	include 'templates/header.html';
?>
	
	<div class="container content contact">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 backdrop">
				<div class="col-md-6 divmargin">
                    <h3 class="align-center">Send us a message</h3>
                    <p>Feel free to fill out our contact form if you have any questions regarding one of our listins or just a general inquiry.</p>
                    <p>Or you could email us at <a href="mailto:Michael.Rhoads@rhoadsrentals.com">Michael.Rhoads@rhoadsrentals.com</a>, and we will get back to you as soon as possible.</p>
                </div>
                <div class="col-md-6 form-group divmargin">
                    <form action="" id="contactus">
                        <?=$nickname;?>
                        <label>First Name:</label>
                        <input type="text" name="firstname" required />
                        <label>Email:</label>
                        <input type="text" name="email" required />
                        <label>Question:</label>
                        <textarea name="question" rows="3" cols="50" required ></textarea>
                        <input type="submit" value="Submit" />
                    </form>
                </div>
			</div>
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