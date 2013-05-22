<?php

class GameManager
{
	private $_instance;
	public static getInstance()
	{
		if ($this->_instance == null)
			$this->_instance = new GameManager();
		return $this->_instance;
	}

	private $_games; // Array

	private function __constuct()
	{
		$this->_games = array();
	}

	public function getGame()
	{
		return $this->_games;
	}

	public function getGameById($id)
	{
		foreach ($this->getGames() as $g) {
			if ($g->getGame()->getId() == $id) {
				return $g;
			}
		}
		return null;
	}

	public function createGame()
	{
		return $this->_games[] = new Game();
	}

}
