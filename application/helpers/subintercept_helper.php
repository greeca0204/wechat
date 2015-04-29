<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 *
 * Return part of a string(Enhance the function substr())
 * 
 * @param string $String
 *        	the string to cut.
 * @param int $Length
 *        	the length of returned string.
 * @param booble $Append
 *        	whether append "...": false|true
 * @return string the cutted string.
 *        
 */
function sysSubStr($String, $Length, $Append = false) {
	if (strlen ( $String ) <= $Length) {
		return $String;
	} else {
		$I = 0;
		while ( $I < $Length ) {
			$StringTMP = substr ( $String, $I, 1 );
			if (ord ( $StringTMP ) >= 224) {
				$StringTMP = substr ( $String, $I, 3 );
				$I = $I + 3;
			} elseif (ord ( $StringTMP ) >= 192) {
				$StringTMP = substr ( $String, $I, 2 );
				$I = $I + 2;
			} else {
				$I = $I + 1;
			}
			$StringLast [] = $StringTMP;
		}
		$StringLast = implode ( "", $StringLast );
		if ($Append) {
			$StringLast .= "...";
		}
		return $StringLast;
	}
}
?> 