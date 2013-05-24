<?php

class Bal
{
	private $_ID;
	
	public static function create()
	{
		$id = 1;

 		$dir_handle = opendir('bal');

 		while($entry = readdir($dir_handle))
		 	if(is_file('bal/'.$entry))
 				$id++;

 		closedir($dir_handle);

		return self::get($id);
	}

	public static function get($id)
	{
		return new Bal($id);
	}

	public function __construct($id)
	{
		$this->_ID = $id;
	}

	public function getId()
	{
		return $this->_ID;
	}

	public function clean()
	{
		fopen("bal/".$this->getId().".bal", "w");
	}

	public function write($msg)
	{
		if (!$msg)
			return;

		$fp = fopen("bal/".$this->getId().".bal", "a");
		fputs($fp, $msg."\n");
		fclose($fp);
	}

	public function read()
	{
		$fp = fopen ("bal/".$this->getId().".bal", "r");

		$cpt = 0;
		$msg = '';
		$total = array();

		while (!feof($fp))
		{
			$ligne = trim(fgets($fp, 4096));

			if ($cpt == 0)
				$msg = $ligne;
			else
				$total[] = $ligne;

			$cpt++;
 		}

 		fclose($fp);

 		$this->clean();

 		foreach ($total as $l)
 		{
 			$this->write($l);
 		}

 		return $msg;


	}
}

