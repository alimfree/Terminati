<?php 
/**
 * @author Ali <techsupport@brafton.com>
 * @package Terminati
 * Helper functions 
 */ 
/**
 * Retrieves path of uploads directory.
 * @return $uploads_dir
 */
function get_uploads_dir(){
	$root = $_SERVER['DOCUMENT_ROOT']; 
	$app_path = str_replace( '/src', '', dirname($_SERVER['PHP_SELF']) );
	$uploads_dir = $root . $app_path . '/uploads/';
	return $uploads_dir;
}		

function get_css_path(){
	$root = dirname($_SERVER['PHP_SELF']);

	if( strpos( $root, 'src' ) !== false );
		$root = str_replace( '/src', '', $root);

	$css_path = $root . '/assets/main.css';

	return $css_path;
}

function prepare_files( $files_array ){

	$filenames = array();
	foreach( $files_array  as $file ){
		$file = '../uploads/' . $file;
		$filenames[] = $file;
	}
	return $filenames;
}

?>