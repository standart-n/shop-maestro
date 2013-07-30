// Dement.ru				 
										
var dePhotoEffect = jQuery.Class.create({  // ����������� ���������� ������ �����
									    
										
  init: function(deParentDiv_id,		 //	������������ ��� (��� � ������� ����� �������� HTML ��� 
				 deImage_path,			 // ���� � �������� � ����������� ����������
				 deEventStart,			 // ������� ����� �������� ���������� ��������	
				 deEventFinish,			 // ������� �� �������� ������������� ��������������
				 deScrollLeft,			 // ��������� �������������� ������	
				 deScrollTop,			 // ��������� ������������ ������
				 deWidth,				 // WIDTH
				 deHeight,				 // HEIGHT
				 deReturnScroll,		 //	���������� ��� ��� ������ �� ��������� �����������
				 deZindex,				 // Z-index	
				 deMoveDiv_id			 // id div ���� � ����������� ����������
				 ){				
				 
  
$(document).ready(function () {			

	deParentDiv=document.getElementById(deParentDiv_id);				// ������� ������������ ��� � ��������� � ���� ����������� ��� HTML ��� 
	deParentDiv.innerHTML=deParentDiv.innerHTML+'<div id="'+deMoveDiv_id+'Dement"></div><div id="'+deMoveDiv_id+'"></div>';

	dePhotoEffect_css();													// ������������� ��� ���������� ��� ������ ������ 
	$('#'+deParentDiv_id).scrollLeft(deScrollLeft);    						// ������������� ��������� ������ �������		
	$('#'+deParentDiv_id).scrollTop(deScrollTop);
	deFlag="false"; 

});

$('#'+deMoveDiv_id).live("mouseover", function(e){  	

	$('#'+deMoveDiv_id).css({'cursor': 'move'});		// ������ ������ ����

});
																		

$('#'+deMoveDiv_id).live(deEventStart, function(){   	// �������� ��� ��������� ������� :
														// �������� ������������ �������� ������������ �� �������


	dePhotoEffect_css();								// ��� ��� ��� ���������					
	deFlag="true"; 										// ��������� ���� : �������������� �������� 			
	$('#'+deMoveDiv_id).css({'cursor': 'move'});		// ������ ������ ����

});


$('#'+deMoveDiv_id).live("mousemove", function(e){ 						

    $('#'+deParentDiv_id).stop();
	parentDiv=$('#'+deParentDiv_id);  									
	moveDiv=$('#'+deMoveDiv_id);  									
													// ��� ����������� �������� �������������� ����� ��������� �������� ������� ���. ����������			
	if (deFlag=="true") {								// ���� ���� ������ �� �������������� �������� ������� 
	
		xpos=(e.pageX-parentDiv.offset().left)*(moveDiv.width()-parentDiv.width())/(parentDiv.width());	// ����������� ����� ��������		
		ypos=(e.pageY-parentDiv.offset().top)*(moveDiv.height()-parentDiv.height())/(parentDiv.height()); 
		parentDiv.scrollLeft(xpos);    								
		parentDiv.scrollTop(ypos);

		/*
		animSpeed=Math.sqrt(Math.pow(((parentDiv.width()/2)-(e.pageX-parentDiv.offset().left))/10,2)+Math.pow(((parentDiv.height()/2)-(e.pageY-parentDiv.offset().top))/10,2))/deSpeed;
		parentDiv.animate({
			scrollLeft: xpos,
			scrollTop: ypos
			}, 
			animSpeed,
			"linear",
			function(){
			}
		);*/

		parentDiv.css({'cursor': 'move'});				// ������ ������ ����
	}
	
});


$('#'+deMoveDiv_id).live(deEventFinish, function(){						
	
    $('#'+deParentDiv_id).stop();
	deFlag="false"; 									// �������� ����
	dePhotoEffect_css();								// �������� ����������
	
	if (deReturnScroll=="TRUE") {						// ���� ����� �� ���������� ��������� �������� ������� 
		$('#'+deParentDiv_id).scrollLeft(deScrollLeft);    								
		$('#'+deParentDiv_id).scrollTop(deScrollTop);
	}


});



function dePhotoEffect_css() { 

	moveDiv=$('#'+deMoveDiv_id);  										// ��������� ��� ���������� ��� �������� ������ ������������� ���������� 
	moveDiv.css({'position': 'absolute'});
	moveDiv.css({'display': 'block'});
	moveDiv.css({'float': 'left'});
	moveDiv.css({'top': '0px'});
	moveDiv.css({'left': '0px'});
	moveDiv.css({'background': 'url('+deImage_path+') no-repeat center'});
	moveDiv.height(deHeight);
	moveDiv.width(deWidth);
	moveDiv.css({'z-index': deZindex});
	
	
	parentDiv=$('#'+deParentDiv_id);
	parentDiv.css({'overflow': 'hidden'});				 			
	parentDiv.css({'cursor': 'auto'});								
}



	return "Dement.ru";												
  }				// 2010 ��� "��������-�"


});	



