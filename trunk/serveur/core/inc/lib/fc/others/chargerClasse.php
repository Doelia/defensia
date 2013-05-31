$<?php

function chargerClasse($classe)
{
	if (file_exists("inc/lib/objets/$classe.class.php"))
		require("inc/lib/objets/$classe.class.php");
	else if (file_exists("inc/lib/objets/states/$classe.class.php"))
		require("inc/lib/objets/states/$classe.class.php");
	else if (file_exists("inc/lib/objets/server/$classe.class.php"))
		require("inc/lib/objets/server/$classe.class.php");
	else if (file_exists("inc/lib/objets/level/$classe.class.php"))
		require("inc/lib/objets/level/$classe.class.php");
	else if (file_exists("inc/lib/objets/level/case/$classe.class.php"))
		require("inc/lib/objets/level/case/$classe.class.php");
	else if (file_exists("inc/lib/objets/level/tower/$classe.class.php"))
		require("inc/lib/objets/level/tower/$classe.class.php");
	else if (file_exists("inc/lib/objets/level/monster/$classe.class.php"))
		require("inc/lib/objets/level/monster/$classe.class.php");
	else
	{
		$fichier = debug_backtrace();
		exit("Fichier classe $classe introuvable sur ".$fichier[1]['file']." ligne ".$fichier[1]['line']);
	}
		
		
}
