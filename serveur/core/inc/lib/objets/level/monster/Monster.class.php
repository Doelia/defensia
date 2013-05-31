<?php

class Monster
{
	private $_life;
	private $_speed;
	private $_damage;
	private $_type;
	
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
}