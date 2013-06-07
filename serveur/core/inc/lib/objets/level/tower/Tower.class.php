<?php

class Tower
{

	public static $SLOW_TOWER_PRICE = 50;

	private $_damage;
	private $_fireRate;
	private $_range;
	private $_attackRadius;
	private $_type;
	private $_player;
	private $_timeSinceLastHit;

	public function __construct($type, $player)
	{
		switch ($type) {
			case TowerTemplate::$BASE_BETTER_LONG_RANGE_TOWER_TYPE : $array = TowerTemplate::$BASE_BETTER_LONG_RANGE_TOWER_TEMPLATE;
			break;

			case TowerTemplate::$BASE_LONG_RANGE_TOWER_TYPE : $array = TowerTemplate::$BASE_LONG_RANGE_TOWER_TEMPLATE;
			break;
			
			case TowerTemplate::$BASE_TOWER_TYPE : $array = TowerTemplate::$BASE_TOWER_TEMPLATE;
			break;
			
			case TowerTemplate::$BEST_TOWER_TYPE : $array = TowerTemplate::$BEST_TOWER_TEMPLATE;
			break;
			
			case TowerTemplate::$FAST_TOWER_TYPE : $array = TowerTemplate::$FAST_TOWER_TEMPLATE;
			break;
			
			case TowerTemplate::$SLOW_LONG_RANGED_TOWER_TYPE : $array = TowerTemplate::$SLOW_LONG_RANGED_TOWER_TEMPLATE;
			break;
				
			case TowerTemplate::$SLOW_TOWER_TYPE : $array = TowerTemplate::$SLOW_TOWER_TEMPLATE;
			break;
			
			default: break;
		}

		$this->_damage = $array["damage"];
		$this->_fireRate = $array["fireRate"];
		$this->_range = $array["range"] + 1;
		$this->_attackRadius = $array["radius"];
		$this->_type = $type;
		$this->_player = $player;
		$this->_timeSinceLastHit = $this->_fireRate;
	}

	public function getDamage()
	{
		$this->_timeSinceLastHit = 0;
		return $this->_damage;
	}

	public function getFireRate()
	{
		return $this->_fireRate;
	}

	public function getRange()
	{
		return $this->_range;
	}

	public function getType()
	{
		return $this->_type;
	}

	/**
	 * true is la temps depuis son dernier tir est supérieur à sa cadence de tir
	 * @return boolean
	 */
	public function canHit()
	{
		return $this->_timeSinceLastHit > $this->_fireRate;
	}

	public function addTimeSinceLastHit($delta)
	{
		$this->_timeSinceLastHit++;
	}

	public function getPlayer()
	{
		return $this->_player;
	}
}