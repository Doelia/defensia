<?php

function addPourcent($input, $pourcent)
{
	$output = $input + ($input/100 * $pourcent);
	return $output;
}
