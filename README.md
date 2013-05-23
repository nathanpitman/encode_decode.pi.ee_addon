'Encode/Decode' for ExpressionEngine
=========================

This plug-in is designed to help you encode and decode a string of text. Typical use would be to encode a string so it can be safely passed from one page to another in the URL. Includes support for json, base64, htmlspecialchars, htmlentities, uuencode and rawurlencode.

BASIC USAGE:

{exp:encode_decode style="url" direction="encode"}This is @/ test string{/exp:encode_decode}

PARAMETERS:

string = 'nathan@ninefour.co.uk' (optional)
 - If you'd rather not use the plug-in as a tag pair, use a single tag and specify the string parameter.

style = 'url' (default - url)
 - The encoding style. this can be either: "url","rawurl","htmlspecialchars","htmlentities","uu", "base64" or "url_safe_base64".
 
direction = 'encode' (default - encode)
 - The direction to push the string in: "encode" or "decode".
