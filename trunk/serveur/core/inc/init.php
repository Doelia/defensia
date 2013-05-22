<?php

// Ouverture du serveur

function thread_server() {

	
   
}

$thread_server = new Thread('thread_server');
$thread_server->start();

GameManager::getInstance()->createGame();
