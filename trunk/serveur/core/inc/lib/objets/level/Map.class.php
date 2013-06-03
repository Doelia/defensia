<?php

class Map
{
	private $_map; // Array of Case
	private $_monsters; // Array of Monster
	private $_currentWave;
	private $_game;

	public function __construct($map, $game)
	{
		$this->_map = $map;
		$this->_monsters;
		$this->_currentWave = 0;
		$this->_game = $game;
	}

	public function getMap()
	{
		return $this->_map;
	}

	public function getCell($x, $y)
	{	
		return $this->_map[$y][$x];
	}


	public function moveMonsters()
	{
		foreach ($this->_monsters as $monster)
		{
			if($monster->moved())
			{
				$monster->updatePosition($this->getCell($monster->getX(), $monster->getY())->getDirection());
			}
		}
	}

	public function hitMonsters()
	{

	}

	public function newWave()
	{
// 		$this->_monsters = array();
		$this->parseMap("../../res/level.xml");
		$this->_currentWave++;

	}


	private function parseMap($file)
	{
		$string = file_get_contents($file);
		$level = new SimpleXMLElement($string,LIBXML_NOCDATA);
		$ns=$level->getNamespaces(true);
			
			
		foreach ($level->wave[$this->_currentWave]->monster as $monster) {
			$this->addMonster($monster['type'], $monster['x'], $monster['y']);
		}
	}
	
	public function addMonster($type, $x, $y)
	{
		$monster = new Monster($type, trim($x), trim($y));
		$this->_monsters[] = $monster;
		
// 		foreach ($this->_game->getPlayers() as $p) {
// 			GameManager::getInstance()->balReiv->addMonster($monster, count($this->_monsters), $p->getNumSocket());
// 		}
	}
}