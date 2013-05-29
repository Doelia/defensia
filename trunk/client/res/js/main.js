console.log("Connexion...");

var socket = new WebSocket("ws://localhost:8080/serveur.php"); 
socket.onopen = function(e)
{
	console.log("onopen");
	socket.send("LOGIN:Doelia");
}


socket.onmessage = function(e){
	console.log("Message reçu : "+e.data);

}

socket.onclose = function(e){
	console.log("Socket close");

}

socket.onerror = function(e){
	console.log("Erreur : "+e);

} 



$(function() {

  drawTerrain();
  
});
