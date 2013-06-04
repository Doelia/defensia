
function loadMap() {

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
		
	return Map;
}


function drawTerrain() {

	var Map = loadMap();
	
	$.each(Map.map.routes, function(id, obj) { 
	
		$('routes').append('<route></route>');
		$('routes route:last-child')
				.css("top", obj.y * 33)
				.css("left", obj.x * 33)
				.attr("type", obj.texture);
	});
	
	
	$.each(Map.map.sockets, function(id, obj) { 
	
		$('sockets').append('<socket></socket>');
		$('sockets socket:last-child')
				.css("top", obj.y * 33)
				.css("left", obj.x * 33)
				.attr("type", obj.direction);
	});
	
	$('.map').append('<centre></centre>');
	$('centre:last-child').css("top", Map.map.centre.y * 33)
				.css("left", Map.map.centre.x * 33);

}


function getAngle(x1, y1, x2, y2)
{
	return ((Math.atan2(y2-y1, x2-x1) * 180.0/Math.PI)) + 90.0;
}



