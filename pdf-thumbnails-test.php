<?php
/*
Plugin Name: PDF Thumbnails Support Test
Plugin URI:
Desription: Determine if your server is missing software for WordPress 4.7's native PDF thumbnail generator
Version: 1.0.1
Author: Ethan Clevenger / Sterner Stuff Design
Author URI: https://sternerstuffdesign.com
 */

$root = array( 'Eclev\\PdfThumbnailsTest' => __DIR__ . '/src/PdfThumbnailsTest' );

require_once( __DIR__ . '/src/PdfThumbnailsTest/Autoloader.php' );
$loader = 'Eclev\\PdfThumbnailsTest\\Autoloader';
new $loader( $root );

$start = new Eclev\PdfThumbnailsTest\Admin\Admin;
