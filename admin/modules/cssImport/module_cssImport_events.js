
$(document).ready(function () {			

 $('#idBtnHTML').live("click",function(){  	

	btnHTML_click();

 });

});


function browser_change() {
		
	//alert('js');
	browser_ndx = (document.getElementById("idBrowser").selectedIndex);
	browser_vl = (document.getElementById("idBrowser").options[browser_ndx].value);
	pattern_tb = (document.getElementById("idPattern").value);

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/cssImport/module_cssImport_browsers.php?browser_vl="+browser_vl+"&pattern_tb="+pattern_tb;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});

}



function selector_change() {
	
	selector_ndx = (document.getElementById("idSelector").selectedIndex);
	selector_vl = (document.getElementById("idSelector").options[selector_ndx].value);
	pattern_tb = (document.getElementById("idPattern").value);

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/cssImport/module_cssImport_selectors.php?selector_vl="+selector_vl+"&pattern_tb="+pattern_tb;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});
	//alert(selector_vl);
	//alert(pattern_tb);

}


function btnImport_click() {

	/*docu=deDoc.getElementById("idBlockMain").innerHTML;*/
	//alert(docu);
	browser_ndx = (document.getElementById("idBrowser").selectedIndex);
	browser_vl = (document.getElementById("idBrowser").options[browser_ndx].value);
	css_code = (document.getElementById("idCSS").value);
	pattern_tb = (document.getElementById("idPattern").value);
	document.getElementById("idSave_type").value="import";
	document.getElementById("idSave_txt").value=css_code;
	document.getElementById("idSave_id").value=pattern_tb;
	document.getElementById("idSave_br").value=browser_vl;
	document.getElementById("idFrmSave").submit();

}

function btnDelSel_click() {

	selector_ndx = (document.getElementById("idSelector").selectedIndex);
	selector_vl = (document.getElementById("idSelector").options[selector_ndx].value);
	document.getElementById("idDelSel").value=selector_vl;
	document.getElementById("idFrmDelSel").submit();

}


function btnEdit_click() {

	/*docu=deDoc.getElementById("idBlockMain").innerHTML;*/
	//alert(docu);
	browser_ndx = (document.getElementById("idBrowser").selectedIndex);
	browser_vl = (document.getElementById("idBrowser").options[browser_ndx].value);
	css_code = (document.getElementById("idCSS").value);
	pattern_tb = (document.getElementById("idPattern").value);
	document.getElementById("idSave_type").value="edit";
	document.getElementById("idSave_txt").value=css_code;
	document.getElementById("idSave_id").value=pattern_tb;
	document.getElementById("idSave_br").value=browser_vl;
	document.getElementById("idFrmSave").submit();

}


function btnHTML_click() {

	docu=deDoc.firstChild.innerHTML;
	/*docu=deDoc.getElementById("idBlockMain").innerHTML;*/
	alert(docu);

}

