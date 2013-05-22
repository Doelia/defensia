<?php

class Logger
{
	private static $log = true;
	
	public static display($m)
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
}
