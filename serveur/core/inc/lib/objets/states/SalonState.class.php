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
		if($this->_game->getNumberOfPlayers() >= 0)
		{	
			Logger::logState("changing SalonState to GameState");
			$this->_game->setState(new GameState($this->_game));
		}
	}
	
	public function show()
	{
		$monster = new Monster(MonsterTemplate::$FAST_MONSTER_TYPE);	
	}
}
