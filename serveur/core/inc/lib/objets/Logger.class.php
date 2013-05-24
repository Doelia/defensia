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
}
