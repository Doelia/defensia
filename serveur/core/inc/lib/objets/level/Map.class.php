<?php

class Map
{
	private $_map; // Array of Case
	private $_monsters; // Array of Monster
	private $_currentWave;

	public function __construct($map)
	{
		$this->_map = $map;
		$this->_monsters = array();
		$this->_currentWave = 0;
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
		$this->_monsters = array();
		$this->parseMap("/home/noe/defensia/res/level.xml");
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
	
	private function addMonster($type, $x, $y)
	{
		$this->_monsters = new Monster($type, $x, $y);
		$_monsters[] = $monster;
		
		foreach ($this->_game->getPlayers() as $p) {
			GameManager::getInstance()->balReiv->addMonster($monster, count($this->_monsters), $p->getNumSocket());
		}
	}
}