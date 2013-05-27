<?php

class Tower
{	

	public static $SLOW_TOWER_PRICE = 50;

	private $_damage;
	private $_fireRate;
	private $_range;
	private $_attackRadius;
	private $_type;

	public function __construct($type)
	{	
		Logger::logTower("new $type");
		switch ($type) {
			case TowerTemplate::$FAST_TOWER_TYPE : $array = TowerTemplate::$FAST_TOWER_TEMPLATE;
				break;

			case TowerTemplate::$SLOW_TOWER_TYPE : $array = TowerTemplate::$SLOW_TOWER_TEMPLATE;
				break;

			case TowerTemplate::$AOE_TOWER_TYPE : $array = TowerTemplate::$AOE_TOWER_TEMPLATE;
				break;
			
			default: break;
		}

		$this->_damage = $array["damage"];
		$this->_fireRate = $array["fireRate"];
		$this->_range = $array["range"];
		$this->_attackRadius = $array["radius"];
		$this->_type = $type;
	}

	public function getDamage()
	{
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
}