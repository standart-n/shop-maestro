
$(document).ready(function () {			


 $('#idBtnHTML').live("click",function(){  	
	btnHTML_click();
 });





});


function make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hovd,tbl,text,act) {

	document.getElementById("deAjax").innerHTML="MSIE...<script></script>";
	deUrl="modules/"+mdl+"/module_"+mdl+"_ajax.php?type="+type+"&main_act="+main_act+"&sub_act="+sub_act+"&main_hov="+main_hov+"&sub_hov="+sub_hov+"&tbl="+tbl+"&mdl="+mdl+"&act="+act+"&text="+text;
	$('#deAjax').animate({top: '1px'},10,"linear",function(){	
		sendscipt(deUrl); 
	});
    
}

function main_over(id) {

    mainid=document.getElementById("idSave_main_id").value;
    if (id!=mainid) {
	$('#btn_main_rename_'+id).css({'display':'block'});
	$('#btn_main_delete_'+id).css({'display':'block'});
    }
    document.getElementById("main_input_id").value=id;
}

function main_leave(id) {

	$('#btn_main_rename_'+id).css({'display':'none'});
	$('#btn_main_delete_'+id).css({'display':'none'});
}

function main_delete() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"delete");
}

function main_deleteAct() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"deleteAct");
}

function main_open() {
		
	main_hov=document.getElementById("main_input_id").value;
    main_act=document.getElementById("idSave_main_id").value;
    sub_act="";
    sub_hov="";
    if (main_act!=main_hov) {
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"open");
    document.getElementById("idSave_main_id").value=main_hov;
    }
}

function main_rename() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text=document.getElementById("main_input_rename").value;
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"rename");
}

function main_renameAct() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text=document.getElementById("main_input_renameAct").value;
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"renameAct");
}

function main_create() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text=document.getElementById("main_input_create").value;
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"create");
}

function main_list_next() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"list_next");
}

function main_list_prev() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"list_prev");
}

function main_limit_five() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"limit_five");
}

function main_limit_ten() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"limit_ten");
}

function main_limit_twenty() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"limit_twenty");
}

function main_limit_fivty() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act="";
	main_hov=document.getElementById("main_input_id").value;
	sub_hov="";
	type=document.getElementById("main_input_type").value;
	tbl=document.getElementById("main_input_tbl").value;
	mdl=document.getElementById("main_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"limit_fivty");
}



function sub_over(id) {

    subid=document.getElementById("idSave_sub_id").value;
    if (id!=subid) {
	$('#btn_sub_rename_'+id).css({'display':'block'});
	$('#btn_sub_delete_'+id).css({'display':'block'});
    }
    document.getElementById("sub_input_id").value=id;
}

function sub_leave(id) {

	$('#btn_sub_rename_'+id).css({'display':'none'});
	$('#btn_sub_delete_'+id).css({'display':'none'});
}

function sub_open() {
		
	sub_hov=document.getElementById("sub_input_id").value;
    sub_act=document.getElementById("idSave_sub_id").value;
    main_act="";
    main_hov="";
    if (sub_act!=sub_hov) {
	   type=document.getElementById("sub_input_type").value;
	   tbl=document.getElementById("sub_input_tbl").value;
	   mdl=document.getElementById("sub_input_mdl").value;
       text="";
       make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"open");
       document.getElementById("idSave_sub_id").value=sub_hov;
	   $('#idsub_ul li').css({'border':'none'});
    }
    
}

function sub_delete() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"delete");
}

function sub_deleteAct() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"deleteAct");
}

function sub_setAct() {
		
	set_ndx=(document.getElementById("sub_input_set").selectedIndex);
	main_act=(document.getElementById("sub_input_set").options[set_ndx].value);
    document.getElementById("idSave_main_id").value=main_act;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"setAct");
}

function sub_rename() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text=document.getElementById("sub_input_rename").value;
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"rename");
}


function sub_list_next() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"list_next");
}

function sub_list_prev() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"list_prev");
}

function sub_create() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text=document.getElementById("sub_input_create").value;
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"create");
}

function sub_limit_five() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"limit_five");
}

function sub_limit_ten() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"limit_ten");
}

function sub_limit_twenty() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"limit_twenty");
}

function sub_limit_fivty() {
		
	main_act=document.getElementById("idSave_main_id").value;
	sub_act=document.getElementById("idSave_sub_id").value;
	main_hov=document.getElementById("main_input_id").value;
	sub_hov=document.getElementById("sub_input_id").value;
	type=document.getElementById("sub_input_type").value;
	tbl=document.getElementById("sub_input_tbl").value;
	mdl=document.getElementById("sub_input_mdl").value;
    text="";
    make_ajax(mdl,type,main_act,sub_act,main_hov,sub_hov,tbl,text,"limit_fivty");
}



function sub_save() {

	docu=deDoc.body.innerHTML;
	docu=docu.replace(new RegExp('<link href=\"modules/textEditor/module_textEditor_style.css\" rel=\"stylesheet\" type=\"text/css\">','gi'),'');
	docu=docu.replace(new RegExp("<html>",'gi'),'');
	docu=docu.replace(new RegExp("<\/html>",'gi'),'');
	docu=docu.replace(new RegExp("<head>",'gi'),'');
	docu=docu.replace(new RegExp("<\/head>",'gi'),'');
	docu=docu.replace(new RegExp("<body>",'gi'),'');
	docu=docu.replace(new RegExp("<\/body>",'gi'),'');
	docu=docu.replace(new RegExp("<script>",'gi'),'');
	docu=docu.replace(new RegExp("<\/script>",'gi'),'');
	docu=docu.replace(new RegExp("<object>",'gi'),'');
	docu=docu.replace(new RegExp("<\/object>",'gi'),'');
	docu=docu.replace(new RegExp("<embed>",'gi'),'');
	docu=docu.replace(new RegExp("<\/embed>",'gi'),'');
	docu=docu.replace(new RegExp("<iframe>",'gi'),'');
	docu=docu.replace(new RegExp("<\/iframe>",'gi'),'');
	docu=docu.replace(new RegExp("<frame>",'gi'),'');
	docu=docu.replace(new RegExp("<\/frame>",'gi'),'');
	docu=docu.replace(new RegExp("<b>",'gi'),'<strong>');
	docu=docu.replace(new RegExp("<\/b>",'gi'),'</strong>');
	docu=docu.replace(new RegExp("\"\.\.\/files\/",'gi'),"\"files\/");
	docu=docu.replace(new RegExp("\"\.\.\/photo\/",'gi'),"\"photo\/");

	document.getElementById("idSave_txt").value=docu;
	document.getElementById("idFrmSave").submit();

}

function btnNewItem_click() {

	document.getElementById("idFrmNewItem").submit();

}

function btnSetItem_click() {

	item_ndx = (document.getElementById("idItem").selectedIndex);
	item_vl = (document.getElementById("idItem").options[item_ndx].value);
	document.getElementById("idSetItem").value=item_vl;
	document.getElementById("idFrmSetItem").submit();

}


function btnHTML_click() {

	docu=deDoc.firstChild.innerHTML;
	alert(docu);

}

