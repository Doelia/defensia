<?php

class BalEnvoi extends Bal
{

	/**
	boite aux lettres dans laquelle le Game lira et que laquelle le serveur WebSocket écrira ↑ ↘ ↙ ← → ↖ ↗ ↔
	c'est ici que sont traités les paquets pour le Game
	*/

	public function writeWithNumSocket($msg, $numSocket)
	{
		parent::write($msg.$numSocket);
		Logger::logBal("BalEnvoi.writeWithNumSocket($msg, $numSocket)");
	}

	/**
	Actions possibles envoyées par le client
	AT : addTower - params : type, x, y, idJoueur
	RT : removeTower - params : x, y, idJoueur
	*/
	public function read()
	{
		$msg = parent::read();

		if($msg == null)
		{
			return false;
		}
		else
		{
			$msg = explode("-", $msg);

			if($msg[0] == "LOGIN")
			{

			}

			else
			{
				$g = GameManager::getInstance()->getGameBySocketId($msg[0]);

				$msg = explode(":", $msg[1]);

				$g->addAction($msg);
			}

			return true;	
		}
	}

	public function getActions()
	{	
		$read = true;
		while ($read == true)
		{
			$read = $this->read();
		}
	}

}