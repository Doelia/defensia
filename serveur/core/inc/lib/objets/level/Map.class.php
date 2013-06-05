<?php

class Map
{
	private $_map; // Array of Case
	private $_monsters; // Array of Monster
	private $_currentWave;
	private $_game;

	public function __construct($map, $game)
	{
		$this->_map = $map;
		$this->_monsters;
		$this->_currentWave = 0;
		$this->_game = $game;
	}

	public function getMap()
	{
		return $this->_map;
	}

	public function getCell($x, $y)
	{
		return $this->_map[$y][$x];
	}


	public function moveMonsters()
	{
		foreach ($this->_monsters as $id => $monster)
		{
			if($monster->isAlive() && $monster->moved())
			{
				$cell = $this->getCell($monster->getX(), $monster->getY());

				print "\n\n\ntype de la case : ".$cell->getType()."\n\n\n";


				if($cell->getType() == AbstractCase::$PATH_CASE_TYPE)
				{
					$monster->updatePosition($cell->getDirection());
						
					foreach ($this->_game->getPlayers() as $p) {
						GameManager::getInstance()->balReiv->moveMonster($monster, $id+1, $p->getNumSocket());
					}
						
				}

				else if($cell->getType() == AbstractCase::$CENTER_CASE_TYPE)
				{
					$monster->kill();
						
					$this->_game->getState()->removeLifeToCenter($monster->getDamage());
						
					$life = $this->_game->getState()->getCenterLife();
						
					foreach ($this->_game->getPlayers() as $p) {
						GameManager::getInstance()->balReiv->updateCenterLife($life, $p->getNumSocket());
					}
				}
			}
		}
	}

	public function hitMonsters($delta)
	{
		foreach ($this->_map as $i => $value)
		{
			foreach ($value as $j => $cell)
			{
				if($cell->getType() == AbstractCase::$TOWERSOCKET_CASE_TYPE)
				{
					if($cell->hasTower())
					{
						foreach ($this->_monsters as $id => $monster)
						{
							if($monster->isAlive() && $cell->canHit($monster, $delta))
							{
								$monster->takeDamages($cell->getTower()->getDamage());

								$idTower = $cell->getX().$cell->getY();

								$player = $cell->getTower()->getPlayer();

								if(!$monster->isAlive())
									$player->giveMoney($monster->getMoneyOnDeath());

								foreach ($this->_game->getPlayers() as $p) {
										
									GameManager::getInstance()->balReiv->hitMonster($idTower, $id+1, $p->getNumSocket());
										
									if(!$monster->isAlive())
									{
										GameManager::getInstance()->balReiv->killMonster($id+1, $p->getNumSocket());
										GameManager::getInstance()->balReiv->updateMoney($player->getCash(), $player->getId(), $player->getUsername(), $p->getNumSocket());
									}
								}
							}
						}
					}
				}
			}
		}
	}

	public function newWave()
	{
		$this->_monsters = array();
		$this->parseMap("../../res/level.xml");
		$this->_currentWave++;

	}


	private function parseMap($file)
	{
		$string = file_get_contents($file);
		$level = new SimpleXMLElement($string,LIBXML_NOCDATA);
		$ns=$level->getNamespaces(true);
			
			
		foreach ($level->wave[$this->_currentWave]->monster as $monster) {
			$this->addMonster($monster['type'], $monster['x'], $monster['y']);
		}
	}

	public function addMonster($type, $x, $y)
	{
		$monster = new Monster($type, trim($x), trim($y));
		$this->_monsters[] = $monster;

		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->addMonster($monster, count($this->_monsters), $p->getNumSocket());
		}
	}
}