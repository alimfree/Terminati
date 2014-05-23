<?php
/**
 * @author Ali <techsupport@brafton.com>
 * form submission action.
 * @package Terminati
 */

require_once( 'handler.php' );
require_once( 'functions.php' );
require_once( 'zipper.php' );

if( isset($_FILES['archive'] ) ) {
	$file = $_FILES['archive']['tmp_name']; 

	$handler = new XMLHandler( $file, $_POST ); 
	$uploads_dir = get_uploads_dir(); 
	$new_xml = @$handler->delete_articles();

	if( gettype( $new_xml ) == 'object' ){ 
		$new_xml->asXML( 'archives.xml' ); 
		if( $_POST['split'] == 'yes' ){
			$filenames = $handler->split_file( $new_xml->asXML() );
			$files = prepare_files( $filenames );
			$result = create_zip( $files, $uploads_dir . 'brafton-archives.zip', true );			
		}

		#var_dump( $filenames );
		#require_once( 'page-success.php' );
	} else {

		if( $_POST['split'] == 'yes' ){ 
			$new_xml = $handler->xml;
			$filenames = $handler->split_file( $new_xml->asXML() );
			$files = prepare_files( $filenames );
			$result = create_zip( $files, $uploads_dir . '../brafton-archives.zip', true );
			require_once( 'page-error.php' );
		}
	}

	//delete contents of uploads directory
	if( !uploads_empty() )
		delete_files();
}
?>