function Infos()
{
	this.vieCenter;

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