<?php

function genGuid($taille=30)
{
	$guid = '';
	$chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$nb_caract = $taille;

	for ($u = 1; $u <= $nb_caract; $u++)
	{
		$nb = mt_rand(0,(strlen($chaine)-1));
		$guid .= $chaine[$nb];
	}

	return $guid;
}

function ChaineAleatoire($nbcar)
{
	$chaine = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

	srand((double)microtime()*1000000);

	$variable='';
        
	for($i=0; $i<$nbcar; $i++) $variable .= $chaine{rand()%strlen($chaine)};
	return $variable;
}
