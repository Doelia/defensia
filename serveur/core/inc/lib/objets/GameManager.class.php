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
	private $_AI; // Auto incrément de l'id du jeu

	private function __constuct()
	{
		$_AI = 0;
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
		$g = $this->_games[] = new Game($this->_AI++);
		$g->setState(new SalonState($g));
		$g->boucleUpdate();
	}


}
