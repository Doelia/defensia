
function onTowerPlacer(x, y, idTower, idTypeTower, idPlayer)
{
	g.plateau.poserTower(x, y, idTower, idTypeTower, idPlayer)
}

function onTowerFire(id, x, y)
{
		
}

function onTowerLevelUp(id)
{

}

function onWaveStart(num)
{

}

function onMonsterPop(idTypeMonstre, idMonstre, x, y)
{
	g.plateau.spawnMonstre(x, y, idMonstre, idTypeMonstre)
}

function onMonsterMove(idMonstre, x, y)
{
	g.plateau.deplaceMonstre(x, y, idMonstre);
}

function onMonsterDie(id)
{

}

function onCenterAttacked(idMonster, damage)
{

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
	g.infos.setPlayerMoney(money, idPlayer, pseudo);
}




