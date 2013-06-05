
function Plateau()
{
	this.cellules = new Array();
	console.log("Plateau.construct()");

	this.preparePlateau = function()
	{
		console.log("Plateau.preparePlateau()");
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

		// Création des onclick sur le shop
		$('.tour').each(function(i){
			$(this).click(
				( function(elem) {
					return function() {
						if ($(this).hasClass('dispo'))
						{
							g.inMove = $(this);	
							$('.game').css('cursor', 'crosshair');

							$('socket:empty') 
								.css('opacity', 0.6)
								.mouseenter(function() {
									$(this).css('opacity', 1);
								})
								.mouseleave(function() {
									$(this).css('opacity', 0.6);
								})
							;
						}
					};
				} ) (this)
			);	
		});


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
	
			//g.plateau.cellules[obj.y][obj.x].setIsRoute();
			
			$('routes').append('<route></route>');
			$('routes route:last-child')
					.css("top", obj.y * 33)
					.css("left", obj.x * 33)
					.attr("type", obj.texture);
		});
	
		// Création sockets
		$.each(json.map.sockets, function(id, obj) { 
	
			//g.plateau.cellules[obj.y][obj.x].setIsSocket();
			
			$('sockets').append('<socket></socket>');
			$('sockets socket:last-child')
					.css("top", obj.y * 33)
					.css("left", obj.x * 33)
					.attr("x", obj.x)
					.attr("y", obj.y)
					.attr("direction", obj.direction)
					.attr("class", "socket")
					.click(function() {
						if (g.inMove != null) // Si une tourelle est séléctionnée
						{
							var packet = 'PT:'+g.inMove.attr('idType')+':'+obj.x+':'+obj.y;
							socket.send(packet);
							console.log("Packet = "+packet);

							$('.game').css('cursor', 'default');
							g.inMove = null;

							$('socket:empty')
								.css('opacity', 0.4)
								.off('mouseenter')
								.off('mouseleave')
							;
						}
					})
				;
		});

		// Création du centre
		$.each(json.map.centre, function(id, obj) { 
	
			$('.map').append('<centre></centre>');
			$('.map centre:last-child')
					.css("top", obj.y * 33)
					.css("left", obj.x * 33)
					.attr("life", obj.life);
		});


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
			.attr("id", "id"+idMonstre)
			.attr("x", x)
			.attr("y", y)
			.attr("type", idTypeMonstre);
					
		//this.cellules[x][y].setObjectOn($('monstre#'+idMonstre));
	}

	this.deplaceMonstre = function(x, y, idMonster)
	{
		$('monstre#id'+idMonster)
			.attr("x", x)
			.attr("y", y)
			.css("top", y * 33)
			.css("left", x * 33)
			;

		// TODO
		//this.getCelulleFromMonster(idMonster).setObjectOn(null);
		//this.cellules[x][y].setObjectOn($('monstre#'+idMonster));
	}

	this.poserTower = function(x, y, idTower, idTypeTower, idPlayer)
	{
		
		$('socket[x='+x+'][y='+y+']')
			.css('opacity', 1)
			.html('<tour></tour>');
		$('socket[x='+x+'][y='+y+'] tour:last-child')
			.attr("id", "id"+idTower)
			.attr("type", idTypeTower)
			.attr("placedby", idPlayer);

		//g.plateau.cellules[x][y].setObjectOn($('tower#'+idTower));
	}

	this.playAnimatationFire = function(x, y)
	{
		if (!x || !y)
			return;

		console.log("fire @ "+x+","+y);
		$('animations').append('<animation></animation>');

		$('animations animation:last-child')
			.css("top", y * 33)
			.css("left", x * 33)

		$('animations animation:last-child').append('<c></c>');

		for (var i=1; i<=7; i++)
		{
			$('animations animation:last-child c')
				.queue(
					( function(i, elem) {
						return function() {

							$('<step></step').appendTo(elem)
								.hide()
								.attr('class', 's'+i)
								.fadeIn(20)
								.fadeOut(20)
							;

							elem
								.dequeue();
						};
					} ) (i, $('animations animation:last-child c'))
				)
				.delay(20)
		}

		$('animations animation:last-child c')
			.delay(20)
			.queue(
				( function(elem) {
						return function() {
							elem.remove();
						};
					} ) ( $('animations animation:last-child'))
			)

	}
	
	this.orienteTower = function(idTower, idMonstre)
	{
		x1 = $('tour#id'+idTower).parent().attr('x');
		y1 = $('tour#id'+idTower).parent().attr('y');
		x2 = $('monstre#id'+idMonstre).attr('x');
		y2 = $('monstre#id'+idMonstre).attr('y');
		var degree = ((Math.atan2(y2-y1, x2-x1) * 180.0/Math.PI)) + 180.0;
		
		
		$('tour#id'+idTower).stop().animate(
		  {rotation: degree},
		  {
		    duration: 500,
		    step: function(now, fx) {
		      $(this).css({ WebkitTransform: 'rotate(' + degree + 'deg)'});
		    }
		  }
		);

	}

}

