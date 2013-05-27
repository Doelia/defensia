<?php

class GameState implements State
{

	private $_game;

	public function __construct($game)
	{
		$this->_game = $game;
	}

	public function update($detla)
	{
		
	}
	
	public function show()
	{
		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->changeState("GameState", $p->getNumSocket());
		}

	}
}
