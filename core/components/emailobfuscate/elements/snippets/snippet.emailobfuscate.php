<?php
/**
 * emailObfuscate output modifier snippet for MODx
 *
 * @package emailobfuscate
 */
$emailObfuscate = $modx->getService('emailobfuscate', 'emailObfuscate', $modx->getOption('emailobfuscate.core_path', null, $modx->getOption('core_path') . 'components/emailobfuscate/') . 'model/emailobfuscate/', $scriptProperties);
if (!($emailObfuscate instanceof emailObfuscate)) return '';

/**
 * Output modifier example:
 * [[*myTv:emailObfuscate]] or [[$myChunk:emailObfuscate]]
 *
 * Snippet example:
 * [[!emailObfuscate? 
 *   &input=`<a href="mailto:info@mydomain.com">info@mydomain.com</a>`
 * ]]
 **/

if (!function_exists('email_regex')){
	function email_regex(){
		/* Set up email regex that partially conforms to RFC2822
		 * (the ignored parts are indicated):
		 * 
		 * addr-spec		=	local-part "@" domain
		 * 
		 * local-part		=	dot-atom
		 *						/ quoted-string				// Ignored
		 *						/ obs-local-part			// Ignored
		 * 
		 * domain			=	dot-atom
		 *						/ domain-literal			// Ignored
		 *						/ obs-domain				// Ignored
		 *
		 * dot-atom			=	[CFWS] dot-atom-text [CFWS]	// Ignored CFWS
		 *
		 * dot-atom-text	=	1*atext *("." 1*atext)
		 * atext			=	ALPHA / DIGIT / ; Any character except controls,
		 *						"!" / "#" /		; SP, and specials.
		 *						"$" / "%" /		; Used for atoms
		 *						"&" / "'" /
		 *						"*" / "+" /
		 *						"-" / "/" /
		 *						"=" / "?" /
		 *						"^" / "_" /
		 *						"`" / "{" /
		 *						"|" / "}" /
		 *						"~"
		 */
		
		$atom = "[-!#$%&'*+/=?^_`{|}~0-9A-Za-z]+";
		$email_half = $atom . '(?:\\.' . $atom . ')*';
		$email = $email_half . '@' . $email_half;
		$email_regex = '<(' . $email . ')>';
		return $email_regex;
	}
}

if (!function_exists('replaceEntities')){
	function replaceEntities($matches){
		$address = html_entity_decode($matches[1]);
		$replaced = '';
		
		for ($i = 0 ; $i < strlen($address) ; $i++){
			$char = $address[$i];
			$r = rand(0, 100);

			# roughly 10% raw, 45% hex, 45% dec
			if ($r > ($hexadecimal + $decimal)){
				$replaced .= $char;
			} else if ($r < $hexadecimal){
				$replaced .= '&#x' . dechex(ord($char)) . ';';
			} else {
				$replaced .= '&#' . ord($char) . ';';
			}
		}
		return $replaced;
	}
}

$output = preg_replace_callback(email_regex(), 'replaceEntities', $input);
$output = preg_replace_callback('/(mailto:)/', 'replaceEntities', $output);

return $output;
