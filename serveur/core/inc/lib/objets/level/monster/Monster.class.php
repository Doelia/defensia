<?php

class Monster
{
	private $_life;
	private $_speed; //un mouvement tous les x cycles d'actualisation
	private $_damage;
	private $_type;
	private $_x;
	private $_y;

	private $_numberOfUpdateCycles;

	public function __construct($type, $x, $y)
	{
// 		Logger::logMonster("new $type");
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
		$this->_x = $x;
		$this->_y = $y;

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

	public function getX()
	{
		return $this->_x;
	}

	public function getY()
	{
		return $this->_y;
	}


	public function moved()
	{
		$this->_numberOfUpdateCycles++;

		if ($this->_numberOfUpdateCycles < $this->_speed)
		{
			return false;
		}

		else
		{
			$this->_numberOfUpdateCycles = 0;
			return true;
		}
	}

	public function updatePosition($direction)
	{
		print $direction."\n";
		if($direction == PathCase::$EAST)
			$this->_x--;

		else if($direction == PathCase::$WEST)
			$this->_x++;

		else if($direction == PathCase::$SOUTH)
			$this->_y--;
			
		else if($direction == PathCase::$NORTH)
			$this->_y++;
		
		print "x : ".$this->_x."\n";
		print "y : ".$this->_y."\n";
	}
}