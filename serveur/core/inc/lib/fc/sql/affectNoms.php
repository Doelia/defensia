<?php

function affectNoms($noms, $fetchArray)
{
	/*
		Pour chaque $nom, crée une case (indéxée par le nom) avec la valeur de la clonne suivante du fetch array
	*/
	
	$cpt = 0;
	$b = array();
	foreach ($noms as $v)
		$b[$v] = $fetchArray[$cpt++];
	
	return $b;
}
