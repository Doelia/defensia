function Infos()
{
	this.myPseudo;

	/*
		Ajoute un joueur au jeu, en affichant son nom, son avatar et son argent
	*/	
	this.addPlayer = function(num, username)
	{
		if(!$('.cadrePlayer#num'+num).length)
		{
			$('<div class="cadrePlayer cadre"></div>')
				.appendTo('div[class="listPlayers"]')
				.attr('id', 'num'+num)
				.attr('idPlayer', num)
				.attr('username', username)
				.append('<div class="avatar'+num+' avatar"></div>')
				.append('<div class="pseudo">'+username+'</div>')
				.append('<div class="money">$0</div>');
		}
	}	

	/*
		Modifie le nom du joueur
	*/
	this.setUserName = function(username)
	{
		$('.infos .name').html(username);
	}

	/*
		Modifie la vie actuelle du centre
	*/
	this.setVieCenter = function(vie)
	{
		$('.infosCentre vie').html(vie);
	}

	/*
		Affecte la vie totale du centre
	*/
	this.setMaxVieCenter = function(vie)
	{
		$('.infosCentre viemax').html(vie);
	}

	/*
		Modifie le numéro de la vague
	*/
	this.setWave = function(num)
	{
		$('.vague vague').html(num);
	}

	/*
		Affiche la vie du centre
	*/
	this.displayVieCenter = function()
	{
		$('.vieCenterBlock').show(200);
	}


	/*
		Modifie l'argent du joueur num
		Raffraichit l'état des achats possibles s'il s'agit du joueur courant
	*/
	this.setPlayerMoney = function(money, num)
	{
		$('.cadrePlayer#num'+num+' .money').html('$'+money);

		if (num == this.getMyNumber())
			this.refreshShop();
	}

	/*
		Modifie les achats disponibles selon l'argent du joueur
	*/
	this.refreshShop = function()
	{
		money = $('.cadrePlayer#num'+this.getMyNumber()+' .money').html();
		money = parseInt(money.substr(1, money.length));
		$('.tour').each(function(){
			if(money >= tm.getPrice(parseInt($(this).attr('idType'))))
				$(this).addClass('dispo');			
			else
				$(this).removeClass('dispo');
		});
	}

	/*
		Retourne le numéro du joueur courant
	*/
	this.getMyNumber = function()
	{
		return parseInt($(".cadrePlayer[username='"+this.myPseudo+"']").attr('idPlayer'));
	}

	/*
		Stocke le pseudo du joueur connecté
	*/
	this.setMyPseudo = function(pseudo)
	{
		this.myPseudo = pseudo;
	}
}
