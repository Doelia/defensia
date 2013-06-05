<?php

class CenterCase extends AbstractCase
{	

	private static $_life;

	public function __construct($x, $y)
	{
		parent::__construct($x, $y, AbstractCase::$CENTER_CASE_TYPE);
	}
	
	public static function setLife($life)
	{
		self::$_life = $life;
	}

	public static function getLife()
	{
		return self::$_life;
	}

	/**
	*	param : damage
	*	soustrait les dommages à la vie totale
	*/
	public function takeDamage($damage)
	{
		self::$_life -= $damage;
	}


	/**
	*	return true si la vie est inférieure à 0
	*/
	public function isDead()
	{
		return self::_life <= 0;
	}
}
