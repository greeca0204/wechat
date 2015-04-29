<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
//读取远程内容 
function curl_get_contents($url,$timeout=1) {
	if(extension_loaded('curl')) {
		$curlHandle = curl_init(); 
		curl_setopt( $curlHandle , CURLOPT_URL, trim($url) ); 
		curl_setopt( $curlHandle , CURLOPT_RETURNTRANSFER, 1 ); 
		curl_setopt( $curlHandle , CURLOPT_TIMEOUT, $timeout ); 
		$result = curl_exec( $curlHandle ); 
		curl_close( $curlHandle ); 
	}else{
		$opts = array(
				'http'=>array(
						'method'=>"GET",
						'timeout'=>$timeout,
				)
		);
		$context = stream_context_create($opts);
		$result = @file_get_contents(trim($url) , false , $context);
	}
	return $result; 
}
?> 