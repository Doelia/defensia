<?php

class Server extends WebSocketServer
{
	private static $instance;

	public static function getInstance($idBalReiv, $idBalSend)
	{
		if (self::$instance == null)
			self::$instance = new Server("localhost", "8080", $idBalReiv, $idBalSend);

		echo "test";
		return self::$instance;
	}

	private $balReiv;
	private $balSend;

	public function __construct($server, $port, $idBalReiv, $idBalSend)
	{
		$this->balReiv = Bal::get($idBalReiv);
		$this->balSend = Bal::get($idBalSend);
		parent::__construct($server, $port);
	}

	protected function traiterBalReiv()
	{
		while ($msg = $balReiv->read())
		{
			$tab = explode('-', $msg);
			if ($tab && $tab[0] && $tab[1] && is_numeric($tab[0]))
			{
				$socketUser = $this->getSocketFromId($tab[0]);
				$this->send($socketUser, $tab[1]);
			}
		}
	}
	
	protected function process ($socket, $message) 
	{
		Logger::logSocket("[WS] recu : $message par ".$socket->id);
		$this->traiterBalReiv();
	}
	
	protected function connected ($socket) 
	{
		Logger::logSocket("new client connected");
		GameManager::getInstance()->getGameById(1)->createPlayer($socket);
	}
	
	protected function closed ($socket) {
		Logger::logSocket("lost connection to : " . $socket->id);
		// Do nothing: This is where cleanup would go, in case the socket had any sort of
		// open files or other objects associated with them.  This runs after the socket 
		// has been closed, so there is no need to clean up the socket itself here.
	}

	protected function send ($socket, $message)
	{
		Logger::logSocket("[WS] Envoyé : $message a ".$socket->id);
		$this->send($socket,$message);
	}

	protected function getSocketFromId($idNeed)
	{
		foreach ($users as $u)
		{
			if ($u->id == $idNeed)
				return $u;
		}
	}

}
