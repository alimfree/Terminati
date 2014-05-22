<?php 
/**
 * @author Ali <techsupport@brafton.com>
 * @package Terminati
 * Helper functions to find paths.
 */ 
/**
 * Retrieves path of uploads directory on server.
 * @return $uploads_dir
 */
function get_uploads_dir(){
	$root = $_SERVER['DOCUMENT_ROOT']; 
	$app_path = str_replace( '/src', '', dirname($_SERVER['PHP_SELF']) );
	$uploads_dir = $root . $app_path . '/uploads/';
	return $uploads_dir;
}		

/**
 * Returns relative url path of uploads dir
 * @return String$root;
 */
function get_uploads_path(){
	$root = dirname( $_SERVER['PHP_SELF'] ); 
	if( strpos( $root, 'src' ) !== false ) 
		$root = str_replace( '/src', '', $root );
	$root = $root . '/uploads';
	return $root;
}

/**
 * Returns relative url path of main.css file
 * @return String $css_path
 */
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