<?php

/*

	@author	
		Doelia - www.doelia.fr
	@creation date
		02.08.2011
	@last modif
		06.10.2012

*/

/* Calculs */

function time_addSecondes($date, $secs)
{
	/*
		Pré requis: 
			- $date au format SQL
			- $secondes un entier, le nombre de seconde a ajouter
		Retourne: Une date au format sql	
	*/

}

function time_getDifDate_secs($date1, $date2) // Depuis SQL
{
	/*
		Retourne en secondes la différence entre 2 dates au format sql
	*/

	return abs(time_dateToSec($date1) - time_dateToSec($date2));
}

function time_dateToSec($date = '')
{
	/*
		Convertit une date SQL en secondes bruts
	*/

	if (empty($date)) return 0;
	return @mktime(substr($date,11,2), substr($date,14,2), substr($date,17,2),
	substr($date,5,2), substr($date,8,2), substr($date,0,4));
}


function date_joursPasses($date) // depuis SQL
{
	/*
		Calcul le nombre de jours passés entre $date et aujourd'hui
	*/

	$secondesEnUnJour = 24 * 60 * 60;
	$secondesPasses = time_getDifDate_secs($date, get_dateActuelle_sql());
	return round($secondesPasses / $secondesEnUnJour);
}

function ancienneDate_vers_sql($date)
{
	/*
		Convertit une ancienne date (d/m/Y H:i:s) au format SQL (Y-m-d H:i:s)
	*/
	$dateExplode = explode(' ', $date);
	$arrayDate = explode('/', $dateExplode[0]);
	return $arrayDate[2].'-'.$arrayDate[1].'-'.$arrayDate[0].' '.$dateExplode[1];
}

function time_sqlToJs($dateSql)
{
	/*
		Convertit une date SQL (Y-m-d H:i:s) au format JS (pour le décompte) (m/d/Y H:i:s)
	*/
	$dateExplode = explode(' ', $dateSql);
	$arrayDate = explode('-', $dateExplode[0]);
	return $arrayDate[1].'/'.$arrayDate[2].'/'.$arrayDate[0].' '.$dateExplode[1];

}

function time_tempsPasse($date)
{
	/*
		@param
			$date format SQL
		@retour
			Donne dans une unité correcte le temps passé (jours, heures, minutes ou secondes)
	*/
	
	
	$s = time_getDifDate_secs($date, get_dateActuelle_sql());
	
	if ($s > 24 * 60 * 60) // Ca fait plus d'un jours
	{
		$n = round($s / (24 * 60 * 60));
		return "$n jour".(($n>1)?'s':'');
	}
	elseif ($s > 60*60) // Ca fait plus d'une heure
	{
		$n = round($s / (60 * 60));
		return "$n heure".(($n>1)?'s':'');
	}
	elseif ($s > 60) // Ca fait plus d'une minute
	{
		$n = round($s / 60);
		return "$n minute".(($n>1)?'s':'');
	}
	else
	{
		$n = $s;
		return "$n seconde".(($n>1)?'s':'');
	}

}


/* Affichages */

function get_dateActuelle_sql()
{
	return date("Y-m-d H:i:s");
}

function formatDate($dateSql, $mode=1) // 
{


	$array = explode(' ', $dateSql);
	$date = $array[0];
	$temps = $array[1];

	$arrayDate = explode('-', $date);
	$arrayTemps = explode(':', $temps);
	$arrayDate[2] = intval($arrayDate[2]);

	switch($mode) {
		case 1: // 27 fév 12h41

			$newDate = $arrayDate[2].' '.recup_mois($arrayDate[1], true, false);
			
			if ($arrayDate[0] != date("Y"))
				$newDate .= ' '.$arrayDate[0];

			$newDate .= ' à '.$arrayTemps[0].'h'.$arrayTemps[1];

		break;
		case 2: // 14h21 si aujourd'hui, puis hier, puis 21/12

			$jPasses = date_joursPasses($dateSql);

			if ($jPasses == 0)
				$newDate = $arrayTemps[0].'h'.$arrayTemps[1];
			elseif ($jPasses == 1)
				$newDate = 'Hier, '.$arrayTemps[0].'h'.$arrayTemps[1];
			else
				$newDate = $arrayDate[2].' '.recup_mois($arrayDate[1], false, true).' '.$arrayTemps[0].'h'.$arrayTemps[1];

		break;
	}
	return $newDate;
}

function formatDate_passe($dateSql, $majs=true) // Hier à 20h21, Le 8 juil à 23h23 depuis SQL
{
	$parts = explode(' ', $dateSql);

	$days = explode('-', $parts[0]);
	$times = explode(':', $parts[1]);

	$jPasses = date_joursPasses($dateSql);
	if ($jPasses == 1)
		$txt = ($majs ? 'H' : 'h')."ier à ".$times[0].'h'.$times[1];
	elseif ($jPasses == 0)
		$txt = ($majs ? 'A' : 'a')."ujourd'hui à ".$times[0].'h'.$times[1];
	else
		$txt = ($majs ? 'L' : 'l')."e ".intval($days[2]).' '.recup_mois($days[1], false, false)." à ".$times[0].'h'.$times[1];

	return $txt;
}

function formatDate_variable($event) // Demain à 22h30 depuis SQL
{
	$now = date("Y-m-d H:i:s");

	$nowExplode = explode(' ', $now);
	$now_arrayDate = explode('-', $nowExplode[0]);
	$now_arrayTime = explode(':', $nowExplode[1]);

	$eventExplode = explode(' ', $event);
	$event_arrayDate = explode('-', $eventExplode[0]);
	$event_arrayTime = explode(':', $eventExplode[1]);

	$out = '';
	if ($joursPasses = date_joursPasses($event) > 0)
	{
		if ($joursPasses == 1) $out .= 'demain, ';
		else $out .= 'le '.intval($event_arrayDate[2]).' '.recup_mois($event_arrayDate[2], false, false).', ';
	}
	$out .= 'à '.$event_arrayTime[0].'h'.$event_arrayTime[1];

	return $out;
}



// all

function reduireSecs($secondes, $format=0)
{
	/*
	Formats:
	1: 1j, 2h, 51m, 50s (non implanté)
	0: 1 jour, 2 heures, 51 minutes et 50 secondes
	*/

	# References en secondes
	$uneSeconde = 1;
	$uneMinute = 60 * $uneSeconde;
	$uneHeure = 60 * $uneMinute;
	$unJour = 24 * $uneHeure;

	# Calculs
	$secondesRestantes = $secondes;

	$nJour = floor($secondes / $unJour);
	$secondesRestantes = $secondesRestantes - $nJour*$unJour;

	$nHeures = floor($secondesRestantes / $uneHeure);
	$secondesRestantes = $secondesRestantes - $nHeures*$uneHeure;

	$nMinutes = floor($secondesRestantes / $uneMinute);
	$secondesRestantes = $secondesRestantes - $nMinutes*$uneMinute;

	$nSecondes = $secondesRestantes;

	# Elements
	$elements = array();
	$i = 0;
	
	if ($nJour) {
		$elements[$i] = $nJour.' jour'.plur($nJour);
		$i++; }
	if ($nHeures) {
		$elements[$i] = $nHeures.' heure'.plur($nHeures);
		$i++; }
	if ($nMinutes) {
		$elements[$i] = $nMinutes.' minute'.plur($nMinutes);
		$i++; }
	if ($nSecondes && !$nMinutes && !$nHeures) {
		$elements[$i] = $nSecondes.' seconde'.plur($nSecondes);
		$i++; }
	
	# Chaine finale
	$out = '';
	for ($i=0; $i<count($elements); $i++)
	{
		$combienIlEnReste = count($elements) - $i;

		$sep = ', ';
		if ($combienIlEnReste == 2) $sep = ' et ';
		if ($combienIlEnReste == 1) $sep = '';

		$out .= $elements[$i].$sep;

	}

	return $out;
}


function recup_mois($num, $maj=false, $mini=false)
{
	$mois = 'NaN';
	if($mini)
	{
		if ($maj)
		{
			switch($num) {
			case '01': $mois =	'Janv'		; break;
			case '02': $mois =	'Fev'		; break;
			case '03': $mois =	'Mars'		; break;
			case '04': $mois =	'Avr'		; break;
			case '05': $mois =	'Mai'		; break;
			case '06': $mois =	'Juin'		; break;
			case '07': $mois =	'Juil'		; break;
			case '08': $mois =	'Août'		; break;
			case '09': $mois =	'Sept'		; break;
			case '10': $mois =	'Oct'		; break;
			case '11': $mois =	'Nov'		; break;
			case '12': $mois =	'Déc'		; break; }
		}
		else
		{
			switch($num) {
			case '01': $mois =	'janv'		; break;
			case '02': $mois =	'fév'		; break;
			case '03': $mois =	'mars'		; break;
			case '04': $mois =	'avr'		; break;
			case '05': $mois =	'mai'		; break;
			case '06': $mois =	'juin'		; break;
			case '07': $mois =	'juil'		; break;
			case '08': $mois =	'août'		; break;
			case '09': $mois =	'sept'		; break;
			case '10': $mois =	'oct'		; break;
			case '11': $mois =	'nov'		; break;
			case '12': $mois =	'déc'		; break; }
		}
	}
	else
	{
		if($maj) {
			switch($num) {
			case '01': $mois =	'Janvier'	; break;
			case '02': $mois =	'Février'	; break;
			case '03': $mois =	'Mars'		; break;
			case '04': $mois =	'Avril'		; break;
			case '05': $mois =	'Mai'		; break;
			case '06': $mois =	'Juin'		; break;
			case '07': $mois =	'Juillet'	; break;
			case '08': $mois =	'Août'		; break;
			case '09': $mois =	'Septembre'	; break;
			case '10': $mois =	'Octobre'	; break;
			case '11': $mois =	'Novembre'	; break;
			case '12': $mois =	'Décembre'	; break; }
		}
		else
		{
			switch($num) {
			case '01': $mois =	'janvier'	; break;
			case '02': $mois =	'février'	; break;
			case '03': $mois =	'mars'		; break;
			case '04': $mois =	'avril'		; break;
			case '05': $mois =	'mai'		; break;
			case '06': $mois =	'juin'		; break;
			case '07': $mois =	'juillet'	; break;
			case '08': $mois =	'août'		; break;
			case '09': $mois =	'septembre'	; break;
			case '10': $mois =	'octobre'	; break;
			case '11': $mois =	'novembre'	; break;
			case '12': $mois =	'décembre'	; break; }
		}
	}
	return $mois;
}




// Anciennes dates

function convertDate($dateFR)
{
	$jour = substr($dateFR, 0, 2);
	$mois = substr($dateFR, 3, 2);
	$suite = substr($dateFR, -14);
	return $mois.'/'.$jour.$suite;
}

function DateToSec($date = '')
{
	if(empty($date)) return 0;
	return @mktime(substr($date,11,2), substr($date,14,2), substr($date,17,2),
	substr($date,3,2), substr($date,0,2), substr($date,6,4));
}

function ajoute_secondes($date, $secs)
{
	$time = DateToSec($date) + $secs;
	return date("d/m/Y H:i:s", $time);
}

function retire_secondes($date, $secs)
{
	$time = DateToSec($date) - $secs;
	return date("d/m/Y H:i:s", $time);
}


function GetDiffDate($date1 = '',$date2 = '')
{
	return abs(DateToSec($date1) - DateToSec($date2));
}

function datePasse($date)
{
	if(DateToSec($date) < DateToSec(date("d/m/Y H:i:s"))) return TRUE;
	else return FALSE;
}

function date_ancestraToSql($ancestra)
{
	$sql = "";
	
	foreach (explode('~', $ancestra) as $i => $el)
	{
		if ($i == 0)
			$sql .= $el;
		elseif ($i <= 2)
			$sql .= '-'.$el;
		elseif ($i == 3)
			$sql .= ' '.$el;
		else
			$sql .= ':'.$el;
	}
	
	$sql .= ':00';	
	return $sql;

}


# Obsoletes

function minutesDecom($minutes) // Obsoléte, voir reduireSecs
{
	$txtH = $txtM = '';
	$heures = floor($minutes / 60);
	$minutes = $minutes - ($heures*60);
	if ($heures > 0 && $minutes > 0) $txtH = $heures.' heures, ';
	if ($heures > 0 && $minutes == 0) $txtH = $heures.' heures';
	if ($minutes > 0) $txtM = $minutes.' minutes';
	return $txtH.$txtM;
}

function secondesDecom($secondes) // Obsoléte, voir reduireSecs
{
	$txtS = $txtM = '';
	$minutes = floor($secondes / 60);
	$secondes = $secondes - ($minutes*60);
	if ($minutes > 0) $txtM = minutesDecom($minutes);
	if ($secondes > 0) $txtS = $secondes.' secondes';
	if ($minutes > 0 && $secondes > 0) $f = $txtM.', '.$txtS;
	else $f = $txtM.$txtS;
	return $f;
}


