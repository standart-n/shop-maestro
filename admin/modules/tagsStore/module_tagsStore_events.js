
$(document).ready(function () {			

 $('#idBtnHTML').live("click",function(){  	

	btnHTML_click();

 });

});


function listmain_change() {
		
	//alert('js');
	main_ndx = (document.getElementById("idListMain").selectedIndex);
	main_vl = (document.getElementById("idListMain").options[main_ndx].value);

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/tagsStore/module_tagsStore_main.php?main_vl="+main_vl;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});

}



function listsub_change() {
	
	sub_ndx = (document.getElementById("idListSub").selectedIndex);
	sub_vl = (document.getElementById("idListSub").options[sub_ndx].value);

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/tagsStore/module_tagsStore_sub.php?sub_vl="+sub_vl;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});
	//alert(sub_vl);
	//alert(pattern_nm);

}

function btnNewBox_click() {

	document.getElementById("idFrmNewBox").submit();

}

function btnDelShelf_click() {

	item_ndx = (document.getElementById("idListSub").selectedIndex);
	item_vl = (document.getElementById("idListSub").options[item_ndx].value);
	document.getElementById("idSave_id").value=item_vl;
	document.getElementById("idFrmSave").action="index.php?page=tagsStore&action=del_shelf";
	document.getElementById("idFrmSave").submit();

}

function btnNewShelf_click() {

	document.getElementById("idFrmNewShelf").submit();

}

function btnSetShelf_click() {

	item_ndx = (document.getElementById("idListSub").selectedIndex);
	item_vl = (document.getElementById("idListSub").options[item_ndx].value);
	document.getElementById("idSetShelf").value=item_vl;
	document.getElementById("idFrmSetShelf").submit();

}

function btnDelBox_click() {

	document.getElementById("idFrmDelBox").submit();

}


function btnSave_click() {

	/*docu=deDoc.getElementById("idBlockMain").innerHTML;*/
	//alert(docu);
	sub_ndx = (document.getElementById("idListSub").selectedIndex);
	sub_vl = (document.getElementById("idListSub").options[sub_ndx].value);
	element_html = (document.getElementById("idEl").value);
	document.getElementById("idSave_type").value="save";
	document.getElementById("idSave_txt").value=element_html;
	document.getElementById("idSave_sub").value=sub_vl;
	document.getElementById("idFrmSave").submit();

}

