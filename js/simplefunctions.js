/*
	Version: 0.0.2
	Author: Benjamin Burkett
	File:  simplefuntions.js
	Createad: 05/08/15
	Contributors:
	Last Updated: 05/08/15
*/

function ajaxSubmit(urlprocess, submit_data){
	$.ajax({
		type: "POST",
		url: urlprocess,
		data: submit_data
	});
};

/* On dom ready form submit buttons for logging in and new users */
$( document ).ready(function(){
	$( '#user-login' ).on( 'submit', function( e ) {
		e.preventDefault();
		var form_data = $( this ).serialize();
		$.ajax({
			type: "POST",
			url: 'login.php',
			data: form_data,
			success: function( data ){
				if( data == 1 ){
					alert( 'Success!' );
					window.location.replace( 'index.php' );
				} else {
					alert('Your username or password is incorrect');
				}
			},
			datatype: "text"
		});
	});
	
	$( '#add-user' ).on( 'submit', function( e ) {
    e.preventDefault();
    var input_check = validate();
  	 
    if( input_check === true ) {
    	var form_data = $( this ).serialize();		
   		$.ajax({
				type: "POST",
				url: '../php/adduser.php',
				data: form_data,
				success: function( data ){
					if( data == 1 ){
						alert( 'Success!' );
                        $( '#add-user' )[0].reset();
					} else {
						alert( 'We we\'er unable to fulfill your request');
					}
				},
				datatype: "text"
   	 });
  	}
  });

  //check to see if we are on the sales page, then create scrolling objects
  if( $( 'div.salespage' ).length > 0 ){
      // None of the options are set
      var count = $( '.salespage').children().length;
      for ( i = 1; i <= count; i++) {
          $("div#scroller" + i ).smoothDivScroll({});
      }
  }

    //check to see if we are on the gallery page, then create scrolling objects
    if( $( 'div.gallery' ).length > 0 ){
        // None of the options are set
        var count = $( '.gallery').children();
        var i = 1;
        count.each( function (){
            $("div#scroller" + i ).smoothDivScroll({});
            $("div#scroller" + (i+1) ).smoothDivScroll({});
            i = i + 2;
        });
        /*
        for ( i = 1; i <= count; i = i + 2) {
            alert(i);
            $("div#scroller" + i ).smoothDivScroll({});
            $("div#scroller" + (i+1) ).smoothDivScroll({});
        }*/
    }

    $( '#contactus' ).on("submit", function( e ){
        e.preventDefault();
        var form_data = $( this ).serialize();
         $.ajax({
         type: "POST",
         url: "/php/contact.php",
         data: form_data,
         success: function( data ){
             alert('Thank you for messaging us');
             $( '#contactus' )[0].reset();
         },
         datatype: "text"
         });
    });



});

function validate() {
	var first = $('#firstPass');
	var second = $('#secondPass');
	if ( first.val() != second.val() ){
		first.val( '' );
		second.val( '' );
		alert( "Passwords don't match" );
		first.focus();
		return false;
	};
	return true;
};


/*	Start of admin login fucntions	*/
$( '#new-user-btn' ).click( function( e ) {
	e.preventDefault();
	$( '.new-user-container' ).show();
});

$('.new-user-container').hide();

/*
							Change log
-------------------------------------------

	0.0.2 -- 05/10/15 -- BAB -- Added some core funtions
	0.0.1 -- 05/08/15 -- BAB -- Created file added some basic funtions 

--------------------------------------------
*/