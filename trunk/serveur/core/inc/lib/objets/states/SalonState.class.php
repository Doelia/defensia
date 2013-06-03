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
		if($this->_game->getNumberOfPlayers() >= 1)
		{	
			Logger::logState("changing SalonState to GameState");
			$this->_game->setState(new GameState($this->_game));
		}
	}
	
	public function show()
	{
		
	}
}
