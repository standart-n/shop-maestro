
$(document).ready(function () {			

 $('#idBtnHTML').live("click",function(){  	

	btnHTML_click();

 });

});



function listmain_change() {
	
	sub_ndx = (document.getElementById("idListMain").selectedIndex);
	pr_vl = (document.getElementById("idListMain").options[sub_ndx].value);
	skeleton_tb = (document.getElementById("idSkeleton").value);

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/propertyEditor/module_propertyEditor_property.php?pr_vl="+pr_vl+"&skeleton_tb="+skeleton_tb;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});
	//alert(sub_vl);
	//alert(pattern_nm);

}


function btnNewEl_click() {

	document.getElementById("idFrmNewEl").submit();

}

function btnDelEl_click() {

	main_ndx = (document.getElementById("idListMain").selectedIndex);
	main_vl = (document.getElementById("idListMain").options[main_ndx].value);
	document.getElementById("idDelEl").value=main_vl;
	document.getElementById("idFrmDelEl").submit();

}


function btnSave_click() {

	/*docu=deDoc.getElementById("idBlockMain").innerHTML;*/
	//alert(docu);
	main_ndx = (document.getElementById("idListMain").selectedIndex);
	main_vl = (document.getElementById("idListMain").options[main_ndx].value);
	element_html = (document.getElementById("idEl").value);
	skeleton_tb = (document.getElementById("idSkeleton").value);
	document.getElementById("idSave_type").value="save";
	document.getElementById("idSave_txt").value=element_html;
	document.getElementById("idSave_id").value=skeleton_tb;
	document.getElementById("idSave_sub").value=main_vl;
	document.getElementById("idFrmSave").submit();

}

