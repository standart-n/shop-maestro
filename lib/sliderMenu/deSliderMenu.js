// Dement.ru				 
										
var deSliderMenu = jQuery.Class.create({  // 
									    
  init: function(deParentDiv_id,		 // id div'a � �������	
				 deObjectStart,			 // ������ ��� �������	
				 deEventStart,			 // ������� �� �������� ����������� �������
				 deObjectFinish,		 // ������ ��� �������		
				 deEventFinish,			 // ������� �� �������� ����������� �������
				 deSpeed,				 // �������� �������
				 dePosition,			 // ���������������� ������� "��������"
				 deLeft,				 // ��������� : ������ �����	
				 deTop,					 // ������ ������ 	
				 deCap_textOFF,			 // ���������� ��� �������� ������� 	
				 deCap_textON,			 // ���������� ��� �������� ������� 	
				 deCap_width,			 // ������ ��������� ��������	
				 deCap_height,			 // ��� ������
				 deTab_text,			 // �������� ���������� ��������	
				 deTab_width,			 // ������ ��������  	
				 deTab_height,			 // ������ ��������
				 deTab_background,		 // ���������	
				 deTab_border,			 // �������
				 deOpen,				 // ��������� ��������� :������� ��� �������  
				 deZindex,				 // css z-index 	
				 deSlider			     // id ���� �������� 
				 ){				
				 
  
$(document).ready(function () {			

	//document.body.innerHTML+='<div id="'+deSlider+'Dement"></div><div id="'+deSlider+'"><div id="'+deSlider+'Cap">'+deCap_text+'</div><div id="'+deSlider+'Tab">'+deTab_text+'</div></div>'			
	// ��������� html ��� � ������ ��� 
	document.getElementById(deParentDiv_id).innerHTML+='<div id="'+deSlider+'Dement"></div><div id="'+deSlider+'"><div id="'+deSlider+'Cap"></div><div id="'+deSlider+'Tab">'+deTab_text+'</div></div>';			

	deSliderBlock_css();								// ������������� ��� ���������� ��� ������ ������� 

});																		

$('#'+deSlider+'Cap').live('mouseover', function(){

	$('#'+deSlider+'Cap').css({'cursor': 'pointer'});		// ������ ������ ����

});

$('#'+deSlider+'Cap').live('mouseleave', function(){

	$('#'+deSlider+'Cap').css({'cursor': 'auto'});			// ������ ������ ����

});


$(deObjectFinish).live(deEventFinish, function(){   	// ������� �������� 

	 if ($('#'+deSlider+'Tab').is(":visible")) {  // ���� ������ 
		$('#'+deSlider+'Tab').slideUp(deSpeed);   // �������� 
		document.getElementById(deSlider+'Cap').innerHTML=deCap_textOFF; // ������ ����� ��������� 
//		$('#'+deSlider+'Cap').css({'background': deCap_backgroundOFF});  // ������ ������ ��� 
//		$('#'+deSlider+'Cap').css({'border': deCap_borderOFF});  // ������ ������� 
	 }

});


$(deObjectStart).live(deEventStart, function(){ // ��������� �������� 						

	 if ($('#'+deSlider+'Tab').is(":hidden")) {
		$('#'+deSlider+'Tab').slideDown(deSpeed);
		document.getElementById(deSlider+'Cap').innerHTML=deCap_textON;
//		$('#'+deSlider+'Cap').css({'background': deCap_backgroundON}); 
//		$('#'+deSlider+'Cap').css({'border': deCap_borderON}); 
	}

});




function deSliderBlock_css() { 

	slider=$('#'+deSlider);				 		// ������� ��� 	
	slider.css({'position': dePosition});
	slider.css({'display': 'block'});
	slider.css({'float': 'left'});
	slider.css({'top': deTop});
	slider.css({'left': deLeft});
	slider.css({'width': 'auto'});
	slider.css({'height': 'auto'});
	slider.css({'z-index': deZindex});

	slider=$('#'+deSlider+'Cap');				// ��� � ����������  			
	slider.css({'display': 'block'});
	slider.css({'float': 'left'});
	slider.css({'width': deCap_width});
	if (deCap_height!="auto") {
		slider.css({'line-height': deCap_height});
	}
	slider.css({'height': deCap_height});
	if (deOpen=="ON") {
//		slider.css({'background': deCap_backgroundON}); 
//		slider.css({'border': deCap_borderON});
		document.getElementById(deSlider+'Cap').innerHTML=deCap_textON;
	} else {
//		slider.css({'background': deCap_backgroundOFF}); 
//		slider.css({'border': deCap_borderOFF});
		document.getElementById(deSlider+'Cap').innerHTML=deCap_textOFF;
	}
	
	slider=$('#'+deSlider+'Tab');			// ��� ������� ������� ��� ���������� 	 			
	slider.css({'display': 'block'});
	slider.css({'float': 'left'});
	slider.css({'width': deTab_width});
	slider.css({'height': deTab_height});
	slider.css({'border': deTab_border});
	slider.css({'background': deTab_background});
	slider.css({'clear': 'both'});
	slider.css({'overflow': 'hidden'});

	if (deOpen=="OFF") {					// ���� ���������� ������� ����� �� �������� ��� 
		$('#'+deSlider+'Tab').css({'display': 'none'});
		$('#'+deSlider+'Tab').slideUp(1);
	}

}



	return "Dement.ru";												
  }				// 2010 ��� "��������-�"


});	



