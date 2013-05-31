<?php

class PathCase extends AbstractCase
{	

	public static $NORTH = "NORTH";
	public static $SOUTH = "SOUTH";
	public static $EAST = "EAST";
	public static $WEST = "WEST";

	private $_direction;
	private $_monsters; //array

	public function __construct($x, $y, $direction)
	{
		parent::__construct($x, $y, AbstractCase::$PATH_CASE_TYPE);
		$this->_direction = $direction;
	}

	public function getDirection()
	{
		return $this->_direction;
	}

	public function getXModifier()
	{
		if($this->_direction == self::$EAST)
			return -1;

		else if($this->_direction == self::$WEST)
			return 1;

		else 
			return 0;
	}

	public function getYModifier()
	{
		if($this->_direction == self::$NORTH)
			return 1;

		else if($this->_direction == self::$SOUTH)
			return -1;

		else 
			return 0;
	}
	
	public function setMonster($monster)
	{
		$this->_monsters = $monster;
	}

	public function getMonster()
	{
		return $this->_monsters;
	}
	
	public function hasMonster()
	{
		return $this->_monsters != null;
	}
	
	public function removeMonster()
	{
		$monster = $this->_monsters;
		$this->_monsters = null;
		
		return $monster;
	}
}


