<?php

// Ouverture du serveur

function thread_server($res, $b1, $b2) {
	Server::getInstance($b1, $b2);
	exit($res);
}


$b1 = Bal::create();
$b2 = Bal::create();

$thread_server = new Thread('thread_server');
$thread_server->start(1, $b1->getId(), $b2->getId());

GameManager::init($b1->getId(), $b2->getId());
GameManager::getInstance()->createGame();

while ($thread_server->isAlive(1));
