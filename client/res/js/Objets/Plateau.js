
function Plateau()
{
	this.cellules = new Array();
	console.log("Plateau.construct()");

	this.preparePlateau = function(xml)
	{
		/* Création des celulles */
		for (var i = 0; i < 33; i++)
		{
			this.cellules.push(new Array());
			for (var j=0; j < 33; j++)
			{
				this.cellules[i].push(new Array());
				this.cellules[i][j] = new Cellule(i, j);
			}
		}

		this.drawBackground(xml);
	}

	/************** GETTERS **************************/
	this.getCelluleFromMonster = function(idMonster)
	{
		// TODO : Boucler sur les divs
	}


	/************** FONCTION AFFICHAGE ***************/

	/*
	* Dessine la carte de base (static)
	* TODO : Définir en même temps la nature des cellules avec cellule.setIsRoute et cellule.setIsSocket
	*/
	this.drawBackground = function(json)
	{
		console.log("plateau.drawnBackground");

		// Création des routes
		
		// Placement du centre

		// Placement des sockets

	}

	/*
		Affiche un monstre à la coordonées demandée
		Définit le montre à la cellule crée
	*/
	this.spawnMonstre = function(x, y, idMonstre, idTypeMonstre)
	{
		// TODO : Afficher l'image demandée <monster id="idMonstre" type="idMonstre" style="left: X: right: X" />
		this.cellule[x][y].setObjectOn($('monstre#'+idMonstre));
	}

	this.deplaceMonstre = function(x, y, idMonster)
	{
		// TODO : Changer le left et le right du <monster id="idmonstre">
		this.getCelulleFromMonster(idMonster).setObjectOn(null);
		this.cellule[x][y].setObjectOn($('monstre#'+idMonstre));
	}

	this.poserTower = function(x, y, idTypeTower)
	{
		// TODO : Poser la balice dans la socket correspondante, dans le bon sens
		// TODO : Définir l'objet sur la cellule
	}

}

