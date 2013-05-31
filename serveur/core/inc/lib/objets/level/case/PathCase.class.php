<?php

class PathCase extends AbstractCase
{	

	public static $NORTH = "N";
	public static $SOUTH = "S";
	public static $EAST = "E";
	public static $WEST = "W";

	private $_direction;
	private $_monster;

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
		if($_direction == $EAST)
			return 1;

		else if($_direction == $WEST)
			return -1;

		else 
			return 0;
	}

	public function getYModifier()
	{
		if($_direction == $NORTH)
			return 1;

		else if($_direction == $SOUTH)
			return -1;

		else 
			return 0;
	}
	
	public function setMonster($monster)
	{
		$this->_monster = $monster;
	}

	public function getMonster()
	{
		return $this->_monster;
	}
}
