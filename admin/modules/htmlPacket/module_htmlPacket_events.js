$(document).ready(function () { mdl=document.getElementById("info_module_name").innerHTML;
    deAjax("modules/"+mdl+"/module_"+mdl+"_ajax.php?mdl="+mdl+"&action=start");
    img="modules/"+mdl+"/img/"; loader=img+"loader.gif"; down=img+"down.png"; del=img+"del.png"; 
    preload(loader,down,del);
});
$(".cl_link").live("click",function(){ ajax_loader(); id=this.id.split("_");
    deAjax("modules/"+mdl+"/module_"+mdl+"_ajax.php?mdl="+mdl+"&action=button&id="+id[2]);
    $("#"+this.id).effect("bounce",{times:1,direction:"down",distance:2},50);
});
$(".cl_part_caption").live("click",function(){ ajax_loader(); editStatus(""); id=this.id.split("_");
    deAjax("modules/"+mdl+"/module_"+mdl+"_ajax.php?mdl="+mdl+"&action=line&id="+id[3]);
});
$("#id_link_delete").live("click",function(){
 if (document.getElementById("id_status_event").innerHTML=="") { editStatus("delete");
    $(".cl_part_event").css({'background':'url('+img+'del.png) no-repeat center'});
    deShowOpacitySlow(".cl_part_event",0,100,300);
 } else { editStatus(""); hideEvent(); $(".cl_part_event").css({'background':'none'}); }
});
$(".cl_part_event").live("click",function(){ id=this.id.split("_");
 if (document.getElementById("id_status_event").innerHTML=="delete") { ajax_loader();
    deAjax("modules/"+mdl+"/module_"+mdl+"_ajax.php?mdl="+mdl+"&action=remove&id="+id[3]);
 }
});
 	
$(".cl_opt_input input").live("blur",function(){ saveSettings(this.id); });
$(".cl_link").live("mouseover",function(){deShowOpacitySlow("#"+this.id,100,90,100);});
$(".cl_link").live("mouseleave",function(){deShowOpacitySlow("#"+this.id,90,100,100);});
$(".cl_part_line").live("mouseover",function(){ $("#"+this.id).css({'cursor':'pointer'}); });  	
$(".cl_part_line").live("mouseover",function(){ $("#"+this.id).css({'background':'#eeeeee'}); });  	
$(".cl_part_line").live("mouseleave",function(){ $("#"+this.id).css({'background':'#ffffff'}); });  	
$(".cl_part_event").live("mouseover",function(){
    $(".cl_part_event").css({'cursor':'pointer'}); deShowOpacitySlow("#"+this.id,100,60,100);
});
$(".cl_part_event").live("mouseleave",function(){deShowOpacitySlow("#"+this.id,60,100,100);});
function saveSettings(id) { val=document.getElementById(id).value;
    deAjax("modules/"+mdl+"/module_"+mdl+"_ajax.php?mdl="+mdl+"&action=settingsSave&id="+id+"&value="+val);
}
function ajax_loader() { document.getElementById("id_box_header_center").innerHTML="<img align='center' src='"+loader+"'>"; }
function editStatus(stat) { document.getElementById("id_status_event").innerHTML=stat; }
function hideEvent() { deShowOpacitySharp(".cl_part_event",0); }
