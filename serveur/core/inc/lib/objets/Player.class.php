<?php

class Player
{
	private $_numSocket; // Id socket
	private $_username;

	public function __construct($pseudo, $numSocket)
	{
		$this->_username = $pseudo;
		$this->_numSocket = $numSocket;
	}

	public function getNumSocket()
	{
		return $this->_numSocket;
	}

	public function getUsername()
	{
		return $this->_username;
	}

}
