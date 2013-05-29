
/*
	Ne gére pas le graphique
	Sert uniquement pour les calculs, detections d'objet, colisions...
*/
function Cellule(x, y)
{
	this.x = x;
	this.y = y;
	this.objectOn = null; // Objet jquery placé sur la case

	this.isRoute = false; // false par defaut
	this.isSocket = false; // false par défauat

	this.onconstruct = function()
	{
		
	}

	this.setIsRoute = function()
	{
		this.isRoute = true;
	}

	this.setIsSocket = function()
	{
		this.isSocket = true;
	}

	/*
		A appeller lors d'un changement
	*/
	this.setObjectOn = function(objectJquery)
	{
		this.objectOn = objectJquery;
	}

	/*
		Retourne true si l'élement sur la case est un monstre
		Stratégie : Utilisation du nom de la balise
	*/
	this.haveAMonstre = function()
	{
		
	}

	/*
		Retourne true si l'élement sur la case est une tour
		Stratégie : Utilisation du nom de la balise
	*/
	this.haveTower = function()
	{

	}

	this.playAnimation = function()
	{
		// TODO : Jouer une animation sur la case
	}



	this.onconstruct();
	
}
