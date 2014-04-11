<?php
/* Si non connecté, on redirige */
if (!is_log()) {
	header("Location: ?page=accueil");
} else {
	$pseudo = unserialize($_SESSION['user'])->getPseudo();
?>

<div id="recus">
<p id="num_pages"></p>
<ul id= "liste_messages">
	
</ul>
</div>

<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
	
	/* Partie traitement page via JS */
	var numPage = 1;
	
	$( document ).ready(function() {
		initConversJS();
	});
			
	
	/* il s'agit de changer la liste des messages en fct de la page selectionnee */
	$( "#num_pages a" ).click(function() {
		var numPageToShow = $( this ).html();
		numPage = numPageToShow;
		/* on met a jour la liste des messages */
	});
	
	
	
	
	/* ------------------------------- Fonctions JS necessaire ------------------------------ */
	
	function initConversJS() {
		$.ajax({
			url : 'src_php/xhrReq/messagesTraitement.php',
			type : 'POST',
			data : 'req=init_messages&numPage=1',
			dataType : 'text',
			success : function(code_json, statut) {
					majListeMessages(1, JSON.parse(code_json));
			},
			
		});
	}
	
	
	function majListeMessages(numPage, json) {
		addNumPages(json.length);
		var i;
		var tmp = "";
		var ul = $( "liste_messages" );
		for (i=numPage-1; i<numPage+9; i++) {
			tmp = "<li class=\"convers\">" + afficheEnTeteConvers(json[i]) +"</li>";
			ul.append(tmp);
		}
	}
	
	function afficheEnTeteConvers(json) {
		var me = "";
		var he = "";
		if (json.user1 == <?=$pseudo?>) {
			me = json.user1;
			he = json.user2;
		} else {
			me = json.user2;
			he = json.user1;
		}
		return '<div class="entete"> From: ' + he + " <br />"+ "Title: " + json.title + "</div>" + 
				'<div class="contenu">' + interpreteContenuMess(json.contenu) +'</div>';
	}
	
	function interpreteContenuMess(json.contenu) {
		//TODO: afficher le message en revenant a la ligne a chaque new mess d'un user
		//chaque nouveau mess est separé du précedent par <sep> et commence par:
		//<sep>pseudo: messagefds,fksdkf,dsk,f<sep>pseudo2:fkdsfjdngjn<sep>etc etc.
	}
	
	function addNumPages(nbConvers) {
		var nbPages = ( nbConvers / 10 )+ 1;
		var i;
		var s = "";
		for (i=1; i<nbPages; i++) {
			s += "<a href=\"#\" class=\"pages\">" + i + "</a>, ";
		}
		s += "<a href=\"#\" class=\"pages\">" + i + "</a>";
		$( "#num_pages" ).html(s);
	}
	
	
</script>


<?php
}
?>