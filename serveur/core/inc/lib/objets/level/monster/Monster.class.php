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
	private $_moneyOnDeath;
	private $_timeBeforeMoving;


	private $_numberOfUpdateCycles;

	public function __construct($type, $x, $y, $time)
	{
		Logger::logMonster("new $type in $x, $y");
		switch ($type) {
			case MonsterTemplate::$BASE_BETTER_MONSTER_TYPE : $array = MonsterTemplate::$BASE_BETTER_MONSTER_TEMPLATE;
			break;

			case MonsterTemplate::$BASE_MONSTER_TYPE : $array = MonsterTemplate::$BASE_MONSTER_TEMPLATE;
			break;
			
			case MonsterTemplate::$FAST_MONSTER_TYPE : $array = MonsterTemplate::$FAST_MONSTER_TEMPLATE;
			break;
			
			case MonsterTemplate::$SLOW_MONSTER_TYPE : $array = MonsterTemplate::$SLOW_MONSTER_TEMPLATE;
			break;

			default: break;
		}

		$this->_life = $array["life"];
		$this->_speed = $array["speed"];
		$this->_damage = $array["damage"];
		$this->_moneyOnDeath = $array["moneyOnDeath"];
		$this->_type = $type;
		$this->_x = $x;
		$this->_y = $y;
		$this->_isAlive = false;
		$this->_timeBeforeMoving = $time;

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
		return $this->_damage;
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
			if($direction == PathCase::$EAST)
				$this->_x--;

			else if($direction == PathCase::$WEST)
				$this->_x++;

			else if($direction == PathCase::$SOUTH)
				$this->_y--;
				
			else if($direction == PathCase::$NORTH)
				$this->_y++;

		}
	}

	public function takeDamages($damages)
	{
		$this->_life -= $damages;

		if($this->_life <= 0)
		{
			$this->_isAlive = false;
		}
	}

	public function isAlive()
	{
		if($this->_life <= 0)
			$this->_isAlive = false;
		
		return $this->_isAlive;
	}
	
	public function kill()
	{
		$this->_isAlive = false;
		$this->_life = 0;
	}
	
	public function getMoneyOnDeath()
	{
		return $this->_moneyOnDeath;
	}
	
	public function isAllowedToMove()
	{
		
		if($this->_timeBeforeMoving > 1)
		{
			$this->_timeBeforeMoving--;
			
			return false;
		}
		else if($this->_timeBeforeMoving == 1)
		{
			$this->_isAlive = true;
			$this->_timeBeforeMoving = 0;
			
			return false;
		}
		
		else 
		{
			return true;
		}
	}
}