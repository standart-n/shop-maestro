/*standart-n.ru*/ 
var showDialog=jQuery.Class.create({		
init:function(de){$(document).ready(function() { showDialog_init();
    de.code='<div id="'+de.dialogId+'Dement"></div><div id="'+de.wallId+'"></div><div id="'+de.dialogId+'"><div id="'+de.uplineId+'">'+de.uplineCaption;			
	if (de.closeVisible=="TRUE") { de.code+='<span class="'+de.closeButton+'"><a class="'+de.closeClassLink+'" href="#de"></a></span>'; }
	de.code+='</div><div id="'+de.contentId+'">'+de.contentText+'</div></div>';  													 
	document.body.innerHTML+=de.code; showDialog_css(); 														
$(de.object).live(de.event, function(){ showDialog_css();
	de.documentHeight=deGetDocumentSize().height; de.documentWidth=deGetDocumentSize().width;
	de.screenHeight=deGetScreenSize().height; de.screenWidth=deGetScreenSize().width;
	de.scrollTop=deGetScrollSize().top; de.scrollLeft=deGetScrollSize().left;
    de.mDialog=$('#'+de.dialogId);  de.wall=$('#'+de.wallId); de.mDialog.css({'display': 'none'}); de.wall.css({'display': 'none'});		
    de.mDialogHeight=de.mDialog.height(); de.mDialogWidth=de.mDialog.width();
	de.mDialogTop=(de.screenHeight-de.mDialogHeight)/2+de.scrollTop; de.mDialogLeft=(de.screenWidth-de.mDialogWidth)/2+de.scrollLeft;
    if (de.mDialogTop>0) { 
		if ((de.mDialogHeight+de.mDialogTop)<(de.documentHeight+100)) { de.mDialog.css({'top': de.mDialogTop}); } else { de.mDialog.css({'top': '50px'}); }
    } else { de.mDialog.css({'top': '100px'}); }    
    if (de.mDialogLeft>0) {
        if ((de.mDialogWidth+de.mDialogLeft)<(de.documentWidth+100)) { de.mDialog.css({'left': de.mDialogLeft}); } else { de.mDialog.css({'left': '50px'}); }
    } else { de.mDialog.css({'left': '100px'}); }    
	de.wallHeight=de.screenHeight+de.scrollTop; de.wallWidth=de.screenWidth+de.scrollLeft; de.wall.width(de.documentWidth); de.wall.height(de.documentHeight);		
	if (de.wallVisible=="TRUE") { deShowOpacitySlow('#'+de.wallId,0,de.wallOpacity,1); }
	deShowEffect('#'+de.dialogId,de.effect,de.speed);
});
$('span.'+de.closeButton+' a').live("click", function(){
	deShowEffect('#'+de.dialogId,de.effect,de.speed); 
	if (de.wallVisible=="TRUE") { deShowOpacitySlow('#'+de.wallId,de.wallOpacity,0,1); }
	$('#'+de.dialogId+'Dement').animate({top: '1px'},de.speed,"linear",function(){ showDialog_css(); });
});
$('a.'+de.closeClassLink).live("mouseover", function(){ deShowOpacitySlow('a.'+de.closeClassLink,100,60,100); });
$('a.'+de.closeClassLink).live("mouseout", function(){ deShowOpacitySlow('a.'+de.closeClassLink,60,100,100); });
});
function showDialog_init() {
    if (de.object==undefined) {de.object="#primary";}
    if (de.event==undefined) {de.event="click";}
    if (de.effect==undefined) {de.effect="OpacityEffect";}
    if (de.before==undefined) {de.before="0.01";}
    if (de.width==undefined) {de.width="300px";}
    if (de.height==undefined) {de.height="300px";}
    if (de.dialogBorder==undefined) {de.dialogBorder="#999999 solid 1px";}
    if (de.dialogZindex==undefined) {de.dialogZindex="200";}
    if (de.dialogOpacity==undefined) {de.dialogOpacity="95";}
    if (de.speed==undefined) {de.speed="10";}
    if (de.dialogId==undefined) {de.dialogId="showDialog";}
    if (de.uplineCaption==undefined) {de.uplineCaption="Всплывающее окно";}
    if (de.uplineFontFamily==undefined) {de.uplineFontFamily="Verdana, Times New Roman, Sans-Serif";}
    if (de.uplineFontSize==undefined) {de.uplineFontSize="medium";}
    if (de.uplineColor==undefined) {de.uplineColor="#000000";}
    if (de.uplineHeight==undefined) {de.uplineHeight="30px";}
    if (de.uplineBackground==undefined) {de.uplineBackground="#cccccc";}
    if (de.uplineAlign==undefined) {de.uplineAlign="center";}
    if (de.uplineId==undefined) {de.uplineId=de.dialogId+'Upline';}
    if (de.target==undefined) {de.target="#target";}
    if (de.contentText==undefined) {de.contentText=$(de.target).html(); $(de.target).html("");}
    if (de.contentFontFamily==undefined) {de.contentFontFamily="Verdana, Times New Roman, Sans-Serif";}
    if (de.contentFontSize==undefined) {de.contentFontSize="small";}
    if (de.contentColor==undefined) {de.contentColor="#000000";}
    if (de.contentBackground==undefined) {de.contentBackground="#ffffff";}
    if (de.contentAlign==undefined) {de.contentAlign="left";}
    if (de.contentId==undefined) {de.contentId=de.dialogId+'Content';}
    if (de.wallBackground==undefined) {de.wallBackground="#000000";}
    if (de.wallVisible==undefined) {de.wallVisible="TRUE";}
    if (de.wallOpacity==undefined) {de.wallOpacity="50";}
    if (de.wallId==undefined) {de.wallId=de.dialogId+'Wall';}
    if (de.closeBackground==undefined) {de.closeBackground="url(http://www.dement.ru/!lib/deShowDialog/img/btnClose.png) no-repeat center";}
    if (de.closeButton==undefined) {de.closeButton=de.dialogId+'Close';}
    if (de.closeClassLink==undefined) {de.closeClass=de.dialogId+'LinkClose';}
    if (de.closeVisible==undefined) {de.closeVisible='TRUE';}
}
function showDialog_css() {
	de.mDialog=$('#'+de.dialogId);
	de.mDialog.css({'position': 'absolute'});		
	de.mDialog.css({'display': 'none'});		
	de.mDialog.css({'float': 'left'});		
	de.mDialog.css({'top': '0'});		
	de.mDialog.css({'left': '0'});		
	de.mDialog.css({'width': de.width});		
	de.mDialog.css({'height': 'auto'});				
	de.mDialog.css({'border': de.dialogBorder});							
	de.mDialog.css({'z-index': de.dialogZindex});	

	de.upLine=$('#'+de.uplineId);					 
	de.upLine.css({'font-family': de.uplineFontFamily});		
	de.upLine.css({'font-size': de.uplineFontSize});		
	de.upLine.css({'color': de.uplineColor});		
	de.upLine.css({'display': 'block'});		
	de.upLine.css({'float': 'left'});		
	de.upLine.css({'width': (de.mDialog.width()-20)});		
	de.upLine.css({'line-height': de.uplineHeight});		
	de.upLine.height(de.uplineHeight);		
	de.upLine.css({'padding': '0 10px 0 10px'});		
	de.upLine.css({'text-align': de.uplineAlign});		
	de.upLine.css({'background': de.uplineBackground});		

	de.content=$('#'+de.contentId);			
	de.content.css({'font-family': de.contentFontFamily});
	de.content.css({'font-size': de.contentFontSize});		
	de.content.css({'color': de.contentColor});		
	de.content.css({'display': 'block'});		
	de.content.css({'float': 'left'});		
	de.content.css({'width': (de.mDialog.width()-20)});		
	de.content.css({'height': de.height});		
	de.content.css({'padding': '10px 10px 10px 10px'});		
	de.content.css({'clear': 'both'});		
	de.content.css({'text-align': de.contentAlign});		
	de.content.css({'background': de.contentBackground});		

	de.wall=$('#'+de.wallId);					
	de.wall.css({'position': 'absolute'});		
	de.wall.css({'display': 'none'});		
	de.wall.css({'float': 'left'});		
	de.wall.css({'top': '0'});		
	de.wall.css({'left': '0'});		
	de.wall.css({'background': de.wallBackground});		
	de.wall.css({'z-index': (de.dialogZindex-1)});
	de.wall.height(deGetDocumentSize().height);
	de.wall.width(deGetDocumentSize().width);
	
	de.btnClose=$('a.'+de.closeClassLink); 
	de.btnClose.css({'position': 'absolute'});		
	de.btnClose.css({'display': 'block'});		
	de.btnClose.css({'float': 'left'});		
	de.btnClose.css({'top': '8px'});		
	de.btnClose.css({'right': '10px'});		
	de.btnClose.css({'width': '16px'});		
	de.btnClose.css({'height': '16px'});		
	de.btnClose.css({'background': de.closeBackground});		
	de.btnClose.css({'text-decoration': 'none'});		
}
return "Dement.ru";}
});
									 



