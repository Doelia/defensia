<?php

// Inclusion de tout les fichiers dans ce repertoire

$filesAInclure = array();
listUnDir(getRep(__FILE__));
foreach ($filesAInclure as $f)
	require($f);