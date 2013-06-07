/*
 * Fonctions appelées par le serveur php
*/


// Placement d'une tour sur le plateau
function onTowerPlacer(x, y, idTower, idTypeTower, idPlayer)
{
	g.plateau.poserTower(x, y, idTower, idTypeTower, idPlayer)
}

// Tir de la tour idTower sur le monstre idMonster
function onTowerFire(idTower, idMonster)
{
	g.plateau.orienteTower(idTower, idMonster);
	setTimeout(function() {
		g.plateau.playAnimatationFire($('monstre#id'+idMonster).attr('x'), $('monstre#id'+idMonster).attr('y'));
	}, 0);
}

// Apparaition d'un monstre sur le plateau
function onMonsterPop(nameMonstre, idMonstre, x, y)
{
	g.plateau.spawnMonstre(x, y, idMonstre, getIdTypeMonstreFromName(nameMonstre));
}

// Déplacement du monstre idMonstre
function onMonsterMove(idMonstre, x, y)
{
	g.plateau.deplaceMonstre(x, y, idMonstre);
}

// Mort du monstre idMonster
function onMonsterDie(idMonster)
{
	$('monstre#id'+idMonster).remove();
}

// Définition de la vie totale du centre
function onMaxCenterLife(life)
{
	g.infos.setMaxVieCenter(life);
}

// Modification de la vie du centre
function updateCenterLife(newlife)
{
	console.log('updateCenterLife');
	g.infos.setVieCenter(newlife);
}

// Réception du plateau
function onMapRecu(json)
{
	g.plateau.drawBackground(json);
}

// Connexion d'un joueur
function onAddPlayer(idJoueur, pseudo)
{
	g.infos.addPlayer(idJoueur, pseudo);
}

// Modification de l'argent du joueur idPlayer
function onMoneyRecue(money, idPlayer, pseudo)
{
	g.infos.setPlayerMoney(money, idPlayer);
}

// Préviens que le jeu est pret à démarrer
function onGameState()
{
	g.setStateGame();
}

// Démarrage de la vague numVague
function onNewWave(numVague)
{
	g.passerAnnonce('Vague '+numVague);
	g.infos.setWave(numVague);
}
