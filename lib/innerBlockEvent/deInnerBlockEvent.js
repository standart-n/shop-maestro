// Dement.ru				 
										 
var deInnerBlockEvent = jQuery.Class.create({ 
										 
  init: function(deTarget_id,			// id ������� �� ������� ��������� �������
				 deEvent,				// ������� ��� ������� ����� �������� HTML ��� 
				 deParent_id,			// ������������ ���� � ������� ��������� ���
				 deObject_html,			// html ��� ������� ����� ��������
				 deParam				// after     before     place	
				 ){						 
										
  
$(document).ready(function () {		

  $('#'+deTarget_id).live(deEvent, function(){   

	deParent=document.getElementById(deParent_id);		// ����� ������������ ����	

	if (deParam=="after") {								// ���� ��������� ������ �����
		deParent.innerHTML=deParent.innerHTML+deObject_html;
	}
	if (deParam=="before") {							// ���� ��������� ������� �����	
		deParent.innerHTML=deObject_html+deParent.innerHTML;
	}
	if (deParam=="place") {								// ���� �������� ��� ���������� �����
		deParent.innerHTML=deObject_html;
	}

  });														

  $('#'+deTarget_id).live("mouseover", function(e){  	

	$('#'+deTarget_id).css({'cursor': 'pointer'});		// ������ ������ ����

  });




});														

	return "Dement.ru";						
  }				// 2010 ��� "��������-�"


});	

