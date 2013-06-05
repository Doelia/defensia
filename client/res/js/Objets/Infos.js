function Infos()
{
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
	}


}
