<?php

function recup_param_paypal($resultat_paypal)
{
	$liste_parametres = explode("&",$resultat_paypal); // Crée un tableau de paramètres
	foreach($liste_parametres as $param_paypal) // Pour chaque paramètre
	{
		list($nom, $valeur) = explode("=", $param_paypal); // Sépare le nom et la valeur
		$liste_param_paypal[$nom]=urldecode($valeur); // Crée l'array final
	}
	return $liste_param_paypal; // Retourne l'array
}
