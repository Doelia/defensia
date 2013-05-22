<?php

function decom($nombre, $avecOblique=false)
{
	$sep = $avecOblique?"/'":"'";

	$milliards_R = substr($nombre, -12, -9);
	if ($milliards_R != '') $milliards_F = $milliards_R.$sep;
	else $milliards_F = '';

	$millions_R = substr($nombre, -9, -6);
	if ($millions_R != '') $millions_F = $millions_R.$sep;
	else $millions_F = '';

	$milliers_R = substr($nombre, -6, -3);
	if ($milliers_R != '') $milliers_F = $milliers_R.$sep;
	else $milliers_F = '';

	$unites_F = substr($nombre, -3, 3);

	return $milliards_F.$millions_F.$milliers_F.$unites_F;
}

