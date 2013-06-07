<?php

class Monster
{
	private $_life;
	private $_speed; //un mouvement tous les x cycles d'actualisation
	private $_damage;
	private $_type;
	private $_x;
	private $_y;
	private $_isAlive;
	private $_moneyOnDeath;
	private $_timeBeforeMoving;
	private $_numberOfUpdateCycles;

	public function __construct($type, $x, $y, $time)
	{
		Logger::logMonster("new $type in $x, $y");
		switch ($type) {
			case MonsterTemplate::$BASE_BETTER_MONSTER_TYPE : $array = MonsterTemplate::$BASE_BETTER_MONSTER_TEMPLATE;
			break;

			case MonsterTemplate::$BASE_MONSTER_TYPE : $array = MonsterTemplate::$BASE_MONSTER_TEMPLATE;
			break;
			
			case MonsterTemplate::$FAST_MONSTER_TYPE : $array = MonsterTemplate::$FAST_MONSTER_TEMPLATE;
			break;
			
			case MonsterTemplate::$SLOW_MONSTER_TYPE : $array = MonsterTemplate::$SLOW_MONSTER_TEMPLATE;
			break;

			default: break;
		}

		$this->_life = $array["life"];
		$this->_speed = $array["speed"];
		$this->_damage = $array["damage"];
		$this->_moneyOnDeath = $array["moneyOnDeath"];
		$this->_type = $type;
		$this->_x = $x;
		$this->_y = $y;
		$this->_isAlive = false;
		$this->_timeBeforeMoving = $time;

		$this->_numberOfUpdateCycles = 0;

	}

	/**
	 * la vie du monstre
	 * @return number
	 */
	public function getLife()
	{
		return $this->_life;
	}

	/**
	 * la vitesse du monstre
	 * un mouvement tous les $vitesse cycles d'update
	 * @return number
	 */
	public function getSpeed()
	{
		return $this->_speed;
	}
	
	/**
	 * type du monstre
	 * @return number
	 */
	public function getType()
	{
		return $this->_type;
	}

	/**
	 * damages du monstre
	 * @return number
	 */
	public function getDamage()
	{
		return $this->_damage;
	}

	public function getX()
	{
		return $this->_x;
	}

	public function getY()
	{
		return $this->_y;
	}

	/**
	 * incrémente le temps depuis le dernier mouvement
	 * vrai si le temps depuis le dernier mouvement est supérieur à $speed
	 * @return boolean
	 */
	public function moved()
	{
		$this->_numberOfUpdateCycles++;

		if ($this->_numberOfUpdateCycles < $this->_speed)
		{
			return false;
		}

		else
		{
			$this->_numberOfUpdateCycles = 0;
			return true;
		}
	}

	/**
	 * met à jour la position du monstre en fonction de la direction passée en parametre
	 * @param String $direction
	 */
	public function updatePosition($direction)
	{

		if($this->_isAlive)
		{
			if($direction == PathCase::$EAST)
				$this->_x--;

			else if($direction == PathCase::$WEST)
				$this->_x++;

			else if($direction == PathCase::$SOUTH)
				$this->_y--;
				
			else if($direction == PathCase::$NORTH)
				$this->_y++;

		}
	}

	/**
	 * soustrait les dommages en parametre à la vie du monstre
	 * @param number $damages
	 */
	public function takeDamages($damages)
	{
		$this->_life -= $damages;

		if($this->_life <= 0)
		{
			$this->_isAlive = false;
		}
	}

	/**
	 * true si le monstre est en vie
	 * @return boolean
	 */
	public function isAlive()
	{
		if($this->_life <= 0)
			$this->_isAlive = false;
		
		return $this->_isAlive;
	}
	
	/**
	 * tue le monstre
	 */
	public function kill()
	{
		$this->_isAlive = false;
		$this->_life = 0;
	}
	
	/**
	 * l'argent que donne le monstre en mousrant
	 * @return number
	 */
	public function getMoneyOnDeath()
	{
		return $this->_moneyOnDeath;
	}
	
	/**
	 * true si le monstre est autorisé à bouger, si le temps avant son premier mouvement est écoulé
	 * @return boolean
	 */
	public function isAllowedToMove()
	{
		
		if($this->_timeBeforeMoving > 1)
		{
			$this->_timeBeforeMoving--;
			
			return false;
		}
		else if($this->_timeBeforeMoving == 1)
		{
			$this->_isAlive = true;
			$this->_timeBeforeMoving = 0;
			
			return false;
		}
		
		else 
		{
			return true;
		}
	}
}