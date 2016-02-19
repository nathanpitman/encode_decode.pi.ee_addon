<?php

$plugin_info = array(
	'pi_name'		=> 'Encode/Decode',
	'pi_version'		=> '1.3',
	'pi_author'		=> 'Nathan Pitman',
	'pi_author_url'		=> 'https://github.com/nathanpitman/encode_decode.pi.ee_addon',
	'pi_description'	=> 'Encodes and decodes a text string using a number of encoding and decoding methods',
	'pi_usage'		=> encode_decode::usage()
);

class encode_decode {

	var $style = "";
	var $direction = "";
	
	function encode_decode()
	{
		global $TMPL;
		$str = $TMPL->tagdata;
		$style = $TMPL->fetch_param('style');
		$direction = $TMPL->fetch_param('direction');
        
		if ($str != "") {

			if ($direction == "decode") {
				if ($style == "base64") {
					$string = base64_decode($str);
				} elseif ($style == "htmlspecialchars") {
					$string = htmlspecialchars_decode($str);
				} elseif ($style == "htmlentities") {
					$string = html_entity_decode($str);
				} elseif ($style == "uuencode") {
					$string = convert_uudecode($str);
				} elseif ($style == "rawurl") {
					$string = rawurldecode($str);
				} else {
					$string = urldecode($str);
				}
			} else {
				if ($style == "base64") {
					$string = base64_encode($str);
				} elseif ($style == "htmlspecialchars") {
					$string = htmlspecialchars($str);
				} elseif ($style == "htmlentities") {
					$string = htmlentities($str, ENT_COMPAT, "UTF-8", false);
				} elseif ($style == "uuencode") {
					$string = convert_uuencode($str);
				} elseif ($style == "rawurl") {
					$string = rawurlencode($str);
				} elseif ($style == "url_dash") {
					$string = strtr(strtolower(urlencode($string)),'+', '-');
				} else {
					$string = urlencode($str);
				}
			}
			
			$this->return_data = $string;

		} else {
			$this->return_data = "Error: You must provide content between the opening and closing tags.";
			return;
		}	
	}
	

// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start(); 
?>
This plug-in is designed to help you encode and decode a string of text so that it can be safely passed from one page to another in the URL for example.

BASIC USAGE:

{exp:encode_decode style="url" direction="encode"}This is @/ test string{/exp:encode_decode}

PARAMETERS:

style = 'url' (default - url)
 - The encoding style. this can be either: "url","rawurl","htmlspecialchars","htmlentities","uuencode" or "base64".
 
direction = 'encode' (default - encode)
 - The direction to push the string in: "encode" or "decode".
	
For updates and support check the developers website: https://github.com/nathanpitman/encode_decode.pi.ee_addon

<?php
$buffer = ob_get_contents();
	
ob_end_clean(); 

return $buffer;
}


}
?>
