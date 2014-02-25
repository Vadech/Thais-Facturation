var dataHotel = null;
var clickedIdFacture = null;
var clickedMois = null;

$(document).ready(
		function() {
			$(".progressbar").progressbar({
				value : 0
			});
			updateAll();
});


function updateAll() {
	updateProgress();
	$("#tabHotel").hide();
	$("#tabHotel").load( "../html/tableFactures.html", { limit: 25 }, function() {
		$.ajax({
			type : "POST",
			dataType : "json",
			url : '../php/getHotelsData.php',
			success : function(data) {
				dataHotel = data;
				var res = Mustache.render($("#tabHotel").html(), data);
				$("#tabHotel").html(res);
				$("#tabHotel").show();
				$("img").tooltip();
				$("th p").tooltip();
				
				$(".pdfFact").click(function(){
					loadExternalPage($(this).attr("data-url"), "PDF");
				});
				
				$(".creerFact").click(function(){
					clickedMois = $(this).attr("data-date");
					clickedIdHotel = $(this).attr("data-idHotel");
					clickedIdFacture = $(this).attr("data-idFacture");
					clickedMontantFact = $(this).attr("data-montantFact");
					loadInDialog("creationFacture.html", "Facture", 800);
				});
				
				$(".euroLogo").click(function(){
					var clickedFacture = $(this).attr("data-idFacture");
					$.ajax({
						  url: "../php/tooglePayeeFacture.php",
						  type: "GET",
						  data: { 
							  	idFacture : clickedFacture
						  },
						  dataType: "html"
						});
					
					
					if($("img.euroLogo[data-idfacture="+clickedFacture+"]").attr('src') == "../images/euroP.png")
					{
						$("img.euroLogo[data-idfacture="+clickedFacture+"]").attr('src', '../images/euroNP.png');
					}
					else
					{
						$("img.euroLogo[data-idfacture="+clickedFacture+"]").attr('src', '../images/euroP.png');
					}
				});
				
				$(".emailFact").click(function(){
					if(confirm("Etes vous sûr de vouloir envoyer cette facture?"))
					{
						var clickedFacture = $(this).attr("data-idFacture");
						$.ajax({
							  url: "../php/envoyerFacture.php",
							  type: "GET",
							  data: { 
								  	idFacture : clickedFacture
							  },
							  dataType: "html"
							});
					}
				});
				
				$(".creerFact.hidden").parent().hover(
					function() {
						$( this ).children(".creerFact").removeClass( "hidden" );
					}, function() {
						$( this ).children(".creerFact").addClass( "hidden" );
					}
				);
				
				endProgress();
			}
		});
	});
}

function updateFactPopupMustache()
{
	var data = new Array();
	data["dateDeb"] = clickedMois+"/2014";
	data["numeroFact"] = "2014"+clickedMois+pad(clickedIdHotel, 2);
	data["montantFact"] = clickedMontantFact;
	var res = Mustache.render($("#creationFacture").html(), data);
	$("#creationFacture").html(res);
	
	updateFactOption();
	
	$("#validFact").click(function(){
		
		var selectedOpt = new Array();
		var offertOpt = new Array();
		$.each($("input[name='options[]']:checked"), function() {
			selectedOpt.push($(this).val());
		});
		
		$.each($("input[name='offert[]']:checked"), function() {
			offertOpt.push($(this).val());
		});
		
		var request = $.ajax({
		  url: "../php/ajoutFacture.php",
		  type: "GET",
		  data: { 
			  	idHotel : clickedIdHotel,
			  	dateDeb : data["dateDeb"],
			  	num : $("#numeroFacture").val(),
			  	montant : $("#montantFacture").val(), 
			  	libelReduc : $("#libelleReduc").val(),
			  	montantReduc : $("#montantReduc").val(),
			  	nbMois : $("#nbMois").val(),
			  	selectedOptions : selectedOpt,
			  	optionOfferts : offertOpt
		  },
		  dataType: "html"
		});
		 
		request.done(function( msg ) {
			closeAllDialog();
			updateAll();
		});
		 
		request.fail(function( jqXHR, textStatus ) {
		  alert( "Request failed: " + textStatus );
		});
	});
}

function updateFactOption() {
	$.ajax({
		type : "GET",
		dataType : "json",
		url : '../php/getOptions.php',
		data: { 
		  	idFacture : clickedIdFacture,
		},
		success : function(data) {
			var res = Mustache.render($("#divOptions").html(), data);
			$("#divOptions").html(res);
		}
	});
	
}
