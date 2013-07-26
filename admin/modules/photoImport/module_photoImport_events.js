

$(document).ready(function () {			


 $('#idBtnPhotoImportPrev').live("click",function(){  	

	photoImport_list('prev');

 });

 $('#idBtnPhotoImportNext').live("click",function(){  	

	photoImport_list('next');

 });


  $('.clDlgImgScale img').live('click', function(){  

	imagepath=this.src;
	imagepath=imagepath.replace(/([0-9]){3}x([0-9]){2}_/i,'');
	document.getElementById('deIMGContent').innerHTML='<img src="'+imagepath+'">';
	$('#deIMGDialog').css({'width':'auto'});
	$('#deIMGTopline').css({'width':'auto'});
	$('#deIMGContent').css({'width':'auto'});

  });														

  $('.clDlgImgScale img').live('mouseover', function(){  

	$('.clDlgImgScale img').css({'cursor': 'pointer'});		// меняем курсор мыши


  });														


  $('.clDlgImgScale img').live('mouseleave', function(){  

	$('.clDlgImgScale img').css({'cursor': 'auto'});		// меняем курсор мыши

  });														


});


function link_over(id) {

	$('#idDelLink_'+id).css({'display':'block'});
	$('#idIMGLink_'+id).css({'border':'#33ccff solid 1px'});
	$('#idTDLink1_'+id).css({'border-top':'#33ccff dashed 1px'});
	$('#idTDLink2_'+id).css({'border-top':'#33ccff dashed 1px'});
	$('#idTDLink3_'+id).css({'border-top':'#33ccff dashed 1px'});
	$('#idTDLink4_'+id).css({'border-top':'#33ccff dashed 1px'});
	$('#idTDLink1_'+id).css({'border-bottom':'#33ccff dashed 1px'});
	$('#idTDLink2_'+id).css({'border-bottom':'#33ccff dashed 1px'});
	$('#idTDLink3_'+id).css({'border-bottom':'#33ccff dashed 1px'});
	$('#idTDLink4_'+id).css({'border-bottom':'#33ccff dashed 1px'});
	//deShowOpacitySlow('#idDelFormat_'+id+'',0,100,100);
	
}

function link_leave(id) {

	//deShowOpacitySlow('#idDelFormat_'+id+'',100,0,100);
	$('#idDelLink_'+id).css({'display':'none'});
	$('#idIMGLink_'+id).css({'border':'#ffffff solid 1px'});
	$('#idTDLink1_'+id).css({'border-top':'#ffffff solid 1px'});
	$('#idTDLink2_'+id).css({'border-top':'#ffffff solid 1px'});
	$('#idTDLink3_'+id).css({'border-top':'#ffffff solid 1px'});
	$('#idTDLink4_'+id).css({'border-top':'#ffffff solid 1px'});
	$('#idTDLink1_'+id).css({'border-bottom':'#ffffff solid 1px'});
	$('#idTDLink2_'+id).css({'border-bottom':'#ffffff solid 1px'});
	$('#idTDLink3_'+id).css({'border-bottom':'#ffffff solid 1px'});
	$('#idTDLink4_'+id).css({'border-bottom':'#ffffff solid 1px'});
	
}


function format_over(id) {

	$('#idDelFormat_'+id).css({'display':'block'});
	$('#idTDFormat_'+id).css({'border':'#33ccff dotted 1px'});
	//deShowOpacitySlow('#idDelFormat_'+id+'',0,100,100);
	
}

function format_leave(id) {

	//deShowOpacitySlow('#idDelFormat_'+id+'',100,0,100);
	$('#idTDFormat_'+id).css({'border':'#ffffff solid 1px'});
	$('#idDelFormat_'+id).css({'display':'none'});
	
}


function delurl(id) {

	text="<a style='border:#999999 1px dashed;padding:10px 30px;' href='index.php?page=photoImport&action=del_photo&id="+id+"' id='idDlgYes'><b>Да</b></a>"+
			"&nbsp;&nbsp;&nbsp;&nbsp;<span class='ClassButtonClose'>"+
			"<a style='border:#999999 1px dashed;padding:10px 30px;' href='#de' id='idDlgNo'><b>Нет</b></a></span>";
	document.getElementById("idDlgButtons").innerHTML=text;

}

function btnNewFormat_click() {

	document.getElementById("idFrmNewFormat").submit();

}


function photoImport_list(type) {

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/photoImport/module_photoImport_list.php?type="+type;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});
}


function btnSavePhoto_click() {

	document.getElementById("idFrmSave").submit();

}

