<?php

class Server extends WebSocketServer
{
	private static $instance;
	public static function getInstance()
	{
		if (self::$instance == null)
			self::$instance = new Server("localhost", "8080");
		return self::$instance;
	}
	//protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.
	
	protected function process ($socket, $message) 
	{
		$player = GameManager::getInstance()->getGameById(1)->getPlayerFromSocket($socket);
		$message = explode(":", $message);

		switch ($message[0]) {
			case "LOGIN":
				$player->setUsername($message[1]);
				break;
			
			default:
				# code...
				break;
		}

		print "message : ".$message;
		$this->send($socket,$message);
	}
	
	protected function connected ($socket) 
	{
		GameManager::getInstance()->getGameById(1)->createPlayer($socket);
	}
	
	protected function closed ($socket) {
		// Do nothing: This is where cleanup would go, in case the socket had any sort of
		// open files or other objects associated with them.  This runs after the socket 
		// has been closed, so there is no need to clean up the socket itself here.
	}

	protected function send ($socket, $message)
	{
		$this->send($socket,$message);
	}

}
