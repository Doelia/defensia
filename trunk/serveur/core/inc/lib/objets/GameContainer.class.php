<?php

class GameContainer
{
	private $_currentGame;
	const SLEEPTIME = 100000;



	public function setGame($game)
	{
		$this->_currentGame = $game;
		$game->show();

		while(true)
		{
			usleep(self::SLEEPTIME);
			$_currentGame->update(SLEEPTIME);
		}
	}


	

}
