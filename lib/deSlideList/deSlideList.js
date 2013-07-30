/*standart-n*/
var slideList=jQuery.Class.create({		
init: function(de){ $(document).ready(function(){ 
	de.list=0; slideList_init(); slideList_css(); slideList_size();
});
function slideList_size(){ de.width=0; de.height=0; de.maxList=0;
	$('#'+de.ulId).find('li').each(function(){ de.width+=($(this).width()); de.height+=($(this).height()); de.maxList++; }); 
	if (de.type=="h") {
		$('#'+de.boxId).scrollLeft(0);
	}
	if (de.type=="v") { 
		$('#'+de.boxId).scrollTop(0);
	}
}
$('#'+de.boxId).live("mousemove",function(e){
	if (de.type=="h") {
		de.offsetLeft=intval($('#'+de.boxId).offset().left);
		de.boxWidth=intval($('#'+de.boxId).width());
		de.lastLi=$('#'+de.ulId).find('li:last-child');
		de.lastoffset=de.lastLi[0].offsetLeft; de.lastouter=de.lastLi.outerWidth();
		de.ulWidth=intval(de.lastoffset+de.lastouter);
		de.left=intval((e.pageX-de.offsetLeft)*(de.ulWidth-de.boxWidth)/(de.boxWidth));
		$('#'+de.boxId).scrollLeft(de.left);
	}
	if (de.type=="v") {
		de.offsetTop=intval($('#'+de.boxId).offset().top);
		de.boxHeight=intval($('#'+de.boxId).height());
		de.lastLi=$('#'+de.ulId).find('li:last-child');
		de.lastoffset=de.lastLi[0].offsetTop; de.lastouter=de.lastLi.outerHeight();
		de.ulHeight=intval(de.lastoffset+de.lastouter);
		//de.ulHeight=de.lastLi[0].offsetTop+de.lastLi.outerHeight();
		de.top=intval((e.pageY-de.offsetTop)*(de.ulHeight-de.boxHeight)/(de.boxHeight));
		$('#'+de.boxId).scrollTop(de.top);
	}
});
 
function slideList_css(){
	$('#'+de.boxId).css({
	'position':'relative',
	'display':'block',
	'float':'left',
	'width':de.slideWidth+'px',
	'height':de.slideHeight+'px',
	'border':de.border,
	'background':de.background,
	'overflow':'hidden'
	});
	$('#'+de.ulId).css({
	'padding':'0',
	'margin':'0',
	'list-style':'none'
	});
	$('#'+de.ulId+' li').css({
	'float':'left',
	'padding':'0',
	'margin':'0',
	'border':'none'
	});
	if (de.type=="h") {
		$('#'+de.ulId).css({'width':de.maxWidth+'px'});
		$('#'+de.ulId).css({'height':'auto'});
	}
	if (de.type=="v") { 
		$('#'+de.ulId).css({'width':'auto'});
		$('#'+de.ulId).css({'height':de.maxHeight+'px'});
	}
}
function slideList_init(){
    if (de.boxId==undefined) {de.boxId="box_slidelist";}
    if (de.ulId==undefined) {de.ulId="ul_slidelist";}
    if (de.type==undefined) {de.type="v";}
    if (de.maxWidth==undefined) {de.maxWidth="50000";}
    if (de.maxHeight==undefined) {de.maxHeight="50000";}
    if (de.slideWidth==undefined) {de.slideWidth="640";}
    if (de.slideHeight==undefined) {de.slideHeight="480";}
    if (de.border==undefined) {de.border="none";}
    if (de.background==undefined) {de.background="none";}
}												
return "Dement.ru";	}
});
