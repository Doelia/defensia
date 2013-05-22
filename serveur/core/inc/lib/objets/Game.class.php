<?php

class Game
{
	private $_currentState;
	const SLEEPTIME = 10 * 1000;
	private $_ID;



	public function setState($state)
	{
		$this->_currentGame = $state;
		$state->state();
	}

	public function boucleUpdate()
	{
		while(true)
		{
			usleep(self::SLEEPTIME);
			$_currentState->update(SLEEPTIME);
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
