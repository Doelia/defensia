
/*
	Ne gére pas le graphique
	Sert uniquement pour les calculs, detections d'objet, colisions...
*/

function TowerManager()
{
	this.onconstruct = function()
	{
		
	}

	this.getCandence = function(idTower)
	{
		switch(idTower)
		{
			case 1:
				return 
		}

		return 0;
	}

	this.getPorte = function(idTower)
	{
		switch(idTower)
		{
			case 1:
				return 
		}
		
		return 0;
	}

	this.getPrice = function(idTypeTower)
	{
		switch(idTypeTower)
		{
			case 1: return 50; break;
			case 2: return 80; break;
			case 3: return 150; break;
			case 4: return 275; break;
			case 5: return 400; break;
			case 6: return 600; break;
			case 7: return 800; break;
		}
	}



	this.onconstruct();
	
}

var tm = new TowerManager();
