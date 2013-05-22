<?php

class Game
{
	private $_currentState;
	const SLEEPTIME = 100000;
	private $_ID;



	public function setState($state)
	{
		$this->_currentGame = $state;
		$state->state();

		while(true)
		{
			usleep(self::SLEEPTIME);
			$_currentGame->update(SLEEPTIME);
		}
	}

	public function getGame()
	{
		return $this->_currentGame;
	}

	public function getID()
	{
		return $_this->_ID;
	}
}
