<?php

class Logger
{
	private static $log = true;
	
	public static setLog($boolean)
	{
		$log = $boolean;
	}

	public static function logGame ($message)
	{
		print "Game : ". $message;
	}

	public static logSocket ($message)
	{
		print "Socket : ". $message;
	}
}
