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
		$this->_game->setState(new GameState($game));
	}
	
	public function show()
	{

	}
}