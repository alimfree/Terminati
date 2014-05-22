<?php
/**
 * @author Ali <techsupport@brafton.com>
 * @package Terminati
 */

require_once('handler.php');

if( isset($_FILES['archive'] ) ) {
	$file = $_FILES['archive']['tmp_name']; 

	$handler = new XMLHandler( $file, $_POST );  
	$new_xml = @$handler->delete_articles();

	var_dump( $new_xml->asXML() );
	if( gettype( $new_xml ) == 'object' ){ 
		$new_xml->asXML( 'archives.xml' ); 
		if( $_POST['split'] == 'yes' )
			$filenames = $handler->split_file( $new_xml->asXML() );
		#var_dump( $filenames );
		#require_once( 'page-success.php' );
	} else 
		require_once( 'page-error.php' );
}
?>