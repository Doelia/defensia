<?php

class Game
{
	private $_currentState;
	const SLEEPTIME = '100000';

	private $_ID; // Généré par le gamemanager
	private $_players; // Array

	public function __construct($id)
	{
		$this->_ID = $id;
		$this->_players = array();
	}

	public function setState($state)
	{
		$this->_currentState = $state;
		$state->show();
	}

	public function boucleUpdate()
	{
		while(true)
		{
			usleep(self::SLEEPTIME);
			$_currentState->update(SLEEPTIME);
		}
	}

	public function getState()
	{
		return $this->_currentGame;
	}

	public function getID()
	{
		return $_this->_ID;
	}

	public function createPlayer(WebSocketUser $u)
	{
		$this->_players[] = new Player($u);
	}

	private function getPlayers()
	{
		return $this->_players;
	}

	public function getPlayerFromSocket(WebSocketUser $u)
	{
		foreach ($this->getPlayers as $p)
		{
			if ($p->getSocket()->equals($u))
				return true;
		}
		return false;
	}
}
