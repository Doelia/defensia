
function onTowerPlacer(x, y, type)
{

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

function onMonsterPop(idType, idMonstre, x, y)
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




