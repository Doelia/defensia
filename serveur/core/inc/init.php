<?php

// Ouverture du serveur

function thread_server($res) {
	Server::getInstance();
	exit($res);
}

$thread_server = new Thread('thread_server');
$thread_server->start(1);

GameManager::getInstance()->createGame();

while ($thread_server->isAlive(1));
