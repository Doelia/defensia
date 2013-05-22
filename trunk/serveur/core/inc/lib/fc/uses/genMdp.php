<?php

function genMdp($taille=8)
{
	/*
		Génére un mot de passe avec la structure suivante:
			[consome,voyelle]x(taille-2) . [chiffre]x2
			Exemple avec taille 8 : loxoja56
	*/
	
	$mdp = '';
	
	$voyelles = "aeiouy";
	$consonnes = "bcdfghjklmnpqrstvwxz";
	
	$voyelle = false;
	for ($i=0; $i < $taille-2; $i++)
	{
		$chaine = $voyelle ? $voyelles : $consonnes;
		$n = rand(0,strlen($chaine)-1);
		$mdp .= $chaine[$n];
		$voyelle = !$voyelle;
	}
	
	$mdp .= rand(0,9);
	$mdp .= rand(0,9);
	
	return $mdp;
}

