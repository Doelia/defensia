console.log("Connexion...");

var g;
var socket;

function boucle_send()
{
	socket.send(".");
	setTimeout('boucle_send()', 400);
}

$(function() {

	g = new Game();

	socket = new WebSocket("ws://10.20.118.7:8080/serveur.php"); 
	socket.onopen = function(e)
	{
		console.log("onopen");
		g.setStateSetUsername();
	}

	socket.onmessage = function(e){
		//console.log("Message reçu : "+e.data);
		var packet = e.data.split('!');
		var nameFunction = packet[0];
		var parametres = '';

		var i = 0;

		if (packet.length == 2)
			parametres = packet[1];
		else
		{
			if (packet.length > 1)
				parametres = "'";
			else
				parametres = "";

			for ( var int = 1; int < packet.length; int++) {
				if(int + 1 == packet.length)
				{
					parametres = parametres+packet[int]+"'";
				}
				else
				{
					parametres = parametres+packet[int]+"', '";
				}
			}

			//console.log('a executer : ' + nameFunction+'('+parametres+')');
		}

//		if (packet.length == 2)
//		parametres = packet[1];

//		else if (packet.length == 3)
//		{
//		parametres = "'"+packet[1]+"'"+', '+"'"+packet[2]+"'";
//		console.log(parametres);
//		}

		eval(nameFunction+'('+parametres+')');
	}

	socket.onclose = function(e){
		console.log("Socket close");

	}

	socket.onerror = function(e){
		console.log("Erreur : "+e);

	} 

});
