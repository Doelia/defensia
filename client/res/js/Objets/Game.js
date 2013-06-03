function Game()
{
	console.log("Game.construct()")
	this.plateau = new Plateau();
	this.plateau.preparePlateau();
	this.infos = new Infos();

	this.inMove; // Tourelle cliquée

	this.nextStep = function()
	{
		for (var i = 0; i < 20; i++)
			for (var j=0; j < 20; j++)
			{
				this.plateau.cellules[i][j].playStep();
			}
	}

}
