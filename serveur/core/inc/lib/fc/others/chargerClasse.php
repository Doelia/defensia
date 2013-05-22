<?php

function chargerClasse($classe)
{
	if (file_exists("inc/lib/objets/$classe.class.php"))
		require("inc/lib/objets/$classe.class.php");
	else if (file_exists("inc/lib/objets/hg/$classe.class.php"))
		require("inc/lib/objets/hg/$classe.class.php");
	else if (file_exists("inc/lib/objets/modules/$classe.class.php"))
		require("inc/lib/objets/modules/$classe.class.php");
	else
	{
		$fichier = debug_backtrace();
		exit("Fichier classe $classe introuvable sur ".$fichier[1]['file']." ligne ".$fichier[1]['line']);
	}
		
		
}
