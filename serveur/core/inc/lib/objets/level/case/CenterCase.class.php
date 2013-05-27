<?php

class CenterCase extends Case
{	

	private $_life;

	public function __construct($x, $y, $life)
	{
		parent::__construct($x, $y, Case::$CENTER_CASE_TYPE);
		$this->_life = $life;
	}

	public function getLife()
	{
		return $this->_life;
	}

	/**
	*	param : damage
	*	soustrait les dommages à la vie totale
	*/
	public function takeDamage($damage)
	{
		$this->_life -= $damage;
	}


	/**
	*	return true si la vie est inférieure à 0
	*/
	public function isDead()
	{
		return $this->_life <= 0;
	}
}