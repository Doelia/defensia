var g;

$(function() {
  
	console.log("doelia.test");

	g = new Game();

	var Map = { "map": {
		    "sockets": [
		    		{ "x": 2, "y": 2, "direction": 1 },
		    		{ "x": 2, "y": 4, "direction": 1 }
		    	],
		    	
		   "routes": [
		    		{ "x": 1, "y": 1, "texture": "bd" },
		            { "x": 2, "y": 1, "texture": "gd" },
		            { "x": 3, "y": 1, "texture": "gb" },
		            { "x": 1, "y": 2, "texture": "bh" },
		            { "x": 3, "y": 2, "texture": "bh" },
		            { "x": 1, "y": 3, "texture": "hd" },
		            { "x": 2, "y": 3, "texture": "gd" },
		            { "x": 3, "y": 3, "texture": "gh" }
		    	],
		    	

		   "centre": { "x": 5, "y": 5, "life": 200 }
		    }
		}
		
	g.plateau.preparePlateau(Map);
  
});

function animate()
{
	for (var i=1; i<=7; i++)
	{
		$('animation')
			.queue(
				( function(i) {
					return function() {

						$('animation c')
							.append('<step></step>')
						;

						/*
						$('animation c')
							.animate({
								'left': i*3
							}, 50)
						;
						*/

						$('animation c :last-child')
							.hide()
							.attr('class', 's'+i)
							.fadeIn(100)
						;

						$('animation c step')
							.fadeOut(100);

						$('animation')
							.dequeue();
					};
				} ) (i)
			)
			.delay(100)
	    
	}

	$('animation')
		.delay(100)
		.queue(
			function() {
				$('animation c step').remove();
			}
		)

	$('animation')
		.dequeue();
}






