<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<?php
/* Si non connecté, on redirige */
if (!is_log()) {
	//header("Location: ?page=accueil");
} else {
	$pseudo = unserialize($_SESSION['user'])->getPseudo();
?>

<div id="all_messages" style="display:none;" >
<p id="num_pages"></p>
<ul id= "liste_messages">
	
</ul>
</div>

<script type="text/javascript">

	
	/* Partie traitement page via JS */
	var numPage = 1;
	var json;
	$( document ).ready(function() {
		initConversJS();
	});
			
	
	/* il s'agit de changer la liste des messages en fct de la page selectionnee */
	$( "#num_pages a" ).click(function() {
		var numPageToShow = $( this ).html();
		numPage = numPageToShow;
		/* on met a jour la liste des messages */
		majListeMessages(numPage, json);
	});
	
	
	
	
	/* ------------------------------- Fonctions JS necessaire ------------------------------ */
	
	function initConversJS() {
		$.ajax({
			url : 'src_php/xhrReq/messagesTraitement.php',
			type : 'POST',
			data : 'req=init_messages&numPage=1',
			dataType : 'text',
			success : function(code_json, statut) {
					json = JSON.parse(code_json);
					majListeMessages(1, json);
			},
			
		});
	}
	
	
	function majListeMessages(numPage, json) {
		//addNumPages(json.length);
		var i;
		var tmp = "";
		var ul = $( "#liste_messages" );
		for (i=numPage-1; i<numPage+9; i++) {
			if (json[i] == undefined) continue;
			tmp = "<li class=\"convers\">" + afficheConvers(json[i], i) +"</li>";
			ul.append("<br />");
			ul.append(tmp);
		}
		hideContenu();
		addEventsConvers();
	}
	
	function afficheConvers(json, i) {
		//if (json == undefined) return "none";
		var me = "";
		var he = "";
		if (json.user1 == "<?=$pseudo?>") {
			me = json.user1;
			he = json.user2;
		} else {
			me = json.user2;
			he = json.user1;
		}
		return '<div id_entete="' + i + '" class="entete_mess"> Vous et ' + he + " <br />"+ "Sujet: " + json.titre + "</div>" + 
				'<div id="contenu_' + i + '" class="contenu_mess">' + interpreteContenuMess(json.contenu, me) +'</div>';
	}
	
	function interpreteContenuMess(contenu, me) {
		//TODO: afficher le message en revenant a la ligne a chaque new mess d'un user
		//chaque nouveau mess est separé du précedent par <sep> et commence par:
		//pseudo<sep>messagefds,fksdkf,dsk,f<sep>pseudo2<sep>fkdsfjdngjn<sep>etc etc.
		var tabC = contenu.split("<sep>");
		var tmp = "";
		var pseudo = "";
		for (var i=0; i<tabC.length; i+=2) {
			(tabC[i] == me) ? pseudo="Me" : pseudo=tabC[i];
			tmp += "<p num=\""+i+"\">" + pseudo + ": " + tabC[i+1] + "</p>";
		}
		return tmp;
	}
	
	function addNumPages(nbConvers) {
		var nbPages = ( nbConvers / 10 )+0;
		var i;
		var s = "";
		for (i=1; i<nbPages; i++) {
			s += "<a href=\"#\" class=\"pages\">" + i + "</a>, ";
		}
		s += "<a href=\"#\" class=\"pages\">" + i + "</a>";
		$( "#num_pages" ).html(s);
	}
	
	function hideContenu() {
		var acache = $(".contenu_mess");
		acache.each(function () {
			$( this ).hide();
		});
	}
	
	function addEventsConvers() {
		var listeMess = $( ".entete_mess" );
		listeMess.each(function() {
			var id = $( this ).attr("id_entete");
			$( this ).click(function(){
				derouleConvers(id);
			});
		});
	}
	
	function derouleConvers(id) {
		var contenu = $("#contenu_"+id);
		if (contenu.css("display") == "none") {
			contenu.show("slow", function() {
				//TODO: ??
			});
		} else {
			contenu.hide("slow", function () {
				//TODO: ??
			});
		}
		
	}
	
	
</script>

<?php
}
?>