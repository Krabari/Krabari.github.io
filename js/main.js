'use strict';  


////////////////////////////// DONNEES ///////////////////////////////////////////////////////////////

var myButton;


///////////////////////////// FONCTIONS //////////////////////////////////////////////////////////////

// Affiche le message "Deconnexion..." lorsqu'on appuie sur le bouton "deconnexion"
function afficherMessageDeconnexion(){
	alert("Déconnexion...");
}

// Demande confirmation au moment de s'inscrire avant d'envoyer les données
function confirmerInscription(){
	if(confirm("Etes-vous sûr de vouloir d'envoyer vos données ?")){
		document.formulaire.submit();
	}
	else{
		return false;
	}	
}

// Demande confirmation au moment de publier un message
function confirmerPublier(){
	if(confirm("Etes-vous sûr de vouloir publier ce message ?")){
		document.formulaire.submit();
	}
	else{
		return false;
	}	
}

// Demande confirmation au moment de répondre à un message publié
function confirmerRepondre(){
	if(confirm("Etes-vous sûr de vouloir répondre ?")){
		document.formulaire.submit();
	}
	else{
		return false;
	}	
}

// L'utilisateur ne peut supprimer que ses propres messages.
// Lors de la suppression d'un message dans la messagerie:
// 	- si l'utilisateur n'en est pas l'auteur, alors un message d'erreur s'affiche.
//	- sinon on lui demande de confirmer sa suppression.
function confirmerSupprimerMessage(id_msg, id_user_msg, id_user, nbc){
	if(id_user_msg !== id_user){
		alert("Suppression impossible: vous ne pouvez supprimer que les messages que vous avez publié !");
	}
	else if (confirm("Etes-vous sûr de vouloir supprimer ce message ?")) {
		if(nbc > 0){
			if(confirm("Ce message contient des réponses.\nVoulez-vous vraiment le supprimer ?")){
				document.location.href="php/remove_message.php?idmsg=" + id_msg;
			}
			else{
				return false;
			}
		}
		else{
			document.location.href="php/remove_message.php?idmsg=" + id_msg;				
		}
	}
	else{
		return false;
	}
}

// Même choses que pour les messages, au moment de supprimer une réponse d'un message.
function confirmerSupprimerReponse(id_user, userSessionId){
	if(id_user !== userSessionId){
		alert("Vous ne pouvez supprimer que vos réponses !");
	}
	else if(confirm("Etes-vous sûr de vouloir supprimer ce message réponse ?")){
		// suppression de la réponse
	}
	else{
		return false;
	}
}


////////////////////////// CODE PRINCIPAL //////////////////////////////////////////////////////////

// Récupère la balise HTML portant l'id "deconnecting" 
myButton = document.getElementById("deconnecting");

// Lorsqu'on clique sur le bouton "Deconnexion": 
myButton.addEventListener("click", afficherMessageDeconnexion); 