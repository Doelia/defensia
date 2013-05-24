<?php

class Player
{
	private $_sock; // Users
	private $_username;

	public function setUsername($s)
	{
		$this->_username = $s;
	}

	public function isFullyDefined()
	{
		if ($this->_username)
			return true;

		return false;
	}

	public function getSocket()
	{
		return $this->_sock;
	}

}
