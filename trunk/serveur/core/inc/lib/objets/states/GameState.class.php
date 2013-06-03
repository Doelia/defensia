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
// 		$this->_map->moveMonsters();
	}

	public function show()
	{

		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->changeState("GameState", $p->getNumSocket());
		}

		$jsonString = file_get_contents("../../res/level1_server");
		$this->_map = new Map(MapBuilder::build($jsonString), $this->_game);


		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->sendMap($jsonString, $p->getNumSocket());
		}
		
		$this->_map->newWave();
	}
	
	public function getMap()
	{
		return $this->_map;
	}
	
}
