<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
  'pi_name' => 'Encode/Decode',
  'pi_version' => '1.2',
  'pi_author' => 'Nine Four',
  'pi_author_url' => 'http://ninefour.co.uk/labs/',
  'pi_description' => 'Encodes and decodes a text string using a number of encoding and decoding methods',
  'pi_usage' => Encode_decode::usage()
  );

/**
 * Memberlist Class
 *
 * @package			ExpressionEngine
 * @category		Plugin
 * @author			Nine Four
 * @copyright		Copyright (c) 2010, Nine Four Ltd
 * @link			http://ninefour.co.uk/labs/
 */

class Encode_decode {

	var $style = "";
	var $direction = "";
  
	function Encode_decode() {
	
		$this->EE =& get_instance();
		
		$string = $this->EE->TMPL->tagdata;
		
		if ($string == "") {
			$string = $this->EE->TMPL->fetch_param('string');
		}
		
		$style = $this->EE->TMPL->fetch_param('style');
		$direction = $this->EE->TMPL->fetch_param('direction');
        
		if ($string != "") {

			if ($direction == "decode") {
				
				switch ($style) {
				
					case "base64":
						$string = base64_decode($string);
						break;
					case "htmlspecialchars":
						$string = htmlspecialchars_decode($string);
						break;
					case "htmlentities":
						$string = html_entity_decode($string);
						break;
					case "uu":
						$string = convert_uudecode($string);
						break;
					case "rawurl":
						$string = rawurldecode($string);
						break;
					case "url":
						$string = urldecode($string);
						break;
					case "url_safe_base64":
						$string = base64_decode($string);
						$replacement_chars = array(
					        '+' => '.',
	            			'=' => '-',
	            			'/' => '~'
					    );
	    				$string = strtr($string, $replacement_chars);
						break;

				}
				
			} else {
				
				
				switch ($style) {
				
					case "base64":
						$string = base64_encode($string);
						break;
					case "htmlspecialchars":
						$string = htmlspecialchars($string);
						break;
					case "htmlentities":
						$string = htmlentities($string);
						break;
					case "uu":
						$string = convert_uuencode($string);
						break;
					case "rawurl":
						$string = rawurlencode($string);
						break;
					case "url":
						$string = urlencode($string);
						break;
					case "url_safe_base64":
						$string = base64_encode($string);
						$replacement_chars = array(
					        '.' => '+',
       						'-' => '=',
        					'~' => '/'
					    );
	    				$string = strtr($string, $replacement_chars);
						break;

				}
				
			}

			$this->return_data = $string;

		} else {
			$this->return_data = "Error: You must provide content between the opening and closing tags.";
			return;
		}	
	}
  
	function usage()
	{
	ob_start(); 
	?>
This plug-in is designed to help you encode and decode a string of text so that it can be safely passed from one page to another in the URL (for example).

BASIC USAGE:

{exp:encode_decode style="url" direction="encode"}This is @/ test string{/exp:encode_decode}

PARAMETERS:

string = 'nathan@ninefour.co.uk' (optional)
 - If you'd rather not use the plug-in as a tag pair, use a single tag and specify the string parameter.

style = 'url' (default - url)
 - The encoding style. this can be either: "url","rawurl","htmlspecialchars","htmlentities","uu", "base64" or "url_safe_base64".
 
direction = 'encode' (default - encode)
 - The direction to push the string in: "encode" or "decode".
	
RELEASE NOTES:

1.2 - Added ExpressionEngine 2 compatibility.
1.1 - Re-branded as a 'Nine Four' plug-in.
1.0 - Initial Release.

For updates and support check the developers website: http://ninefour.co.uk/labs
	<?php
	$buffer = ob_get_contents();
	
	ob_end_clean(); 
	
	return $buffer;
	}
	// END
  
}

/* End of file pi.url_title_to_entry_id.php */ 
/* Location: ./system/expressionengine/third_party/url_title_to_entry_id/pi.url_title_to_entry_id.php */