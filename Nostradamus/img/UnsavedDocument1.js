//permet de creer un objet XMLHttpRequest (ou ActiveXObject si Windows)
function getXhr(){
	var xhr = null;
	if (window.XMLHttpRequest) // Firefox et autres
      	xhr = new XMLHttpRequest();
	else if(window.ActiveXObject){ // Internet Explorer< 7
  		try {
		xhr = new ActiveXObject("Msxml2.XMLHTTP");
  		} catch (e) {
		xhr = new ActiveXObject("Microsoft.XMLHTTP") ;
  		}
	}
	else{
	    alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
      	xhr = false;
	}
	return xhr;
}

function showHelpDialog(){
	$("#dialog-help").dialog('open');
}

// demande confirmation avant de rediriger l'utilisateur vers l'url donnee
function confirmNRedirect(url){
	document.getElementById("confirmNRedirectURL").setAttribute("href", url);
	$('#confirmNRedirectDialog').dialog( 'open' );
}

function closeCNRD(){
	$('#confirmNRedirectDialog').dialog('close');
}

// change la page d'accueil de l'utilisateur vers la page actuelle
function definePageAccueil(profil){
	if(document.location.href.indexOf(".jsp") == -1){
		alert("Action impossible pour cette page !");
	}
	else{
		var xhr;
		xhr = getXhr();
		xhr.onreadystatechange = function(){
	    if(xhr.readyState == 4 && xhr.status == 200){
				alert("Le changement de page d'accueil sera pris en compte à votre prochaine connexion.");
		  	}
	   	};
		xhr.open("POST", urlServer+"home/ModifAccueil?url="+document.location.href, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=utf-8');
		xhr.send();
	}
}

/*
 * GESTION DES FILTRES DANS LES LISTING DE RELS
 */
function filtrerSousTypeOn(filtre){
	var filtres = $('.'+filtre);
	for(var i = 0; i < filtres.length; i++){
		if(!$('#'+filtres[i].id).is(':checked')){
			$('.'+filtres[i].id).show();
		}
	}
	filtres.attr('checked', true);
}
function filtrerSousTypeOff(filtre){
	var filtres = $('.'+filtre);
	for(var i = 0; i < filtres.length; i++){
		if($('#'+filtres[i].id).is(':checked')){
			$('.'+filtres[i].id).hide();
		}
	}
	filtres.attr('checked', false);
}
function filtrerSousType(filtre){
	if($('#'+filtre).is(':checked')){
		$('.'+filtre).show();
	}
	else{
		$('.'+filtre).hide();
	}
};
/*
 * FIN GESTION DES FILTRES DANS LES LISTING DE RELS
 */

// publie ou depublie une rel affichee dans une liste
function changerEtatPublication(id, etatActuel, categorie) {
	var xhr;
	var pere;
	var etatNouveau;

	if(etatActuel == 'PUBLIEE') {
		etatNouveau = 'BROUILLON';
	}
	else {
		etatNouveau = 'PUBLIEE';
	}
	xhr = getXhr();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			reponse = xhr.responseText;
			if(reponse == 'OK'){
				pere = document.getElementById(categorie);
				if(etatNouveau == 'PUBLIEE'){
					pere.innerHTML = '<a href="javascript:changerEtatPublication('+id+',\''+etatNouveau+'\',\''+categorie+'\')">' +
											'<img src="../images/icons/autorise-icon.png" border="0" alt="publier" title="ressource publi&#233;e"/>' +
									  '</a>';
				}
				else{
					pere.innerHTML = '<a href="javascript:changerEtatPublication('+id+',\''+etatNouveau+'\',\''+categorie+'\')">' +
											'<img src="../images/icons/interdit-icon.png" border="0" alt="publier" title="ressource non publi&#233;e"/>' +
									  '</a>';
				}
			}
			else{
				alert("Erreur : "+reponse);
			}
		}
   	};
	xhr.open("POST","../home/ModifPublication", true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=utf-8');
 	xhr.send("id="+id+"&etat="+etatNouveau);
}

//affiche la boite de dialogue "ressources parentes"
function showRelsParentes(){
	$( '#RELS_PARENTES' ).dialog( 'open' );
}

$(document).ready(function(){	
	
	$(document).ajaxComplete(function() {
	$(".table-arel").tablesorter();
	});
	$(".table-arel").tablesorter();
	$(".select_chosen").chosen({no_results_text: "Aucun élément correspondant à ",width: "95%"});

	jQuery.fn.fadeToggle = function(speed, easing, callback) {
   		return this.animate({opacity: 'toggle'}, speed, easing, callback);
	};

	$(".navmenu").each(function(i, item){
		$("li", this).each(function(j, item2){
				$(item2).mouseover(function(){
					$(this).attr('class', $(this).attr('class') + " iehover");
				});
				
				$(item2).mouseout(function(){
					$(this).attr('class', $(this).attr('class').replace(new RegExp(" iehover\\b"), ""));
				});
		});
	});
	


	$('.block_menu_left').find('div:first').find('.head_block_center').find('.button_toggle_block').html('<img src="../images/icons/bullet_toggle_minus.png" class="icons toggle_block clickable" alt="" />');
	
	$('.toggle_block').click(function(){
		var block_name = $(this).parent('.button_toggle_block').parent('.head_block_center').parent('.head_block').parent('.block_menu_left').attr('id');
        var date = new Date();
        
        date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
                    
		if( $(this).attr('src') == '../images/icons/bullet_toggle_minus.png' ){
			$.cookie(block_name, 'true', { path: '/', expires: date });
			
			$(this).attr('src', '../images/icons/bullet_toggle_plus.png');
			
			$('#' + block_name).find('.block_content').fadeToggle();
		} else {
			$.cookie(block_name, null, { path: '/', expires: date });
			
			$(this).attr('src', '../images/icons/bullet_toggle_minus.png');
			
			$('#' + block_name).find('.block_content').fadeToggle();
		}
	});
	
	$('.toggle_block').each(function(){
		var block_name = $(this).parent('.button_toggle_block').parent('.head_block_center').parent('.head_block').parent('.block_menu_left').attr('id');
        
		if( $.cookie(block_name) == null && block_name != 'block1'){
			$(this).attr('src', '../images/icons/bullet_toggle_minus.png');
		} else {
			$(this).attr('src', '../images/icons/bullet_toggle_plus.png');
			
			$('#' + block_name).find('.block_content').hide();
		}    
	});

	$("#close_left_menu").click(function()
	{     
		if($(this).attr("src") == '../images/icons/arrow_in.png'  )
		{
			$(this).attr("src", '../images/icons/arrow_out.png');
			document.getElementById('page').style.margin = 0;
			document.getElementById('page').style.left = '10px';
		} 
		else 
		{
			$(this).attr("src", '../images/icons/arrow_in.png');
			document.getElementById('page').style.left = '250px';
		}
		
		$(".zone_left").toggle();
		$("#menu_top").toggle();
		$("#menu_top_url").toggle();
		//$("#bar_top").toggle();
		$("#top_bg").toggle();
		$("#left_bg").toggle();	
		$("#TITRE_PAGE").toggle();	
	});

	
	
	
	
	/*
	Fin affichage des tables � tri dynamique
	*/

	

	/*
	Debut datepicker langage
	*/
	$.datepicker.regional['fr'] = {
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
		'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
		'Jul','Aoû','Sep','Oct','Nov','Déc'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
		dateFormat: 'dd/mm/yy', firstDay: 1,
		renderer: $.datepicker.defaultRenderer,
		prevText: '&#x3c;Préc', prevStatus: 'Voir le mois précédent',
		prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: 'Voir l\'année précédent',
		nextText: 'Suiv&#x3e;', nextStatus: 'Voir le mois suivant',
		nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: 'Voir l\'année suivant',
		currentText: 'Courant', currentStatus: 'Voir le mois courant',
		todayText: 'Aujourd\'hui', todayStatus: 'Voir aujourd\'hui',
		clearText: 'Effacer', clearStatus: 'Effacer la date sélectionnée',
		closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
		yearStatus: 'Voir une autre année', monthStatus: 'Voir un autre mois',
		weekText: 'Sm', weekStatus: 'Semaine de l\'année',
		dayStatus: '\'Choisir\' le DD d MM', defaultStatus: 'Choisir la date',
		isRTL: false
	};
	$.datepicker.setDefaults($.datepicker.regional['fr']);
	/*
	Fin datepicker langage
	*/
	
	
	/*
	D�but affichage syst�me d'onglets
	*/
	$(".tabs").tabs();
	/*
	Fin affichage syst�me d'onglets
	*/
	
	
	
	
	
	/*
	D�but affichage accord�on
	*/
	$(".accordion").accordion();
	
	$(".accordion2").accordion({ active: false });
	
	/*
	Fin affichage accord�on
	*/
	
	
	
	
	/*
	D�but affichage boutons
	*/
	$("input:submit, button, input:reset, .button").button();
	/*
	Fin affichage boutons
	*/
	
	
	
	
	
	/*
	D�but affichage radioset
	*/
	$(".radioset").buttonset();
	/*
	Fin affichage radioset
	*/
	
	
	
	
	
	/*
	D�but affichage dialog
	*/
	$('.dialog').each(function(item, i){
		$($(this).attr("href")).dialog({
			autoOpen: false,
			width: 600,
			buttons: {
				"Ok": function() { 
					$(this).dialog("close"); 
				}, 
				"Cancel": function() { 
					$(this).dialog("close"); 
				} 
			}
		});
		
		$(this).click(function(){
			$($(this).attr("href")).dialog('open');
			return false;
		});
	});
	/*
	Fin affichage dialog
	*/
	
	/*
	D�but affichage multiselect et select
	*/
	$.fn.multiSelect.defaults.minWidth = 225;
	
	$("select.multiselect").multiSelect();
	
	$('select.eSelect').selectmenu({width: 225, menuWidth : 225});
	/*
	Fin affichage multiselect et select
	*/
	
	
	/*
	 * D�but Transfert select box
	 */
	
	$('#add').click(function() {  
		return !$('#select1 option:selected').remove().appendTo('#select2');  
	});  
	
	$('#remove').click(function() {  
		return !$('#select2 option:selected').remove().appendTo('#select1');  
	});  
	
	/*
	 * Fin Transfert select box
	 */

	// gestion des erreurs et messages
	$("#dialog-erreur").dialog({
		modal: true,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		}
	});
	
	// dialogue d'aide
	$( "#dialog-help" ).dialog({
		autoOpen: false,
		modal: true
	});
	
	// gestion de l'accordion permettant l'ouverture plusieurs div en meme temps 
	// (contrairement a l'accordion classique de jquery)
	$(".multiAccordion").addClass("ui-accordion ui-widget ui-helper-reset ui-accordion-icons").find("h3")
	.addClass("ui-accordion-header ui-helper-reset ui-corner-all ui-state-default")
	.prepend('<span class="ui-icon ui-icon-triangle-1-e"/>')
	.click(function() {
		$(this).toggleClass("ui-accordion-header-active").toggleClass("ui-state-active")
		.toggleClass("ui-state-default").toggleClass("ui-corner-bottom")
		.find("> .ui-icon").toggleClass("ui-icon-triangle-1-e").toggleClass("ui-icon-triangle-1-s")
		.end().next().toggle("slow").toggleClass("ui-accordion-content-active");
		return false;
	})
	.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();
	$(".multiAccordion h3").click();
	
	/*
	 * DEBUT DIV RELS_PARENTES
	 */
	$( "#RELS_PARENTES" ).dialog({
		autoOpen: false,
		height: 480,
		width: 640,
		modal: true,
		close: function() {
		}
	});
	/*
	 * FIN DIV RELS_PARENTES
	 */
	
	/*
	 * DEBUT DIV confirmer redirection
	 */
	$( "#confirmNRedirectDialog" ).dialog({
		autoOpen: false,
		modal: true,
		close: function() {
		}
	});
	/*
	 * FIN DIV confirmer redirection
	 */
	
	/*
	 * DEBUT arborescences (blog.jaysalvat.com)
	 */
	$('#tree').tree();
	/*
	 * FIN arborescences
	 */
});

/*
 * DEBUT arborescences (blog.jaysalvat.com)
 */
(function($) {
    $.fn.tree = function() {
        return this.each(function(){
            var $$ = $(this).addClass('tree');

            // Applique la classe 'file' aux "li" qui n'ont pas d'enfants
            $('li:not(:has(ul))', $$).addClass('file');

            // Applique la classe 'folder' aux "li" qui ont des enfants
            $('li:has(ul)', $$).addClass('folder');

            // Masque tous les "ul" sous les dossiers
            $('.folder ul', $$).hide();

            // Affiche/masque le "ul" sous le folder lorsqu'il est cliqué
            // et y ajoute/supprime la classe "open" puis stoppe la propagation
            // pour que les dossiers supérieurs ne "reçoivent pas" le clic
            $('.folder', $$).click(function(e) {
                $('ul:first', this).slideToggle();
                $(this).toggleClass('open');
                e.stopPropagation();
                return false;
            });

            // Stoppe la propagation du clic sur les fichiers
            // pour que les dossiers supérieurs ne "reçoivent pas" le clic
            // et se ferment
            
            

