<?php

class Map
{
	private $_map; // Array of Case
	private $_monsters; // Array of Monster
	private $_currentWave;
	private $_game;
	private $_monstersDead;
	private $_numberOfWaves;

	public function __construct($map, $game)
	{
		$this->_map = $map;
		$this->_monsters;
		$this->_currentWave = 0;
		$this->_game = $game;
		$this->_monstersDead = 0;
		$this->_numberOfWaves = 3;
	}

	public function getMap()
	{
		return $this->_map;
	}

	/**
	 * 
	 * @param number $x
	 * @param number $y
	 * @return AbstractCase
	 */
	public function getCell($x, $y)
	{
		return $this->_map[$y][$x];
	}


	/**
	 * bouge les monstres
	 */
	public function moveMonsters()
	{
		foreach ($this->_monsters as $id => $monster)
		{
			if($monster->isAllowedToMove() && $monster->isAlive() && $monster->moved())
			{
				$cell = $this->getCell($monster->getX(), $monster->getY());

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
					$this->_monstersDead++;

					$this->_game->getState()->removeLifeToCenter($monster->getDamage());

					$life = $this->_game->getState()->getCenterLife();

					foreach ($this->_game->getPlayers() as $p) {
						GameManager::getInstance()->balReiv->updateCenterLife($life, $p->getNumSocket());
						GameManager::getInstance()->balReiv->killMonster($id+1, $p->getNumSocket());
					}
				}
			}
		}
	}

	/**
	 * fait taper les monstres par les tours
	 * @param number $delta
	 */
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
								{
									$player->giveMoney($monster->getMoneyOnDeath());
									$this->_monstersDead++;
								}

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

	/**
	 * parse le fichier de level pour charger la map suivante
	 */
	public function newWave()
	{
		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->newWave($this->_currentWave+1, $p->getNumSocket());
		}
		
		$this->_monsters = array();
		$this->parseMonstersWave("../../res/level.xml");
		$this->_currentWave++;
		$this->_monstersDead = 0;
	}


	/**
	 * parse la map
	 * @param unknown_type $file
	 */
	private function parseMonstersWave($file)
	{
		$string = file_get_contents($file);
		$level = new SimpleXMLElement($string,LIBXML_NOCDATA);
		$level->getNamespaces(true);
			
		foreach ($level->wave[$this->_currentWave]->monster as $monster) {
			$this->addMonster($monster['type'], $monster['x'], $monster['y'], $monster['time']);
		}
	}

	/**
	 * ajoute un monstre à la liste de monstres de la map
	 * @param String $type
	 * @param number $x
	 * @param number $y
	 * @param number $time
	 */
	private function addMonster($type, $x, $y, $time)
	{
		$monster = new Monster($type, trim($x), trim($y), trim($time));
		$this->_monsters[] = $monster;

		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->addMonster($monster, count($this->_monsters), $p->getNumSocket());
		}
	}

	/**
	 * true si on a besoin d'une nouvelle vague
	 * si tous les monstres sont morts
	 * @return boolean
	 */
	public function needsNewWave()
	{
		if($this->_currentWave < $this->_numberOfWaves)
		{
			if($this->_monstersDead == count($this->_monsters))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}