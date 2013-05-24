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
		if($this->_game->getNumberOfPlayers() > 0)
			$this->_game->setState(new GameState($_game))
	}
	
	public function show()
	{

	}
}