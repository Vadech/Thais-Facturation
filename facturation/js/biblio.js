var progressProccess;

function closeAllDialog()
{
	$(".ui-dialog-content").dialog("close");
}

function pad(numNumber, numLength)
{
	var strString = '' + numNumber;
	while (strString.length < numLength)
	{
		strString = '0' + strString;
	}
	return strString;
}

function loadInDialog(url, name, myWidth)
{
	window["url_" + name] = url;
	if ($("#" + name).length == 0)
	{
		$(document.body).append(
				'<div id="' + name + '" title="' + name + '"></div>');
		$("#" + name).dialog({
			minWidth : myWidth,
			minHeight : 200,
			maxHeight : window.innerHeight - 25,
			title : name.replace("_", " "),
			position : [ 'center', 25 ],
			closeOnEscape : true,
			show : 'scale',
			stack : true,
			resizable: false,
			autoResize:true
		});
	}
	updateProgress();
	$("#" + name).load(url, {
		limit : 25
	}, function()
	{
		$("#" + name).dialog("open");
		$("#" + name).dialog("moveToTop");
		endProgress();
		lastPopup = name;
		updateFactPopupMustache();
	});
}

function reload(name)
{
	$("#" + name).load(window["url_" + name], {
		limit : 25
	}, function()
	{
		endProgress();
	});
}

function endProgress()
{
	clearTimeout(progressProccess);
	$(".progressbar").progressbar("option", "value", 0);
	$(".progressbar").hide();
}

function updateProgress()
{
	$(".progressbar").show();
	progress = $(".progressbar").first().progressbar("option", "value");
	if (progress < 100)
	{
		$(".progressbar").progressbar("option", "value", progress + 3);
		progressProccess = setTimeout(updateProgress, 100);
	} else
	{
		endProgress();
	}
}

function showMessage(myMessage)
{
	$.blockUI({
		message : myMessage,
		fadeIn : 700,
		fadeOut : 700,
		timeout : 4000,
		showOverlay : false,
		centerY : false,
		css : {
			width : '350px',
			top : '10px',
			left : '',
			right : '10px',
			border : 'none',
			padding : '5px',
			backgroundColor : '#000',
			'-webkit-border-radius' : '10px',
			'-moz-border-radius' : '10px',
			opacity : .6,
			color : '#fff'
		}
	});
}

var isMobile = {
	Android : function()
	{
		return navigator.userAgent.match(/Android/i) ? true : false;
	},
	BlackBerry : function()
	{
		return navigator.userAgent.match(/BlackBerry/i) ? true : false;
	},
	iOS : function()
	{
		return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;
	},
	Windows : function()
	{
		return navigator.userAgent.match(/IEMobile/i) ? true : false;
	},
	any : function()
	{
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile
				.Windows());
	}
};

function loadExternalPage(myHref, myTitle)
{
	var html = '<iframe id="iframe" style="border: 0px; " src="' + myHref + '" width="100%" height="100%"></iframe>';
	
	var $dialog = $('#external')
	               .html(html)
	               .dialog({
	            	   	minWidth : 1000,
		       			minHeight : 200,
		       			maxHeight : window.innerHeight - 25,
		       			title : myTitle.replace("_", " "),
		       			position : [ 'center', 25 ],
		       			closeOnEscape : true,
		       			show : 'scale',
		       			stack : true,
		       			resizable: false
	               });
	$dialog.dialog('open');
	$('#iframe').attr("src", $('#iframe').attr("src"));
}

function loadPDFinDialog(myHref, myTitle)
{
	var horizontalPadding = 30;
	var verticalPadding = 30;
	var container = '<object data="'
			+ myHref
			+ '" type="text/html" codetype="application/pdf" ><iframe src="https://docs.google.com/viewer?url='
			+ window.location.hostname + "/thaishotel/templates/" + myHref
			+ '&embedded=true"></iframe></object>';
	if (isMobile.any())
	{
		container = '<iframe src="https://docs.google.com/viewer?url='
				+ window.location.hostname + "/thaishotel/templates/" + myHref
				+ '&embedded=true"></iframe>';
	}

	$(container).dialog({
		title : myTitle.replace("_", " "),
		autoOpen : true,
		width : 1024,
		height : 650,
		modal : false,
		resizable : true,
		autoResize : true,
		position : [ 'center', 25 ],
		overlay : {
			opacity : 0.5,
			background : "black"
		}
	}).width(1024 - horizontalPadding).height(650 - verticalPadding);
}

function printElem(elem, nomFenetre)
{
	popup($(elem).html(), nomFenetre);
}

function popup(data, nomFenetre)
{
	var mywindow = window.open('', nomFenetre, 'height=400,width=600');
	mywindow.document
			.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">');
	mywindow.document.write('<head>');
	mywindow.document
			.write('<meta http-equiv="content-type" content="text/html; charset=utf-8" />');
	mywindow.document.write('<title>Thais-Hotel</title>');

	mywindow.document
			.write('<link rel="stylesheet" href="../biblio/jquery/plugins/jquery.tablesorter.css" type="text/css"/>');
	mywindow.document
			.write('<link rel="stylesheet" href="../biblio/jquery/css/style.css" type="text/css" />');

	mywindow.document.write('</head><body style="padding:10px;">');
	mywindow.document.write(data);
	mywindow.document.write('</body></html>');
	mywindow.document.close();
	mywindow.print();
	return true;
}

function exportTableAsCsv(id)
{
	$("#" + id).table2CSV();
}