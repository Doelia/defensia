
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
	
			g.plateau.cellules[obj.y][obj.x].setIsRoute();
			
			$('routes').append('<route></route>');
			$('routes route:last-child')
					.css("top", obj.y * 33)
					.css("left", obj.x * 33)
					.attr("type", obj.texture);
		});
	
	
		// Création sockets
		$.each(json.map.sockets, function(id, obj) { 
	
			g.plateau.cellules[obj.y][obj.x].setIsSocket();
			
			$('sockets').append('<socket></socket>');
			$('sockets socket:last-child')
					.css("top", obj.y * 33)
					.css("left", obj.x * 33)
					.attr("x", obj.x)
					.attr("y", obj.y)
					.attr("direction", obj.direction);
		});

		
		// Placement du centre
		$('.map').append('<centre></centre>');
		$('centre:last-child')
					.css("top", json.map.centre.y * 33)
					.css("left", json.map.centre.x * 33)
					.attr("life", json.map.centre.life);

	}

	/*
		Affiche un monstre à la coordonées demandée
		Définit le montre à la cellule crée
	*/
	this.spawnMonstre = function(x, y, idMonstre, idTypeMonstre)
	{
		$('monstres').append('<monstre></monstre>');
		$('monstres monstre:last-child')
					.css("top", y * 33)
					.css("left", x * 33)
					.attr("id", idMonstre)
					.attr("type", idTypeMonstre);
					
		this.cellule[x][y].setObjectOn($('monstre#'+idMonstre));
	}

	this.deplaceMonstre = function(x, y, idMonster)
	{
		// TODO : Changer le left et le right du <monster id="idmonstre">
		this.getCelulleFromMonster(idMonster).setObjectOn(null);
		this.cellule[x][y].setObjectOn($('monstre#'+idMonstre));
	}

	this.poserTower = function(x, y, idTower, idTypeTower, idPlayer)
	{
		$('socket[x='+x+'][y='+y+']').html('<tour></tour>');
		$('socket[x='+x+'][y='+y+'] tour:last-child')
					.attr("id", idTower)
					.attr("type", idTypeTower)
					.attr("placedby", idPlayer);
					
		g.plateau.cellule[x][y].setObjectOn($('tower#'+idTower));
	}

}

