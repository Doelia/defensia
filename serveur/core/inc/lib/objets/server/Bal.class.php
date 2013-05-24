<?php

class Bal
{
	private $_ID;
	
	public static function create()
	{
		Sql::query("INSERT INTO df_bal");
		Sql::
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

	public function write($msg)
	{
		Sql::query("INSERT INTO df_bal_msg (idBal, msg) VALUES (".$this->getId().")");
	}

	/*
		
	*/
	public function read()
	{
		$q = Sql::query("SELECT msg, ID FROM df_bal_msg WHERE idBal='".$this->getId()."' LIMIT 1 ORDER BY ID");
		if ($q->rowCount())
		{
			$l = $q->fetch();
			Sql::query("DELETE FROM df_bal_msg WHERE ID=".$l['ID']);
			return $l['msg'];
		}

		return '';
	}
}

