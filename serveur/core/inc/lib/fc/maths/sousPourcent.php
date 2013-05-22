<?php

function sousPourcent($input, $pourcent)
{
	$output = $input - ($input/100 * $pourcent);
	return $output;
}
