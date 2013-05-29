$(function() {
  
	console.log("doelia.test");

	new Game();
  
});

function Cellule(x, y)
{
	this.x = x;
	this.y = y;
	this.objectOn = null; // Objet placé sur la case

	this.onconstruct = function()
	{

	}

	this.setObjetOn = function(object)
	{
		this.objectOn = object;
	}

	this.onconstruct();
	
}

function 

function Plateau()
{
	this.cellules = new array();
	console.log("Plateau.construct()");

	this.preparePlateau = function(xml)
	{
		for (var i = 0; i < 33; i++)
		{
			this.celulles.push(new array());
			for (var j=0; j < 33; j++)
			{
				this.celulles[i].push(new array());
				this.ceulles[i][j] = new Celulle(x, y);
			}
		}

		this.drawBackground(xml);
	}

	/*
	* Dessine le terrain en background en partir du XML
	*/
	this.drawBackground = function(xml)
	{
		console.log("plateau.drownBackground");
	}

}

function Game()
{
	console.log("Game.construct()")
	this.plateau = new Plateau();
}