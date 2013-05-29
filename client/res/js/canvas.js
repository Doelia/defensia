function createGrille() {

	var i;
	for(i = 0; i < 20; i++)
		$('table').append("<tr></tr>");
		
	for(i = 0; i < 20; i++)
		$('tr').append("<td></td>");
} 


function drawTerrain() {

	var i, j;
	
	for(i = 0; i < 20; i++)
	{
		for(j = 0; j < 20; j++)
		{
			$('canvas').drawImage( {
				source: "res/img/textures/gauche-droite.jpg",
				x: j * 33, y: i * 33
			});	
		}
	}
}
