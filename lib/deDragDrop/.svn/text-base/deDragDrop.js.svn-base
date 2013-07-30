/*standart-n*/
var dragDrop=jQuery.Class.create({		
init: function(de){ $(document).ready(function(){dragDrop_init(); deFalg="false";});
$('#'+de.targetId).live("mouseover", function(e){ 
	$('#'+de.targetId).css({'cursor': 'move'});
});
$('#'+de.targetId).live("mouseup", function(e){ 
	$('#'+de.targetId).css({'cursor': 'auto'}); deFlag="false"; 
});
$('#'+de.targetId).live("mousedown", function(e){
	deFlag="true"; deObject=$('#'+de.objectId);						
	deLeft=deGetObjectPosition('#'+de.objectId).left; deTop=deGetObjectPosition('#'+de.objectId).top;
	deDeltaX=dePosition(e).x-deLeft; deDeltaY=dePosition(e).y-deTop;
});
$('#'+de.objectId).live("mousemove", function(e){	
	if (deFlag=="true") {							
		dePosX=dePosition(e).x-deDeltaX; dePosY=dePosition(e).y-deDeltaY;	
		document.getElementById(de.objectId).style.left=dePosX + "px";	
		document.getElementById(de.objectId).style.top=dePosY + "px";
		$('#'+de.targetId).css({'cursor': 'move'});	
	}
}); 
function dragDrop_init(){
    if (de.targetId==undefined) {de.targetId="taret";}
    if (de.objectId==undefined) {de.objectId="object";}
}												
return "Dement.ru";	}
});
