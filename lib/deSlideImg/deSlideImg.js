/*standart-n*/
var slideImg=jQuery.Class.create({		
init: function(de){ $(document).ready(function(){ 
	de.list=0; inc=1; slideImg_init(); slideImg_html(); slideImg_css(); slideImg_width(); slideImg_dots(); checkLinks(); de.list=-1; slideShow(); 
});
slideShow=function() { 
	de.flag=$("#de_slideImg_flag").val();
	if (de.flag=="FALSE") { 
		de.list=intval(de.list)+intval(inc); checkList(intval(de.list)); setTimeout("slideShow();",intval($("#de_slideImg_delay").val())); 
	} 
}
$('#'+de.boxId+'Left').live("click", function(){ if (intval(de.list)>0) { $("#de_slideImg_flag").val("TRUE"); de.list=intval(de.list)-1; checkList(de.list); } });
$('#'+de.boxId+'Right').live("click", function(){ if ((intval(de.list))<intval(de.maxList-1)) { $("#de_slideImg_flag").val("TRUE"); de.list++; checkList(de.list); } });
$('#'+de.divId+'Dots a').live("click", function(){ $("#de_slideImg_flag").val("TRUE"); str=this.id; id=str.split("_"); de.list=id[(id.length)-1]; checkList(de.list); });
function clearDots() { $('#'+de.divId+'Dots a').css({'background':de.dotBg}); }
function slideImg_width(){ de.width=0; de.maxList=0;
	$('#'+de.ulId).find('li').each(function(){ de.width+=($(this).width()); de.maxList++; }); 
	$('#'+de.ulId).css({'width':de.width+'px'}); $('#'+de.divId).scrollLeft(0);
}
function slideImg_html(){ 
	de.code=$("#"+de.boxId).html();
	de.code+='<a id="'+de.boxId+'Left" class="'+de.boxId+'Link" href="#de"></a>';
	de.code+='<a id="'+de.boxId+'Right" class="'+de.boxId+'Link" href="#de"></a>';
	de.code+=slideImg_config();
	$("#"+de.boxId).html(de.code);
}
function slideImg_config() { de.conf="";
	de.conf+='<div id="'+de.configId+'"><form>';
	de.conf+='<input type="hidden" id="de_slideImg_delay" value="'+de.delay+'">';
	de.conf+='<input type="hidden" id="de_slideImg_flag" value="'+de.flag+'">';
	de.conf+='</form></div>';
	return de.conf;
}
function checkLinks() { 
	if (intval(de.list)<=0) { inc=1; $('#'+de.boxId+'Left').css({'background':'none'}); } else { $('#'+de.boxId+'Left').css({'background':de.leftBg}); }
	if ((intval(de.list))>=intval(de.maxList-1)) { inc=-1; $('#'+de.boxId+'Right').css({'background':'none'}); } else { $('#'+de.boxId+'Right').css({'background':de.rightBg}); }
}
function checkList(n_list) { clearDots(); checkLinks();
	de.scrollLeft=intval((n_list)*de.slideWidth);
	$('#'+de.divId).animate({scrollLeft:de.scrollLeft},de.speed);
	$('#'+de.divId+"_"+n_list).css({'background':de.dotBgAct});				 			
}
function slideImg_dots() { 
	de.code=$("#"+de.boxId).html();
	de.code+='<div id="'+de.divId+'Dots"><div id="'+de.divId+'DotBox">';
	for(i=0;i<de.maxList;i++) { de.code+='<a id="'+de.divId+"_"+i+'" href="#de"></a>'; } 
	de.code+='</div></div>';
	$("#"+de.boxId).html(de.code);
	
	$('#'+de.divId+'Dots').css({
	'position':'relative',
	'display':'block',
	'float':'left',
	'width':de.slideWidth+"px",
	'height':'auto',
	'padding':'0 0 0 0',
	'margin':'0',
	'top':de.dotTop,
	'left':de.dotLeft,
	'z-index':'200',
	'text-align':de.dotAlign
	});
	$('#'+de.divId+'DotBox').css({
	'display':'block',
	'float':'left',
	'margin':de.dotMargin,
	'padding':'0'
	});				 			
	$('#'+de.divId+'Dots a').css({
	'display':'block',
	'float':'left',
	'width':de.dotWidth+"px",
	'height':de.dotHeight+"px",
	'padding':de.dotPadding,
	'margin':'0',
	'border':'none',
	'outline':'none',
	'background':de.dotBg
	});
	$('#'+de.divId+"_"+de.list).css({
	'background':de.dotBgAct
	});
}
function slideImg_css(){
	$('#'+de.boxId).css({
	'display':'block',
	'float':'left',
	'width':de.slideWidth+'px',
	'height':de.slideHeight+'px',
	'border':de.boxBorder,
	'margin':'0',
	'padding':'0',
	'background':de.boxBg
	});
	$('#'+de.divId).css({
	'display':'block',
	'float':'left',
	'width':de.slideWidth+'px',
	'height':de.slideHeight+'px',
	'margin':'0',
	'padding':'0',
	'overflow':'hidden'
	});
	$('#'+de.ulId).css({
	'display':'block',
	'float':'left',
	'width':'3000px',
	'height':'auto',
	'padding':'0',
	'margin':'0',
	'list-style':'none'
	});
	$('#'+de.ulId+' li').css({
	'display':'block',
	'float':'left',
	'padding':'0',
	'margin':'0',
	'width':de.slideWidth+'px',
	'height':de.slideHeight+'px',
	'border':'none'
	});
	$('#'+de.ulId+' li a').css({
	'display':'block',
	'float':'left',
	'padding':'0',
	'margin':'0',
	'width':de.slideWidth+'px',
	'height':de.slideHeight+'px',
	'border':'none',
	'ouline':'none'
	});
	$('#'+de.ulId+' li a img').css({
	'margin':'0',
	'padding':'0',
	'border':'none',
	'ouline':'none'
	});				 			
	$('.'+de.boxId+'Link').css({
	'position':'relative',
	'top':de.linkTop,
	'display':'block',
	'width':de.linkWidth,
	'height':de.linkHeight,
	'border':'none',
	'outline':'none',
	'z-index':de.linkZindex
	});
	$('#'+de.boxId+'Left').css({
	'float':de.leftFloat,
	'background':de.leftBg
	});
	$('#'+de.boxId+'Right').css({
	'float':de.rightFloat,
	'background':de.rightBg
	});
}
function slideImg_init(){
    if (de.flag==undefined) {de.flag="FALSE";}
    if (de.boxId==undefined) {de.boxId="box_slideshow";}
    if (de.divId==undefined) {de.divId="div_slideshow";}
    if (de.ulId==undefined) {de.ulId="ul_slideshow";}
    if (de.configId==undefined) {de.configId=de.boxId+"_config";}
    if (de.speed==undefined) {de.speed="150";}
    if (de.delay==undefined) {de.delay="3000";}
    if (de.linear==undefined) {de.linear="linear";}
    if (de.boxBg==undefined) {de.boxBg="none";}
    if (de.boxBorder==undefined) {de.boxBorder="none";}
    if (de.slideWidth==undefined) {de.slideWidth="400";}
    if (de.slideHeight==undefined) {de.slideHeight="200";}
    if (de.linkTop==undefined) {de.linkTop="-"+(de.slideHeight/2)+"px";}
    if (de.linkWidth==undefined) {de.linkWidth="32px";}
    if (de.linkHeight==undefined) {de.linkHeight="32px";}
    if (de.leftFloat==undefined) {de.leftFloat="left";}
    if (de.rightFloat==undefined) {de.rightFloat="right";}
    if (de.linkZindex==undefined) {de.linkZindex="300";}
    if (de.leftBg==undefined) {de.leftBg="url(http://www.dement.ru/!lib/deSlideImg/img/left.png) no-repeat center";}
    if (de.rightBg==undefined) {de.rightBg="url(http://www.dement.ru/!lib/deSlideImg/img/right.png) no-repeat center";}
    if (de.dotTop==undefined) {de.dotTop="-60px";}
    if (de.dotLeft==undefined) {de.dotLeft=(de.slideWidth/2)+"px";}
    if (de.dotWidth==undefined) {de.dotWidth="16";}
    if (de.dotHeight==undefined) {de.dotHeight="16";}
    if (de.dotPadding==undefined) {de.dotPadding="0 5px 0 0";}
    if (de.dotMargin==undefined) {de.dotMargin="0 0 0 -40px";}
    if (de.dotBg==undefined) {de.dotBg='url(http://www.dement.ru/!lib/deSlideImg/img/dot.png) no-repeat center';}    
    if (de.dotBgAct==undefined) {de.dotBgAct='url(http://www.dement.ru/!lib/deSlideImg/img/dot_act.png) no-repeat center';}    
    if (de.dotAlign==undefined) {de.dotAlign="center";}
}												
return de;}
});
