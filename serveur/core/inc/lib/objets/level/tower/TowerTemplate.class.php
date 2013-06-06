<?php

class TowerTemplate
{	
	
	public static $TYPES = array("", "fastTower", "slowTower", "AOETower");
	public static $PRICES = array(0, 
									"fastTower" => 50, 
									"slowTower" => 80,
									"AOETower" => 50
									);

	public static $FAST_TOWER_TYPE = "fastTower";
	public static $FAST_TOWER_PRICE = 50;
	public static $FAST_TOWER_TEMPLATE = array(
											"damage" => 3,
											"fireRate" => 4,
											"range" => 2,
											"radius" => 1
										);

	public static $SLOW_TOWER_TYPE = "slowTower";
	public static $SLOW_TOWER_PRICE = 80;
	public static $SLOW_TOWER_TEMPLATE = array(
											"damage" => 7,
											"fireRate" => 3,
											"range" => 3,
											"radius" => 1
										);	

	public static $AOE_TOWER_TYPE = "AOETower";
	public static $AOE_TOWER_PRICE = 50;
	public static $AOE_TOWER_TEMPLATE = array(
											"damage" => 50,
											"fireRate" => 3,
											"range" => 3,
											"radius" => 5
										);																	
}
