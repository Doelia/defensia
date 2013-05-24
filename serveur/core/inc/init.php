<?php

// Ouverture du serveur

$b1 = Bal::create();
$b2 = Bal::create();
Server::getInstance($b1->getId(), $b2->getId());

/*
function thread_server($res) {
	
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
*/