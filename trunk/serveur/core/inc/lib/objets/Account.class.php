<?php



class Account
{
	// Champs de la table profil
	protected $_id;
	protected $_name;
	protected $_dateRecord;
	protected $_isInscris;
	protected $_pass;
	protected $_isAdmin;
	protected $_lang;
	protected $_pb = 0;
	protected $_dateEndVip;
	protected $_mail;
	protected $_recevoirMails;
	protected $_option_ip;
	protected $_vip; // int 1 ou 0

	protected $_rights = null; // Chargé quand demandé
	protected $_needUpdate; // A passer à true à chaque modif, utilisé pour AccountManager::update()

	public function __construct($a)
	{
		$this->hydrate($a);
		$this->_needUpdate = false;
	}

	protected function hydrate($a)
	{
		foreach ($a as $i => $v)
		{
			$att = '_'.$i;
			$this->$att = $v;
		}
	}

	public function set_isAdmin($adm = false)
	{
		$this->_needUpdate = true;
		
		if($adm)
			$this->_isAdmin = 1;
		else
			$this->_isAdmin = 0;
	}

	public function isAdmin()
	{
		return ($this->_isAdmin == 1);
	}

	public function rights()
	{
		if($this->_rights == null)
			$this->_rights = RightsManager::getRightsOf($this);

		return $this->_rights;
	}

	public function haveRight($id)
	{
		foreach ($this->rights() as $r)
		{
			if ($r->id() == $id)
				return true;
		}
		return false;
	}

	public function modules()
	{
		$modules = array();
		foreach ($this->rights() as $r)
			if ($r->isModule())
				$modules[] = $r;
		return $modules;
	}

	public function recevoirMails()
	{
		return $this->_recevoirMails?1:0;
	}

	public function dateRecord()
	{
		return new DateSql($this->_dateRecord);
	}

	public function setRecevoirMails($b)
	{
		$this->_needUpdate = true;

		if ($b)
			$this->_recevoirMails = 1;
		else
			$this->_recevoirMails = 0;

	}

	public function name()
	{
		return $this->_name;
	}

	public function isInscris()
	{
		return ($this->_isInscris == 1);
	}

	public function pass()
	{
		return $this->_pass;
	}

	public function xp()
	{
		return $this->_xp;
	}

	public function mail()
	{
		return $this->_mail;
	}

	public function lang()
	{
		if (empty($this->_lang)) return 'US';
		return $this->_lang;
	}

	public function ID()
	{
		return $this->_ID;
	}
	
	public function pb()
	{
		return $this->_pb;
	}

	public function isVip()
	{
		return ($this->_vip == 1);
	}

	public function addPb($v)
	{
		$this->_needUpdate = true;
		$this->_pb += $v;
	}

	public function dateEndVip()
	{
		return new DateSql($this->_dateEndVip);
	}

	public function getDateEndVip()
	{
		return formatDate($this->_dateEndVip, 1);
	}

	public function setNouvPass($clair)
	{
		$this->_needUpdate = true;
		$this->_pass = AccountManager::cryptMdp($clair);
	}

	public function doVip()
	{
		$this->addPb(60);
		AccountManager::doVip($this);
		$this->_vip = 1;
	}

	public function doVipCode()
	{
		AccountManager::doVip($this, 6);
		$this->_vip = 1;
	}

	public function set_option_ip($v)
	{
		$this->_needUpdate = true;
		$this->_option_ip = $v?1:0;
	}

	public function option_ip()
	{
		return $this->_option_ip;
	}

	/**
	*
	*	Retourne null si le jour n'est pas ban
	*	Un objet ban si c'est le cas (raison, durée, etc...)
	*
	*/
	public function get_ban()
	{
		if(BanManager::exists($this->ID(), true))
		{
			return BanManager::getObject($this->ID());
		} else {
			return null;
		}
	}

	public function updateNecessaire()
	{
		return $this->_needUpdate;
	}

}



