
$(document).ready(function () {			

 $('#idBtnFileImportPrev').live("click",function(){  	

	fileImport_list('prev');

 });

 $('#idBtnFileImportNext').live("click",function(){  	

	fileImport_list('next');

 });

});


function fileImport_list(type) {

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/fileImport/module_fileImport_list.php?type="+type;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});
}


function btnSaveFile_click() {

	document.getElementById("idFrmSave").submit();

}
