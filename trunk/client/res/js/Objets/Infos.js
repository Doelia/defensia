function Infos()
{
	this.myPseudo;

	this.addPlayer = function(num, username)
	{
		if(!$('.cadrePlayer#num'+num).length)
		{
			$('<div class="cadrePlayer cadre"></div>')
				.appendTo('div[class="listPlayers"]')
				.attr('id', 'num'+num)
				.append('<div class="avatar'+num+' avatar"></div>')
				.append('<div class="pseudo">'+username+'</div>')
				.append('<div class="money">$0</div>');
		}
	}	

	this.setUserName = function(username)
	{
		$('.infos .name').html(username);
	}

	this.setVieCenter = function(vie)
	{
		this.vieCenter = vie;
	}

	this.displayVieCenter = function()
	{
		$('.vieCenterBlock').show(200);
	}

	this.setPlayerMoney = function(money, num)
	{
		console.log('setplayermoney');
		$('.cadrePlayer#num'+num+' .money').html('$'+money);

		this.refreshShop(num);
	}

	this.refreshShop = function(num)
	{
		money = $('.cadrePlayer#num'+num+' .money').html();
		money = money.substr(1, money.length);
		$('.tour').each(function(id,obj){
			if(money >= tm.getPrice(obj.attr('idType')))
				obj.addClass('dispo');			
			else
				obj.removeClass('dispo');
		});
	}

	this.setMyPseudo = function(pseudo)
	{
		this.myPseudo = pseudo;
	}
}
