
function Plateau()
{
	this.cellules = new Array();
	console.log("Plateau.construct()");

	this.preparePlateau = function(json)
	{
		/* Création des celulles */
		for (var i = 0; i < 20; i++)
		{
			this.cellules.push(new Array());
			for (var j=0; j < 20; j++)
			{
				this.cellules[i].push(new Array());
				this.cellules[i][j] = new Cellule(i, j);
				console.log(i + "-" + j);
			}
		}

		this.drawBackground(json);
	}

	/************** GETTERS **************************/
	this.getCelluleFromMonster = function(idMonster)
	{
		// TODO : Boucler sur les divs
	}


	/************** FONCTION AFFICHAGE ***************/

	/*
	* Dessine la carte de base (static)
	*/
	this.drawBackground = function(json)
	{
		console.log("plateau.drawnBackground");
		
		
		// Création routes
		$.each(json.map.routes, function(id, obj) { 
	
			console.log(obj.y + " - " + obj.x);
			this.cellules[obj.y][obj.x].setIsRoute();
			
			$('routes').append('<route></route>');
			$('routes route:last-child')
					.css("top", obj.y * 33)
					.css("left", obj.x * 33)
					.attr("type", obj.texture);
		});
	
	
		// Création sockets
		$.each(json.map.sockets, function(id, obj) { 
	
			this.cellules[obj.y][obj.x].setIsSocket();
			
			$('sockets').append('<socket></socket>');
			$('sockets socket:last-child')
					.css("top", obj.y * 33)
					.css("left", obj.x * 33)
					.attr("type", obj.direction);
		});

		
		// Placement du centre
		$('.map').append('<centre></centre>');
		$('centre:last-child')
					.css("top", json.map.centre.y * 33)
					.css("left", json.map.centre.x * 33);

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

