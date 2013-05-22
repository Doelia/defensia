<?php

function masqueMail($mail)
{
	$out = '';
	$arobasePasse = false;
	
	for ($i=0; $i < strlen($mail); $i++)
	{
		if ($mail[$i] == '@')
			$arobasePasse = true;
			
		if ($i < 3 ||  $arobasePasse)
			$out .= $mail[$i];
		else
			$out .= '*';
		
		
		
	}
	
	return $out;
		
		
}

