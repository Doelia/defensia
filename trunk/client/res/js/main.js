console.log("Connexion...");

var g;

$(function() {

	g = new Game();

	var socket = new WebSocket("ws://localhost:8080/serveur.php"); 
	socket.onopen = function(e)
	{
		console.log("onopen");
		socket.send("LOGIN:Doelia");
	}


	socket.onmessage = function(e){
		var packet = e.split('!');
		console.log("Message reçu : "+e.data);
		eval(packet[0]+'('+packet[1]+')');
	}

	socket.onclose = function(e){
		console.log("Socket close");

	}

	socket.onerror = function(e){
		console.log("Erreur : "+e);

	} 
  
});
