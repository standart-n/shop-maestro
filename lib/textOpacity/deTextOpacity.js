// Dement.ru				 
										
var deTextOpacity = jQuery.Class.create({  // ��������� �������������� ���� ������� 
									    
  init: function(deTargetDiv_id,		 // id div'a � �������	
				 deEventStart,			 // ������� ����� �������� ���������� ��������	
				 deEventFinish,			 // ������� �� �������� ������������� ��������������
				 deSpeed,				 // ������� �� �������� ������������� ��������������
				 deTextOpSt,			 // ��������� �������������� ������	
				 deTextOpFn,			 // ��������� ������������ ������
				 deBackOpSt,			 // ��������� �������������� ������	
				 deBackOpFn,			 // ��������� ������������ ������
				 deBackground,			 // ���� � �������� � ����������� ����������
				 deZindex,				 // Z-index	
				 deBackDiv_id			 // id div ���� � ����������� ����������
				 //deTimeBefore			 // ����� �������� �������� �� ������ ������� 	
				 ){				
				 
  
$(document).ready(function () {			

	//document.getElementById(deParentDiv_id).innerHTML+='<div id="'+deBackDiv_id+'Dement"></div><div id="'+deBackDiv_id+'"></div>'			
	//document.body.innerHTML+='<div id="'+deBackDiv_id+'Dement"></div><div id="'+deBackDiv_id+'"></div>';
	deText=$('#'+deTargetDiv_id).parent().html();
	$('#'+deTargetDiv_id).parent().html('<div id="'+deBackDiv_id+'Dement"></div><div id="'+deBackDiv_id+'"></div>'+deText);
	deTextOpacity_css();								// ������������� ��� ���������� ��� ������ ������� 
		//deShowOpacitySlow('#'+deTargetDiv_id,deTextOpSt,deTextOpFn,deSpeed);
		//alert('js');
	deFlag="OFF";

});																		

$('#'+deBackDiv_id).live(deEventStart, function(){   	// �������� ��� ��������� ������� :

//	if(deFlag=="OFF") {
		deShowOpacitySlow('#'+deTargetDiv_id,deTextOpSt,deTextOpFn,deSpeed);
		deShowOpacitySlow('#'+deBackDiv_id,deBackOpFn,deBackOpSt,deSpeed);
		deFlag="ON";
//	}
});

$('#'+deTargetDiv_id).live(deEventStart, function(){   	// �������� ��� ��������� ������� :

//	if(deFlag=="OFF") {
		deShowOpacitySlow('#'+deTargetDiv_id,deTextOpSt,deTextOpFn,deSpeed);
		deShowOpacitySlow('#'+deBackDiv_id,deBackOpFn,deBackOpSt,deSpeed);
		deFlag="ON";
//	}
});


$('#'+deBackDiv_id).live(deEventFinish, function(){						
	
//	if(deFlag=="ON") {
		deShowOpacitySlow('#'+deTargetDiv_id,deTextOpFn,deTextOpSt,deSpeed);
		deShowOpacitySlow('#'+deBackDiv_id,deBackOpSt,deBackOpFn,deSpeed);
		deFlag="OFF";
//	}
});

$('#'+deTargetDiv_id).live(deEventFinish, function(){						
	
//	if(deFlag=="ON") {
		deShowOpacitySlow('#'+deTargetDiv_id,deTextOpFn,deTextOpSt,deSpeed);
		deShowOpacitySlow('#'+deBackDiv_id,deBackOpSt,deBackOpFn,deSpeed);
		deFlag="OFF";
//	}
});


function deTextOpacity_css() { 

	$('#'+deTargetDiv_id).css({'z-index': (deZindex+1)});				 			
	deWidth=$('#'+deTargetDiv_id).width();
	deHeight=$('#'+deTargetDiv_id).height();
	//deTop=deGetObjectPagePos(deTargetDiv_id).top;
	//deLeft=deGetObjectPagePos(deTargetDiv_id).left;
	deTop=$('#'+deTargetDiv_id).css('top');
	deLeft=$('#'+deTargetDiv_id).css('left');
	//deWidth=$('#'+deTargetDiv_id).css('width');
	//deHeight=$('#'+deTargetDiv_id).css('height');
	dePadding=$('#'+deTargetDiv_id).css('padding');
	deMargin=$('#'+deTargetDiv_id).css('margin');
	deBorder=$('#'+deTargetDiv_id).css('border');

	backDiv=$('#'+deBackDiv_id);  
	backDiv.css({'position': 'absolute'});
	backDiv.css({'display': 'block'});
	backDiv.css({'float': 'left'});
	backDiv.css({'top': deTop});
	backDiv.css({'left': deLeft});
	backDiv.css({'padding': dePadding});
	backDiv.css({'margin': deMargin});
	backDiv.css({'border': deBorder});
	//backDiv.css({'width': deWidth});
	//backDiv.css({'height': deHeight});
	backDiv.width(deWidth);
	backDiv.height(deHeight);
	backDiv.css({'background': deBackground});
	backDiv.css({'z-index': deZindex});
	deShowOpacitySharp('#'+deTargetDiv_id,deTextOpSt);		
 	deShowOpacitySharp('#'+deBackDiv_id,deBackOpFn);		
	
}



	return "Dement.ru";												
  }				// 2010 ��� "��������-�"


});	



