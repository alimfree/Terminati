<?php
/**
 * @author Ali <techsupport@brafton.com>
 * @subpackage Archives Filter
 */

require_once('handler.php');

if( isset($_FILES['archive'] ) ) {
	$file = $_FILES['archive']['tmp_name']; 

	
	$handler = new XMLHandler( $file, $_POST );  
			
	$new_xml = @$handler->delete_articles();

	echo htmlspecialchars( $new_xml->asXML() );
	#echo $handler->create_new_archive($new_xml)->asXML();

	#var_dump( $new_xml );
}
?>