<?php

class GameState implements State
{

	private $_game;
	private $_map;
	private $_centerLife;

	public function __construct($game)
	{
		$this->_game = $game;
		$this->_map = array();
	}

	public function update($delta)
	{
		$this->_map->moveMonsters();
		$this->_map->hitMonsters($delta);
		
		if($this->_map->needsNewWave())
		{
			$this->_map->newWave();
		}
	}

	public function show()
	{

		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->changeState("GameState", $p->getNumSocket());
		}

		$jsonString = file_get_contents("../../res/level1_server");
		$this->_map = new Map(MapBuilder::build($jsonString), $this->_game);

		$this->_centerLife = CenterCase::getLife();

		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->sendMap($jsonString, $p->getNumSocket());
		}

		foreach ($this->_game->getPlayers() as $p) {
			foreach ($this->_game->getPlayers() as $player) {
				GameManager::getInstance()->balReiv->updateMoney($player->getCash(), $player->getId(), $player->getUsername(), $p->getNumSocket());
			}
			GameManager::getInstance()->balReiv->updateCenterLife($this->_centerLife, $p->getNumSocket());
		}

		$this->_map->newWave();
	}

	public function getMap()
	{
		return $this->_map;
	}

	public function removeLifeToCenter($amount)
	{
		$this->_centerLife -= $amount;
	}

	public function getCenterLife()
	{
		return $this->_centerLife;
	}

}
