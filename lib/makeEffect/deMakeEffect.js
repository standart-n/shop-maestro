// Dement.ru				 
										 
var deMakeEffect = jQuery.Class.create({ 
										 
  init: function(deParent_id,			// ������������ ���� � ������� ��������� ��� ��� 		 
				 deObject_html,			// html ��� �����, ������� �� ����� ����������� 
				 deSubject_id_open,		// ������ � �������� ���������� ������� ��������� 		 
				 deEvent_open,			// ������� ��������� 	 
				 deEffect_open,			// ������ ��������� 	 
				 deSubject_id_close,	// ������ � �������� ���������� ������� ������� 		 
				 deEvent_close,			// ������� ������� 	 
				 deEffect_close,		// ������ ������� 		 
				 deSpeed,				// �������� ��������  
				 dePosition,			// ���������������� ������������� ����� 
				 deTop,					// ������ ������ 
				 deLeft,				// ������ ����� 
				 deWidth,				// ������ 
				 deHeight,				// ������  
				 deVisible,				// ���������� ��� ��� ��� �������� �������� 
				 deZindex,				// ���-������ 
				 deObject_id,			// id ������������ �����
				 deTimeBefore			// ����� �� ������ �������  
				 ){						 
										
  
$(document).ready(function () {		
															// ���������� ��� ����� � ��� ���������� � ��������� � ������������ ��� 
	deParent=document.getElementById(deParent_id);			
	deParent.innerHTML=deParent.innerHTML+'<div id="'+deObject_id+'Dement"></div><div id="'+deObject_id+'">'+deObject_html+'</div>';

	deMakeEffect_css();									
	if (deVisible=="visible") {
		moveDiv=$('#'+deObject_id);  				
		moveDiv.css({'display': 'block'});
	} else {
		moveDiv=$('#'+deObject_id);  				
		moveDiv.css({'display': 'none'});
	}
});														

$('#'+deSubject_id_open).live(deEvent_open, function(){   		
														 	// ������ ��������� ������� ��� ��� ������� ���� �� ����� 	
 if ($('#'+deObject_id).is(":hidden")) { 
  $('#'+deObject_id+'Dement').animate({top: '1px'},deTimeBefore,"linear",function(){

	deMakeEffect_css();											
											
	deShowEffect('#'+deObject_id,deEffect_open,deSpeed);			

  });																
 }

});


$('#'+deSubject_id_close).live(deEvent_close, function(){				
															// ������ ������� ������� ��� ������� ������� � ���� ��������� ���� �� ��� ��������� �� ������
 if ($('#'+deObject_id).is(":visible")) { 
	deShowEffect('#'+deObject_id,deEffect_close,deSpeed);

	$('#'+deObject_id+'Dement').animate({top: '1px'},deSpeed,"linear",function(){	
		deMakeEffect_css();
		  });																
 }

});

  $('#'+deSubject_id_open).live("mouseover", function(e){  	

	$('#'+deSubject_id_open).css({'cursor': 'pointer'});		// ������ ������ ����

  });

  $('#'+deSubject_id_close).live("mouseover", function(e){  	

	$('#'+deSubject_id_close).css({'cursor': 'pointer'});		// ������ ������ ����

  });




function deMakeEffect_css() { 
														// ���������� 
	moveDiv=$('#'+deObject_id);  				
	moveDiv.css({'position': dePosition});
	moveDiv.css({'display': 'none'});
	moveDiv.css({'float': 'left'});
	moveDiv.css({'top': deTop});
	moveDiv.css({'left': deLeft});
	moveDiv.height(deHeight);
	moveDiv.width(deWidth);
	moveDiv.css({'z-index': deZindex});
}



	return "Dement.ru";						
  }				// 2010 ��� "��������-�"


});	

