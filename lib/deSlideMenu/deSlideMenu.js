/*standart-n*/
var slideMenu=jQuery.Class.create({		
init: function(de){ $(document).ready(function(){ slideMenu_init(); slideMenu_css(); 
$(de.objectOpen).live(de.eventOpen, function(){ if ($('#'+de.bodyId).is(":hidden")) {
		$('#'+de.bodyId).slideDown(de.speed);
		document.getElementById(de.headerId).innerHTML=de.textOpen;
		addOpenClass(de.menuId); addOpenClass(de.headerId); addOpenClass(de.bodyId);
}	});
$(de.objectClose).live(de.eventClose, function(){ if ($('#'+de.bodyId).is(":visible")) {
		$('#'+de.bodyId).slideUp(de.speed);
		document.getElementById(de.headerId).innerHTML=de.textClose;
		addCloseClass(de.menuId); addCloseClass(de.headerId); addCloseClass(de.bodyId);
}	});
$('#'+de.headerId).live('mouseover', function(){ $('#'+de.headerId).css({'cursor': 'pointer'}); });
$('#'+de.headerId).live('mouseleave', function(){ $('#'+de.headerId).css({'cursor': 'auto'}); });
addOpenClass=function(id){ $("#"+id).removeClass(de.classClose).addClass(de.classOpen); }
addCloseClass=function(id){ $("#"+id).removeClass(de.classOpen).addClass(de.classClose); }
});
function slideMenu_css(){ if (de.open=="FALSE") { $('#'+de.bodyId).css({'display':'none'}); $('#'+de.bodyId).slideUp(1); } }
function slideMenu_init(){
    if (de.menuId==undefined) {de.menuId="menu";}
    if (de.headerId==undefined) {de.headerId="header";}
    if (de.bodyId==undefined) {de.bodyId="body";}
    if (de.objectOpen==undefined) {de.objectOpen="#"+de.headerId;}
    if (de.objectClose==undefined) {de.objectClose="#"+de.menuId;}
    if (de.eventOpen==undefined) {de.eventOpen="mouseover";}
    if (de.eventClose==undefined) {de.eventClose="mouseleave";}
    if (de.classOpen==undefined) {de.classOpen="clOpen";}
    if (de.classClose==undefined) {de.classClose="clClose";}
    if (de.textOpen==undefined) {de.textOpen=document.getElementById(de.headerId).innerHTML;}
    if (de.textClose==undefined) {de.textClose=document.getElementById(de.headerId).innerHTML;}
    if (de.speed==undefined) {de.speed="300";}
    if (de.linear==undefined) {de.linear="linear";}
    if (de.open==undefined) {de.open="FALSE";}
}												
return "Dement.ru";	}
});
