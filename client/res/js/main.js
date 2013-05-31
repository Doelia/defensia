console.log("Connexion...");

var g;
var socket;

$(function() {

	g = new Game();

	socket = new WebSocket("ws://localhost:8080/serveur.php"); 
	socket.onopen = function(e)
	{
		console.log("onopen");
		socket.send("LOGIN:Doelia");
	}


	socket.onmessage = function(e){
		console.log("Message reçu : "+e.data);
		var packet = e.data.split('!');
		eval(packet[0]+'('+packet[1]+')');
	}

	socket.onclose = function(e){
		console.log("Socket close");

	}

	socket.onerror = function(e){
		console.log("Erreur : "+e);

	} 
  
});
