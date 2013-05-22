<?php

/*
	Fichier inclu dans l'index si $ajax est remplit
*/


$pBrut = explode('|', $ajax);
$p = array();

foreach ($pBrut as $v)
	if (isset($v))
		$p[] = $v;
		

$ajax = new Ajax(DISP_AJAX);

$ajax->exec($p);
