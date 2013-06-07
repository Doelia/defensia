function Game()
{
	console.log("Game.construct()")
	this.plateau = new Plateau();
	this.plateau.preparePlateau();
	this.infos = new Infos();

	this.inMove; // Tourelle cliquée

	this.setStateSetUsername = function()
	{
		$('.connexion').hide();
		$('.setUsername').show();
		$('#in_submit').click(function() {
			if ($('#in_username').val != '')
			{
				socket.send("LOGIN:"+$('#in_username').val());
				g.infos.setMyPseudo($('#in_username').val());
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
		$('.salon').fadeOut(1000);
	}

	this.passerAnnonce = function(texte)
	{
		$('#announce')

			.css({
				opacity: '0',
				top: '0px',
				display: 'block'
			})

			.html(texte)

			.animate({
			    opacity: '0.9',
				top: '250px'
			}, 1000 ,'swing')

			.delay(1000)

			.fadeOut(400)
		;
	}

}

function getIdTypeMonstreFromName(name)
{
	switch (name)
	{
		case 'baseMonster':
			return 1;
		case 'slowMonster':
			return 2;
		case 'fastMonster':
			return 3;
		case 'baseBetterMonster':
			return 4;
	}

}

