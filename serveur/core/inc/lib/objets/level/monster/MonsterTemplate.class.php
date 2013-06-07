<?php

class MonsterTemplate
{
	public static $BASE_MONSTER_TYPE = "baseMonster";
	public static $BASE_MONSTER_TEMPLATE = array(
			"life" => 10,
			"speed" => 15,
			"damage" => 1,
			"moneyOnDeath" => 15,
	);

	public static $SLOW_MONSTER_TYPE = "slowMonster";
	public static $SLOW_MONSTER_TEMPLATE = array(
			"life" => 40,
			"speed" => 20,
			"damage" => 1,
			"moneyOnDeath" => 20,
	);

	public static $FAST_MONSTER_TYPE = "fastMonster";
	public static $FAST_MONSTER_TEMPLATE = array(
			"life" => 20,
			"speed" => 6,
			"damage" => 1,
			"moneyOnDeath" => 30,
	);

	public static $BASE_BETTER_MONSTER_TYPE = "baseBetterMonster";
	public static $BASE_BETTER_MONSTER_TEMPLATE = array(
			"life" => 40,
			"speed" => 10,
			"damage" => 1,
			"moneyOnDeath" => 50,
	);
}