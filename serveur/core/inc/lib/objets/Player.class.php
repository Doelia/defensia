<?php

class Player
{
	private $_numSocket; // Id socket
	private $_username;
	private $_cash;

	public function __construct($pseudo, $numSocket)
	{
		$this->_username = $pseudo;
		$this->_numSocket = $numSocket;
		$this->_cash = 250;
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
		if($this->_cash - $amount > 0)
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

}
