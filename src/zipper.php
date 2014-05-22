<?php 
/**
 * @author Ali <techsupport@brafton.com>
 * @package Terminati
 * 
 * Create a zip file to quickly download all generated xml files.
 * 
 * Reference: http://davidwalsh.name/create-zip-php
 */


/* creates a compressed zip file */
function create_zip( $files = array(),$destination = '',$overwrite = false ) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists( $destination ) && !$overwrite ) { return false; }
	$valid_files = array();
	//if files were passed in...
	if( is_array( $files ) ) {
		//cycle through each file
		foreach( $files as $file_path => $filename ) {
			//make sure the file exists
			if( file_exists( $file_path ) ) {
				$valid_files[$file_path] = $filename;
			}
		}
	}
	//if we have good files...
	if( count( $valid_files ) ) {
		//create the archive
		$zip = new ZipArchive();
		if( $zip->open( $destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE ) !== true ) {
			return false;
		}
		//add the files
		foreach( $valid_files as $file_path => $filename ) {
			$result = $zip->addFile( $file_path, $filename );
		}
		//debug
		#echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists( $destination );
	}
	else
	{
		return false;
	}
}
?>