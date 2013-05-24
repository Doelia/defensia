<?php

class GameManager
{
	private static $instance = null;

	public static function init($idBalReiv, $idBalSend)
	{
		self::$instance = new GameManager($idBalReiv, $idBalSend);
	}

	public static function getInstance()
	{
		if (self::$instance == null)
		{
			echo "Instance GameManager non initalisée";
			exit();
		}
		return self::$instance;
	}

	private $_games; // Array
	private $_AI; // Auto incrément de l'id du jeu
	public $balReiv; // 
	public $balSend; // 

	private function __construct($idBalReiv, $idBalSend)
	{
		Logger::logGame("GameManager.construct()");
		$this->_AI = 0;
		$this->_games = array();

		$this->balReiv = new BalReception($idBalReiv);
		$this->balSend = new BalEnvoi($idBalSend);
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
		Logger::logGame("GameManager : Définition first state game : salon");
		$g->setState(new SalonState($g));
		$g->boucleUpdate();
	}

	public function getGameBySocketId($IDsocket)
	{	
		foreach ($this->getGames() as $g) {
			foreach ($g->getPlayers() as $p) {
				if ($p->getNumSocket() == $IDsocket)
				{
					return $g;
				}
			}
		}
		return null;
	}

	public function getLastGame()
	{
		$nbrGames = count($this->getGames());
		return $this->_games[$nbrGames-1];
	}


}
