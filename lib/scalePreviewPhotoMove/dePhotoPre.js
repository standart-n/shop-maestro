			// Dement.ru				 
										 // ��� ������ ����� ����� �������� ��� �� ��� � js ����  ( ��� ��������)  					
var dePhotoPre = jQuery.Class.create({   // ������ ����� ��������� ����� � ���������� ��� ����������, ����������� ������������ ������ �������� � ������ ���������� 
									     // ����� ��� � ������ ����������� ������ ������� ������� ��������� �� ����� ���� �������, ��� ��������� ����������� �� ������� 
										 // � ���������� ��� ������� � ����� ��������� de  - ��� ������ ��� ��������� ������� dement.ru 
  init: function(deParentDiv_id,		 //	������������ ��� (��� � ������� ����� �������� HTML ��� 
				 deImage_id,			 // id �������� ��� ��������� �� ������� ���������� ������ 
				 deImage_path,			 // ���� � �������� � ����������� ����������
				 deEffect,				 // ��� ������� ��������� �������
				 deSpeed,				 // �������� ����� �������� ��������� 
				 dePosition,			 // POSITION - ���������������� ����� (CSS)
				 deTop,					 // TOP  - ������������ ������. ��������� (CSS)
				 deLeft,				 // LEFT
				 deWidth,				 // WIDTH
				 deHeight,				 // HEIGHT
				 deZindex,				 // Z-index	
				 deBorder,				 // Border 	
				 deMoveDiv_id,			 // id div ���� � ����������� ����������
				 deMoveImg_id,			 // id img �������� ������. ���������
				 deTimeBefore			 // ����� ����� ��������� ���� ���������� ��� ������� �� �������� (���������� � 10��) 
				 ){						 // ����������� �������� � ���������� � �������� 
				 
				 						//  !!! ����� �������� ������������ var !!! 
										//      � ����� ��� ����� �������� � ���������� �����������, ����� ����� �� ����� 
										//		������� ��� ������������ ������������� ������ ������ �� �������� + ���������� �� ����� ��������. 
  
$(document).ready(function () {			// ������� ��������� �������� ��� �������� ��������

	deParentDiv=document.getElementById(deParentDiv_id);				// ������� ������������ ��� � ��������� � ���� ����������� ��� HTML ��� 
	deParentDiv.innerHTML=deParentDiv.innerHTML+'<div id="'+deMoveDiv_id+'Dement"></div><div id="'+deMoveDiv_id+'"><img id="'+deMoveImg_id+'" align="center" src="'+deImage_path+'"></div>';

	dePhotoPre_css();													// ������������� ��� ���������� ��� ������ ������ (������� ������ ������� �����)

});																		// ������ ������� �������� ��� �������� 

$('#'+deImage_id).live("mouseover", function(){   						// �������� ��� ��������� ����� �� �������� 

  $('#'+deMoveDiv_id+'Dement').animate({top: '1px'},deTimeBefore,"linear",function(){		// ������ �������� ����� ��������� ����� ���������� ��� �������

	dePhotoPre_css();													// ��������� 
											
	deShowEffect('#'+deMoveDiv_id,deEffect,deSpeed);					// ������ ���������


  });																

$('#'+deImage_id).live("mouseover", function(e){  	

	$('#'+deImage_id).css({'cursor': 'pointer'});		// ������ ������ ����

});

$('#'+deImage_id).live("mousemove", function(e){ 						// �������� ����� ������� ����� ����� �� ����

	staticImg=$('#'+deImage_id);										// ��������� ���������� � �������� ������ 	
	moveImg=$('#'+deMoveImg_id);
	moveDiv=$('#'+deMoveDiv_id);  									
	$('#'+deImage_id).css({'cursor': 'pointer'});		// ������ ������ ����
																	
	//deShowEffect('#'+deMoveDiv_id,deEffect,deSpeed);

		staticImgWidth=staticImg.width(); 									// ��������� ��������� ��������
		staticImgHeight=staticImg.height();
		moveImgWidth=moveImg.width();   					 				// ��������� ������������ ��������
		moveImgHeight=moveImg.height();
		leftStep=staticImgWidth/2; 											// ������� ��� ������������ �������� �� ������
		topStep=staticImgHeight/2;

		yConst=moveImgHeight/staticImgHeight;
		xConst=moveImgWidth/staticImgWidth;   							// ��������� ���� �������� 
	
		xpos=(e.pageX-staticImg.offset().left)*xConst-leftStep;			// ���������� ����������� �������� 
		ypos=(e.pageY-staticImg.offset().top)*yConst-topStep; 
	
		moveDiv.scrollLeft(xpos);    									// ������ ������ ���� (�������� �������� )
		moveDiv.scrollTop(ypos);

});


$('#'+deImage_id).live("mouseout", function(){							// �������� ��� ����� ����� � ���� 
	
	deShowEffect('#'+deMoveDiv_id,deEffect,deSpeed);

	$('#'+deMoveDiv_id+'Dement').animate({top: '1px'},deSpeed,"linear",function(){		// ������ �������� ����� ��������� ����� ���������� ��� �������
		dePhotoPre_css();
		  });																

});



});


function dePhotoPre_css() { 

	moveDiv=$('#'+deMoveDiv_id);  										// ��������� ��� ���������� ��� ������ ������. ��������� 
	moveDiv.css({'position': dePosition});
	moveDiv.css({'display': 'none'});
	moveDiv.css({'float': 'left'});
	moveDiv.css({'top': deTop});
	moveDiv.css({'left': deLeft});
	//moveDiv.css({'width': deWidth});
	//moveDiv.css({'height': deHeight});
	moveDiv.height(deHeight);
	moveDiv.width(deWidth);
	moveDiv.css({'border': deBorder});
	moveDiv.css({'z-index': deZindex});
	moveDiv.css({'overflow': 'hidden'});				 				// �������� ������ 
}



	return "Dement.ru";													// ������ �������
  }				// 2010 ��� "��������-�"


});	



