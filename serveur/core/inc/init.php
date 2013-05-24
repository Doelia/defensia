<?php

// Ouverture du serveur

function thread_server($res) {
	Server::getInstance();
	exit($res);
}

//$thread_server = new Thread('thread_server');
//$thread_server->start(1);

//GameManager::getInstance()->createGame();

$b = Bal::create(1);
$b->write("Packet1");
$b->write("Packet2");
echo $b->read();

//while ($thread_server->isAlive(1));
