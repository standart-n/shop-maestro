// Dement.ru				 
										 
var deInnerBlock = jQuery.Class.create({ 
										 
  init: function(deParent_id,			// ������������ ���� � ������� ��������� ���
				 deObject_html,			// html ��� ������� ����� ��������
				 deParam				// after     before     place	
				 ){						 
										
  
$(document).ready(function () {		
															
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

	return "Dement.ru";						
  }				// 2010 ��� "��������-�"


});	

