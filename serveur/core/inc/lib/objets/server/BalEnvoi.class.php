<?php

class BalEnvoi extends Bal
{

	/**
	 boite aux lettres dans laquelle le Game lira et que laquelle le serveur WebSocket écrira ↑ ↘ ↙ ← → ↖ ↗ ↔
	 c'est ici que sont traités les paquets pour le Game
	 */

	public function writeWithNumSocket($msg, $numSocket)
	{
		parent::write($numSocket."-".$msg);
		if($msg != ".")
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
			Logger::logBal("BalEnvoi.read() : $msg");
			$msg = explode("-", $msg);
			$socket = $msg[0];
			$msg = explode(":", $msg[1]);

				
			if($msg[0] == "LOGIN")
			{
				Logger::logBal("new player added : ".$msg[1]);
				GameManager::getInstance()->getLastGame()->createPlayer($msg[1], $socket);
			}

			else if($msg[0] == "AT" || $msg[0] == "RT")
			{
				Logger::logBal("new action added : ".$msg[1]);

				$g = GameManager::getInstance()->getGameBySocketId($socket);

				$g->addAction($msg);
			}
				
			else if($msg[0] == "PT")
			{

				Logger::logBal("new tower added : type = ".TowerTemplate::$TYPES[$msg[1]]."x = ".$msg[2]."y = ".$msg[3]);

				$g = GameManager::getInstance()->getGameBySocketId($socket);
				$p = $g->getPlayerFromSocketId($socket);

				if($p->canSpend(TowerTemplate::$PRICES[TowerTemplate::$TYPES[$msg[1]]]))
				{
					if($g->getState()->getMap()->getCell($msg[2], $msg[3])->setTower(new Tower(TowerTemplate::$TYPES[$msg[1]], $p)))
					{
						$p->spend(TowerTemplate::$PRICES[TowerTemplate::$TYPES[$msg[1]]]);
						
						foreach ($g->getPlayers() as $player) {
							GameManager::getInstance()->balReiv->updateMoney($p->getCash(), $p->getId(), $p->getUsername(), $player->getNumSocket());
							GameManager::getInstance()->balReiv->addTower($msg[2], $msg[3], $msg[2].$msg[3], $msg[1], $p->getId(), $player->getNumSocket());
						}
					}
				}
			}

			return true;
		}
	}

}