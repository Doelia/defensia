<?php

class MonsterTemplate
{
	public static $FAST_MONSTER_TYPE = "fastMonster";
	public static $FAST_MONSTER_TEMPLATE = array(
												"life" => 100,
												"speed" => 5,
												"damage" => 1,
												"moneyOnDeath" => 25,
										);
	
	public static $SLOW_MONSTER_TYPE = "slowMonster";
	public static $SLOW_MONSTER_TEMPLATE = array(
												"life" => 100,
												"speed" => 50,
												"damage" => 1,
												"moneyOnDeath" => 20,
										);
}