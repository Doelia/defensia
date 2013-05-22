<?php

function isIp($s)
{
	$parts = explode('.', $s);
	if (count($parts) != 4)
		return false;

	foreach ($parts as $p)
	{
		if (!is_numeric($p))
			return false;
		if ($p > 255)
			return false;
	}

	return true;
}
