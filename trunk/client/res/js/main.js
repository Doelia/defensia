		console.log("Connexion...");

		var socket = new WebSocket("ws://localhost:8080/serveur.php"); 
		socket.onopen = function(e)
		{
			console.log("onopen");
			socket.send("LOGIN:Doelia");
		}
		/*on "écoute" pour savoir si la connexion vers le serveur websocket s'est bien faite */ 
		socket.onmessage = function(e){
			console.log("Message reçu : "+e);

		} /*on récupère les messages provenant du serveur websocket */ 
		socket.onclose = function(e){
			console.log("Socket close");

		} /*on est informé lors de la fermeture de la connexion vers le serveur*/ 
		socket.onerror = function(e){
			console.log("Erreur : "+e);

		} /*on traite les cas d'erreur*/ 
