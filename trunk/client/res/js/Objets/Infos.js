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
				.attr('idPlayer', num)
				.attr('username', username)
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
		
	}

	this.displayVieCenter = function()
	{
		$('.vieCenterBlock').show(200);
	}

	this.setPlayerMoney = function(money, num)
	{
		console.log('setplayermoney');
		$('.cadrePlayer#num'+num+' .money').html('$'+money);

		if (num == this.getMyNumber())
			this.refreshShop();
	}

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

	this.getMyNumber = function()
	{
		return parseInt($(".cadrePlayer[username='"+this.myPseudo+"']").attr('idPlayer'));
	}

	this.setMyPseudo = function(pseudo)
	{
		this.myPseudo = pseudo;
	}
}
