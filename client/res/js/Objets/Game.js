function Game()
{
	console.log("Game.construct()")
	
	this.plateau = new Plateau();
	this.plateau.preparePlateau();

}