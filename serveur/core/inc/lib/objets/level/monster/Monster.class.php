<?php

class Monster
{
	private $_life;
	private $_speed; //un mouvement tous les x cycles d'actualisation
	private $_damage;
	private $_type;
	private $_x;
	private $_y;
	private $_isAlive;


	private $_numberOfUpdateCycles;

	public function __construct($type, $x, $y)
	{
		Logger::logMonster("new $type in $x, $y");
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
		$this->_isAlive = true;

		$this->_numberOfUpdateCycles = 0;

	}

	public function getLife()
	{
		return $this->_life;
	}

	public function getSpeed()
	{
		return $this->_speed;
	}

	public function getType()
	{
		return $this->_type;
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

		if($this->_isAlive)
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

	public function takeDamages($damages)
	{
		$this->_life -= $damages;

		if($this->_life < 0)
		{
			$this->_isAlive = false;
			print "i am dead ! \n\n";
		}
	}

	public function isAlive()
	{
		return $this->_isAlive;
	}
	
	public function kill()
	{
		$this->_isAlive = false;
		$this->_life = 0;
	}
}