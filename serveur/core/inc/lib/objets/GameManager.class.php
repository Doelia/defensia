<?php

class GameManager
{
	private static $instance = null;

	public static function getInstance()
	{
		echo "getInstance";
		if (self::$instance == null)
			self::$instance = new GameManager();
		return self::$instance;
	}

	private $_games; // Array
	private $_AI; // Auto incrément de l'id du jeu

	private function __construct()
	{
		Logger::logGame("GameManager.construct()");
		$this->_AI = 0;
		$this->_games = array();
	}

	public function getGames()
	{
		return $this->_games;
	}

	public function getGameById($id)
	{
		print_r($this->getGames());
		foreach ($this->getGames() as $g) {
			if ($g->getId() == $id) {
				return $g;
			}
		}
		return null;
	}

	public function createGame()
	{
		Logger::logGame("GameManager.createGame()");
		$this->_games[] = $g = new Game(1);
		Logger::logGame("GameManager : Définition state game : salon");
		$g->setState(new SalonState($g));
		$g->boucleUpdate();
	}


}
