
$(document).ready(function () {			

 $('#idBtnHTML').live("click",function(){  	

	btnHTML_click();

 });

});


function btnSaveText_click() {

	element_html = (document.getElementById("idEv").value);
	document.getElementById("idSave_txt").value=element_html;
	document.getElementById("idFrmSave").submit();

}

