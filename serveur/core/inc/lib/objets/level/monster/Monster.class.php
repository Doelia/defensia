<?php

class Monster
{
	private $_life;
	private $_speed; //un mouvement tous les x cycles d'actualisation
	private $_damage;
	private $_type;
	
	private $_numberOfUpdateCycles;
	
	public function __construct($type)
	{
		Logger::logMonster("new $type");
		switch ($type) {
			case MonsterTemplate::$FAST_MONSTER_TYPE : $array = MonsterTemplate::$FAST_MONSTER_TEMPLATE;
			break;
	
			case MonsterTemplate::$SLOW_MONSTER_TYPE : $array = MonsterTemplate::$SLOW_MONSTER_TEMPLATE;
			break;
	
			default: break;
		}
	
		$this->_life = $array["life"];
		$this->_speed = $array["speed"];
		$this->_damage = $array["damage"];
		$this->_type = $type;
		
		$this->_numberOfUpdateCycles = 0;
	}
	
	public function getLife()
	{
		return $_life;
	}
	
	public function getSpeed()
	{
		return $_speed;
	}
	
	public function getType()
	{
		return $_type;
	}
	
	public function getDamage()
	{
		
	}

	public function moved()
	{
		$this->_numberOfUpdateCycles++;
		
		if ($this->_numberOfUpdateCycles < $this->_speed)
		{
// 			print "did not move : ".$this->_numberOfUpdateCycles."\n";
			return false;
		}
		
		else 
		{
			$this->_numberOfUpdateCycles = 0;
// 			print "moved : ".$this->_numberOfUpdateCycles."\n";
			return true;
		}
	}
}