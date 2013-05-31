<?php
	
class Map 
{
	private $_map; // Array of Case
	private $_monsters; // Array of Monster
	
	public function __construct($map)
	{
		$this->_map = $map;
		$this->_monsters = array();
	}
	
	public function getMap()
	{
		return $this->_map;
	}
	
	public function getCell($x, $y)
	{
		return $this->_map[$y][$x];
	}
	
	public function addMonster($monster)
	{
		$this->_monsters[] = $monster;
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
}