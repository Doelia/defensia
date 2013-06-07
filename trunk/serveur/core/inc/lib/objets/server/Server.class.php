<?php

class Server extends WebSocketServer
{
	private static $instance;

	public static function getInstance($idBalReiv, $idBalSend)
	{
		if (self::$instance == null)
			self::$instance = new Server("10.20.118.7", "8080", $idBalReiv, $idBalSend);

		echo "test";
		return self::$instance;
	}

	private $balReiv;
	private $balSend;

	public function __construct($server, $port, $idBalReiv, $idBalSend)
	{
		$this->balReiv = new BalReception($idBalReiv);
		$this->balSend = new BalEnvoi($idBalSend);
		parent::__construct($server, $port);
	}

	protected function traiterBalReiv()
	{
// 		Logger::logsocket("Server.traiterBalReiv()");
		while ($msg = $this->balReiv->read())
		{
			Logger::logsocket("Server.traiterBalReiv() : Message trouvé : $msg");

			$tab = explode('-', $msg, 2);
			if ($tab && $tab[0] && $tab[1])
			{
				$this->send($tab[0], $tab[1]);
			}
		}
// 		Logger::logsocket("FIN Server.traiterBalReiv()");
	}

	protected function process ($socket, $message)
	{
		if($message != ".")
			Logger::logSocket("[WS] recu : $message par ".$socket->id);
		$this->balSend->writeWithNumSocket($message, $socket->id);
		$this->traiterBalReiv();
	}

	protected function connected ($socket)
	{
		Logger::logSocket("new client connected");
	}

	protected function closed ($socket) {
		Logger::logSocket("lost connection to : " . $socket->id);
		// Do nothing: This is where cleanup would go, in case the socket had any sort of
		// open files or other objects associated with them.  This runs after the socket
		// has been closed, so there is no need to clean up the socket itself here.
	}

	protected function send ($numSocket, $message)
	{
		$user = $this->getUserById($numSocket);
		Logger::logSocket("[WS] User  : ".$user->id);
		parent::send($user,$message);
		Logger::logSocket("[WS] Envoyé : $message a ".$numSocket);
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
