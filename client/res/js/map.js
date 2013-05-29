
function loadMap() {

	var Map = { "map": {
		    "placement": [
		    		{ "x": 1, "y": 2 },
		            { "x": 2, "y": 3 }
		    	],
		    	
		   "chemin": [
		    		{ "x": 1, "y": 1, "texture": "bd" },
		            { "x": 2, "y": 1, "texture": "gd" },
		            { "x": 3, "y": 1, "texture": "gb" },
		            { "x": 1, "y": 2, "texture": "bh" },
		            { "x": 3, "y": 2, "texture": "bh" },
		            { "x": 1, "y": 3, "texture": "hd" },
		            { "x": 2, "y": 3, "texture": "gd" },
		            { "x": 3, "y": 3, "texture": "gh" }
		    	],
		    	

		   "centre": [
		    		{ "x": 1, "y": 2, "life": 200 }
		    	]
		    }
		}
		
	return Map;
}


function drawTerrain() {

	var Map = loadMap();
	
	$.each(Map.map.chemin, function(id, obj) { 
	
		$('bg').append('<texture></texture>');
		$('bg texture:last-child')
				.css("top", obj.y * 33)
				.css("left", obj.x * 33)
				.attr("type", obj.texture);
	});
}
