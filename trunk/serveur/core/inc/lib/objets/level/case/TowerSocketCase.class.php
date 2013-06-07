<?php

class TowerSocketCase extends AbstractCase
{	

	private $_tower;

	public function __construct($x, $y)
	{
		parent::__construct($x, $y, AbstractCase::$TOWERSOCKET_CASE_TYPE);

		$this->_tower = null;
	}

	/**
	*	return true si la tour a pu etre placee
	*/
	public function setTower($tower)
	{
		if($this->_tower == null)
		{
			$this->_tower = $tower;
			return true;
		}
		else
			return false;
	}

	
	/**
	 * retourne la tour tenue par la socket
	 * @return Tower tower
	 */
	public function getTower()
	{
		return $this->_tower;
	}

	/**
	 * retounrne le montant d'argent que donne la tour lorsqu'elle est détruite
	 * @return int amount
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
	
	/**
	 * true si la case a une tour
	 * @return boolean
	 */
	public function hasTower()
	{
		return $this->_tower != null;
	}
	
	/**
	 * true si le monstre est à portée de la tour tenue par la case
	 * @param Monster $monster
	 * @param float $delta
	 * @return boolean
	 */
	public function canHit($monster, $delta)
	{
		$this->_tower->addTimeSinceLastHit($delta);
		
		if(ceil(sqrt(pow(($monster->getX() - $this->getX()), 2) + pow($monster->getY() - $this->getY(), 2))) < $this->_tower->getRange())
		{
			if($this->_tower->canHit())
			{
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}
}
