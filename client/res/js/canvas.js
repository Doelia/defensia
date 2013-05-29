function createGrille() {

	var i;
	for(i = 0; i < 20; i++)
		$('table').append("<tr></tr>");
		
	for(i = 0; i < 20; i++)
		$('tr').append("<td></td>");
} 


function loadXml() {

	
}


function drawTerrain() {
	
	for(var i = 0; i < 20; i++)
	{
		for(var j = 0; j < 20; j++)
		{
			$('bg').append('<img></img>');
			$('bg img:last-child')
				.css("top", i*33)
				.css("left", j*33)
				.attr("src", "res/img/textures/gauche-droite.jpg");
		}
	}
}
