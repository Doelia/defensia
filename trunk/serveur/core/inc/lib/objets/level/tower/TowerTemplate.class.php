<?php

class TowerTemplate
{	

	public static $FAST_TOWER_TYPE = "fastTower";
	public static $FAST_TOWER_PRICE = 50;
	public static $FAST_TOWER_TEMPLATE = array(
											"damage" => 10,
											"fireRate" => 10,
											"range" => 10,
											"radius" => 1
										);

	public static $SLOW_TOWER_TYPE = "slowTower";
	public static $SLOW_TOWER_PRICE = 50;
	public static $SLOW_TOWER_TEMPLATE = array(
											"damage" => 50,
											"fireRate" => 3,
											"range" => 10,
											"radius" => 1
										);	

	public static $AOE_TOWER_TYPE = "AOETower";
	public static $AOE_TOWER_PRICE = 50;
	public static $AOE_TOWER_TEMPLATE = array(
											"damage" => 50,
											"fireRate" => 10,
											"range" => 10,
											"radius" => 5
				);																	
}
