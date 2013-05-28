<?php

class AbstractCase
{	

	public static $CENTER_CASE_TYPE = "center";
	public static $PATH_CASE_TYPE = "path";
	public static $TOWERSOCKET_CASE_TYPE = "towersocket";


	private $_x;
	private $_y;
	private $_type;

	public function __construct($x, $y, $type)
	{
		$this->_x = $x;
		$this->_y = $y;
		$this->_type = $type;

		Logger::logCase("new $type in $x, $y");
	}

	public function getX()
	{
		return $this->_x;
	}

	public function getY()
	{
		return $this->_y;
	}

	public function getType()
	{
		return $this->_type;
	}

}
