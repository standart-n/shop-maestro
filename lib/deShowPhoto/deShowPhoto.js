/*standart-n.ru*/ 
var showPhoto=jQuery.Class.create({		
init:function(de){$(document).ready(function() { 
	showPhoto_init(); showPhoto_search(); showPhoto_wrapper(); showPhoto_css(); 
	showPhoto_cssHeader(); showPhoto_cssAbout(); showPhoto_cssControls();
showPhoto_run=function(){ 
	de.flag=$("#de_showPhoto_flag").val();
	if (de.flag=="TRUE") {
		de.count_now=intval($("#"+de.contentId+" img").attr("de_showPhoto_count")); de.count_now++; showPhoto_refresh(de.count_now); 
		setTimeout("showPhoto_run();",$("#de_showPhoto_delay").val()); 
	}	
}
$('#'+de.closeId+' a').live("click", function(){ showPhoto_close(); });
$('#'+de.closeId+' a').live("mouseover", function(){ deShowOpacitySlow('a.'+de.closeClassLink,100,60,100); });
$('#'+de.closeId+' a').live("mouseout", function(){ deShowOpacitySlow('a.'+de.closeClassLink,60,100,100); });
$(de.area+" img").live(de.event,function(){ 
	de.img_src=$(this).attr("src"); de.img_count=$(this).attr("de_showPhoto_count");
	de.img_caption=$(this).attr("caption"); de.img_comment=$(this).attr("comment");
	de.img_width=$(this).attr("n_width"); de.img_height=$(this).attr("n_height");
	de.img_src=de.img_src.replace(de.str,de.replace);
	$('<img>').load(function(){
		showPhoto_count(de.img_count);
		showPhoto_about(de.img_caption,de.img_comment);
		showPhoto_insert(de.img_src,de.img_count,de.img_width,de.img_height);
		showPhoto_css();
		showPhoto_position();
		$("#"+de.controlId).html(showPhoto_codeControls("play"));
		showPhoto_cssControls();
		showPhoto_displayControls();
		$("#"+de.dialogId).css({'top':showPhoto_xy(de.img_width,de.img_height).top});
		$("#"+de.dialogId).css({'left':showPhoto_xy(de.img_width,de.img_height).left});
		if (de.wallVisible=="TRUE") { deShowOpacitySlow('#'+de.wallId,0,de.wallOpacity,1); }
		deShowEffect('#'+de.dialogId,de.effect,de.speed);
	}).attr('src',de.img_src);
});
$("#"+de.contentId+" img").live("click",function(){
	de.count_now=intval($("#"+de.contentId+" img").attr("de_showPhoto_count")); de.count_now++; showPhoto_refresh(de.count_now);
});
$("#"+de.prevId+" a").live("click",function(){
	de.count_now=intval($("#"+de.contentId+" img").attr("de_showPhoto_count")); de.count_now=de.count_now-1; showPhoto_refresh(de.count_now);
});
$("#"+de.nextId+" a").live("click",function(){
	de.count_now=intval($("#"+de.contentId+" img").attr("de_showPhoto_count")); de.count_now++; showPhoto_refresh(de.count_now);
});
$("#"+de.headerCloseId).live("click",function(){ showPhoto_close(); });
$("#"+de.wallId).live("click",function(){ showPhoto_close(); });
$("#"+de.playId+" a").live("click",function(){
	$("#"+de.controlId).html(showPhoto_codeControls("pause"));
	showPhoto_cssControls();
	showPhoto_displayControls();
	$("#de_showPhoto_flag").val("TRUE");
	showPhoto_run();	
});
$("#"+de.pauseId+" a").live("click",function(){
	$("#"+de.controlId).html(showPhoto_codeControls("play"));
	showPhoto_cssControls();
	showPhoto_displayControls();
	$("#de_showPhoto_flag").val("FALSE");
});
$(de.area+" img").live("mouseover",function(){ $(this).css({'cursor':'pointer'}); });
$(de.area+" img").live("mouseleave",function(){ $(this).css({'cursor':'auto'}); });
$("#"+de.contentId+" img").live("mouseover",function(){ $(this).css({'cursor':'pointer'}); });
$("#"+de.contentId+" img").live("mouseleave",function(){ $(this).css({'cursor':'auto'}); });
$("#"+de.wallId).live("mouseover",function(){ $(this).css({'cursor':'pointer'}); });
$("#"+de.wallId).live("mouseleave",function(){ $(this).css({'cursor':'auto'}); });
$("#"+de.headerCloseId).live("mouseover",function(){ $(this).css({'cursor':'pointer'}); });
$("#"+de.headerCloseId).live("mouseleave",function(){ $(this).css({'cursor':'auto'}); });
});
function showPhoto_config() { de.conf="";
	de.conf+='<div id="'+de.configId+'"><form>';
	de.conf+='<input type="hidden" id="de_showPhoto_delay" value="'+de.delay+'">';
	de.conf+='<input type="hidden" id="de_showPhoto_flag" value="'+de.flag+'">';
	de.conf+='</form></div>';
	return de.conf;
}
function showPhoto_close() {
	deShowEffect('#'+de.dialogId,de.effect,de.speed);
	$('#'+de.closeId).css({'display':'none'})
	$('#'+de.controlId).css({'display':'none'})
	if (de.wallVisible=="TRUE") { deShowOpacitySlow('#'+de.wallId,de.wallOpacity,0,1); }
	$('#'+de.dialogId+'Dement').animate({top:'1px'},de.speed,"linear",function(){ showPhoto_css(); });
	$("#"+de.controlId).html(showPhoto_codeControls("play"));
	de.flag="FALSE";
}
function showPhoto_codeControls(type) { de.cd="";
	de.cd+='<div id="'+de.prevId+'" class="'+de.controlBtnCl+'"><a href="#de"></a></div>';
	if (type=="play") { de.cd+='<div id="'+de.playId+'" class="'+de.controlBtnCl+'"><a href="#de"></a></div>'; } 
	else { de.cd+='<div id="'+de.pauseId+'" class="'+de.controlBtnCl+'"><a href="#de"></a></div>'; }
	de.cd+='<div id="'+de.nextId+'" class="'+de.controlBtnCl+'"><a href="#de"></a></div>';
	return de.cd;
}
function showPhoto_codeAbout() { de.cc="";
	de.cc+='<div id="'+de.aboutCaptionId+'"></div>';
	de.cc+='<div id="'+de.aboutCommentId+'"></div>';
	return de.cc;
}
function showPhoto_codeHeader() { de.ch="";
	de.ch+='<div id="'+de.headerCountId+'">Фотография</div>';
	de.ch+='<div id="'+de.headerCloseId+'">Закрыть</div>';
	return de.ch;
}
function showPhoto_displayControls() {
	$("#"+de.closeId).css({'top':(showPhoto_xy().sT+32)});
	$('#'+de.closeId).css({'display':'block'});
	$('#'+de.controlId).css({'display':'block'});
	if (de.controlPosition=="bottom") {
		$("#"+de.controlId).css({'top':(showPhoto_xy().h+showPhoto_xy().sT-50)});
	}
	if (de.controlPosition=="top") {
		$("#"+de.controlId).css({'top':(showPhoto_xy().sT+13)});
	}
	$("#"+de.controlId).fadeTo("fast",0.7);
}
function showPhoto_refresh(count_now) {
	if (intval(count_now)>=intval(showPhoto_search())) { count_now=0; }
	if (intval(count_now)<=(-1)) { count_now=intval(showPhoto_search())-1; }
	de.caption_new=$("[de_showPhoto_count="+count_now+"]").attr("caption");
	de.comment_new=$("[de_showPhoto_count="+count_now+"]").attr("comment");
	de.width_new=$("[de_showPhoto_count="+count_now+"]").attr("n_width");
	de.height_new=$("[de_showPhoto_count="+count_now+"]").attr("n_height");
	de.src_new=$("[de_showPhoto_count="+count_now+"]").attr("src");
	de.src_new=de.src_new.replace(de.str,de.replace);
	showPhoto_count(count_now);
	showPhoto_about(de.caption_new,de.comment_new);
	$('<img>').load(function(){
		showPhoto_insert(de.src_new,count_now,de.width_new,de.height_new);
		$("#"+de.dialogId).animate({
			'top':showPhoto_xy(de.width_new,de.height_new).top,
			'left':showPhoto_xy(de.width_new,de.height_new).left
		},500,"linear",function(){ showPhoto_displayControls(); });
	}).attr('src',de.img_src);
}
function showPhoto_count(count) {
	de.c=intval(count); de.c++;
	$("#"+de.headerCountId).html("Фотография "+de.c+" из "+showPhoto_search());
}
function showPhoto_about(caption,comment) {
	if (caption==undefined) { caption=""; } 
	$("#"+de.aboutCaptionId).html(caption);
	if (comment==undefined) { comment=""; } 
	$("#"+de.aboutCommentId).html(comment);
}
function showPhoto_search() { de.count=0;
	$(de.area).find('img').each(function(){ 
		$(this).attr("de_showPhoto_count",de.count); de.count++;
		de.src_small=$(this).attr("src");
		de.src_large=de.src_small.replace(de.str,de.replace);
	});
	return de.count;
}
function showPhoto_wrapper() {
	de.code='<div id="'+de.dialogId+'Dement"></div><div id="'+de.wallId+'"></div><div id="'+de.dialogId+'">';
	de.code+=showPhoto_config();
	if (de.header=="TRUE") { 
		de.code+='<div id="'+de.headerId+'">';
		de.code+=showPhoto_codeHeader();
		de.code+='</div>';
	}
	de.code+='<div id="'+de.contentId+'"></div>';
	if (de.about=="TRUE") { 
		de.code+='<div id="'+de.aboutId+'">';
		de.code+=showPhoto_codeAbout();
		de.code+='</div>';
	}
	de.code+='</div>';
	if (de.close=="TRUE") { 
		de.code+='<div id="'+de.closeId+'"><a href="#de"></a></div>'; 
	}
	if (de.control=="TRUE") { 
		de.code+='<div id="'+de.controlId+'">';
		de.code+=showPhoto_codeControls("play");
		de.code+='</div>';
	}
	document.body.innerHTML+=de.code;
	$("#"+de.configId).css({'display':'none'});
}
function showPhoto_insert(de_src,de_count,n_width,n_height) {
	de.code='<img ';
	de.code+='src="'+de_src+'" '; 
	de.code+='align="center" ';
	if (n_width!=undefined) { de.code+='width="'+n_width+'" '; }
	if (n_height!=undefined) { de.code+='height="'+n_height+'" '; }
	de.code+='de_showPhoto_count="'+de_count+'" ';
	de.code+='>';
	$('#'+de.contentId).html(de.code);
}
function showPhoto_xy(width,height){
	de.documentHeight=deGetDocumentSize().height; de.documentWidth=deGetDocumentSize().width;
	de.screenHeight=deGetScreenSize().height; de.screenWidth=deGetScreenSize().width;
	de.scrollTop=deGetScrollSize().top; de.scrollLeft=deGetScrollSize().left;
    de.mDialog=$('#'+de.dialogId);  de.wall=$('#'+de.wallId);
    
    if (width==undefined) {
		de.mDialogWidth=$("#"+de.contentId+" img").width();
		if (de.mDialogWidth==0) { de.mDialogWidth=de.mDialog.width(); }
	} else { de.mDialogWidth=width; }

    if (height==undefined) {
		de.mDialogHeight=$("#"+de.contentId+" img").height(); 
		if (de.mDialogHeight==0) { de.mDialogHeight=de.mDialog.height(); }
	} else { de.mDialogHeight=height; }
	if (de.center=="FALSE") { de.mDialogLeft=de.scrollLeft; } else { de.mDialogLeft=(de.screenWidth-de.mDialogWidth)/2+de.scrollLeft; }
	if (de.middle=="FALSE") { de.mDialogTop=de.scrollTop; } else { de.mDialogTop=(de.screenHeight-de.mDialogHeight)/2+de.scrollTop; }
	
	$("#"+de.headerId).width(de.mDialogWidth);
	$("#"+de.aboutId).width(de.mDialogWidth);
	$("#"+de.aboutCommnetId).width(de.mDialogWidth);
	de.top=de.mDialogTop;
	de.left=de.mDialogLeft;
	return {top:de.top,left:de.left,h:de.screenHeight,w:de.screenWidth,sT:de.scrollTop,sL:de.scrollLeft,dW:de.mDialogWidth,dH:de.mDialogHeight};
}
function showPhoto_position() {
	de.documentHeight=deGetDocumentSize().height; de.documentWidth=deGetDocumentSize().width;
	de.screenHeight=deGetScreenSize().height; de.screenWidth=deGetScreenSize().width;
	de.scrollTop=deGetScrollSize().top; de.scrollLeft=deGetScrollSize().left;
    de.mDialog=$('#'+de.dialogId);  de.wall=$('#'+de.wallId); 
    de.mDialog.css({'display': 'none'}); de.wall.css({'display': 'none'});		
	de.wallHeight=de.screenHeight+de.scrollTop; de.wallWidth=de.screenWidth+de.scrollLeft; de.wall.width(de.documentWidth); de.wall.height(de.documentHeight);
}
function showPhoto_init() {
    if (de.id==undefined) {de.id="showPhoto";}
    if (de.middle==undefined) {de.middle="FALSE";}
    if (de.center==undefined) {de.center="TRUE";}
    if (de.area==undefined) {de.area="#primary";}
    if (de.event==undefined) {de.event="click";}
    if (de.effect==undefined) {de.effect="OpacityEffect";}
    if (de.before==undefined) {de.before="10";}
    if (de.str==undefined) {de.str="";}
    if (de.replace==undefined) {de.replace="";}
    if (de.width==undefined) {de.width="auto";}
    if (de.height==undefined) {de.height="auto";}
    if (de.dialogBorder==undefined) {de.dialogBorder="#fff solid 10px";}
    if (de.dialogZindex==undefined) {de.dialogZindex="100";}
    if (de.dialogOpacity==undefined) {de.dialogOpacity="95";}
    if (de.flag==undefined) {de.flag="FALSE";}
    if (de.speed==undefined) {de.speed="1";}
    if (de.delay==undefined) {de.delay="2000";}
    if (de.padding==undefined) {de.padding="0";}
    if (de.margin==undefined) {de.margin="10px 0 0 0";}
    if (de.dialogId==undefined) {de.dialogId=de.id;}
    if (de.dialogBackground==undefined) {de.dialogBackground="#fff";}
    if (de.contentAlign==undefined) {de.contentAlign="center";}
    if (de.contentId==undefined) {de.contentId=de.dialogId+'Content';}
    if (de.wallBackground==undefined) {de.wallBackground="#000000";}
    if (de.wallVisible==undefined) {de.wallVisible="TRUE";}
    if (de.wallOpacity==undefined) {de.wallOpacity="50";}
    if (de.wallId==undefined) {de.wallId=de.dialogId+'Wall';}
    if (de.closeId==undefined) {de.closeId=de.dialogId+'_close';}
    if (de.close==undefined) {de.close='FALSE';}
    if (de.configId==undefined) {de.configId=de.dialogId+'_config';}
    if (de.header==undefined) {de.header='TRUE';}
    if (de.headerId==undefined) {de.headerId=de.dialogId+"_header";}
    if (de.headerCountId==undefined) {de.headerCountId=de.dialogId+"_headerCountId";}
    if (de.headerCloseId==undefined) {de.headerCloseId=de.dialogId+"_headerCloseId";}
    if (de.about==undefined) {de.about='TRUE';}
    if (de.aboutId==undefined) {de.aboutId=de.dialogId+"_about";}
    if (de.aboutCaptionId==undefined) {de.aboutCaptionId=de.dialogId+"_aboutCaptionId";}
    if (de.aboutCommentId==undefined) {de.aboutCommentId=de.dialogId+"_aboutcommentId";}
    if (de.control==undefined) {de.control="TRUE";}
    if (de.controlId==undefined) {de.controlId=de.dialogId+"_conrtol";}
    if (de.controlPosition==undefined) {de.controlPosition="top";}
    if (de.prevId==undefined) {de.prevId=de.controlId+"_prev";}
    if (de.nextId==undefined) {de.nextId=de.controlId+"_next";}
    if (de.playId==undefined) {de.playId=de.controlId+"_play";}
    if (de.pauseId==undefined) {de.pauseId=de.controlId+"_pause";}
    if (de.controlBtnCl==undefined) {de.controlBtnCl=de.controlId+"_cl";}
    if (de.imgPath==undefined) {de.imgPath="http://www.dement.ru/!lib/deShowPhoto/img/";}
    if (de.prevSrc==undefined) {de.prevSrc=de.imgPath+"prev.png";}
    if (de.nextSrc==undefined) {de.nextSrc=de.imgPath+"next.png";}
    if (de.playSrc==undefined) {de.playSrc=de.imgPath+"play.png";}
    if (de.pauseSrc==undefined) {de.pauseSrc=de.imgPath+"pause.png";}
    if (de.closeSrc==undefined) {de.closeSrc=de.imgPath+"close.png";}
    if (de.prevBg==undefined) {de.prevBg="url("+de.prevSrc+") no-repeat center";}
    if (de.nextBg==undefined) {de.nextBg="url("+de.nextSrc+") no-repeat center";}
    if (de.playBg==undefined) {de.playBg="url("+de.playSrc+") no-repeat center";}
    if (de.pauseBg==undefined) {de.pauseBg="url("+de.pauseSrc+") no-repeat center";}
    if (de.closeBg==undefined) {de.closeBg="url("+de.closeSrc+") no-repeat center";}
}
function showPhoto_css() {
	$('#'+de.dialogId).css({
	'position':'absolute',
	'display':'none',
	'float':'left',
	'top':showPhoto_xy().top,
	'left':showPhoto_xy().top,
	'width':de.width,
	'height':de.height,
	'padding':de.padding,
	'margin':de.margin,
	'border':de.dialogBorder,
	'z-index':de.dialogZindex,
	'background':de.dialogBackground
	});
	$('#'+de.contentId).css({
	'display':'block',
	'float':'left',
	'width':'auto',
	'height':'auto',
	'clear':'both',
	'text-align':de.contentAlign
	});
	$('#'+de.wallId).css({
	'position':'absolute',
	'display':'none',
	'float':'left',
	'top':'0',
	'left':'0',
	'background':de.wallBackground,
	'z-index':(de.dialogZindex-1)
	});
	$('#'+de.wallId).height(deGetDocumentSize().height);
	$('#'+de.wallId).width(deGetDocumentSize().width);
}
function showPhoto_cssAbout() {
	$('#'+de.aboutId).css({
	'display':'block',
	'float':'left',
	'width':'auto',
	'height':'auto',
	'clear':'both',
	'padding':'10px 0 5px 0'
	});
	$('#'+de.aboutCaptionId).css({
	'font-family':'Verdana, Sans-Serif',
	'font-size':'18px',
	'color':'#333',
	'display':'block',
	'float':'left',
	'height':'auto',
	'clear':'both',
	'text-decoration':'none'
	});
	$('#'+de.aboutCommentId).css({
	'font-family':'Verdana, Sans-Serif',
	'font-size':'12px',
	'color':'#000',
	'display':'block',
	'float':'left',
	'width':'auto',
	'height':'auto',
	'clear':'both',
	'padding':'2px 0 0 0',
	'text-decoration':'none'
	});
}
function showPhoto_cssHeader() {
	$('#'+de.headerId).css({
	'display':'block',
	'float':'left',
	'width':'inherit',
	'height':'auto',
	'padding':'1px 0 7px 0'
	});
	$('#'+de.headerCountId).css({
	'font-family':'Verdana, Sans-Serif',
	'font-size':'12px',
	'color':'#333',
	'display':'block',
	'float':'left',
	'height':'auto',
	'text-decoration':'none'
	});
	$('#'+de.headerCloseId).css({
	'font-family':'Verdana, Sans-Serif',
	'font-size':'12px',
	'color':'#036',
	'display':'block',
	'float':'right',
	'height':'auto',
	'text-decoration':'underline'
	});
}
function showPhoto_cssControls() {
	$('#'+de.closeId).css({
	'position':'absolute',
	'display':'none',
	'float':'left',
	'top':'2px',
	'right':'32px',
	'width':'auto',
	'height':'auto',
	'margin':'0',
	'padding':'0',
	'z-index':(de.dialogZindex+10)
	});
	$('#'+de.closeId+' a').css({
	'display':'block',
	'float':'left',
	'width':'30px',
	'height':'30px',
	'margin':'0',
	'padding':'0',
	'background':de.closeBg,
	'outline':'none',
	'border':'none'
	});
	$('#'+de.controlId).css({
	'position':'absolute',
	'display':'none',
	'float':'left',
	'width':'84px',
	'height':'28px',
	'left':'50%',
	'margin':'0 0 0 -42px',
	'background':'none',
	'z-index':(de.dialogZindex+10)
	});
	$('.'+de.controlBtnCl+' a').css({
	'display':'block',
	'float':'left',
	'width':'28px',
	'height':'28px',
	'margin':'0',
	'outline':'none',
	'border':'none'
	});
	$('#'+de.prevId+' a').css({ 'background':de.prevBg });	
	$('#'+de.nextId+' a').css({ 'background':de.nextBg });	
	$('#'+de.playId+' a').css({ 'background':de.playBg });	
	$('#'+de.pauseId+' a').css({'background':de.pauseBg});	
}
return de;}
});





