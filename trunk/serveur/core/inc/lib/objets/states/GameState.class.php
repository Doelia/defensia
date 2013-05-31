<?php

class GameState implements State
{

	private $_game;
	private $_map;

	public function __construct($game)
	{
		$this->_game = $game;
		$this->_map = array();
	}

	public function update($detla)
	{
		foreach ($this->_map->getMap() as $i => $val )
		{
			foreach ($val as $j => $cell)
			{
				if ($cell->getType() == AbstractCase::$PATH_CASE_TYPE)
				{
					$this->_map->moveMonsters($j, $i);					
				}
				
				if($cell->getType() == AbstractCase::$TOWERSOCKET_CASE_TYPE)
				{
// 					$this->hitMonsters();
				}
			}
		}
	}

	public function show()
	{

		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->changeState("GameState", $p->getNumSocket());
		}

		$jsonString = file_get_contents("../../res/level1_server");
		$this->_map = new Map(MapBuilder::build($jsonString));


		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->sendMap($jsonString, $p->getNumSocket());
		}
// 		print_r($this->_map);
		
		$this->_map->getCell(10, 0)->setMonster(new Monster(MonsterTemplate::$FAST_MONSTER_TYPE));
		
	}
	
}
