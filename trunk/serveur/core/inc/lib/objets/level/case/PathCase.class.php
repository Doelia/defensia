<?php

class PathCase extends Case
{	

	public static $NORTH = "N";
	public static $SOUTH = "S";
	public static $EAST = "E";
	public static $WEST = "W";

	private $_direction;

	public function __construct($x, $y, $direction)
	{
		parent::__construct($x, $y, Case::$PATH_CASE_TYPE);
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

}