<?php

function construit_url_paypal()
{
	$api_paypal = 'https://api-3t.paypal.com/nvp?'; // Site de l'API PayPal. On ajoute déjà le ? afin de concaténer directement les paramètres.
	$version = 74.0; // Version de l'API

	/*
	$user = 'kinder_1351354322_biz_api1.free.fr'; // Utilisateur API
	$pass = '1351354345'; // Mot de passe API
	$signature = 'Adw2pVYFX-ffIJXUYQ9g7O4PoU8yAmy7Y.zB5fdoz1fhDGN8Ihq8raCa'; // Signature de l'API
	//*/

	//*
	$user = 'kinder34_api1.free.fr'; // Utilisateur API
	$pass = 'E78QGCJQ9J5GFLVF'; // Mot de passe API
	$signature = 'AemYl.rCd2L4.r-g8oNOqwaW-Ct8Aqw5D09hyRbxEaVRWU-wMiFis-2r'; // Signature de l'API
	//*/

	$api_paypal = $api_paypal.'VERSION='.$version.'&USER='.$user.'&PWD='.$pass.'&SIGNATURE='.$signature; // Ajoute tous les paramètres

	return 	$api_paypal; // Renvoie la chaîne contenant tous nos paramètres.
}