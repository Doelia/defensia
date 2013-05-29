
/*
	Ne gére pas le graphique
	Sert uniquement pour les calculs, detections d'objet, colisions...
*/
function Cellule(x, y)
{
	this.x = x;
	this.y = y;
	this.objectOn = null; // Objet jquery placé sur la case

	this.onconstruct = function()
	{
		
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
	*/
	this.haveAMonstre = function()
	{
		
	}


	this.onconstruct();
	
}
