<?php

function sec($chain)
{
	if (!is_array($chain))
	{
		nl2br($chain);
		$chain = htmlspecialchars($chain);
		$chain = str_replace("'", "&#39;", $chain);
		return $chain;
	}
	return $chain;
}

// Coupe un texte à $longueur caractères, sur les espaces, et ajoute des points de suspension...
function tronque($chaine, $longueur = 120) 
{
 
	if (empty ($chaine)) 
	{ 
		return ""; 
	}
	elseif (strlen ($chaine) < $longueur) 
	{ 
		return $chaine; 
	}
	elseif (preg_match ("/(.{1,$longueur})\s./ms", $chaine, $match)) 
	{ 
		return $match [1] . "..."; 
	}
	else 
	{ 
		return substr ($chaine, 0, $longueur) . "..."; 
	}
}
