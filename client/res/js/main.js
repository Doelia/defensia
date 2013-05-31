console.log("Connexion...");

var g;
var socket;

function boucle_send()
{
	console.log('test');
	socket.send(".");
	setTimeout('boucle_send()', 1000);
}

$(function() {

	g = new Game();

	socket = new WebSocket("ws://localhost:8080/serveur.php"); 
	socket.onopen = function(e)
	{
		console.log("onopen");
		socket.send("LOGIN:Doelia");
		boucle_send();
	}

	socket.onmessage = function(e){
		console.log("Message reçu : "+e.data);
		var packet = e.data.split('!');
		var nameFunction = packet[0];
		var parametres = '';

		if (packet.length == 2)
			parametres = packet[1];
		else if (packet.length == 3)
			parametres = "'"+packet[1]+"'"+', '+"'"+packet[2]+"'";

		eval(nameFunction+'('+parametres+')');
	}

	socket.onclose = function(e){
		console.log("Socket close");

	}

	socket.onerror = function(e){
		console.log("Erreur : "+e);

	} 
  
});
