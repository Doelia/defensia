<?php

/**
* boite aux lettres dans laquelle le Game écrira et que le serveur WebSocket lira
*/

class BalReception extends Bal
{


	/**
	  * Format des paquets : 
	  *	IDaction:param1:param2:param3:...
	***/
	public function write ($msg)
	{
		Logger::logBal("BalRecepetion.write($msg)");
		parent::write($msg);
	}

	/**
	  * IDaction : AT
	  * param1 : type type de la tour
	  * param2 : x position en x de la tour
	  * param3 : y position en y de la tour
	  * param4 : socket du joueur
	***/

	public function addTower($x, $y, $idTower, $idTypeTower, $idPlayer, $socket)
	{	
		Logger::logBal("BalRecepetion.addTower($x, $y, $idTower, $idTypeTower, $idPlayer, $socket)");
		$this->write("$socket-onTowerPlacer!$x!$y!$idTower!$idTypeTower!$idPlayer");
	}

	/**
	  * IDaction : MM
	  * param1 : monster type du monstre
	  * param2 : x position en x du monstre
	  * param3 : y position en y du monstre
	  * param4 : socket du joueur
	***/
	public function moveMonster($monster, $idMonstre, $socket)
	{	
		$x = $monster->getX();
		$y = $monster->getY();
		
		Logger::logBal("BalRecepetion.moveMonster($x, $y, $idMonstre, $socket)");
		$this->write("$socket-onMonsterMove!$idMonstre!$x!$y");
	}

	/**
	  * IDaction : UM
	  * param1 : amount montant courant d'argent du joueur
	  * param2 : socket du joueur
	***/
	public function updateMoney($amount, $playerId, $username, $socket)
	{	
		Logger::logBal("BalRecepetion.updateMoney($amount, $playerId, $username, $socket)");
		$this->write("$socket-onMoneyRecue!$amount!$playerId!$username");
	}

	/**
	  * IDaction : UCL
	  * param1 : amount montant de points de vie du centre
	  * param2 : socket du joueur
	***/
	public function updateCenterLife($amount, $socket)
	{	
		Logger::logBal("BalRecepetion.updateCenterLife($amount, $socket)");
		$this->write("$socket-UCL:$amount");
	}

	/**
	  * IDaction : RT
	  * param1 : x position en x de la tour à enlever
	  * param2 : y position en y de la tour à anlever
	  * param3 : socket du joueur
	***/
	public function removeTower($x, $y, $socket)
	{
		Logger::logBal("BalRecepetion.removeTower($x, $y, $socket)");
		$this->write("$socket-RT:$x:$y");
	}

	/**
	  * IDaction : CS
	  * param1 : state
	  * param : socket du joueur
	***/
	public function changeState($state, $socket)
	{	
		Logger::logBal("BalRecepetion.changeState($state, $socket)");
		$this->write("$socket-CS:$state");
	}
	
	/**
	  * IDaction : SM
	  * param1 : map en xml
	  * param2 : socket du joueur
	***/ 
	public function sendMap($map, $socket)
	{
		Logger::logBal("BalRecepetion.sendMap(map en xml, $socket)");
		$this->write("$socket-onMapRecu!$map");
	}
	
	public function sendPlayer($numPlayer, $username, $socket)
	{
		Logger::logBal("BalRecepetion.player($username, $socket)");
		$this->write("$socket-onAddPlayer!$numPlayer!$username");
	}
	
	public function addMonster(Monster $monster, $idMonster, $socket)
	{
		$type = $monster->getType();
		$x = $monster->getX();
		$y = $monster->getY();
		Logger::logBal("BalRecepetion.addMonster,($type, $idMonster, $socket)");
		$this->write("$socket-onMonsterPop!$type!$idMonster!$x!$y");
	}
	
	public function hitMonster($idTower, $idMonster, $socket)
	{
		Logger::logBal("BalRecepetion.addMonster,($idTower, $idMonster, $xMonster, $yMonster, $xTower, $yTower, $socket)");
		$this->write("$socket-onTowerFire!$idTower!$idMonster!$xMonster");
	}
}