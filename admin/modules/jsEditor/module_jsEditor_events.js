
$(document).ready(function () {			

 $('#idBtnHTML').live("click",function(){  	

	btnHTML_click();

 });

});



function listmain_change() {
	
	main_ndx = (document.getElementById("idListMain").selectedIndex);
	js_vl = (document.getElementById("idListMain").options[main_ndx].value);

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/jsEditor/module_jsEditor_code.php?js_vl="+js_vl;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});
	//alert(sub_vl);
	//alert(pattern_nm);

}


function btnNewJS_click() {

	document.getElementById("idFrmNewJS").submit();

}

function btnDelJS_click() {

	main_ndx = (document.getElementById("idListMain").selectedIndex);
	main_vl = (document.getElementById("idListMain").options[main_ndx].value);
	document.getElementById("idDelJS").value=main_vl;
	document.getElementById("idFrmDelJS").submit();

}


function btnSave_click() {

	/*docu=deDoc.getElementById("idBlockMain").innerHTML;*/
	//alert(docu);
	main_ndx = (document.getElementById("idListMain").selectedIndex);
	main_vl = (document.getElementById("idListMain").options[main_ndx].value);
	element_html = (document.getElementById("idEl").value);
	document.getElementById("idSave_txt").value=element_html;
	document.getElementById("idSave_sub").value=main_vl;
	document.getElementById("idFrmSave").submit();

}

