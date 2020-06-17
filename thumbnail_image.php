<?php
 
/*
	A simple example demonstrate thumbnail creation.
*/ 
 
/* Create the Imagick object */
$im = new Imagick();
 
/* Read the image file */
$im->readImage( 'img/ScaledImage.jpg' );
 
/* Thumbnail the image ( width 100, preserve dimensions ) */
$im->thumbnailImage( 100, null );
 
/* Write the thumbail to disk */
$im->writeImage( 'img/th_test.jpg' );
 
/* Free resources associated to the Imagick object */
$im->destroy();
 
?>