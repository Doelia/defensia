<?php

// Ouverture du serveur

function thread_server($res, $b1, $b2) {
	Server::getInstance($b1, $b2);
	exit($res);
}

echo "Création des BAL...";
$b1 = Bal::create();
$b2 = Bal::create();

$thread_server = new Thread('thread_server');

echo "Lancement du thread...\n";

$thread_server->start(1, $b1->getId(), $b2->getId());

echo "Initialisation du game...\n";
GameManager::init($b1->getId(), $b2->getId());
echo "Création du game...\n";
GameManager::getInstance()->createGame();

while ($thread_server->isAlive(1));
