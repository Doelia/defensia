<?php

class Game
{
	private $_currentState;
	private static $SLEEPTIME = 100000;

	private $_ID; // Généré par le gamemanager
	private $_players; // Array

	private $_actions; //Array

	public function __construct($id)
	{
		Logger::logGame("Game.construct(id=$id)");
		$this->_ID = $id;
		$this->_players = array();
	}

	public function setState($state)
	{
		Logger::logGame("Game.setState(?)");
		$this->_currentState = $state;
		$state->show();
	}

	public function boucleUpdate()
	{
		Logger::logGame("Game.boucleUpdate()");
		while(true)
		{
			while (GameManager::getInstance()->balSend()->read()) { }
			usleep(self::$SLEEPTIME);
			$this->_currentState->update(self::$SLEEPTIME);
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
		Logger::logGame("Game.createPlayer(WebSocketUser u)");
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
