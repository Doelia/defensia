
function onTowerPlacer(x, y, idTower, idTypeTower, idPlayer)
{
	g.plateau.poserTower(x, y, idTower, idTypeTower, idPlayer)
}

function onTowerFire(idTower, idMonster)
{
	g.plateau.orienteTower(idTower, idMonster);
	setTimeout(function() {
		g.plateau.playAnimatationFire($('monstre#id'+idMonster).attr('x'), $('monstre#id'+idMonster).attr('y'));
	}, 0);
}

function onMonsterPop(nameMonstre, idMonstre, x, y)
{
	g.plateau.spawnMonstre(x, y, idMonstre, getIdTypeMonstreFromName(nameMonstre));
}

function onMonsterMove(idMonstre, x, y)
{
	g.plateau.deplaceMonstre(x, y, idMonstre);
}

function onMonsterDie(idMonster)
{
	$('monstre#id'+idMonster).remove();
}

function onMaxCenterLife(life)
{
	g.infos.setMaxVieCenter(life);
}

function updateCenterLife(newlife)
{
	console.log('updateCenterLife');
	g.infos.setVieCenter(newlife);
}

function onMapRecu(json)
{
	g.plateau.drawBackground(json);
}

function onAddPlayer(idJoueur, pseudo)
{
	g.infos.addPlayer(idJoueur, pseudo);
}

function onMoneyRecue(money, idPlayer, pseudo)
{
	g.infos.setPlayerMoney(money, idPlayer);
}

function onGameState()
{
	g.setStateGame();
}

function onNewWave(numVague)
{
	g.infos.setWave(numVague);
}