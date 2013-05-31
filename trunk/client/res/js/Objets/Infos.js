function Infos()
{
	this.addPlayer = function(num, username)
	{
		$('<div class="cadrePlayer cadre"></div>').appendTo('div[class="listPlayers"]')
			.append('<div class="avatar'+num+' avatar"></div>')
			.append('<div class="pseudo">'+username+'</div>')
			.append('<div class="money">$0</div>');
	}	

	


	this.setUserName = function(username)
	{
		$('.infos .name').html(username);
	}

	this.setmoney = function(money)
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

	// Todo : faire toutes les méthodes d'update des infos

}
