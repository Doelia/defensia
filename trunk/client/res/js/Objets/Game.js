function Game()
{
	console.log("Game.construct()")
	this.plateau = new Plateau();
	this.plateau.preparePlateau();
	this.infos = new Infos();

	this.inMove; // Tourelle cliquée

}
