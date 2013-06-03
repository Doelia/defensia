
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

	this.stepWithoutFire = 0;

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
		if (this.objectOn == null)
			return false;

		return (this.objectOn.tagName == 'monstre')
	}

	/*
		Retourne true si l'élement sur la case est une tour
		Stratégie : Utilisation du nom de la balise
	*/
	this.haveTower = function()
	{
		if (this.objectOn == null)
			return false;

		return (this.objectOn.tagName == 'tour')
	}


	/*play
		A jouer à un changement de step
	*/
	this.playStep = function()
	{
		this.stepWithoutFire++;

		if (this.haveTower())
		{
			var idTower = this.objectOn.attr('idType');
			var candence = tm.getCandence(idTower);
			if (stepWithoutFire >= candence)
			{
				this.fire();
				stepWithoutFire = 0;
			}
		}
	}

	/*
		Fait tirer la tourelle
		Prérequis : C'est une tourelle
	*/
	this.fire = function()
	{
		this.objectOn;
	}

	this.onconstruct();
	
}
