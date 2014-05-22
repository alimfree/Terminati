<?php 
/**
 * @author Ali <techsupport@brafton.com>
 * @package Terminati
 * 
 * Simple class used to split large xml files into smaller files.
 * Reference: http://truelogic.org/wordpress/2012/07/03/split-large-xml-into-parts-before-processing-in-php/
 */

if( ! class_exists( 'Splitter' ) ){
	class Splitter {

		/**
		 * Breaks up an xml file into several smaller files 
		 * If the original archives xml file is smaller than max size it will be 
		 * converted into a single file. Tested up to 1k articles.
		 * @param string $boundaryTag for product boundary tag name
		 * @param int $filename_index file number to start at 
		 * @param int articles_per_file how many occurences of the item to break the file at
		 * @param string $xml_string the raw data from the original xml file
		 * @param string $fixedFooter if not null then footer will be this string and not computed
		 * @return $filename_array array of filenames created
		 **/
		function breakIntoFiles( $args ) 
		{

			$uploads_dir = $this->get_uploads_dir();

		 	$boundaryTag = 'newsListItem';
		 	$filename_index = $args['filename_index'];
		 	$articles_per_file = intval( $args['articles_per_file'] );
		 	$xml_string = $args['xml_string'];
			$xml_array = explode("\n",$xml_string);
			$article_count = 0; // no.of articles added to xml file. resets to zero each time a file is created
			$files = $filename_index; // count of files created
			$length= count($xml_array); 
			$header = ""; // header block for xml file
			$footer = "</news>"; // footer block for xml file "its fixed"
			$article_node = "";  // article_node of xml data to be written into file
			$filename_array = array(); // array of files created
			$article_start_tag = false; // true when first boundary tag is found
			$file_created = false;	 // false if some data has not been written to file

			//process main data		
			for ( $i = 0; $i < $length; $i++ ){

				$line  = $xml_array[$i];
				//if the line contains the string "<newsListItem" 
				if ( strpos(  $line , '&lt;newsListItem' ) !== false ) {
					//increase article count.
					$article_count ++; 
					//We are at the start of an article node.
					$article_start_tag = true;
				}
				//Everything before the first article node 
				//is the header of each new file	
				if ( !$article_start_tag )
					$header .= $line . "\r\n";
				
				//Create new files As long as the article count is less than 
				//number of articles per file
				if ( $article_count >= $articles_per_file) {
					$article_count = 0;
					$files++;
					$filename =  $files . ".xml";

					$f = fopen( $uploads_dir . $filename, "w");
					fwrite($f, htmlspecialchars_decode( $header ) );
					fwrite($f, htmlspecialchars_decode( $article_node ) );
					fwrite($f, $footer);
					fclose($f);
					$filename_array[] = $filename;

					$article_node = $line . "\r\n";
					$file_created = true;
				}
				else {
					$file_created = false;
					//push the line onto the article_node.
					if ( $article_start_tag )
						$article_node .= $line . "\r\n";
				}
			}
			if ( $file_created == false ) {
				$files++;
				$filename =  $files . ".xml";
				$f = fopen( $uploads_dir . $filename, "w" );
				fwrite($f,htmlspecialchars_decode( $header ) );
				fwrite($f, htmlspecialchars_decode($article_node ) );
				fclose($f);
				$filename_array[] = $filename;
				$file_created = true;
			}
			 return $filename_array;
		}

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
	}
}
?>