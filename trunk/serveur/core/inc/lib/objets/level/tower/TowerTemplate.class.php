<?php

class TowerTemplate
{

	public static $TYPES = array("", "baseTower", "baseBetterTower", "fastTower", "slowLongRangedTower", "baseTowerLongRange", "baseBtterTowerLongRange", "bestTower");
	public static $PRICES = array(0,
			"baseTower" => 50,
			"baseBetterTower" => 80,
			"fastTower" => 150,
			"slowLongRangedTower" => 275,
			"baseTowerLongRange" => 400,
			"baseBetterTowerLongRange" => 600,
			"bestTower" => 880,
	);

	public static $BASE_TOWER_TYPE = "baseTower";
	public static $BASE_TOWER_TEMPLATE = array(
			"damage" => 2,
			"fireRate" => 16,
			"range" => 2,
			"radius" => 1
	);

	public static $SLOW_TOWER_TYPE = "baseBetterTower";
	public static $SLOW_TOWER_TEMPLATE = array(
			"damage" => 3,
			"fireRate" => 20,
			"range" => 2,
			"radius" => 1
	);

	public static $FAST_TOWER_TYPE = "fastTower";
	public static $FAST_TOWER_TEMPLATE = array(
			"damage" => 2,
			"fireRate" => 10,
			"range" => 2,
			"radius" => 5
	);

	public static $SLOW_LONG_RANGED_TOWER_TYPE = "slowLongRangedTower";
	public static $SLOW_LONG_RANGED_TOWER_TEMPLATE = array(
			"damage" => 3,
			"fireRate" => 40,
			"range" => 5,
			"radius" => 5
	);

	public static $BASE_LONG_RANGE_TOWER_TYPE = "baseTowerLongRange";
	public static $BASE_LONG_RANGE_TOWER_TEMPLATE = array(
			"damage" => 3,
			"fireRate" => 20,
			"range" => 3,
			"radius" => 5
	);

	public static $BASE_BETTER_LONG_RANGE_TOWER_TYPE = "baseBetterTowerLongRange";
	public static $BASE_BETTER_LONG_RANGE_TOWER_TEMPLATE = array(
			"damage" => 3,
			"fireRate" => 15,
			"range" => 3,
			"radius" => 5
	);

	public static $BEST_TOWER_TYPE = "bestTower";
	public static $BEST_TOWER_TEMPLATE = array(
			"damage" => 4,
			"fireRate" => 20,
			"range" => 4,
			"radius" => 5
	);


}
