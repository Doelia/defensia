<?php

function array_concat($array1, $array2){
	$arrayOut = array();
 
	foreach($array1 as $cle => $val){
 
		if( isset($array2[$cle]) ){
			$arrayOut[$cle] = array($val, $array2[$cle]);
		} else {
			$arrayOut[$cle] = $val;
		}
	}
 
	foreach($array2 as $cle => $val){
		if( !isset($arrayOut[$cle]) ){
			$arrayOut[$cle] = $val;
		}		
	}
 
	return $arrayOut;
}