<?php

class SalonState implements State
{
	private $_game;

	public function __construct($game)
	{
		$this->_game = $game;
	}
	public function update($detla)
	{
		if($this->_game->getNumberOfPlayers() >= 2)
		{	
			Logger::logState("changing SalonState to GameState");
			$this->_game->setState(new GameState($this->_game));
		}
	}
	
	public function show()
	{
		$tower = new Tower(TowerTemplate::$FAST_TOWER_TYPE);
		$case = new TowerSocketCase(1, 1);
	}
}
