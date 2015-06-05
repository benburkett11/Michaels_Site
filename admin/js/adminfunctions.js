/*
	Ver: 0.0.2
	Author: Benjamin Burkett
	File:  simpleFuntions.js
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
					window.location.replace( 'index' );
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
					} else {
						alert( 'We we\'er unable to fulfull your request');
					}
				},
				datatype: "text"
   	 });
  	}
  });

  $( '#update-house-for-sale').on('submit', function( e ) {
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: '../php/addPropertyForSale.php',
          data: new FormData( this ),
          processData: false,
          contentType: false,
          success: function( data ){
              if ( data > 0){
                  alert( 'Success!' );
                  window.location.replace( 'house-list' );
              } else if( data == -1 ){
                  alert( 'Unable to update this record' );
              } else if( data == -2){
                  alert( 'Unable to upload images');
              } else {
                alert( data );
              }
          },
          datatype: "text"
      });
  });

    $( '#update-gallery').on('submit', function( e ) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '../php/gallery-add.php',
            data: new FormData( this ),
            processData: false,
            contentType: false,
            success: function( data ){
                if ( data > 0){
                    alert( 'Success!' );
                    window.location.replace( 'gallery-list' );
                } else if( data == -1 ){
                    alert( 'Unable to update this record' );
                } else if( data == -2){
                    alert( 'Unable to upload images');
                } else {
                    alert( data );
                }
            },
            datatype: "text"
        });
    });

    $( '#deleterecord' ).on('click', function( e ){
        e.preventDefault();
        if( confirm("Are you sure you want to delete this record?") ) {
            var form_data = $( '#update-house-for-sale' ).serialize();
            $.ajax({
                type: "POST",
                url: 'php/house_delete.php',
                data: form_data,
                success: function (data) {
                    if (data == 1) {
                        alert('Success!');
                        window.location.replace('updatehouse');
                    } else {
                        alert(data);
                    }
                },
                datatype: "text"
            });
        }
    });
});

$( '#add' ).on( 'click', function(){
    window.location.replace('house-management');
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

$(document).ready(function() {
    $('#houseList').DataTable();
} );


/*	Start of admin login fucntions	*/
$( '#new-user-btn' ).click( function( e ) {
	e.preventDefault();
	$( '.new-user-container' ).show();
});

$( document).ready(function(){
    $( '#gallerylist').DataTable();
});

var $loading = $('#loadingDiv').hide();
$(document)
    .ajaxStart(function () {
        $loading.show();
    })
    .ajaxStop(function () {
        $loading.hide();
    });

$('.new-user-container').hide();

/*
							Change log
-------------------------------------------

	0.0.2 -- 05/10/15 -- BAB -- Added some core funtions
	0.0.1 -- 05/08/15 -- BAB -- Created file added some basic funtions 

--------------------------------------------
*/