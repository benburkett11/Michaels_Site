<?php
/**
 * file: common_funcs.php
 * User: Ben
 * Date: 5/14/2015
 *
 *
 */
    function uploadImage( $imageUpload, $uploadpath ){
        $errorBool = 0;
        $maxFileSize = 5000000;
        $imageLocation = '';
        $imageCount = count( $imageUpload[ 'name' ] );
        $allowed_ext = array( 'jpg', 'jpeg'  ,'png', 'gig' );

        for( $i = 0; $i < $imageCount; $i++ ){
            $errors = array();
            $path = $uploadpath;


            $fileName = str_replace( ' ', '',  $imageUpload[ 'name' ][ $i ] );
            $rawFile = explode( '.', $fileName );                            //doing this in two steps avoids the strict warning
            $fileExt = strtolower( end( $rawFile ) );                        //i really don't want it to break later
            $fileSize = $imageUpload[ 'size' ][ $i ];
            $fileTmp = $imageUpload['tmp_name'][ $i ];

            if( in_array( $fileExt, $allowed_ext ) === false ) {
                $errors[ $fileName ][] = 'Extension not allowed';
                $errorBool++;
            }
            if ( $fileSize > $maxFileSize ){
                $errors[ $fileName ][] = 'Image size must be under 5mb';
                $errorBool++;
            }

            if ( $errorBool == 0 ){
               // $fileDimensions = getimagesize( $fileTmp );  . $fileDimensions[ 0 ] . ',' . $fileDimensions [ 1 ] .
                $path .= $fileName;
                if ( move_uploaded_file( $fileTmp, $path ) ){
                    if ( $i + 1 < $imageCount ) {
                        $imageLocation .= str_replace('../', '', $path) . '|';
                    } else {
                        $imageLocation .= str_replace('../', '', $path);
                    }
                } else {
                    return 'Unable to upload: '.$errorBool;
                }
            } else {
                foreach( $errors as $e ){
                    return -1;
                }
            }
        }

        if ( $errorBool === 0 ){
            return $imageLocation;
        } else {
            return -1;
        }
    }

?>