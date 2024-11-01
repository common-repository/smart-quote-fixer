<?php   
/* 
	Plugin Name: Smart Quote Fixer 
	Plugin URI: http://www.SaltedStone.com 
	Description: Plugin for fixing smart quotes and other symbols from MS Word before it goes into the database
	Author: Stephen Yager 
	Version: 1.0
	Author URI: http://www.SaltedStone.com
*/
	
/**
 * Removes "smart" characters from word processors and replaces them with the correct hmtl safe characters
 * @param: sting $str - The string to be fixed
 * @return: cleaned string
 */
function replace_smart_chars( $str ) {
	
	// Replace the smart quotes that cause question marks to appear
	$str = str_replace(
		array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"),
		array("'", "'", '"', '"', '-', '--', '...'), $str);
	
	// Replace the smart quotes that cause question marks to appear
	$str = str_replace(
		array(chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133)),
		array("'", "'", '"', '"', '-', '--', '...'), $str);
	
	// Replace special chars (tm) (c) (r)
	$str = str_replace(
		array('™', '©', '®'),
		array('&trade;', '&copy;', '&reg;'), $str);
	
	// Return the fixed string
	return $str;
}

// Add filters to modify the content before saving to the database
add_filter( 'content_save_pre',	'replace_smart_chars' );
add_filter( 'title_save_pre',	'replace_smart_chars' );
