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
		$_monsters[] = $monster;
	}
	
// 	public function moveMonsters($x, $y)
// 	{
// 		$cell = $this->getCell($x, $y);
		
// 		if ($cell->hasMonster())
// 		{
// 			if($cell->getMonster()->moved())
// 			{
// 				print ("current x : ".$cell->getX()."\ncurrent y : ".$cell->getY()."\n");
// 				print $cell->getDirection()."\n";
// 				$this->getCell($x + $cell->getXModifier(), $y + $cell->getYModifier())->setMonster($cell->removeMonster());
// 			}
// 		}
// 	}
	
	public function hitMonsters($x, $y)
	{
		$cell = $this->getCell($x, $y);
		
		for ($i = $x - $cell->getRange(), $i <= $x + $cell->getRange(); $i++;)
		{
			for ($j = $y - $cell->getRange(), $j <= $y + $cell->getRange(); $j++;)
			{
					$target = $this->getCell($i, $j);
					
					if(isset($target))
					{
						if($target->getType() == AbstractCase::$PATH_CASE_TYPE)
						{
							
						}
					}
			}
		}
	}
}