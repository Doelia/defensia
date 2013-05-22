<?php

class Game
{
	$_players; // Array
	
	public function __construct()
	{
		$this->_players = new array();
	}
	
	public function update($detla)
	{
		
	}
	
	public function show()
	{
		
		$thread = new Thread('thread');
		$thread->start();

	}

}
