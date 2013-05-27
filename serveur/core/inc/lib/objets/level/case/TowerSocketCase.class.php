<?php

class TowerSocketCase extends Case
{	

	public $_tower;

	public function __construct($x, $y)
	{
		parent::__construct($x, $y, Case::$TOWERSOCKET_CASE_TYPE);

		$this->_tower = null;
	}

	/**
	*	return true si la tour a pu etre placee
	*/
	public function setTower($tower)
	{
		if($_tower == null)
		{
			$this->_tower = $tower;
			return true;
		}
		else
			return false;
	}

	public function getTower()
	{
		return $this->_tower;
	}

	/**
	*	return le montant d'argent que vaut la tour lorsqu'elle est detruite
	*/
	public function removeTower()
	{
		if($this->_tower == null)
			return 0;

		else
		{
			$money = $_this->_tower->getMoneyOnDestroy();
			$this->_tower = null;
			return $money;
		}
	}

	/**
	*	return true si la tour existe et a pu etre uprade
	*/
	public function upgradeTower()
	{	
		if($this->_tower == null)
			return false;
		else
		{
			$this->_tower->upgradeTower();
			return true;
		}
	}
}