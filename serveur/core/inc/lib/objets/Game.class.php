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
			while (GameManager::getInstance()->balSend->read()) { }
			usleep(self::$SLEEPTIME);
			$this->_currentState->update(self::$SLEEPTIME/self::$SLEEPTIME);
		}
	}

	public function getState()
	{
		return $this->_currentState;
	}

	public function getID()
	{
		return $this->_ID;
	}

	public function createPlayer($pseudo, $u)
	{
		Logger::logGame("Game.createPlayer($u)");
		$this->_players[] = new Player($pseudo, $u, count($this->_players) + 1);
		
		foreach ($this->getPlayers() as $p) {
			foreach ($this->getPlayers() as $i => $d) {
				GameManager::getInstance()->balReiv->sendPlayer($i+1, $d->getUsername(), $p->getNumSocket());
			}
		}
	}

	public function getPlayers()
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
	
	public function getPlayerFromSocketId($idSocket)
	{
		foreach ($this->_players as $p)
		{
			if ($p->getNumSocket() == $idSocket)
				return $p;
		}
		return null;
	}

	public function addAction($msg)
	{
		$this->_actions[] = $msg;
	}

	public function getNumberOfPlayers()
	{
		return count($this->getPlayers());
	}
	
}
