
$(document).ready(function () {			

 $('#idBtnHTML').live("click",function(){  	

	btnHTML_click();

 });

});


function listmain_change() {
		
	//alert('js');
	main_ndx = (document.getElementById("idListMain").selectedIndex);
	main_vl = (document.getElementById("idListMain").options[main_ndx].value);
	skeleton_tb = (document.getElementById("idSkeleton").value);

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/elementEditor/module_elementEditor_main.php?main_vl="+main_vl+"&skeleton_tb="+skeleton_tb;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});

}



function listsub_change() {
	
	sub_ndx = (document.getElementById("idListSub").selectedIndex);
	sub_vl = (document.getElementById("idListSub").options[sub_ndx].value);
	skeleton_tb = (document.getElementById("idSkeleton").value);

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/elementEditor/module_elementEditor_sub.php?sub_vl="+sub_vl+"&skeleton_tb="+skeleton_tb;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});
	//alert(sub_vl);
	//alert(pattern_nm);

}


function btnSave_click() {

	/*docu=deDoc.getElementById("idBlockMain").innerHTML;*/
	//alert(docu);
	sub_ndx = (document.getElementById("idListSub").selectedIndex);
	sub_vl = (document.getElementById("idListSub").options[sub_ndx].value);
	element_html = (document.getElementById("idEl").value);
	skeleton_tb = (document.getElementById("idSkeleton").value);
	document.getElementById("idSave_type").value="save";
	document.getElementById("idSave_txt").value=element_html;
	document.getElementById("idSave_id").value=skeleton_tb;
	document.getElementById("idSave_sub").value=sub_vl;
	document.getElementById("idFrmSave").submit();

}

