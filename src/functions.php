<?php 
/**
 * @author Ali <techsupport@brafton.com>
 * @package Terminati
 * Helper functions to find paths and clean up Terminati app dir after 
 * creating zip files.
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
 * Returns relative url path of archive zip file
 * @return String$root;
 */
function get_archives_path(){
	$root = dirname( $_SERVER['PHP_SELF'] ); 

	if( strpos( $root, 'src' ) !== false ) 
		$root = str_replace( '/src', '', $root );

	$root = $root . '/brafton-archives.zip';

	return $root;
}

/**
 * Deletes contents of uploads Directory
 */
function delete_files(){
	$uploads_dir = get_uploads_dir();

	array_map('unlink', glob($uploads_dir . "/*"));
}

/**
 * Checks if uploads directory is empty
 * @return Boolean $empty
 */
function uploads_empty(){
	$uploads_dir = get_uploads_dir();
	if ( count(glob( $uploads_dir . "/*" ) ) === 0 ){
		return false;		
	}

	return true;
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
		$file_path = '../uploads/' . $file;
		$filenames[$file_path] = $file;
	}
	return $filenames;
}
?>