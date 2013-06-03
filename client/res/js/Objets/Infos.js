function Infos()
{
	this.addPlayer = function(num, username)
	{
		// TODO : pas ajouter si num existe déjà
		$('<div class="cadrePlayer cadre"></div>').appendTo('div[class="listPlayers"]')
			.append('<div class="avatar'+num+' avatar"></div>')
			.append('<div class="pseudo">'+username+'</div>')
			.append('<div class="money">$0</div>');
	}	

	this.setUserName = function(username)
	{
		$('.infos .name').html(username);
	}

	this.setmoney = function(money, num)
	{
		$('.infos .money').html(money);
	}

	this.setVieCenter = function(vie)
	{
		this.vieCenter = vie;
	}

	this.displayVieCenter = function()
	{
		$('.vieCenterBlock').show(200);
	}

	this.setPlayerMoney = function(money, num, username)
	{
		this.setmoney(money);
//		$('<div class="cadrePlayer cadre"></div>').appendTo('div[class="listPlayers"]')
//		.append('<div class="avatar'+num+' avatar"></div>')
//		.append('<div class="pseudo">'+username+'</div>')
//		.append('<div class="money">$'+money+'</div>');
	}

	//TODO : faire toutes les méthodes d'update des infos

}
