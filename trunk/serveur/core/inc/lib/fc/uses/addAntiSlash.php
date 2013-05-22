<?php

function addAntiSlash($chain)
{
	$chain = str_replace('"', '\"', $chain);
	return $chain;
}


