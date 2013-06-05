function Game()
{
	console.log("Game.construct()")
	this.plateau = new Plateau();
	this.plateau.preparePlateau();
	this.infos = new Infos();

	this.inMove; // Tourelle cliquée

	/*
	this.nextStep = function()
	{
		for (var i = 0; i < 20; i++)
			for (var j=0; j < 20; j++)
			{
				this.plateau.cellules[i][j].playStep();
			}
	}
	*/

	this.setStateSetUsername = function()
	{
		$('.connexion').hide();
		$('.setUsername').show();
		$('#in_submit').click(function() {
			if ($('#in_username').val != '')
			{
				socket.send("LOGIN:"+$('#in_username').val());
				//g.infos.setMyPseudo($('#in_username').val());
				g.setStateInWait();
			}
		});
	}

	this.setStateInWait = function()
	{
		$('.setUsername').hide();
		$('.inWait').show();
		boucle_send();
	}

	this.setStateGame = function()
	{
		$('.salon').hide(400);
	}

}

function getIdTypeMonstreFromName(name)
{
	switch (name)
	{
		case 'fastMonster':
			return 1;
	}

}