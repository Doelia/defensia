<?php
//exit();
//sleep(1);

print("Lancement du core...\n");

print("Chargement de la configuration..\n");
# Config file
require('config.php');

print("Mise en place des logs..\n");
# Cr�ation debug file
$fichierErreurPhp = './logs/'.date('Y-m-d').'-errors_php.txt';
$monfichier = fopen($fichierErreurPhp, 'a+');
fclose($monfichier);

# Options de d�bug
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', DISP_ERRORS?1:0);
ini_set("log_errors", 1);
ini_set('error_log', $fichierErreurPhp);

# Inclusion libs
print("Inclusion des fonctions...\n");
require('inc/lib/fc/chaineInc.php');	// fonction qui permet d'inclure en recursif
require('inc/lib/fc/index.php');	// Ensemble des fichiers du dossier "fc"

# Les objets sont auto d�clar�s en cas d'utilisation
print("Pr�paration de l'inclusion des classes...\n");
spl_autoload_register('chargerClasse');

print("Moteur charg� !\n");