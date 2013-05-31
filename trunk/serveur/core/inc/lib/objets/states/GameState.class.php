<?php

class GameState implements State
{

	private $_game;

	public function __construct($game)
	{
		$this->_game = $game;
	}

	public function update($detla)
	{
// 		if(!isset($socket))
// 		{
// 			print "trying to connect\n";
// 			$socket=socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// 			if(socket_connect($socket, "localhost", "8080"))
// 				print "connected\n";
// 		}
	}

	public function show()
	{

		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->changeState("GameState", $p->getNumSocket());
		}

		$jsonString = file_get_contents("/home/noe/defensia/res/maptest.json");
		$map = new Map(MapBuilder::build($jsonString));

		// 		print trim($jsonString);

		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->sendMap($jsonString, $p->getNumSocket());
		}

	}
}
