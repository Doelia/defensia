<?php

class Logger
{
	private static $log = true;
	
	public static function display($m)
	{
		if (self::$log)
			print "$m\n";
	}

	public static function logGame($message)
	{
		self::display("[GAME] : ". $message);
	}

	public static function logSocket($message)
	{
		self::display("[SOCKET] : ". $message);
	}

	public static function logBal($message)
	{
		self::display("[BAL] : ". $message);
	}

	public static function logState($message)
	{
		self::display("[State] : ". $message);
	}

	public static function logTower($message)
	{
		self::display("[Tower] : ". $message);
	}

	public static function logCase($message)
	{
		self::display("[Case] : ". $message);
	}
	
	public static function logJson($message)
	{
		self::display("[Json] : ". $message);
	}
	
	public static function logMonster($message)
	{
		self::display("[Monster] : ". $message);
	}
}
