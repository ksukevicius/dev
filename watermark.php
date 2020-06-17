<?php

/*
	Simple example of watermarking
*/

/* Create Imagick object */
$Imagick = new Imagick();

/* Create a drawing object and set the font size */
$ImagickDraw = new ImagickDraw();
$ImagickDraw->setFontSize( 40 );

/* Read image into object*/
$Imagick->readImage( 'img/ScaledImage.jpg' );

/* Seek the place for the text */
$ImagickDraw->setGravity( Imagick::GRAVITY_NORTHEAST );
$ImagickDraw->setStrokeColor('black');
$ImagickDraw->setFillColor('white');

/* Write the text on the image */
$Imagick->annotateImage( $ImagickDraw, 4, 20, 0, "24v.lt" );

/* Set format to png */
$Imagick->setImageFormat( 'jpg' );

/* Output */
header( "Content-Type: image/{$Imagick->getImageFormat()}" );
echo $Imagick->getImageBlob();






?>