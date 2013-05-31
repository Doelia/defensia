<?php

class PathCase extends AbstractCase
{	

	public static $NORTH = "NORTH";
	public static $SOUTH = "SOUTH";
	public static $EAST = "EAST";
	public static $WEST = "WEST";

	private $_direction;

	public function __construct($x, $y, $direction)
	{
		parent::__construct($x, $y, AbstractCase::$PATH_CASE_TYPE);
		$this->_direction = $direction;
	}

	public function getDirection()
	{
		return $this->_direction;
	}

}


