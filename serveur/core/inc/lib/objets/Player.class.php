<?php

class Player
{
	private $_numSocket; // Id socket
	private $_username;
	private $_cash;
	private $_id;

	public function __construct($pseudo, $numSocket, $id)
	{
		$this->_username = $pseudo;
		$this->_numSocket = $numSocket;
		$this->_id = $id;
		$this->_cash = 100;
	}

	public function getNumSocket()
	{
		return $this->_numSocket;
	}

	public function getUsername()
	{
		return $this->_username;
	}
	
	public function canSpend($amount)
	{
		if($this->_cash - $amount >= 0)
		{
			return true;
		}
		else
			return false;
	}
	
	public function spend($amount)
	{
		$this->_cash -= $amount;
	}
	
	public function getCash()
	{
		return $this->_cash;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function giveMoney($amount)
	{
		$this->_cash += $amount;
	}

}
